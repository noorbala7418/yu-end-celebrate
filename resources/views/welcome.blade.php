@extends('layouts.app')

@section('content')
<div class="col-md-8 py-5 border" dir="rtl">
    <h4 class="pb-4" style="text-align: right">لطفا مشخصات خود را با دقت وارد کنید.</h4>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <input id="Full Name" name="name" placeholder="نام" class="form-control" type="text"
                    required>
            </div>
            <div class="form-group col-md-6">
                <input id="Full Name" name="family" placeholder="نام خانوادگی" class="form-control"
                    type="text" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6" dir="ltr">
                <input id="Mobile" name="mobile" placeholder="شماره موبایل" class="form-control" required
                    type="text">

            </div>
            <div class="form-group col-md-6" dir="ltr">
                <input id="stdID" name="stdID" placeholder="شماره دانشجویی" class="form-control" required
                    type="text" max="8" min="7">

            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3" dir="rtl" style="text-align: right; padding-top:6px">
                <label for="anjoman"> رشته تحصیلی: </label>
            </div>
            <div class="form-group col-md-9">
                <select name="anjoman" class="form-control" required>
                    <option value="" selected>انتخاب کنید</option>
                    @foreach ($anjomans as $anjoman)
                        <option value="{{ $anjoman->id }}">{{ $anjoman->name }} - ظرفیت باقی مانده:
                            {{ $anjoman->total_people - $anjoman->used_people }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8" dir="rtl" style="text-align: right; padding-top:6px">
                <label for="anjoman">تعداد همراهان: </label>
            </div>
            <div class="form-group col-md-4" dir="ltr">
                <input id="hamrahan" name="hamrahan" placeholder="تعداد همراهان" class="form-control"
                    required type="number" max="14" min="0" value="0">

            </div>
        </div>

        {{-- <div class="form-row">
            <div class="form-group col-md-12" dir="rtl" style="text-align: right;">
                <p>غذاهای سرو شده:</p>
                <ul>
                    @foreach ($foods as $food)
                        <li>{{ $food->product . ' - ' . $food->amount }}</li>
                    @endforeach
                </ul>
            </div>
        </div> --}}


        <div class="form-row">
            <div class="form-group col-md-8" dir="rtl" style="text-align: right; padding-top:6px">
                <label for="launch">تعداد ناهار: </label>
            </div>
            <div class="form-group col-md-4" dir="ltr">
                <input id="launch" name="launch" class="form-control" placeholder="تعداد ناهار رزرو"
                    required type="number" max="15" min="0" value="0">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8" dir="rtl" style="text-align: right; padding-top:6px">
                <label for="dinner">تعداد شام: </label>
            </div>
            <div class="form-group col-md-4" dir="ltr">
                <input id="dinner" name="dinner" class="form-control" placeholder="تعداد شام رزرو"
                    required type="number" max="15" min="0" value="0">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8" dir="rtl" style="text-align: right; padding-top:6px">
                <label for="anjoman">تندیس می‌خواهم</label>
            </div>
            <div class="form-group col-md-4" dir="ltr">
                <input id="tandis" name="tandis" class="form-control" type="checkbox">
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-8 text-right" dir="rtl">
                <label for="regcode" class="text-right">کد ثبت‌نام:</label>
                <p style="color: red">توجه: درصورتیکه کد ثبت‌نام را ندارید، سیستم به شما خطا خواهد داد. </p>
            </div>
            <div class="form-group col-md-4" dir="ltr">
                <input id="regcode" name="regcode" placeholder="کد ثبت‌نام" class="form-control" required
                    type="text">
            </div>
        </div>

        <div class="form-row">
            <button type="submit" class="btn btn-success col-md-3" style="margin: 0 auto;">
                مرحله بعد
            </button>
        </div>
    </form>
</div>
@endsection