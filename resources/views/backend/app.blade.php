
@php($settings = \App\Models\SystemSetting::first())
<!DOCTYPE html>
<html lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/frontend/assets/"
    data-template="">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $settings->meta_title ?? $settings->site_name }}</title>
    <meta name="description"
        content="{{ $settings->meta_description }}">
    <meta name="keywords"
        content="{{ $settings->meta_keywords }}">
    <!-- Open Graph -->
    <meta property="og:title"
        content="{{ $settings->og_title ?? $settings->meta_title }}">
    <meta property="og:description"
        content="{{ $settings->og_description ?? $settings->meta_description }}">
    <meta property="og:image"
        content="{{ asset($settings->og_image ?? $settings->logo) }}">
    <meta property="og:type"
        content="website">
    <!-- Favicon -->
    <link rel="icon"
        type="image/x-icon"
        href="{{ asset($settings->og_image ?? $settings->favicon) }}" />

    @include('backend.partials.styles')


</head>

<body>
    <!-- From Uiverse.io by Praashoo7 -->
    <div class="loader_box"
        id="loader">

        <div class="main">
            <div class="up">
                <div class="loaders">
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                    <div class="loader"></div>
                </div>
                <div class="loadersB">
                    <div class="loaderA">
                        <div class="ball0"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball1"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball2"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball3"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball4"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball5"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball6"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball7"></div>
                    </div>
                    <div class="loaderA">
                        <div class="ball8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End loader  -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            @include('backend.partials.sidebar')
            <!-- / Menu -->



            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('backend.partials.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('backend.partials.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('backend.partials.scripts')

    <script>
        window.onload = function() {
            document.getElementById("loader").style.display = "none";
        }
    </script>

    <!-- Toastr Notifications -->
    <script>
        @foreach (['t-success', 't-error', 't-warning', 't-info'] as $type)
            @if (session()->has($type))
                toastr.{{ str_replace('t-', '', $type) }}("{{ session($type) }}");
            @endif
        @endforeach
    </script>




</body>

</html>
