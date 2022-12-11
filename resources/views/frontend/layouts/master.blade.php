
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop - @yield('title')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
        @notifyCss
        <style>
            .notify {
                z-index: 999999999;
            }
        </style>
    </head>
    <body>
        <x:notify-messages />
        <!-- Navigation-->
        @include('frontend.layouts.includes.nav')

        <!-- content-->
        @yield('content')

        <!-- Footer-->
        @include('frontend.layouts.includes.footer')

        <!--script-->
        @include('frontend.layouts.includes.script')
    </body>
</html>
