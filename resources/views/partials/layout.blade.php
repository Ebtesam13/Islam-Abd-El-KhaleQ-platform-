<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href=" {{ asset("img/logo-icon.jpeg")}}" sizes="192x192">
    <link href= rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href= {{ asset("lib/animate/animate.min.css")}} rel="stylesheet">
    <link href= {{ asset("lib/owlcarousel/assets/owl.carousel.min.css")}} rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href= {{ asset("css/bootstrap.min.css")}} rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href= {{ asset("css/style.css")}} rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
{{--    <title>HTML5 GSAP Animated Boxing Day Confetti Banner Sale for Flight Centre - Coded by Bradley Lancaster</title>--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&text=1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz%20*$" rel="stylesheet">--}}
    <style type="text/css">
        a#myAdlink {
            display: block;
            background-color: #ff0000;
            text-decoration: none;
            position: absolute;
            top: 20%;
            left: 16%;
            width: 64%;
            z-index: 1002;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        #myAd {
            width: 728px;
            height: 90px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
        }

        #booknow {
            text-align: center;
            width: 728px;
            line-height: 90px;
            color: white;
            z-index: 30;
            background: none;
            position: absolute;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 32px;
            transform: scale(0);
            transition: all 0.2s 0.1s ease;
        }

        #myAd::before {
            padding: 10px;
            border: 8px solid white;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
            opacity: 0;
            background: #ff0000;
            z-index: 20;
            transition: all 0.2s ease;
        }

        a#myAdlink:hover #myAd::before {
            opacity: 1;
        }

        a#myAdlink:hover #booknow {
            transform: scale(1);
        }

        #myAd svg {
            position: absolute;
        }

        .logo {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #FFFFFF;
        }

        #logo {
            bottom: 35px;
            left: 35%;
            margin-left: -139px;
            transform: scale(0);
            opacity: 0;
            z-index: 10;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%) scale(0);
        }

        .arrow {
            fill: #FFFFFF;
        }

        #arrow {
            top: 5px;
            right: 5px;
            opacity: 0;
        }

        .c1 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #C2749D;
        }

        .c1g path,
        .c1g circle {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #531E5B;
        }

        #c1 {
            left: 40px;
            top: -50px;
        }

        #c1x {
            left: 640px;
            top: -75px;
        }

        #c1x2 {
            left: 550px;
            top: -75px;
        }

        .c2 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #F1CB15;
        }

        .c2p path {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #2AB0A5;
        }

        #c2 {
            top: -50px;
        }

        #c2x {
            top: -55px;
            left: 370px;
        }

        #c2x2 {
            top: -55px;
            left: 650px;
        }

        .c3 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #EF5032;
        }

        g.c3g path {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #F5EA14;
        }

        #c3 {
            left: 445px;
            top: -28px;
        }

        #c3x {
            left: 415px;
            top: -35px;
        }

        #c3x2 {
            left: 235px;
            top: -35px;
        }

        .c4 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #531E5B;
        }

        .c4g path,
        .c4g circle {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #FFFFFF;
        }

        #c4 {
            left: 75px;
        }

        #c4x {
            left: 325px;
            top: -35px;
        }

        #c4x2 {
            left: 625px;
            top: -135px;
        }

        .c5 {
            clip-path: url(#XMLID_51_);
        }

        .c5g path,
        .c5g ellipse {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #EB008B;
        }

        .st2 {
            clip-path: url(#XMLID_52_);
        }

        #c5 {
            left: 45px;
            top: -40px;
        }

        #c5x {
            left: 225px;
            top: -20px;
        }

        #c5x3 {
            left: 55px;
            top: -20px;
        }

        .c6 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #EB008B;
        }

        .c6g path,
        .c6g circle {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #FFFFFF;
        }

        #c6 {
            top: -80px;
        }

        #c6x {
            left: 105px;
            top: -150px;
        }

        .c7 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #00ADEE;
        }

        #c7 {
            left: 85px;
            top: -50px;
        }

        #c7x {
            left: 195px;
            top: -120px;
        }

        .c8 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #531E5B;
        }

        #c8 {
            left: 55px;
            top: -80px;
        }

        #c8x {
            left: 155px;
            top: -250px;
        }

        .c9 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #8BC541;
        }

        #c9 {
            left: 105px;
            top: -100px;
        }

        #c9x {
            left: 235px;
            top: -50px;
        }

        .c10 {
            fill-rule: evenodd;
            clip-rule: evenodd;
            fill: #FFF100;
        }

        #c10 {
            left: 420px;
            top: -150px;
        }

        #c10x {
            left: 250px;
            top: -100px;
        }

        #sale_text {
            position: absolute;
            left: 0;
            top: -55px;
            left: 125px;
        }

        #myAd #ny {
            position: relative;
            color: white;
            text-align: center;
            top: 25px;
            font-size: 35px;
            line-height: 25px;
            font-weight: 700;
            text-decoration: none;
            transform: scale(0);
            opacity: 0;
        }

        #nysale {
            position: relative;
            z-index: 10;
            top: 0px;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            font-size: 55px;
            line-height: 70px;
            font-weight: 700;
            transform: scale(0);
            opacity: 0;
        }

        #ic {
            background: white;
            width: 180px;
            height: 180px;
            left: 75%;
            margin-left: -90px;
            top: -45px;
            position: absolute;
            border-radius: 100%;
            z-index: 12;
            transform: scale(0);
            overflow: hidden;
        }

        #i1 {
            opacity: 1;
            position: absolute;
            width: 100%;
            transform: scale(0);
            height: 100%;
        }

        #p1,
        #pd,
        #pp,
        #ca {
            width: 100%;
            position: relative;
            display: block;
            text-align: center;
        }

        #p1 {
            top: 45px;
            color: black;
            font-weight: 700;
            font-size: 25px;
        }

        #pd {
            top: 42px;
            font-size: 11px;
            color: black;
            font-weight: 400;
        }

        #pp {
            top: 45px;
            font-size: 45px;
            font-weight: 800;
            color: #ff0000;
            line-height: 45px;
        }

        #d1 {
            font-size: 24px;
            top: -10px;
            left: 35px;
            position: absolute;
        }

        #ast {
            font-size: 18px;
            position: absolute;
            top: -10px;
            right: 40px;
        }

        #ca {
            color: black;
            font-size: 8px;
            top: 150px;
            position: absolute;
            opacity: 0;
        }

        #i2 {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 1;
        }

        #pp2 {
            position: absolute;
            top: 95px;
            left: -140px;
            font-size: 45px;
            font-weight: 800;
            color: #ff0000;
            line-height: 45px;
        }

        #p2 {
            width: 100%;
            text-align: center;
            position: absolute;
            left: -160px;
            top: 45px;
            color: black;
            font-weight: 700;
            font-size: 25px;
            opacity: 0;
        }

        #pd2 {
            width: 100%;
            text-align: center;
            position: absolute;
            left: -150px;
            top: 76px;
            font-size: 11px;
            color: black;
            font-weight: 400;
        }

        #d2 {
            position: absolute;
            font-size: 24px;
            top: -10px;
            left: -15px;
        }

        #ast2 {
            font-size: 18px;
            position: absolute;
            top: -10px;
            right: -10px;
        }

        #from {
            position: absolute;
            top: 122px;
            left: -200px;
            color: black;
            font-size: 11px;
        }

        /*eid mubarak */

        .eid-mubarak-div{
            margin: 0;
            padding: 0;
            background-color: #333;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        #wire {
            background-color: dimgray;
            height: 2px;
            text-align: center;
            width: 100%;
            white-space: nowrap;
            margin-top: 10px;
        }

        #wire li {
            height: 30px;
            width: 15px;

            list-style: none;
            display: inline-block;
            margin: -3px 15px;
            border-radius: 50%;

            /*animations*/
            animation-name: even-flash;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-timing-function: linear);
        }

        #wire li:nth-child(even) {
            animation-name: odd-flash;
            animation-duration: 1000ms;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        #wire li:before {
            content: " ";
            height: 10px;
            width: 15px;
            background-color: black;
            position: absolute;
            margin-left: -7.5px;
            margin-top: -3px;
            border-radius: 50% 50% 0 0;
        }


        .eid-mubarak {
            color: white;
            text-align: center;
            font-family: 'Permanent Marker', cursive;
            font-size: 5em;
            font-weight: 100;
            text-shadow: 8px 0px 20px #0DB5FE;
            height: 100vh;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            text-align: center;
            animation-name: text-glow;
            animation-duration: 4s;
            animation-iteration-count: infinite;
        }


        .eid{
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            visibility: hidden;

            animation-name: text-animation;
            animation-duration: 1s;
            animation-delay:1s;
            animation-iteration-count: 1;
            animation-timing-function: linear;
            animation-fill-mode: forwards;

        }

        .mubarak{

            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            animation-name: text-animation-second;
            animation-duration: 1s;
            animation-iteration-count: 1;
            animation-timing-function: linear;
            animation-direction: alternate;
            animation-fill-mode: forwards;

        }

        @keyframes even-flash {
            0%,
            100% {
                background: rgba(255, 65, 65, 0.94);
                box-shadow: 0px 2px 20px 4px rgba(255, 65, 65, 1);
            }
            50% {
                background:  rgba(255, 65, 65, .3);
                box-shadow: 0px 2px 20px 4px rgba(255, 65, 65, 0.3);
            }
        }



        @keyframes odd-flash {
            50% {
                background: rgb(14, 220, 195);
                box-shadow: 0px 2px 20px 4px rgb(12, 243, 40);
            }
            0%,
            100% {
                background: rgba(14, 220, 195, .5);
                box-shadow: 0px 2px 20px 4px rgba(14, 220, 195, .5);
            }
        }


        @keyframes text-animation{
            0%{
                top: 0px;
                visibility: visible;
            }


            75%{

                top: 70%;
            }
            100%{

                visibility: visible;
                top: 65%
            }
        }

        @keyframes text-animation-second{
            0%{top: 0px;}
            75%{top: 80%;}
            100%{top: 76%;}
        }

        @keyframes text-glow{
            0%{text-shadow: 8px 0px 20px white; color: white;}
            25%{}
            50%{}
            75%{text-shadow: 8px 0px 20px orange;}
            100%{text-shadow: 8px 0px 5px cyan;}
        }

        /* Responsive styles */
        @media (max-width: 1024px) {
            a#myAdlink {
                width: 80%;
                left: 10%;
            }

            #myAd {
                width: 100%;
                height: auto;
            }

            #booknow {
                width: 100%;
                font-size: 24px;
            }

            #logo {
                left: 50%;
                margin-left: 0;
                transform: translate(-50%, -50%) scale(0);
            }
        }

        @media (max-width: 768px) {
            a#myAdlink {
                width: 90%;
                left: 5%;
                top: 15%;
            }

            #myAd {
                min-height: 150px;
            }

            #ic {
                display: none;
            }

            #sale_text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                width: 100%;
            }

            #ny {
                font-size: clamp(20px, 5vw, 28px);
                font-weight: bold;
                margin-bottom: 5px;
            }

            #nysale {
                display: none;
            }

            #logo {
                width: 90%;
                margin: 15px auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0);
            }

            #logo text {
                font-size: clamp(24px, 5vw, 34px);
            }

            #arrow {
                width: 20px;
                height: 20px;
                bottom: 10px;
                right: 10px;
            }

            #booknow {
                font-size: 18px;
            }

            #p1, #p2, #pd, #pd2, #pp, #pp2, #ny, #nysale {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            a#myAdlink {
                width: 95%;
                left: 2.5%;
                top: 10%;
            }

            #myAd {
                min-height: 120px;
            }

            #ny {
                font-size: clamp(18px, 6vw, 28px);
            }

            #logo {
                width: 95%;
                margin: 10px auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0);
            }

            #logo text {
                font-size: clamp(20px, 6vw, 34px);
            }

            #arrow {
                width: 15px;
                height: 15px;
            }

            #booknow {
                font-size: 16px;
            }

            #p1, #p2, #pd, #pd2, #pp, #pp2, #ny, #nysale {
                font-size: 10px;
            }
        }

        @media (max-width: 320px) {
            a#myAdlink {
                width: 98%;
                left: 1%;
                top: 5%;
            }

            #myAd {
                min-height: 100px;
            }

            #ny {
                font-size: clamp(16px, 7vw, 28px);
            }

            #logo {
                width: 98%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0);
            }

            #logo text {
                font-size: clamp(18px, 7vw, 34px);
            }

            #booknow {
                font-size: 14px;
            }

            #p1, #p2, #pd, #pd2, #pp, #pp2, #ny, #nysale {
                font-size: 9px;
            }
        }
    </style>
    @stack('page-specific-styles')
