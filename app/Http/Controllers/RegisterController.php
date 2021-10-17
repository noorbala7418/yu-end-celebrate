<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Models\Anjoman;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Student;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RegisterController extends Controller
{

  public function index()
  {
    $anjomans = Anjoman::query()->get();
    // $foods = Fee::query()->where('type', '=', Fee::TYPE_FOOD)->get();
    // $tandis = Fee::query()->where('type', '=', Fee::TYPE_GIFT)->where('product', '=', 'تندیس')->get();

    // return view('welcome', compact(['anjomans', 'foods', 'tandis']));
    return view('welcome', compact(['anjomans']));
  }

  public function prepareData(Request $data)
  {

    $code = Fee::query()->where('type', '=', Fee::TYPE_CODE)->get()->first();

    if ($code->product != $data->regcode) {
      return back()->withErrors(['msg' => 'کد ثبت‌نام درست نیست. دوباره تلاش کنید.']);
    }

    $data->validate([
      'name' => 'required|string|min:3',
      'family' => 'required|string|min:3',
      'mobile' => 'required|string|min:10|max:11',
      'stdID' => 'required|unique:students,stdID|digits_between:7,8',
      'anjoman' => 'required|exists:anjomans,id',
      //'hamrahan' => 'required|digits_between:0,14',
      'launch' => 'required|digits_between:0,15',
      'dinner' => 'required|digits_between:0,15'
    ]);

    $anjoman =  Anjoman::query()->findOrFail($data->anjoman);
    $freePlace = $anjoman->total_people - $anjoman->used_people;

    if ($freePlace == 0) {
      return back()->withErrors(['msg' => 'ظرفیت این رشته تکمیل شده است. لطفا دوباره تلاش نکنید.']);
    }

    // if ($data->hamrahan + 1 > $freePlace) {
    //   return back()->withErrors([
    //     'msg' => "تعداد رزرو مورد نظر شما از مقدار باقی مانده بیشتر است. تعداد باقی مانده: ${freePlace}"
    //   ]);
    // }

    return $this->calculateBill($data);
  }


  public function calculateBill(Request $request)
  {
    $anjoman = Anjoman::query()->findOrFail($request->anjoman);
    if ($request->exists('tandis')) {
      $tandisFee = Fee::query()
        ->where('type', '=', Fee::TYPE_GIFT)
        ->where('product', '=', 'تندیس')
        ->get()
        ->first(function ($value, $key) {
          return $value;
        });
    }
    // $hamrahanFee = (int)($anjoman->hamrahan_price);
    $food = Fee::query()
      ->where('type', '=', Fee::TYPE_FOOD)
      ->get()
      ->first();

    $col = collect([
      'person_price' => (int)$anjoman->person_price,
      // 'hamrah_price' => $hamrahanFee * (int)$this->convert2english($request->hamrahan), // mohasebe nerkh hamrahan
      'launch_price' => (int)$food->amount * (int)$this->convert2english($request->launch), // mohasebe food
      'dinner_price' => (int)$food->amount * (int)$this->convert2english($request->dinner) // mohasebe food
    ]);

    if ($request->exists('tandis')) {
      $col->put('tandis_price', (int)$tandisFee->amount); // price of tandis
    }

    $bill = $col->sum();
    $col->put('bill', $bill);

    $newPay = Payment::create([
      'name' => $request->name,
      'family' => $request->family,
      'stdID' => (int)$this->convert2english($request->stdID),
      'mobile' => (int)$this->convert2english($request->mobile),
      'bill' => $col->get('bill'),
      'anjoman_id' => (int)$request->anjoman,
      'hamrahan' => 0,
      // 'hamrahan' => (int)$this->convert2english($request->hamrahan),
      'tandis' => $request->exists('tandis'),
      'launchs' => (int)$this->convert2english($request->launch),
      'dinners' => (int)$this->convert2english($request->dinner)
    ]);


    if ($request->exists('tandis')) {
      return view('confirm', compact(['newPay', 'col', 'anjoman', 'tandisFee', 'food']));
    } else {
      return view('confirm', compact(['newPay', 'col', 'anjoman', 'food']));
    }
  }

  public function payment($id)
  {
    $payment = Payment::query()->findOrFail($id);
    $payment->update([
      'order_id' => $id + 100000,
      'person_confirmed' => true
    ]);


    // request to idpay for receiving info
    $request = Toman::orderId($payment->order_id)
      ->amount($payment->bill)
      ->description(Config::get('app.name'))
      ->name($payment->name . ' - ' . $payment->family)
      ->callback(route('main-confirm'))
      ->mobile($payment->mobile)
      ->request();

    if ($request->successful()) {
      // Store created transaction details for verification
      $transactionId = $request->transactionId();
      $transactionURL = $request->paymentUrl();

      $payment->link = $transactionURL;
      $payment->transaction_id = $transactionId;
      $payment->save();

      // Redirect to payment URL
      return $request->pay();
    }

    if ($request->failed()) {
      // Handle transaction request failure.
      $failedPay = $payment->order_id;
      return view('failed-payment', compact(['failedPay']));
      Log::error('ERROR IN PAYMENT FUNCTION = ', $request);
    }
  }


  public function confirmPayment(CallbackRequest $request)
  {
    $payment = $request->verify();

    if ($payment->successful()) {
      // Store the successful transaction details

      $referenceId = $payment->referenceId();
      $transactionId = $payment->transactionId();

      $confirmPayment = Payment::query()
        ->where('transaction_id', '=', $transactionId)->get()->first();


      $confirmPayment->reference_id = $referenceId;
      $confirmPayment->status_code = $payment->status();
      $confirmPayment->is_paid = true;
      $confirmPayment->save();

      $anjoman = Anjoman::query()->findOrFail($confirmPayment->anjoman_id);
      $anjoman->update([
        'used_people' => $anjoman->used_people + 1
        // 'used_people' => $anjoman->used_people + $confirmPayment->hamrahan + 1
      ]);

      $this->createStudent($confirmPayment);
      return view('success-payment', compact(['referenceId']));
    }

    if ($payment->alreadyVerified()) {
      $referenceId = $payment->referenceId();

      return view('already-paid-payment', compact(['referenceId']));
    }

    if ($payment->failed()) {
      $failedPay = $payment->orderID();
      return view('failed-payment', compact(['failedPay']));
    }
  }

  private function createStudent(Payment $payment)
  {
    Student::query()->create([
      'anjoman_id' => $payment->anjoman_id,
      'payment_id' => $payment->id,
      'stdID' => $payment->stdID,
      'name' => $payment->name,
      'family' => $payment->family,
      'mobile' => $payment->mobile,
      'hamrahan' => $payment->hamrahan,
      'tandis' => $payment->tandis,
      'launchs' => $payment->launchs,
      'dinners' => $payment->dinners,
      'bill' => $payment->bill
    ]);
  }

  public function getReport($name)
  {
    if ($name == "YazdUniGetReport1400") { // TODO: This is a messy! Should be clean in next version
      return Excel::download(new StudentsExport, 'stds.xlsx');
    }
    return redirect('/');
  }

  function convert2english($string)
  {
    $newNumbers = range(0, 9);
    // 1. Persian HTML decimal
    $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
    // 2. Arabic HTML decimal
    $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
    // 3. Arabic Numeric
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    // 4. Persian Numeric
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    $string =  str_replace($persianDecimal, $newNumbers, $string);
    $string =  str_replace($arabicDecimal, $newNumbers, $string);
    $string =  str_replace($arabic, $newNumbers, $string);
    return str_replace($persian, $newNumbers, $string);
  }
}
