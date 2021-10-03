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
    $tandis = Fee::query()->where('type', '=',Fee::TYPE_GIFT)->where('product','=','تندیس')->get();
    return view('welcome', compact(['anjomans', 'foods', 'tandis']));
  }

  public function prepareData(Request $data)
  {
    $data->validate([
      'name' => 'required|string|min:3',
      'family' => 'required|string|min:3',
      'mobile' => 'required|string|min:10|max:11',
      // 'stdID' => 'required|unique:students,stdID|digits:7',
      // 'anjoman' => 'required|exsits:anjoman,id'
    ]);

    $orderID = random_int(100, 9999);

    $request = Toman::orderId($orderID)
      ->amount(env('Amount'))
      ->description('جشن فارغ التحصیلی ۱۴۰۰')
      ->name($data->name . $data->family)
      ->callback(route('confirm'))
      ->mobile($data->mobile)
      // ->email($data->email)
      ->request();

    if ($request->successful()) {
      // Store created transaction details for verification
      $transactionId = $request->transactionId();
      $transactionURL = $request->paymentUrl();

      // $newPay = Payment::create([
      //   'name' => $data->name,
      //   'family' => $data->family,
      //   'stdID' => $data->stdID,
      //   'mobile' => $data->mobile,
      //   'email' => $data->email,
      //   'order_id' => $orderID,
      //   'link' => $transactionURL,
      //   'transaction_id' => $transactionId
      // ]);

      // dd($request);
      // Log::info('TRANSACTION = '.$request->paymentUrl());

      // Redirect to payment URL
      return $request->pay();
    }

    if ($request->failed()) {
      // Handle transaction request failure.
      dd($request);
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

  // public function test()
  // {
  //   Anjoman::create([
  //     'name' => ,
  //      'person_price' => , 'hamrahan_price' => , 'total_people' => , 'used_people' => 
  //   ]);
  // }
}
