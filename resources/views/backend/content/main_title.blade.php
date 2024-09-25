@extends('backend.base_dashboard')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Main Title</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Home Page</li>
                            <li class="breadcrumb-item active" aria-current="page">Main Title</li>
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
                    <form action="{{route('main.title.update')}}" method="post">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" name="id" value="{{$title->id}}">
                            <textarea id="editor1" name="editor_en" rows="10" cols="80">
                         @if(isset($trans_title['en']))
                                    {!! $trans_title['en'] !!}
                                @else
                                    Text Not Available
                                @endif
						</textarea>

                        </div>
                        <div class="box-footer ">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Insert <strong>Mina Title</strong> in <strong>English</strong></h5>
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
            <div class="col-md-6">
                <div class="box">
                    <!-- /.box-headerBlade -->
                    <form action="{{route('main.title.update')}}" method="post">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" name="id" value="{{$title->id}}">
                            <textarea id="editor2" name="editor_ar" rows="10" cols="80">
                         @if(isset($trans_title['ar']))
                                    {!! $trans_title['ar'] !!}
                                @else
                                    Text Not Available
                                @endif
						</textarea>

                        </div>
                        <div class="box-footer ">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5>Insert <strong>Main Title</strong> in <strong>English</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary  mb-5 float-right" onclick="loadingBtn(this)">Insert En</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- ./row -->
    </section>


@endsection
@section('script')
    <script src="{{asset('backend_theme/assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('backend_theme/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
    <script src="{{asset('backend_theme/main-dark/js/pages/editor.js')}}"></script>
@endsection
