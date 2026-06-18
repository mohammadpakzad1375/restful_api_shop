@extends('mails.layouts.master')

@section('title', 'تخفیف جدید')

@section('content')

    <h2 style="margin:0 0 20px 0;color:#111827;font-size:24px;">
        🎉کد تخفیف جدید فعال شد
    </h2>

    <p style="margin:0 0 20px 0;color:#4b5563;line-height:2;">
        مشتری گرامی{{ $copan->user->full_name }} عزیز،
        <br>
        یک تخفیف جدید در فروشگاه فعال شده است و می‌توانید از آن در سفارش‌های خود استفاده کنید.
    </p>

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>کد تخفیف:</strong>
                {{ $copan->code }}
            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>میزان تخفیف:</strong>
                @if($copan->amount_type == 'percentage')
                    {{ $copan->amount }}٪
                @else
                    {{ $copan->amount }}تومان
                @endif

            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>شروع تخفیف:</strong>
                {{ jalaliDate($copan->start_date) }}
            </td>
        </tr>

        <tr>
            <td style="padding:15px;">
                <strong>پایان تخفیف:</strong>
                {{ jalaliDate($copan->end_date) }}
            </td>
        </tr>


    </table>

    <p style="margin:25px 0 0 0;color:#4b5563;line-height:2;">
        فرصت را از دست ندهید و قبل از پایان زمان تخفیف، سفارش خود را ثبت کنید.
    </p>


@endsection
