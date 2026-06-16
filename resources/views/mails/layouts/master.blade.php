<!DOCTYPE html>

<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
</head>
<body style="margin:0;padding:0;background-color:#f5f7fb;font-family:Tahoma,Arial,sans-serif;direction:rtl;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f5f7fb;padding:40px 15px;">
    <tr>
        <td align="center">


            <table width="650" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:650px;background:#ffffff;border-radius:12px;overflow:hidden;">

                @include('mails.layouts.header')

                <tr>
                    <td style="padding:40px 35px;">
                        @yield('content')
                    </td>
                </tr>

                @include('mails.layouts.footer')

            </table>

        </td>
    </tr>


</table>

</body>
</html>
