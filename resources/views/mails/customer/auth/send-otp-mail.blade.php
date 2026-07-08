@extends('mails.layouts.master')

@section('title', 'تخفیف جدید')

@section('content')

    <h2 style="margin:0 0 20px 0;color:#111827;font-size:24px;">
        کد ورود به فروشگاه
    </h2>

    <p style="margin:0 0 20px 0;color:#4b5563;line-height:2;">
        Code: {{$otp}}
        <br>
        برای دیگران نفرستید
    </p>


@endsection
