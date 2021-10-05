<?php

namespace App\Http\Controllers;

use App\Models\Anjoman;
use App\Models\Fee;
use App\Models\Payment;
use Evryn\LaravelToman\CallbackRequest;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

  public function index()
  {
    $anjomans = Anjoman::query()->get();
    $foods = Fee::query()->where('type', '=', Fee::TYPE_FOOD)->get();
    $tandis = Fee::query()->where('type', '=', Fee::TYPE_GIFT)->where('product', '=', 'تندیس')->get();
    return view('welcome', compact(['anjomans', 'foods', 'tandis']));
  }

  public function prepareData(Request $data)
  {

    $code = Fee::query()->where('type', '=', Fee::TYPE_CODE)->get()->first();

    if ($code->product != $data->regcode) {

      return back()->withErrors(['msg' => 'کد ثبت‌نام درست نیست. بعدا تلاش کنید.']);
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
    $food = Fee::query()->where('type', '=', Fee::TYPE_FOOD)->get()->first();

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

    $orderID = random_int(100, 9999);

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
      return view('confirm', compact('newPay', 'col', 'anjoman', 'tandisFee', 'food'));
    } else {
      return view('confirm', compact('newPay', 'col', 'anjoman', 'food'));
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
      ->description(env('APP_NAME'))
      ->name($payment->name . $payment->family)
      ->callback(route('confirm'))
      ->mobile($payment->mobile)
      ->request();

    if ($request->successful()) {
      // Store created transaction details for verification
      $transactionId = $request->transactionId();
      $transactionURL = $request->paymentUrl();

      $payment::query()->update([
        'link' => $transactionURL,
        'transaction_id' => $transactionId
      ]);

      // Redirect to payment URL
      return $request->pay();
    }

    if ($request->failed()) {
      // Handle transaction request failure.
      dd($request);
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
        ->where('transaction_id', '=', $transactionId)
        ->update([
          'reference_id' => $referenceId,
          'status_code' => $payment->status(),
          'is_paid' => true
        ]);
        // TODO: create student from pay object
        // create success page

      // dd('انجام شد', $transactionId, $payment, $payment->status());
    }

    if ($payment->alreadyVerified()) {
      // ...
      dd('انجام شده بود', $payment);

      // implement already paid page
    }

    if ($payment->failed()) {
      dd('انجام نشد', $payment);
      // implement failed page
      // باید شماره ی فاکتور و شماره تراکنش و تاریخ را نمایش بدهیم
      // ...
    }
  }

  private function createStudent(Payment $payment){}


  // public function test()
  // {
  //   Fee::create([
  //     'product' => 'ناهار - جوجه کباب', 'type' => Fee::TYPE_FOOD, 'unit' => 'پرس', 'amount' => '35000'
  //   ]);

  //   Fee::create([
  //     'product' => 'تندیس', 'type' => Fee::TYPE_GIFT, 'unit' => 'عدد', 'amount' => '50000'
  //   ]);

  //   Fee::create([
  //     'product' => 'شام - جوجه کباب', 'type' => Fee::TYPE_FOOD, 'unit' => 'پرس', 'amount' => '35000'
  //   ]);

  //   Fee::create([
  //     'product' => 'UNi1400YZD', 'type' => Fee::TYPE_CODE, 'unit' => 'عدد', 'amount' => '0'
  //   ]);
  // }
}
