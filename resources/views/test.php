<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>

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

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        img {
            width: 100%;
        }

        #testimonial {
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

    </style>
</head>

<body>
    <section class="testimonial py-5" id="testimonial">
        <div class="container">
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
                <!-- Information Section -->
                <div class="col-md-4 py-5 bg-primary text-white text-center ">
                    <div class=" ">
                        <div class="card-body">
                            <img src="https://yazd.ac.ir/UI/Styles/Default/images/logo.png" style="width:90%">
                            <br>
                            <h2 class="py-3">{{ env('APP_NAME') }}</h2>
                            <br>
                            <p>
                                بیتوک | انجمن علمی مهندسی کامپیوتر</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 border" dir="rtl">
                    <h4 class="pb-4" style="text-align: right">لطفا مشخصات خود را وارد کنید.</h4>
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
                                <input id="Mobile" name="mobile" placeholder="شماره موبایل" class="form-control"
                                    required type="text">

                            </div>
                            <div class="form-group col-md-6" dir="ltr">
                                <input id="stdID" name="stdID" placeholder="شماره دانشجویی" class="form-control"
                                    required type="text" size="7">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="anjoman"> انجمن علمی: </label>
                            </div>
                            <div class="form-group col-md-11">
                                <select name="anjoman" class="form-control" required>
                                    <option value="" selected>انتخاب کنید</option>
                                    <option value="ce"> کامپیوتر</option>
                                    <option value="nasaji"> نساجی</option>
                                    <option value="sanaye"> صنایع</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3"></div>
                            <div class="form-group" style="margin: 0 auto;">
                                <h4>مبلغ ثبت‌نام: {{env('Amount')}} تومان</h4>
                            </div>
                            <div class="form-group col-md-3"></div>
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-success col-md-3"
                                style="margin: 0 auto;">پرداخت</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</body>

</html>
