@extends('mails.layouts.master')

@section('title', 'وضعیت پرداخت سفارش')

@section('content')

    <h2 style="margin:0 0 20px 0;color:#111827;font-size:22px;">
        تغییر وضعیت پرداخت سفارش
    </h2>

    <p style="margin:0 0 20px 0;color:#4b5563;line-height:2;">
        مشتری گرامی{{ $order->user->full_name }} عزیز،
        <br>
        وضعیت پرداخت سفارش شما به‌روزرسانی شده است.
    </p>

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>شماره سفارش:</strong>
                #{{ $order->code }}
            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>مبلغ سفارش:</strong>
                {{ number_format($order->order_final_amount) }} تومان
            </td>
        </tr>

        <tr>
            <td style="padding:15px;border-bottom:1px solid #e5e7eb;">
                <strong>وضعیت پرداخت:</strong>

                @if($order->payment->status == 'paid')
                    <span style="color:#16a34a;font-weight:bold;">پرداخت شده</span>
                @elseif($order->payment_status == 'not_paid')
                    <span style="color:#dc2626;font-weight:bold;">پرداخت نشده</span>
                @elseif($order->payment_status == 'canceled')
                    <span style="color:#ea580c;font-weight:bold;">لغو شده</span>
                @elseif($order->payment_status == 'returned')
                    <span style="color:#2563eb;font-weight:bold;">بازگشت داده شده</span>
                @else
                    <span style="color:#6b7280;">نامشخص</span>
                @endif

            </td>
        </tr>

        <tr>
            <td style="padding:15px;">
                <strong>تاریخ بروزرسانی:</strong>
                {{ jalaliDate($order->payment->updated_at) }}
            </td>
        </tr>

    </table>

@endsection
