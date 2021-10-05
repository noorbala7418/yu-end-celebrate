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

    // dd($data->all());
    $data->validate([
      'name' => 'required|string|min:3',
      'family' => 'required|string|min:3',
      'mobile' => 'required|string|min:10|max:11',
      'stdID' => 'required|unique:students,stdID|digits:7',
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

    $hamrahanFee = (int)($anjoman->hamrahan_price);
    $foodFee = (int)(Fee::query()->findOrFail(1)->amount);

    $col = collect([
      'person_price' => (int)$anjoman->person_price,
      'hamrah_price' => $hamrahanFee * $request->hamrahan, // mohasebe nerkh hamrahan
      'launch_price' => $foodFee * $request->launch, // mohasebe food
      'dinner_price' => $foodFee * $request->dinner // mohasebe food
    ]);

    if ($request->exists('tandis')) {
      $tandisFee = Fee::query()
        ->where('type', '=', Fee::TYPE_GIFT)
        ->where('product', '=', 'تندیس')
        ->get()
        ->first(function ($value, $key) {
          return $value;
        });
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

    return view('confirm', compact('newPay', 'col'));
  }

  private function beforePayment()
  {

    // $newPay = Payment::create([
    //   'name' => $request->name,
    //   'family' => $request->family,
    //   'stdID' => $request->stdID,
    //   'mobile' => $request->mobile,
    //   'email' => $request->email,
    //   'order_id' => $orderID,
    //   'link' => $transactionURL,
    //   'transaction_id' => $transactionId
    // ]);
    // // $request = Toman::orderId($orderID)
    // //   ->amount(env('Amount'))
    // //   ->description('جشن فارغ التحصیلی ۱۴۰۰')
    // //   ->name($data->name . $data->family)
    // //   ->callback(route('confirm'))
    // //   ->mobile($data->mobile)
    // //   // ->email($data->email)
    // //   ->request();

    // // if ($request->successful()) {
    // //   // Store created transaction details for verification
    // //   $transactionId = $request->transactionId();
    // //   $transactionURL = $request->paymentUrl();



    // //   // dd($request);
    // //   // Log::info('TRANSACTION = '.$request->paymentUrl());

    // //   // Redirect to payment URL
    // //   return $request->pay();
    // }

    // if ($request->failed()) {
    //   // Handle transaction request failure.
    //   dd($request);
    // }
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
          'status_code' => $payment->status()
        ]);

      // dd('انجام شد', $transactionId, $payment, $payment->status());
    }

    if ($payment->alreadyVerified()) {
      // ...
      dd('انجام شده بود', $payment);
    }

    if ($payment->failed()) {
      dd('انجام نشد', $payment);
      // ...
    }
  }

  public function test()
  {
    // Fee::create([
    //   'product' => 'ناهار - جوجه کباب', 'type' => Fee::TYPE_FOOD, 'unit' => 'پرس', 'amount' => '35000'
    // ]);
  }
}
