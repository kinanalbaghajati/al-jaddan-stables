@extends('backend.base_dashboard')
@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Gallery</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Home Page</li>
                            <li class="breadcrumb-item active" aria-current="page">Gallery Section</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Gallery Images</h4>
                    <button type="button" class="btn btn-rounded btn-info float-right" data-toggle="modal"
                            data-target=".bs-example-modal-lg">
                        Insert Images
                    </button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="owl-carousel owl-theme">
                        @foreach($horse->file()->whereNotIn('extension',['main','cover'])->get() as $file)
                            <div class="box mb-0">
                                <img class="card-img-top img-responsive" src="{{asset($file->file)}}"
                                     alt="Card image cap">
                                <a href="{{route('horse.image.delete',$file->id)}}" role="button"
                                   class="btn btn-circle btn-default btn-xs mb-5 " data-confirm-delete="true"
                                   style="position: absolute;background-color: transparent;top: 5px; right: 5px;"><i
                                        class=" ti-close" style="color:darkred"></i></a>
                            </div>
                        @endforeach
                        @if($horse->file->isEmpty())
                            <p>No Images available.</p>
                        @endif

                    </div>
                </div>
                <!-- /.box-body -->
            </div>


        </div>


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #272E48">
                    <div class="modal-header">
                        <h4 class="box-title" id="myLargeModalLabel">Insert <strong>Gallery</strong> Images</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reloadPage()">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="box">
                            <div class="box-body">
                                <form action="{{route('horse.upload.images',$horse->id)}}" method="post"
                                      class="dropzone dz-clickable">
                                    @csrf
                                    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded text-left" data-dismiss="modal" onclick="reloadPage()">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <script>
        function reloadPage()
        {
            window.location.reload();
        }
    </script>
@endsection

