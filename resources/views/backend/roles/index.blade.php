@extends('backend.base_dashboard')
@section('content')

    {{--    <div class="page-content">--}}


    {{--            <div class="container-fluid">--}}

    {{--                <!-- start page title -->--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-12">--}}


    {{--                        <div class="row">--}}
    {{--                            <div class="col-lg-12 margin-tb">--}}
    {{--                                <div class="pull-left">--}}
    {{--                                    <h2>Role Management</h2>--}}
    {{--                                </div>--}}
    {{--                                <div class="pull-right">--}}

    {{--                                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>--}}

    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="row">--}}
    {{--                            <div class="col-12">--}}
    {{--                                <div class="card">--}}
    {{--                                    <div class="card-body">--}}



    {{--                                        <h4 class="card-title">Roles All Data </h4>--}}


    {{--                                        @if ($message = Session::get('success'))--}}
    {{--                                            <div class="alert alert-success">--}}
    {{--                                                <p>{{ $message }}</p>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                        <table class="table table-bordered">--}}
    {{--                                            <tr>--}}
    {{--                                                <th>No</th>--}}
    {{--                                                <th>Name</th>--}}
    {{--                                                <th width="280px">Action</th>--}}
    {{--                                            </tr>--}}
    {{--                                            @foreach ($roles as $key => $role)--}}
    {{--                                                <tr>--}}
    {{--                                                    <td>{{ ++$i }}</td>--}}
    {{--                                                    <td>{{ $role->name }}</td>--}}
    {{--                                                    <td>--}}
    {{--                                                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}

    {{--                                                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>--}}


    {{--                                                        {!! Form::open(['method' => 'GET','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}--}}
    {{--                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
    {{--                                                        {!! Form::close() !!}--}}

    {{--                                                    </td>--}}
    {{--                                                </tr>--}}
    {{--                                            @endforeach--}}
    {{--                                        </table>--}}
    {{--                                        {!! $roles->render() !!}--}}

    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div> <!-- end col -->--}}
    {{--                        </div> <!-- end row -->--}}



    {{--                    </div> <!-- end col -->--}}
    {{--                </div> <!-- end row -->--}}



    {{--            </div> <!-- container-fluid -->--}}

    {{--        </div>--}}

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">All Roles</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Roles</li>
                                <li class="breadcrumb-item active" aria-current="page">All Roles</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Roles Data</h3>
                            <a role="button" href="{{route('roles.create')}}"
                               class="btn btn-rounded btn-info float-right"
                            >
                                Create New Role
                            </a>
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
                                                        style="width: 240.562px;">#
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 371.312px;">Role
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 169.469px;">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($roles as $key => $role)

                                                    <tr role="row"
                                                        class="@if($key/2 == 1  ) odd @else even @endif ">
                                                        <td>{{ ++$i }}</td>
                                                        <td><span class="badge badge-light" style="font-size: 16px" >{{ $role->name }}</span></td>
                                                        <td>
                                                            @if($role->name == 'Super')

                                                            @else
                                                            <a class="btn btn-info"
                                                               href="{{ route('roles.show',$role->id) }}">Show</a>

                                                            <a class="btn btn-primary"
                                                               href="{{ route('roles.edit',$role->id) }}">Edit</a>

                                                            <a class="btn btn-danger"  href="{{route('roles.destroy',$role->id)}}" style="display:inline"
                                                               data-confirm-delete="true" >
                                                                Delete
                                                            </a>
                                                            @endif

                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Email</th>
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
            {{--        {!! $roles->render() !!}--}}
            <!-- /.row -->
        </section>

    </div>
@endsection











