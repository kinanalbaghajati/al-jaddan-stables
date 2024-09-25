<!DOCTYPE html>
<html lang="en" @if(Config::get('app.locale') == 'ar') dir="rtl" style="overflow-x:hidden "
      @elseif(isset($locale) && $locale == 'en') dir="ltr" @endif>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Al-Jadaan Stables</title>
    <link rel="icon" href="{{asset('frontend/icons/browser-tap-icon.svg')}}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/7.2.3/css/flag-icons.min.css"
          integrity="sha512-bZBu2H0+FGFz/stDN/L0k8J0G8qVsAL0ht1qg5kTwtAheiXwiRKyCq1frwfbSFSJN3jooR5kauE0YjtPzhZtJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('frontend/styles/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('frontend/styles/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('frontend/styles/home.css')}}"/>
    <style>
        .almarai-regular {
            font-family: "Almarai", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body @if(Config::get('app.locale') == 'ar')class="almarai-regular" @endif>
@yield('content')
@include('frontend.layouts.header')
<script src="{{asset('frontend/js/gsap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.autoplay.umd.js"></script>
<script src="{{asset('frontend/js/slider.js')}}"></script>
<script src="{{asset('frontend/js/app.js')}}"></script>
@include('frontend.layouts.footer')
</body>
