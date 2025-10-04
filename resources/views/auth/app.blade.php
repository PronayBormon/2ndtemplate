@php($settings = \App\Models\SystemSetting::first())
<!DOCTYPE html>

<html lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/frontend/assets/"
    data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>
        {{ Request::is('login') ? 'Login' : 'Register' }} {{ config('app.name') ? ' || ' . config('app.name') : '' }}
    </title>
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


    <meta name="description"
        content="" />

    <!-- Favicon -->
    <link rel="icon"
        type="image/x-icon"
        href="{{ asset($settings->favicon ?? 'frontend/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect"
        href="https://fonts.googleapis.com" />
    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet"
        href="{{ asset('frontend/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('frontend/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('frontend/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('frontend/assets/js/config.js') }}"></script>
    <!-- toaster  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                @yield('content')
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('frontend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('frontend/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('frontend/assets/js/pages-auth.js') }}"></script>
    {{-- Toaster  --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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
