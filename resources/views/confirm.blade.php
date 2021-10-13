<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Config::get('app.name') }}</title>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vazir-font/30.1.0/font-face.css"
        integrity="sha512-ZHFuHiK3EA1uh2tx7nB0j9HyXR/IAFW24KVNFGjY8QIjtDKHmcowjUyObXF40wYrG25+kECHEbH8rL+HbvRwYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <style>
        body {
            font-family: 'Vazir'
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        img {
            width: 100%;
        }

        #app {
            direction: rtl;
        }

        ::-webkit-input-placeholder {
            text-align: center;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            text-align: center;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            text-align: center;
        }

        :-ms-input-placeholder {
            text-align: center;
        }

        .clear {
            clear: both;
        }

    </style>
</head>

<body>
    <div class="container " id="app">
        <div class="row">
            <!-- Information Section -->
            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <a href="{{ route('home') }}">
                            <img src="https://yazd.ac.ir/UI/Styles/Default/images/logo.png" style="width:90%">
                        </a>
                        <br>
                        <h2 class="py-3">{{ \Config::get('app.name') }}</h2>
                        <br>
                        <p>
                            ۲۸ مهر لغایت ۲ آبان ۱۴۰۰
                        </p>
                        <br>
                        <p>
                            تماس با ما: <strong dir="ltr"> 0905 743 4161</strong>
                        <p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border" dir="rtl">
                <h6 class="pb-4" style="text-align: center">مرور نهایی</h4>
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


                        <div class="form-row">
                            <div class="form-group col-md-6 text-right">
                                <label for="name">تعداد همراهان (هرنفر: {{ $anjoman->hamrahan_price }} تومان):
                                </label>
                            </div>
                            <div class="form-group col-md-6 text-center">
                                <p>{{ $newPay->hamrahan }} نفر</p>
                                <p style="color: green">مجموعا: {{ $col->get('hamrah_price') }} تومان</p>
                            </div>
                        </div>

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

                            <a href="{{ route('home') }}" id="back" class="btn btn-warning col-md-3"
                                style="margin: 0 auto;">
                                انصراف
                            </a>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="clear"></div>
    <br><br><br><br><br><br><br><br>

    <div>
        <script src="https://static.idpay.ir/trust.js?id=87512173&width=64" style="position: fixed; bottom: 0px; right: 0px;">
        </script>
    </div>

    <footer class="bg-light text-center text-lg-start" id="footer">
        <!-- Copyright -->
        <div class="text-center p-3">
            <div class="text-dark">Copyright &copy; {{ config('app.name') . ' ' . date('Y') }} </div>
            <div class="text-muted">
                <p style="font-size: 10px;">Programmer: Noorbala7418</p>
            </div>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>
