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
      'hamrahan' => 'required|digits_between:0,14',
      'launch' => 'required|digits_between:0,15',
      'dinner' => 'required|digits_between:0,15'
    ]);

    $anjoman =  Anjoman::query()->findOrFail($data->anjoman);
    $freePlace = $anjoman->total_people - $anjoman->used_people;

    if ($freePlace == 0) {
      return back()->withErrors(['msg' => 'ظرفیت این رشته تکمیل شده است. لطفا دوباره تلاش نکنید.']);
    }

    if ($data->hamrahan + 1 > $freePlace) {
      return back()->withErrors([
        'msg' => "تعداد رزرو مورد نظر شما از مقدار باقی مانده بیشتر است. تعداد باقی مانده: ${freePlace}"
      ]);
    }

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
    $hamrahanFee = (int)($anjoman->hamrahan_price);
    $food = Fee::query()
      ->where('type', '=', Fee::TYPE_FOOD)
      ->get()
      ->first();

    $col = collect([
      'person_price' => (int)$anjoman->person_price,
      'hamrah_price' => $hamrahanFee * $request->hamrahan, // mohasebe nerkh hamrahan
      'launch_price' => (int)$food->amount * $request->launch, // mohasebe food
      'dinner_price' => (int)$food->amount * $request->dinner // mohasebe food
    ]);

    if ($request->exists('tandis')) {
      $col->put('tandis_price', (int)$tandisFee->amount); // price of tandis
    }

    $bill = $col->sum();
    $col->put('bill', $bill);

    $orderID = random_int(100, 100000);

    $newPay = Payment::create([
      'name' => $request->name,
      'family' => $request->family,
      'stdID' => $request->stdID,
      'mobile' => $request->mobile,
      'email' => $request->email,
      'order_id' => $orderID,
      'bill' => $col->get('bill'),
      'anjoman_id' => (int)$request->anjoman,
      'hamrahan' => $request->hamrahan,
      'tandis' => $request->exists('tandis'),
      'launchs' => $request->launch,
      'dinners' => $request->dinner
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
      'person_confirmed' => true
    ]);


    // request to idpay for receiving info
    $request = Toman::orderId($payment->order_id)
      ->amount($payment->bill)
      ->description(Config::get('app.name'))
      ->name($payment->name . ' - ' . $payment->family)
      ->callback(route('confirm'))
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
        'used_people' => $anjoman->used_people + $confirmPayment->hamrahan + 1
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
}
