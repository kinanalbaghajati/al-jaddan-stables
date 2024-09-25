@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Show Role</h3>
                    <div class="col-lg-12 margin-tb float-right">
                        <div class="pull-left">

                        </div>

                    </div>

                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Roles</li>
                                <li class="breadcrumb-item active" aria-current="page">Show Role</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">



                        <div class="box box-outline-info">
                            <div class="box-header">
                                <h4 class="box-title">
                                     {{$role->name}} Role
                                  </h4>
                                <div class="box-tools pull-right">

                                       <a class="btn btn-outline-dark btn-flat " role="button" href="{{route('role.index')}}" style="margin-bottom: 20px">
                                           <span style="color: black">back</span>
                                       </a>

                                </div>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <strong>Permissions:</strong>
                                    @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            <label class="label label-info" style="font-size: 14px">{{ $v->name }}</label>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>

@endsection
