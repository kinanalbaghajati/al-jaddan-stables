@extends('backend.base_dashboard')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">First Section</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Home Page</li>
                            <li class="breadcrumb-item active" aria-current="page">First Section</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-lg-6">

                <div class="box">
                    <!-- /.box-headerBlade -->
                    <form action="{{route('first.text.update')}}" method="post">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" name="id" value="{{$first_section->id}}">
                            <textarea id="editor1" name="editor_en" rows="10" cols="80">
                        @if(isset($trans_text['en']))
                                    {!! $trans_text['en'] !!}
                                @else
                                    Text Not Available
                                @endif
						</textarea>


                        </div>
                        <div class="box-footer ">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Insert <strong>First</strong> Section's Content in <strong>English</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary  mb-5 float-right" onclick="loadingBtn(this)">Insert En</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-6 col-lg-6">

                <div class="box">
                    <!-- /.box-headerBlade -->
                    <form action="{{route('first.text.update')}}" method="post">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" name="id" value="{{$first_section->id}}">
                            <textarea id="editor2" name="editor_ar" rows="10" cols="80">
                            @if(isset($trans_text['ar']))
                                    {!! $trans_text['ar'] !!}
                                @else
                                    Text Not Available
                                @endif
						</textarea>

                        </div>
                        <div class="box-footer ">
                            <div class="row">
                                <div class="col-md-10">
                                    <h5>Insert <strong>First</strong> Section's Content in <strong>Arabic</strong></h5>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary  mb-5 " onclick="loadingBtn(this)">Insert Ar</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-->
        </div>
        <div class="row">
            <div class="col-lg-6 col-6">

                <!-- Carousel Slider Only Slide -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>First</strong> Section's Image</h4>
                    </div>
                    <div class="box-body">
                        <div id="carousel-example-generic-only-slide" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">

                                <div class="carousel-item active">
                                    @if(isset($first_section->file->file))
                                        <img src="{{asset($first_section->file->file)}}" class="img-fluid"
                                             alt="slide-3">
                                    @else
                                        <img src="{{asset('backend_theme/static_images/no_image.png')}}"
                                             class="img-fluid"
                                             alt="slide-3">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="{{route('first.image.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{$first_section->id}}" name="id">
                                <div class="col-md-10">
                                    <input class="form-control" type="file" name="image" onchange="mainImage(this)">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary  mb-5" onclick="loadingBtn(this)">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.box -->

            </div>

            <div class="col-lg-6 col-6">

                <!-- Carousel Slider Only Slide -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title"><strong>First</strong> Section's <strong>Edited</strong> Image</h4>
                    </div>
                    <div class="box-body">
                        <div id="carousel-example-generic-only-slide" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox" id="view_image">

                                <div class="carousel-item active">

                                    <img src="{{asset('backend_theme/static_images/no_image.png')}}" class="img-fluid"
                                         alt="slide-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->

            </div>

            <!-- /.col-->
        </div>

        <!-- ./row -->
    </section>

    <script>
        function mainImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('view_image');
                    img.innerHTML = "<div class='carousel-item active'> <img src=" + e.target.result + " class='img-fluid' alt='slide-3'></div>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
@section('script')
    <script src="{{asset('backend_theme/assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('backend_theme/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
    <script src="{{asset('backend_theme/main-dark/js/pages/editor.js')}}"></script>
@endsection

{{--<div class="cke_screen_reader_only cke_copyformatting_notification"><div aria-live="polite"></div></div>--}}
