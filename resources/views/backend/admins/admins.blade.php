@extends('backend.base_dashboard')
@section('content')

    <div class="modal bs-example-modal-lg  @if (count($errors) > 0) show @else fade @endif" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true"
         style="display: @if (count($errors) > 0)block @else none @endif;">
        <div class="modal-dialog modal-lg" >
            <form action="{{ route('admins.store') }}" id="createNewRoleForm" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content " style="background-color: #272E48">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Create User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       value="{{old('name')}}">
                                            </div>
                                            @error('name')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                            <!-- /.input group -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="ti-email"></i>
                                                </div>
                                                <input type="text" class="form-control" id="email" name="email"
                                                       value="{{old('email')}}">
                                            </div>
                                            @error('email')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                            @enderror
                                            <!-- /.input group -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-3">
                                    <div class="col">
                                        <label class="form-control-label" for="role">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}"
                                                        class="text-capitalize">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                        <small class="text-warning">
                                            Go to the permissions page to learn more about it
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row mb-3">
                                    <div class="col">
                                        <label class="form-control-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               value="{{old('password')}}">
                                        @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col">
                                <label class="form-control-label" for="image">Photo</label>
                                <input type="file" name="image" id="image" onchange="mainImage(this)"
                                       class="form-control">
                                @error('image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror

                                {{--                                    <div class="col-md-3 mt-2">--}}
                                {{--                                        <div id="frames"></div>--}}
                                {{--                                    </div>--}}
                            </div>
                        </div>

                        <div class="row flex items-center justify-content-center py-4" id="frames">

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-dark" data-dismiss="modal"
                        >Close
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary float-right" onclick="loadingBtn(this)">Submit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>

    @foreach ($admins as $key => $admin)
        <!-- Modal -->

        <div class="modal fade bs-example-modal-lg" id="editModel{{$admin->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content" style="background-color: #272E48">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit {{$admin->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $admin->name ?? '' }}">
                                    @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{ $admin->email ?? '' }}">
                                    @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label class="form-control-label" for="role">Role</label>
                                    <select class="form-control" name="role" id="role">
                                        @foreach ($roles as $key => $role)

                                            <option value="{{ $role->id }}"
                                                    @if($admin->roles->contains('name', $role->name)) selected
                                                    @endif class="text-capitalize">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                    <small class="text-warning">
                                        Go to the permissions page to learn more about it
                                    </small>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col">
                                    <label class="form-control-label" for="image">Photo</label>
                                    <input type="file" name="image" id="image-edit{{ $admin->id }}" class="form-control"
                                           onchange="EditmainImage{{$admin->id}}(this)">
                                    @error('image')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                    <div class="col-md-12 mt-2">
                                        <div class="row flex  justify-content-center py-2">
                                            <div class=" flex justify-between py-2 gap-10 "
                                                 id="edit_frames{{$admin->id}}">
                                                @if (!is_null($admin->image))
                                                    <img class=" mx-10" src="{{ asset($admin->image) }}"
                                                         alt="{{ $admin->name }} Photo" srcset="" width="210px"
                                                         height="230px" style="border-radius: 5px">
                                                @else
                                                    <small class="text-danger">No Photo for this admin</small>
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-dark" data-dismiss="modal"
                            >Close
                            </button>
                            <button type="submit" class="btn btn-rounded btn-primary float-right" onclick="loadingBtn(this)">Submit</button>
                        </div>

                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach


    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">All Admins</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Admins</li>
                                <li class="breadcrumb-item active" aria-current="page">All Admins</li>
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
                            <h3 class="box-title">Admins Data</h3>
                            <button type="button" class="btn btn-rounded btn-info float-right" data-toggle="modal"
                                    data-target=".bs-example-modal-lg">
                                Create Admin
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
                                                        style="width: 240.562px;">Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 371.312px;">Email
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 60.406px;">Role
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 90.5156px;">Photo
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 169.469px;">Action
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($admins as $key => $admin)

                                                    @if($admin->id == auth()->user()->id)

                                                    @else
                                                        <tr role="row"
                                                            class="@if($key/2 == 1  ) odd @else even @endif ">
                                                            <td class="sorting_1">{{$admin->name}}</td>
                                                            <td><span class="badge badge-light" style="font-size: 16px">{{$admin->email}}</span></td>
                                                            <td>

                                                                @forelse($admin->roles as $role)

                                                                    <span class="badge badge-info" style="font-size: 16px">{{ $role->name }}</span>
                                                                @empty
                                                                    <span class="badge badge-warning" style="font-size: 14px">No Roles Assigned</span>
                                                                @endforelse
                                                            </td>
                                                            <td><img src=" {{asset($admin->image)}}" width='100'/></td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning btn-flat"
                                                                        style="font-size: 18px"
                                                                        data-toggle="modal"
                                                                        data-target="#editModel{{$admin->id}}">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </button> &nbsp;
                                                                <a href="{{route('admins.destroy', $admin->id)}}"
                                                                   role="button" data-confirm-delete="true"
                                                                   class="btn btn-danger btn-flat "
                                                                   style="font-size: 18px">
                                                                    <span class='glyphicon glyphicon-trash'></span>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    @endif

                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Email</th>
                                                    <th rowspan="1" colspan="1">Role</th>
                                                    <th rowspan="1" colspan="1">Photo</th>
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

<script>

    function mainImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                var img = document.getElementById('frames');
                img.innerHTML = "<img id='main_image' class='rounded me-2' src=" + e.target.result + " width='210' height='230' data-holder-rendered='true' style='padding-bottom: 10%;border-radius: 5px'>";


            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // function reload() {
    //     window.location.reload();
    // }
    @foreach($admins as $item)
    function EditmainImage{{$item->id}}(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                var img = document.getElementById('edit_frames{{$item->id}}');
                // img.innerHTML = "<img id='edit_main_image' class='rounded me-2' src=" + e.target.result + " width='200' height='220    ' data-holder-rendered='true' style='padding-bottom: 10%'>";
                var newImg = document.createElement('img');
                newImg.id = 'edit_main_image';
                newImg.className = 'mx-20 ';
                newImg.src = e.target.result;
                newImg.width = '210';
                newImg.height = '230';
                newImg.setAttribute('data-holder-rendered', 'true');
                newImg.style.borderRadius = '5px'
                newImg.name = 'image';

                img.appendChild(newImg);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    @endforeach


</script>


