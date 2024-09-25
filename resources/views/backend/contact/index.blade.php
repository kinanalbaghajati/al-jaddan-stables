@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">All Contacts</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Contacts</li>
                                <li class="breadcrumb-item active" aria-current="page">Contacts</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Contacts Data</h3>
                            <button type="button" class="btn btn-rounded btn-info float-right" data-toggle="modal"
                                    data-target="#CreateModal">
                                Create A Contact
                            </button>
                        </div>

                        <!-- /.box-headerBlade -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped dataTable"
                                                   role="grid" aria-describedby="example1_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 30.562px;">#
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 120.562px;">Name
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 120.562px;">Type
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 45.469px;">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($contacts as $key => $item)
                                                    <tr role="row"
                                                        class="@if($key/2 == 1  ) odd @else even @endif ">
                                                        <td>{{$key+1}}</td>
                                                        <td class="sorting_1"><span
                                                                class="badge badge-lg badge-info">{{$item->name}}</span>
                                                        </td>
                                                        <td>
                                                            <img src="{{asset($item->type)}}">
                                                        </td>
                                                        <td>

                                                            <a role="button"
                                                               href="{{route('contact.delete',$item->id)}}"
                                                               data-confirm-delete="true"><i
                                                                    class="fa fa-trash-o"
                                                                    style="color: red;font-size: 22px"></i> </a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">#</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Type</th>
                                                    <th rowspan="1" colspan="1">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <div id="CreateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{route('contact.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="modal-content" style="background-color: #272E48">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Creat Contact</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact URL</label>
                                <input class="form-control" name="url" type="url">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Image</label>
                                <input class="form-control" name="image" type="file" onchange="mainImage(this)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="frames">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-rounded" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-rounded float-right" onclick="loadingBtn(this)">Insert</button>
                </div>

            </div>
            </form>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        function mainImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('frames');
                    img.innerHTML = "<img id='main_image' class='rounded me-2' src=" + e.target.result + " width='210' height='100px' data-holder-rendered='true' style='padding-bottom: 10%;border-radius: 5px'>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
