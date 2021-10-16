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
                <div class="text-center">
                    <p>ضمن تبریک فارغ التحصیلی شما؛</p>
                    <h3 style="color: green">پرداخت با موفقیت انجام شد.</h3>
                    <br>
                    <div class="alert alert-success" role="alert">
                        <p>شماره مرجع: {{ $referenceId }}</p>
                    </div>
                </div>
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
