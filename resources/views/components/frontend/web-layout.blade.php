<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Open9</title>
    <link rel="shortcut icon" href="{{ asset('collab/assets/images/logo/favourite_icon_1.svg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('collab/assets/css/style.css') }}">
    @stack('styles')
</head>

<body>
    <div class="page_wrapper">
        <div class="backtotop"><a href="#" class="scroll"><i class="far fa-arrow-up"></i></a></div>
        @include('frontend.partials.header')
        <main class="page_content">
            {{ $slot }}
        </main>
        @include('frontend.partials.footer')
    </div>
    <script src="{{ asset('collab/assets/js/script.js') }}"></script>
</body>
@stack('scripts')
</html>
