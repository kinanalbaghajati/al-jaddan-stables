
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('backend_theme/images/favicon.ico')}}">

    <title>Sunny Admin - Log in </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend_theme/main-dark/css/skin_color.css')}}">

</head>
<body class="hold-transition theme-primary " style="background: linear-gradient(180deg, #246af3, #46029f) !important;">

<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">

        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-6 col-md-7 col-12">
                    <div class="content-top-agile p-10">
                        <h2 class="text-white">Get started with <strong>Al-Jaddan Stable</strong> Dashboard</h2>
                        <p class="text-white-50">Sign in to start your session</p>
                    </div>
                    <div class="p-50 rounded10 box-shadowed b-2 ">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group py-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" value="{{old('email')}}" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group py-2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" value="{{old('password')}}" placeholder="Password">
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->
{{--                                <div class="col-6">--}}
{{--                                    <div class="fog-pwd text-right">--}}
{{--                                        <a href="javascript:void(0)" class="text-white hover-info"><i class="ion ion-locked"></i> Forgot pwd?</a><br>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info btn-rounded mt-10">SIGN IN</button>
                                </div>

                                @if ($errors->any())
                                    <div class=" flex items-center p-4">
                                        @foreach ($errors->all() as $error)
                                            <p  class="text-danger font-size-14 text-center">{{$error}}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- /.col -->
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Vendor JS -->
<script src="{{asset('backend_theme/main-dark/js/vendors.min.js')}}"></script>
<script src="{{asset('backend_theme/assets/icons/feather-icons/feather.min.js')}}"></script>

</body>
</html>
