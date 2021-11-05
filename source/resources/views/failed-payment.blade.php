@extends('layouts.app')

@section('content')
    <div class="col-md-8 py-5 border" dir="rtl">
        <div class="text-center">
            <p>ضمن تبریک فارغ التحصیلی شما؛</p>
            <h3 style="color: red">پرداخت بامشکل مواجه شد.</h3>
            <p>لطفا دوباره تلاش کنید.</p>
            <br>
            <div class="alert alert-danger" role="alert">
                <p>شماره تراکنش: {{ $failedPay }}</p>
            </div>
        </div>
    </div>
@endsection