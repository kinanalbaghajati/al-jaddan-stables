<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('frontend/icons/browser-tap-icon.svg')}}">

    <title>Al-Jaddan Stables - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/skin_color.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    @include('backend.partials.header')

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar-->
     @include('backend.partials.side_bar')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
    @include('backend.partials.footer')

    <!-- Control Sidebar -->


    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg "></div>

</div>
<!-- ./wrapper -->

@include('sweetalert::alert')
<!-- Vendor JS -->
<script src="{{asset('backend_theme/main-dark/js/vendors.min.js')}}"></script>
<script src="{{asset('backend_theme/assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('backend_theme/main-dark/js/pages/data-table.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/flexslider/jquery.flexslider.js')}}"></script>
<script src="{{asset('backend_theme/main-dark/js/pages/slider.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/dropzone/dropzone.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/jquery-steps-master/build/jquery.steps.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js')}}"></script>

<script src="{{asset('backend_theme/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
<script src="{{asset('backend_theme/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


<!-- Sunny Admin App -->
<script src="{{asset('backend_theme/main-dark/js/template.js')}}"></script>
<script src="{{asset('backend_theme/main-dark/js/pages/dashboard.js')}}"></script>
<script src="{{asset('backend_theme/main-dark/js/pages/steps.js')}}"></script>
<script src="{{asset('backend_theme/main-dark/js/pages/advanced-form-element.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@yield('script')
<script>
    function loadingBtn(element) {
        if (element.tagName.toLowerCase() == "button") {
            event.target.form.submit();
            element.disabled = true;
            element.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...';
            element.setAttribute('type', 'button');
        } else if (element.tagName.toLowerCase() == "a") {
            element.disabled = true;
            element.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...';
        } else if (element.tagName.toLowerCase() == "input") {
            element.disabled = true;
            element.value = 'Loading...';
            event.target.form.submit();
        }
    }

</script>

<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':

            toastr.options.timeOut = 10000;
            toastr.info("{{ Session::get('message') }}");
            // var audio = new Audio('audio.mp3');
            // audio.play();
            break;
        case 'success':

            toastr.options.timeOut = 10000;
            toastr.success("{{ Session::get('message') }}");
            // var audio = new Audio('audio.mp3');
            // audio.play();

            break;
        case 'warning':

            toastr.options.timeOut = 10000;
            toastr.warning("{{ Session::get('message') }}");
            // var audio = new Audio('audio.mp3');
            // audio.play();

            break;
        case 'error':

            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            // var audio = new Audio('audio.mp3');
            // audio.play();

            break;
    }
    @endif
</script>

</body>
</html>
