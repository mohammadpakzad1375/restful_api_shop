@extends('mails.layouts.master')

@section('title', 'تخفیف جدید')

@section('content')

    <h2 style="margin:0 0 20px 0;color:#111827;font-size:24px;">
        🎉 تخفیف جدید فعال شد
    </h2>

    <p style="margin:0 0 20px 0;color:#4b5563;line-height:2;">
        مشتری گرامی،
        <br>
        یک تخفیف جدید در فروشگاه فعال شده است و می‌توانید از آن در سفارش‌های خود استفاده کنید.
    </p>

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>عنوان تخفیف:</strong>
                {{ $commonDiscount->title }}
            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>درصد تخفیف:</strong>
                {{ $commonDiscount->percentage }}٪
            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>شروع تخفیف:</strong>
                {{ jalaliDate($commonDiscount->start_date) }}
            </td>
        </tr>

        <tr>
            <td style="padding:15px;">
                <strong>پایان تخفیف:</strong>
                {{ jalaliDate($commonDiscount->end_date) }}
            </td>
        </tr>


    </table>

    <p style="margin:25px 0 0 0;color:#4b5563;line-height:2;">
        فرصت را از دست ندهید و قبل از پایان زمان تخفیف، سفارش خود را ثبت کنید.
    </p>


@endsection