</head>

<body>
<!-- Spinner Start -->
@include('partials.spinner')
<!-- Spinner End -->


<!-- Navbar Start -->
@include('partials.navbar')
<!-- Navbar End -->

@yield('content')

<!-- Footer Start -->
@include('partials.footer')
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("lib/wow/wow.min.js")}}"></script>
<script src="{{asset("lib/easing/easing.min.js")}}"></script>
<script src="{{asset("lib/waypoints/waypoints.min.js")}}"></script>
<script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>

@stack('page-specific-scripts')

<!-- Template Javascript -->
<script src="{{asset("js/main.js")}}"></script>
<script src="https://s0.2mdn.net/ads/studio/cached_libs/tweenmax_1.19.1_92cf05aba6ca4ea5cbc62b5a7cb924e3_min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script> -->


<script type="text/javascript">


    function init() {

        var tl1 = new TimelineMax('repeat:-1');

        tl1
            .add('confettiIn')
            .to("#c1", 2, {top: 350, rotation: 520, ease: Power0.easeNone}, 'confettiIn')
            .to("#c2", 3, {top: 270, rotation: 420, ease: Power0.easeNone}, 'confettiIn+=1')
            .to("#c3", 5, {top: 450, rotation: 520, ease: Power0.easeNone}, 'confettiIn')
            .to("#c4", 4, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettiIn')
            .to("#c5", 5, {top: 320, rotation: 650, ease: Power0.easeNone}, 'confettiIn+=1')
            .to("#c6", 3, {top: 400, rotation: 360, ease: Power0.easeNone}, 'confettiIn')
            .to("#c7", 4, {top: 270, rotation: 420, ease: Power0.easeNone}, 'confettiIn+=0.5')
            .to("#c8", 5, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettiIn')
            .to("#c9", 6, {top: 270, rotation: 700, ease: Power0.easeNone}, 'confettiIn')
            .to("#c10", 5, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettiIn')
        ;

        var tl2 = new TimelineMax('repeat:-1');

        tl2
            .add('confettin2')
            .to("#c1x", 4, {top: 350, rotation: 520, ease: Power0.easeNone}, 'confettin2')
            .to("#c2x", 5, {top: 270, rotation: 420, ease: Power0.easeNone}, 'confettin2+=0.5')
            .to("#c3x", 4, {top: 450, rotation: 520, ease: Power0.easeNone}, 'confettin2+=1')
            .to("#c4x", 6, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettin2+=2')
            .to("#c5x", 6, {top: 320, rotation: 650, ease: Power0.easeNone}, 'confettin2+=0.3')
            .to("#c6x", 3, {top: 400, rotation: 360, ease: Power0.easeNone}, 'confettin2+=1')
            .to("#c7x", 5, {top: 270, rotation: 420, ease: Power0.easeNone}, 'confettin2+=1')
            .to("#c8x", 4, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettin2+=1.5')
            .to("#c9x", 5, {top: 300, rotation: 360, ease: Power0.easeNone}, 'confettin2')
            .to("#c10x", 5, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettin2+=1');

        var tl3 = new TimelineMax('repeat:-1');

        tl2
            .add('confettin3')
            .to("#c1x2", 6, {top: 350, rotation: 520, ease: Power0.easeNone}, 'confettin3+=1')
            .to("#c2x2", 7, {top: 270, rotation: 650, ease: Power0.easeNone}, 'confettin3+=0.5')
            .to("#c3x2", 5, {top: 450, rotation: 520, ease: Power0.easeNone}, 'confettin3+=1')
            .to("#c4x2", 4, {top: 270, rotation: 360, ease: Power0.easeNone}, 'confettin3+=0.5')
            .to("#c5x2", 5, {top: 320, rotation: 650, ease: Power0.easeNone}, 'confettin3+=1')
        ;

        var tl4 = new TimelineMax();

        tl4
            .add('sale-in')
            .to("#ny", 0.3, {scale: 1.3, autoAlpha: 1, ease: Sine.easeIn}, 'sale-in')
            .to("#ny", 0.3, {scale: 1, autoAlpha: 1, ease: Bounce.easeOut}, 'sale-in+=0.3')
            .to("#nysale", 0.3, {scale: 1.6, autoAlpha: 1, ease: Sine.easeIn}, 'sale-in+=0.6')
            .to("#nysale", 0.3, {scale: 1, autoAlpha: 1, ease: Bounce.easeOut}, 'sale-in+=0.9')
            .to("#ny", 0.3, {scale: 0, autoAlpha: 0, ease: Sine.easeIn}, 'sale-in+=1.3')
            .to("#nysale", 0.3, {scale: 0, autoAlpha: 0, ease: Sine.easeIn}, 'sale-in+=1.4')
            .to("#logo", 0.3, {scale: 1, autoAlpha: 1, ease: Sine.easeIn}, 'sale-in+=1.4')
        ;

        var tl5 = new TimelineMax({onComplete:replayAnimation});

        tl5
            .add('prices-in')
            .to("#ic", 0.3, {scale: 1.3, ease: Sine.easeIn}, 'sale-in+=1.7')
            .to("#ic", 0.3, {scale: 0.8, ease: Bounce.easeOut}, 'sale-in+=2')
            .to("#i1", 0.3, {scale: 1.3, ease: Sine.easeIn}, 'sale-in+=2')
            .to("#i1", 0.3, {scale: 1, ease: Bounce.easeOut}, 'sale-in+=2.3')
            .to("#ca", 1, {autoAlpha: 1, ease: Bounce.easeOut}, 'sale-in+=2.3')
            .to("#pp", 0.1, {left: 100, autoAlpha: 0, ease: Sine.easeIn}, 'sale-in2.7')
            .to("#pd", 0.1, {left: 100, autoAlpha: 0, ease: Sine.easeIn}, 'sale-in2.9')
            .to("#p1", 0.1, {left: 100, autoAlpha: 0, ease: Sine.easeIn}, 'sale-in3.2')
            .to("#p2", 0.2, {left: 0, autoAlpha: 1, ease: Sine.easeIn}, 'sale-in2.8')
            .to("#pd2", 0.2, {left: 0, autoAlpha: 1, ease: Sine.easeOut}, 'sale-in3.3')
            .to("#from", 0.2, {left: 20, autoAlpha: 1, ease: Sine.easeOut}, 'sale-in3.4')
            .to("#pp2", 0.2, {left: 50, autoAlpha: 1, ease: Sine.easeOut}, 'sale-in3.4')
        ;

        function replayAnimation(){

            setTimeout(function(){

                tl1.restart();
                tl2.restart();
                tl3.restart();
                tl4.restart();
                tl5.restart();


            }, 1000);

        }

    }

    window.onload = init;

</script>
</body>

</html>
