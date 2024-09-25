@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">All {{ucfirst($type)}}s</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Horses</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ucfirst($type)}}s</li>
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
                            <h3 class="box-title">{{ucfirst($type)}}s Data</h3>
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
                                                        style="width: 120.562px;">Name EN
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 120.312px;">Name AR
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 140.406px;">Owner EN
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 140.5156px;">Owner AR
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 60.5156px;">Age
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 45.469px;">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($horses as $key => $item)
                                                    @php
                                                        $trans_name = $item->getTranslations('name');
                                                        $trans_owner = $item->getTranslations('owner');
                                                    @endphp
                                                    <tr role="row"
                                                        class="@if($key/2 == 1  ) odd @else even @endif ">
                                                        <td>{{$key+1}}</td>
                                                        <td class="sorting_1"><span
                                                                class="badge badge-lg badge-info" style="font-size: 16px">{{$trans_name['en']}}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-lg badge-info" style="font-size: 16px">{{$trans_name['ar']}}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-lg badge-primary" style="font-size: 16px">{{$trans_owner['en']}}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-lg badge-primary" style="font-size: 16px">{{$trans_owner['ar']}}</span>
                                                        </td>
                                                        <td><span
                                                                class="badge badge-lg badge-success" style="font-size: 16px">{{$item->age}} Years</span>
                                                        </td>
                                                        <td>

                                                                <div class="dropdown">
                                                                    <button class="btn btn-rounded  btn-social btn-instagram dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="icon ti-settings"></i>  Actions</button>
                                                                    <div class="dropdown-menu" style="will-change: transform;">
                                                                        <a class="dropdown-item" href="{{route('horse.view',$item->id)}}"><i class="fa fa-eye" style="color: #2F5ABD"></i>  <strong style="font-size: 16px">View</strong></a>
                                                                        <a class="dropdown-item" href="{{route('horse.delete',$item->id)}}" data-confirm-delete="true"><i class="fa fa-trash-o" style="color: red"></i> <strong style="font-size: 16px">Delete</strong></a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="{{route('horse.gallery',$item->id)}}"><i class="fa fa-image" style="color: wheat"></i> <strong style="font-size: 16px">Images</strong></a>
                                                                        <a class="dropdown-item" href="{{route('horse.ancestors',$item->id)}}"><i class="fa fa-leaf" style="color: forestgreen"></i> <strong style="font-size: 16px">Ancestors</strong></a>
                                                                    </div>
                                                                </div>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">#</th>
                                                    <th rowspan="1" colspan="1">Name En</th>
                                                    <th rowspan="1" colspan="1">Name Ar</th>
                                                    <th rowspan="1" colspan="1">Owner EN</th>
                                                    <th rowspan="1" colspan="1">Owner AR</th>
                                                    <th rowspan="1" colspan="1">Age</th>
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
@endsection
