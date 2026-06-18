@extends('mails.layouts.master')

@section('title', $email->subject)

@section('content')

    <h2 style="margin-top:0;color:#1f2937;font-size:24px;">
        {{ $email->subject }}
    </h2>

    <div style="width:60px;height:4px;background:#2563eb;margin:20px 0;"></div>

    <div style="color:#4b5563;font-size:15px;line-height:2;">
        {!! nl2br(e($email->body)) !!}
    </div>

@endsection
