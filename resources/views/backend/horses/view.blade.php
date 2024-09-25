@extends('backend.base_dashboard')
@section('content')

    @php
        $trans_name = $horse->getTranslations('name');
        $trans_disc = $horse->getTranslations('disc');
        $trans_owner = $horse->getTranslations('owner');
    @endphp
    <div class="container-full">
        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">All s</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Horses</li>
                                <li class="breadcrumb-item active" aria-current="page">s</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-outline-info">
                        <div class="box-header">
                            <h4 class="box-title"><strong>{{$trans_name['en']}} Main Image</strong></h4>
                        </div>

                        <form method="post" action="{{route('horse.update.main.image')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$horse->id}}">
                                        <div class='row justify-content-center'><img
                                                src="{{asset($horse->image()->where('extension','main')->first()->file)}}"
                                                alt='slide-3' style='height:150px;width: auto;border-radius: 5px'></div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="py-2 px-1" id="view_image">

                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-6 ">
                                        <div class="form-group py-2">
                                            <label for="url123">Main Image :</label>
                                            <input type="file" class="form-control required" id="wmain_image"
                                                   name="main_image" onchange="mainImage(this)">
                                            @error('main_image')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <button type="submit" class="btn btn-warning float-right" onclick="loadingBtn(this)"
                                                style="margin-top: 5%">
                                            Update
                                        </button>
                                    </div>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-outline-info">
                        <div class="box-header">
                            <h4 class="box-title"><strong>{{$trans_name['en']}} Cover Image</strong></h4>
                        </div>
                        <form method="post" action="{{route('horse.update.cover.image')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="{{$horse->id}}">
                                        <div class='row justify-content-center px-1 py-2'><img
                                                src="{{asset($horse->image()->where('extension','cover')->first()->file)}}"
                                                alt='slide-3' style='height:150px;width: auto;border-radius: 5px'></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="py-2" id="view_image_cover">

                                        </div>
                                    </div>

                                </div>
                                <div class="row row justify-content-center align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url123">Cover Image :</label>
                                            <input type="file" class="form-control required" id="wmain_image"
                                                   name="cover_image" onchange="coverImage(this)">
                                            @error('cover_image')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <button class="btn btn-warning float-right" style="margin-top: 5%" onclick="loadingBtn(this)"
                                                type="submit">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="box box-outline-info">
                <div class="box-header">
                    <h4 class="box-title"><strong>{{$trans_name['en']}} Details</strong></h4>
                </div>
                <form method="post" action="{{route('horse.update.info')}}">
                    @csrf
                    <div class="box-body">
                        <section id="data_section">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="hidden" value="{{$horse->id}}" name="id">
                                    <div class="form-group">
                                        <label for="wfirstName2">Name EN:</label>
                                        <input type="text" class="form-control required" id="wname_en" name="name_en"
                                               placeholder="Name EN" value="{{$trans_name['en']}}">
                                        @error('name_en')
                                        <p class="danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="wlastName2">Name AR:</label>
                                        <input type="text" class="form-control required" id="wname_ar" name="name_ar"
                                               placeholder="Name AR" value="{{$trans_name['ar']}}">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5" class="pl-2">Type:</label>
                                        <select class="selectpicker  mr-10" data-style="btn-info btn-outline-info"
                                                name="type">
                                            <option value="stallion" @if($horse->type == 'stallion') selected @endif>
                                                STALLION.
                                            </option>
                                            <option value="mare" @if($horse->type == 'mare') selected @endif>MARE.
                                            </option>
                                            <option value="offspring" @if($horse->type == 'offspring') selected @endif>
                                                OFFSPRING.
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lastName1">Age :</label>
                                        <input type="number" class="form-control required" id="wage" name="age"
                                               placeholder="NUMBER" value="{{$horse->age}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5">Owner EN:</label>
                                        <input type="text" class="form-control required" id="wowner_en" name="owner_en"
                                               placeholder="Owner EN" value="{{$trans_owner['en']}}">
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="firstName5">Owner AR:</label>
                                        <input type="text" class="form-control required" id="wowner_ar" name="owner_ar"
                                               placeholder="Owner AR" value="{{$trans_owner['ar']}}">
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
                                                  placeholder="Description EN">{{$trans_disc['en']}}</textarea>


                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Description AR:</label>
                                        <textarea rows="5" cols="5" class="form-control required" id="wdisc_ar"
                                                  name="disc_ar"
                                                  placeholder="Description AR">{{$trans_disc['ar']}}</textarea>


                                    </div>
                                </div>
                            </div>
                            <hr class="rounded">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-warning float-right" type="submit" onclick="loadingBtn(this)">Update</button>
                                </div>

                            </div>
                        </section>
                    </div>
                </form>
            </div>

        </section>
        <!-- /.content -->

    </div>
    <script>
        function mainImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('view_image');
                    img.innerHTML = "<div class='row justify-content-center'><img src=" + e.target.result + " alt='slide-3' style='height:150px;width: full;border-radius: 5px'></div>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function coverImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    var img = document.getElementById('view_image_cover');
                    img.innerHTML = "<div class='row justify-content-center'><img src=" + e.target.result + " alt='slide-3' style='height:150px;width: full;border-radius: 5px'></div>";


                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection

