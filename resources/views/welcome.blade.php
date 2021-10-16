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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
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
                        </p>
                        <br>
                        <a href="{{ route('hamrah-home') }}" id="hamrah-page" class="btn"
                            style="margin: auto auto; background-color: #fff">
                            <p style="color: #000">
                                ثبت‌نام همراه در جشن
                            </p>
                        </a>
                    </div>
                </div>
            </div>
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

        </div>
        <div class="clear"></div>
        <br><br><br><br><br><br><br><br>
    </div>

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
