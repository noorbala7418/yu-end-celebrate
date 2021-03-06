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
                            ???? ?????? ?????????? ?? ???????? ????????
                        </p>
                        <br>
                        <p>
                            ???????? ???? ????: <strong dir="ltr"> 123 456 7890</strong>
                        </p>
                        <br>
                        <a href="{{ route('hamrah-home') }}" id="hamrah-page" class="btn"
                            style="margin: auto auto; background-color: #fff">
                            <p style="color: #000">
                                ??????????????? ?????????? ???? ??????
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            @yield('content')

        </div>
        <div class="clear"></div>
        <br>
    </div>

    {{-- <!-- Trust LOGO -->
    <div style="position: fixed !important; left: 0px !important;">
        <script src="{{ \Config::get('toman.idpay.trust_logo_url') }}">
        </script> --}}
    </div>

    <div class="clear"></div>
    <br><br><br><br><br><br>
    
    <footer class="bg-light text-center text-lg-start" id="footer" style="position: fized">
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
