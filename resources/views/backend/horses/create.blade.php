@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Create Horse</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Horses</li>
                                <li class="breadcrumb-item active" aria-current="page">Create Horse</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <hr class="rounded pb-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Horse</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <form action="{{route('horse.store')}}" method="post" class="validation-wizard wizard-circle"
                          id="sub_form" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1 -->
                        <h6>Horse Info</h6>
                        <section id="data_section">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wfirstName2">Name EN:</label>
                                        <input type="text" class="form-control required" id="wname_en" name="name_en"
                                               placeholder="Name EN">
                                        @error('name_en')
                                        <p class="danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wlastName2">Name AR:</label>
                                        <input type="text" class="form-control required" id="wname_ar" name="name_ar"
                                               placeholder="Name AR">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5" class="pl-2">Type:</label>
                                        <select class="selectpicker  mr-10" data-style="btn-info btn-outline-info" name="type">
                                            <option value="stallion">STALLION.</option>
                                            <option value="mare">MARE.</option>
                                            <option value="offspring">OFFSPRING.</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lastName1">Age :</label>
                                        <input type="number" class="form-control required" id="wage" name="age"
                                               placeholder="NUMBER">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5">Owner EN:</label>
                                        <input type="text" class="form-control required" id="wowner_en" name="owner_en"
                                               placeholder="Owner EN">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5">Owner AR:</label>
                                        <input type="text" class="form-control required" id="wowner_ar" name="owner_ar"
                                               placeholder="Owner AR">
                                    </div>

                                </div>
                            </div>
                            <hr class="rounded">
                            <div class="row justify-content-around">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Description EN:</label>
                                        <textarea rows="5" cols="5" class="form-control required" id="wdisc_en"
                                                  name="disc_en"
                                                  placeholder="Description EN"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Description AR:</label>
                                        <textarea rows="5" cols="5" class="form-control required" id="wdisc_ar"
                                                  name="disc_ar"
                                                  placeholder="Description AR"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h6> Main Image</h6>
                        <section id="main_image_section">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="url123">Main Image :</label>
                                        <input type="file" class="form-control required" id="wmain_image"
                                               name="main_image" onchange="mainImage(this)">
                                        @error('main_image')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-2" id="view_image">

                                    </div>
                                </div>

                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>Cover Image</h6>
                        <section id="cover_image">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="url123">Cover Image :</label>
                                        <input type="file" class="form-control required" id="wcover_image"
                                               name="cover_image" onchange="coverImage(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="py-2" id="view_image_cover">

                                    </div>
                                </div>

                            </div>
                        </section>
                        <!-- Step 4 -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.content -->
        </section>
    </div>


    <script>
        function mainImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('view_image');
                    img.innerHTML = "<div class='row justify-content-center'><img src=" + e.target.result + " alt='slide-3' style='height:250px;width: full;border-radius: 5px'></div>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function coverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('view_image_cover');
                    img.innerHTML = "<div class='row justify-content-center'><img src=" + e.target.result + " alt='slide-3' style='height:250px;width: full;border-radius: 5px'></div>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
