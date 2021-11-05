@extends('layouts.app')

@section('content')
    <div class="col-md-8 py-5 border" dir="rtl">
        <div class="text-center">
            <p>ضمن تبریک فارغ التحصیلی شما؛</p>
            <h3 style="color: black">پرداخت قبلا انجام شده است.</h3>
            <br>
            <div class="alert alert-warning" role="alert">
                <p>شماره مرجع: {{ $referenceId }}</p>
            </div>
        </div>
    </div>
@endsection
