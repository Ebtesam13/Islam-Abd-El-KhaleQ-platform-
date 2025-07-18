<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{config('app.name').'/'.__('labels.dashboard')}}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and icons -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href=" {{ asset("img/logo-icon.jpeg")}}" sizes="192x192">
    <link href= rel="icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <script src={{asset("dashboard/assets/js/plugin/webfont/webfont.min.js")}}></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href={{asset("dashboard/assets/css/bootstrap.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboard/assets/css/plugins.min.css")}} />
    <link rel="stylesheet" href={{asset("dashboard/assets/css/kaiadmin.min.css")}} />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href={{asset("dashboard/assets/css/demo.css")}} />

</head>
<body>
<div class="wrapper">

    @include('dashboard.partials.sidebar')

    <div class="main-panel">
    @include('dashboard.partials.header')

    @yield('content')

    <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="selected changeLogoHeaderColor"
                                data-color="dark"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="white"
                            ></button>
                            <br />
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="dark2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange2"
                            ></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red2"
                            ></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red"
                            ></button>
                            <button
                                type="button"
                                class="selected changeTopBarColor"
                                data-color="white"
                            ></button>
                            <br />
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange2"
                            ></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red2"
                            ></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="white"
                            ></button>
                            <button
                                type="button"
                                class="selected changeSideBarColor"
                                data-color="dark"
                            ></button>
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="dark2"
                            ></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div> -->
        </div>
        <!-- End Custom template -->

        @include('dashboard.partials.footer')

    </div>
</div>
<!--   Core JS Files   -->
<script src={{asset("dashboard/assets/js/core/jquery-3.7.1.min.js")}}></script>
<script src={{asset("dashboard/assets/js/core/popper.min.js")}}></script>
<script src={{asset("dashboard/assets/js/core/bootstrap.min.js")}}></script>

<!-- jQuery Scrollbar -->
<script src={{asset("dashboard/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js")}}></script>

<!-- Chart JS -->
{{--<script src={{asset("dashboard/assets/js/plugin/chart.js/chart.min.js")}}></script>--}}

<!-- jQuery Sparkline -->
<script src={{asset("dashboard/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js")}}></script>

<!-- Chart Circle -->
<script src={{asset("dashboard/assets/js/plugin/chart-circle/circles.min.js")}}></script>

<!-- Datatables -->
<script src={{asset("dashboard/assets/js/plugin/datatables/datatables.min.js")}}></script>

<!-- Bootstrap Notify -->
{{--<script src={{asset("dashboard/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js")}}></script>--}}

<!-- jQuery Vector Maps -->
<script src={{asset("dashboard/assets/js/plugin/jsvectormap/jsvectormap.min.js")}}></script>
<script src={{asset("dashboard/assets/js/plugin/jsvectormap/world.js")}}></script>

<!-- Sweet Alert -->
<script src={{asset("dashboard/assets/js/plugin/sweetalert/sweetalert.min.js")}}></script>

<!-- Kaiadmin JS -->
<script src={{asset("dashboard/assets/js/kaiadmin.min.js")}}></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src={{asset("dashboard/assets/js/setting-demo.js")}}></script>
<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>
@stack('page-specific-scripts')
</body>
</html>
