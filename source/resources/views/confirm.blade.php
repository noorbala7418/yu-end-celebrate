@extends('layouts.app')

@section('content')
    <div class="col-md-8 py-5 border" dir="rtl">
        <h4 class="pb-4" style="text-align: center">مرور نهایی</h4>
        <form method="POST" action="{{ route('pay', ['id' => $newPay->id]) }}">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-3 text-right">
                    <label for="name">نام و نام خانوادگی: </label>
                </div>
                <div class="form-group col-md-3 text-center">
                    <p>{{ $newPay->name . ' ' . $newPay->family }}</p>
                </div>


                <div class="form-group col-md-3 text-right">
                    <label for="name">شماره دانشجویی: </label>
                </div>
                <div class="form-group col-md-3 text-center">
                    <p>{{ $newPay->stdID }}</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3 text-right">
                    <label for="name">رشته: </label>
                </div>
                <div class="form-group col-md-3 text-center">
                    <p>{{ $anjoman->name }}</p>
                </div>

                <div class="form-group col-md-3 text-right">
                    <label for="name">شماره تماس: </label>
                </div>
                <div class="form-group col-md-3 text-center">
                    <p>{{ $newPay->mobile }}</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 text-right">
                    <label for="name">هزینه شرکت در مراسم برای شما: </label>
                </div>
                {{-- {{dd($col)}} --}}
                <div class="form-group col-md-6 text-center">
                    <p style="color: green">{{ $col->get('person_price') }} تومان</p>
                </div>
            </div>


            {{-- <div class="form-row">
                <div class="form-group col-md-6 text-right">
                    <label for="name">تعداد همراهان (هرنفر: {{ $anjoman->hamrahan_price }} تومان):
                    </label>
                </div>
                <div class="form-group col-md-6 text-center">
                    <p>{{ $newPay->hamrahan }} نفر</p>
                    <p style="color: green">مجموعا: {{ $col->get('hamrah_price') }} تومان</p>
                </div>
            </div> --}}

            <div class="form-row">
                <div class="form-group col-md-6 text-right">
                    <label for="name">تعداد ناهار رزرو شده (هر پرس: {{ $food->amount }} تومان): </label>
                </div>
                <div class="form-group col-md-6 text-center">
                    <p>{{ $newPay->launchs }} {{ $food->unit }}</p>
                    <p style="color: green">مجموعا: {{ $col->get('launch_price') }} تومان</p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 text-right">
                    <label for="name">تعداد شام رزرو شده (هر پرس: {{ $food->amount }} تومان): </label>
                </div>
                <div class="form-group col-md-6 text-center">
                    <p>{{ $newPay->dinners }} {{ $food->unit }}</p>
                    <p style="color: green">مجموعا: {{ $col->get('dinner_price') }} تومان</p>
                </div>
            </div>


            @if ($col->has('tandis_price'))
                <div class="form-row">
                    <div class="form-group col-md-6 text-right">
                        <label for="name">هزینه تندیس: </label>
                    </div>
                    <div class="form-group col-md-6 text-center">
                        <p style="color: green">{{ $col->get('tandis_price') }} تومان</p>
                    </div>
                </div>
            @endif


            <hr color="gray">

            <div class="form-row">
                <div class="form-group col-md-3"></div>
                <div class="form-group" style="margin: 0 auto;">
                    <p style="color: green">مبلغ کل: {{ $col->get('bill') }} تومان</p>
                </div>
                <div class="form-group col-md-3"></div>
            </div>

            <div class="form-row">
                <button type="submit" id="pay" class="btn btn-success col-md-3" style="margin: 0 auto;">
                    پرداخت
                </button>

                <a href="{{ route('home') }}" id="back" class="btn btn-warning col-md-3" style="margin: 0 auto;">
                    انصراف
                </a>
            </div>
        </form>
    </div>
@endsection
