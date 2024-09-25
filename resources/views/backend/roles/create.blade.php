@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Create Role</h3>
                    <div class="col-lg-12 margin-tb float-right">
                        <div class="pull-left">

                        </div>

                    </div>

                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Roles</li>
                                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">


            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="box box-outline-info">
                    <div class="box-header">
                        <h4 class="box-title">
                            Create Role
                        </h4>
                        <div class="box-tools pull-right">

                            <a class="btn btn-outline-dark btn-flat " role="button" href="{{route('role.index')}}"
                               style="margin-bottom: 20px">
                                <span style="color: black">back</span>
                            </a>

                        </div>
                    </div>

                    <div class="box-body">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong class="pr-20">Name:</strong>
                                {{--                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}--}}
                                <label>
                                    <input class="form-control" name="name" type="text" placeholder="Name" value="{{old('name')}}"
                                    >
                                </label>
                            </div>
                        </div>
                        <hr class="rounded">
                        <div class=" flex px-4 justify-between items-start gap-10">
                            <strong class="pr-20">Permissions:</strong>
                            @foreach($permission as $value)

                                <span class="pr-5 mr-10">
                               <input type="checkbox" id="checkbox_{{$value->id}}"
                                      name="permission[]" value="{{$value->name}}">
                                                    <label for="checkbox_{{$value->id}}">{{$value->name}}</label>

                            </span>

                            @endforeach
                        </div>
                    </div>
                    <div class="box-footer">

                        <button type="submit" class="btn btn-primary btn-rounded float-right" onclick="loadingBtn(this)">Submit</button>

                    </div>
                </div>
            </form>

        </section>
    </div>

@endsection
