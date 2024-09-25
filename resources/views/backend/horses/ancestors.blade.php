@extends('backend.base_dashboard')
@section('content')

    <div class="container-full">


        <!-- Content Header (Page headerBlade) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    @php
                        $trans_name = $horse->getTranslations('name');
                        $trans_anc = $horse->getTranslations('ancestors');
                         $anc_en = json_decode($trans_anc['en'],true);
                         $anc_ar = json_decode($trans_anc['ar'],true);
                    @endphp
                    <h3 class="page-title"> Ancestors English</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Horses</li>
                                <li class="breadcrumb-item active" aria-current="page">{{$trans_name['en']}}'s
                                    Ancestors
                                </li>
                            </ol>
                        </nav>

                    </div>
                    {{--<p>{{$anc_en['father_side']['parent']}}</p>--}}
                </div>
                <div class="" id="view_image_cover" style="margin-right: 75px">
                    <img
                        src="{{asset($horse->image()->where('extension','main')->first()->file)}}"
                        alt='slide-3' style='height:100px;width: auto;border-radius: 5px'></div>
            </div>
        </div>


        <!-- Main content -->
        <section class="content">


            <div class="col-12">
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item"><a class="nav-link " id="first_li" data-toggle="tab" href="#first"
                                                    role="tab"><span><i
                                            class="ion-home"></i></span> <span class="hidden-xs-down ml-15">Father Stallion Side En</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="second_li" data-toggle="tab"
                                                    href="#second_active"
                                                    role="tab"><span><i class="ion-person"></i></span> <span
                                        class="hidden-xs-down ml-15">Father Stallion Side Ar</span></a></li>
                            <li class="nav-item"><a class="nav-link" id="third_li" data-toggle="tab"
                                                    href="#third_active"
                                                    role="tab"><span><i class="ion-email"></i></span> <span
                                        class="hidden-xs-down ml-15">Mother Mare Side En</span></a></li>
                            <li class="nav-item"><a class="nav-link" id="fourth_li" data-toggle="tab"
                                                    href="#fourth_active"
                                                    role="tab"><span><i class="ion-settings"></i></span> <span
                                        class="hidden-xs-down ml-15">Mother Mare Side Ar</span></a></li>
                        </ul>
                        <!-- Tab panes -->

                        <form method="post" action="{{route('horse.store.ancestors')}}">
                            @csrf
                            <input type="hidden" value="{{$horse->id}}" name="id">
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane " id="first" role="tabpanel">
                                    <div class="p-15">
                                        <div class="box bt-2 br-2 bb-2 bl-2 border-warning">
                                            <div class="box-header ">
                                                <div class="row justify-content-center">

                                                    <h4 class="box-title">{{$trans_name['en']}}'s Father Stallion Side
                                                        <strong>English</strong></h4>
                                                </div>
                                            </div>

                                            <div class="box-body">
                                                <section id="pedigree">

                                                    <div class="d-flex justify-content-center align-items-center mt-5">
                                                        <ul class="fs-3" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Father Stallion En:</label>
                                                                    <input class="form-control" name="stallion_en"
                                                                           value="{{ old('stallion_en') ?? $anc_en['father_side']['parent']}}">
                                                                    @error('stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 220px">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_grand_stallion_en') ?? $anc_en['father_side']['grand_stallion']}}"
                                                                           name="fs_grand_stallion_en">
                                                                    @error('fs_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>Grand Mare En:</label>
                                                                    <input class="form-control" name="fs_grand_mare_en"
                                                                           value="{{old('fs_grand_mare_en') ?? $anc_en['father_side']['grand_mare']}}">
                                                                    @error('fs_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 80px">
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_2nd_1_grand_stallion_en') ?? $anc_en['father_side']['2nd_1_grand_stallion']}}"
                                                                           name="fs_2nd_1_grand_stallion_en">
                                                                    @error('fs_2nd_1_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_2nd_1_grand_mare_en') ?? $anc_en['father_side']['2nd_1_grand_mare']}}"
                                                                           name="fs_2nd_1_grand_mare_en">
                                                                    @error('fs_2nd_1_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_2nd_2_grand_stallion_en') ?? $anc_en['father_side']['2nd_2_grand_stallion']}}"
                                                                           name="fs_2nd_2_grand_stallion_en">
                                                                    @error('fs_2nd_2_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_2nd_2_grand_mare_en') ?? $anc_en['father_side']['2nd_2_grand_mare']}}"
                                                                           name="fs_2nd_2_grand_mare_en">
                                                                    @error('fs_2nd_2_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class=" d-flex flex-column" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_1_grand_stallion_en') ?? $anc_en['father_side']['3nd_1_grand_stallion']}}"
                                                                           name="fs_3nd_1_grand_stallion_en">
                                                                    @error('fs_3nd_1_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_1_grand_mare_en') ?? $anc_en['father_side']['3nd_1_grand_mare']}}"
                                                                           name="fs_3nd_1_grand_mare_en">
                                                                    @error('fs_3nd_1_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_2_grand_stallion_en') ?? $anc_en['father_side']['3nd_2_grand_stallion']}}"
                                                                           name="fs_3nd_2_grand_stallion_en">
                                                                    @error('fs_3nd_2_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_2_grand_mare_en') ?? $anc_en['father_side']['3nd_2_grand_mare']}}"
                                                                           name="fs_3nd_2_grand_mare_en">
                                                                    @error('fs_3nd_2_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_3_grand_stallion_en') ?? $anc_en['father_side']['3nd_3_grand_stallion']}}"
                                                                           name="fs_3nd_3_grand_stallion_en">
                                                                    @error('fs_3nd_3_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_3_grand_mare_en') ?? $anc_en['father_side']['3nd_3_grand_mare']}}"
                                                                           name="fs_3nd_3_grand_mare_en">
                                                                    @error('fs_3nd_3_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_4_grand_stallion_en') ?? $anc_en['father_side']['3nd_4_grand_stallion']}}"
                                                                           name="fs_3nd_4_grand_stallion_en">
                                                                    @error('fs_3nd_4_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control"
                                                                           value="{{old('fs_3nd_4_grand_mare_en') ?? $anc_en['father_side']['3nd_4_grand_mare']}}"
                                                                           name="fs_3nd_4_grand_mare_en">
                                                                    @error('fs_3nd_4_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                </section>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="second_active" role="tabpanel">
                                    <div class="p-15">
                                        <div class="box bt-2 br-2 bb-2 bl-2 border-warning">
                                            <div class="box-header ">
                                                <div class="row justify-content-center">

                                                    <h4 class="box-title">{{$trans_name['en']}}'s Father Stallion Side
                                                        <strong>Arabic</strong></h4>
                                                </div>
                                            </div>

                                            <div class="box-body">
                                                <section id="pedigree">

                                                    <div class="d-flex justify-content-center align-items-center mt-5">
                                                        <ul class="fs-3" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Father Stallion Ar:</label>
                                                                    <input class="form-control" name="stallion_ar"
                                                                           value="{{old('stallion_ar') ?? $anc_ar['father_side']['parent']}}">
                                                                    @error('stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 220px">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_grand_stallion_ar') ?? $anc_ar['father_side']['grand_stallion']}}"
                                                                           name="fs_grand_stallion_ar">
                                                                    @error('fs_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>Grand Mare Ar:</label>
                                                                    <input class="form-control" name="fs_grand_mare_ar" value="{{old('fs_grand_mare_ar') ?? $anc_ar['father_side']['grand_mare']}}">
                                                                    @error('fs_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 80px">
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_2nd_1_grand_stallion_ar') ?? $anc_ar['father_side']['2nd_1_grand_stallion']}}"
                                                                           name="fs_2nd_1_grand_stallion_ar">
                                                                    @error('fs_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_2nd_1_grand_mare_ar') ?? $anc_ar['father_side']['2nd_1_grand_mare']}}"
                                                                           name="fs_2nd_1_grand_mare_ar">
                                                                    @error('fs_2nd_1_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_2nd_2_grand_stallion_ar') ?? $anc_ar['father_side']['2nd_2_grand_stallion']}}"
                                                                           name="fs_2nd_2_grand_stallion_ar">
                                                                    @error('fs_2nd_2_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_2nd_2_grand_mare_ar') ?? $anc_ar['father_side']['2nd_2_grand_mare']}}"
                                                                           name="fs_2nd_2_grand_mare_ar">
                                                                    @error('fs_2nd_2_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class=" d-flex flex-column" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_1_grand_stallion_ar') ?? $anc_ar['father_side']['3nd_1_grand_stallion']}}"
                                                                           name="fs_3nd_1_grand_stallion_ar">
                                                                    @error('fs_3nd_1_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_1_grand_mare_ar') ?? $anc_ar['father_side']['3nd_1_grand_mare']}}"
                                                                           name="fs_3nd_1_grand_mare_ar">
                                                                    @error('fs_3nd_1_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_2_grand_stallion_ar') ?? $anc_ar['father_side']['3nd_2_grand_stallion']}}"
                                                                           name="fs_3nd_2_grand_stallion_ar">
                                                                    @error('fs_3nd_2_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_2_grand_mare_ar') ?? $anc_ar['father_side']['3nd_2_grand_mare']}}"
                                                                           name="fs_3nd_2_grand_mare_ar">
                                                                    @error('fs_3nd_2_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_3_grand_stallion_ar') ?? $anc_ar['father_side']['3nd_3_grand_stallion']}}"
                                                                           name="fs_3nd_3_grand_stallion_ar">
                                                                    @error('fs_3nd_3_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror

                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_3_grand_mare_ar') ?? $anc_ar['father_side']['3nd_3_grand_mare']}}"
                                                                           name="fs_3nd_3_grand_mare_ar">
                                                                    @error('fs_3nd_3_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_4_grand_stallion_ar') ?? $anc_ar['father_side']['3nd_4_grand_stallion']}}"
                                                                           name="fs_3nd_4_grand_stallion_ar">
                                                                    @error('fs_3nd_4_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('fs_3nd_4_grand_mare_ar') ?? $anc_ar['father_side']['3nd_4_grand_mare']}}"
                                                                           name="fs_3nd_4_grand_mare_ar">
                                                                    @error('fs_3nd_4_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                </section>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="third_active" role="tabpanel">
                                    <div class="p-15">
                                        <div class="box bt-2 br-2 bb-2 bl-2 border-primary">
                                            <div class="box-header ">
                                                <div class="row justify-content-center">

                                                    <h4 class="box-title">{{$trans_name['en']}}'s Mother Mare Side
                                                        <strong>English</strong></h4>
                                                </div>
                                            </div>

                                            <div class="box-body">
                                                <section id="pedigree">

                                                    <div class="d-flex justify-content-center align-items-center mt-5">
                                                        <ul class="fs-3" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Mother Mare En:</label>
                                                                    <input class="form-control" name="mare_en" value="{{old('mare_en') ?? $anc_en['mother_side']['parent']}}">
                                                                    @error('mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 220px">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_grand_stallion_en') ?? $anc_en['mother_side']['grand_stallion']}}"
                                                                           name="ms_grand_stallion_en">
                                                                    @error('ms_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>Grand Mare En:</label>
                                                                    <input class="form-control" name="ms_grand_mare_en" value="{{old('ms_grand_mare_en') ?? $anc_en['mother_side']['grand_mare']}}">
                                                                    @error('ms_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 80px">
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_1_grand_stallion_en') ?? $anc_en['mother_side']['2nd_1_grand_stallion']}}"
                                                                           name="ms_2nd_1_grand_stallion_en">
                                                                    @error('ms_2nd_1_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_1_grand_mare_en') ?? $anc_en['mother_side']['2nd_1_grand_mare']}}"
                                                                           name="ms_2nd_1_grand_mare_en">
                                                                    @error('ms_2nd_1_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_2_grand_stallion_en') ?? $anc_en['mother_side']['2nd_2_grand_stallion']}}"
                                                                           name="ms_2nd_2_grand_stallion_en">
                                                                    @error('ms_2nd_2_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_2_grand_mare_en') ?? $anc_en['mother_side']['2nd_2_grand_mare']}}"
                                                                           name="ms_2nd_2_grand_mare_en">
                                                                    @error('ms_2nd_2_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class=" d-flex flex-column" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_1_grand_stallion_en') ?? $anc_en['mother_side']['3nd_1_grand_stallion']}}"
                                                                           name="ms_3nd_1_grand_stallion_en">
                                                                    @error('ms_3nd_1_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_1_grand_mare_en') ?? $anc_en['mother_side']['3nd_1_grand_mare']}}"
                                                                           name="ms_3nd_1_grand_mare_en">
                                                                    @error('ms_3nd_1_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_2_grand_stallion_en') ?? $anc_en['mother_side']['3nd_2_grand_stallion']}}"
                                                                           name="ms_3nd_2_grand_stallion_en">
                                                                    @error('ms_3nd_2_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_2_grand_mare_en') ?? $anc_en['mother_side']['3nd_2_grand_mare']}}"
                                                                           name="ms_3nd_2_grand_mare_en">
                                                                    @error('ms_3nd_2_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_3_grand_stallion_en') ?? $anc_en['mother_side']['3nd_3_grand_stallion']}}"
                                                                           name="ms_3nd_3_grand_stallion_en">
                                                                    @error('ms_3nd_3_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_3_grand_mare_en') ?? $anc_en['mother_side']['3nd_3_grand_mare']}}"
                                                                           name="ms_3nd_3_grand_mare_en">
                                                                    @error('ms_3nd_3_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_4_grand_stallion_en') ?? $anc_en['mother_side']['3nd_4_grand_stallion']}}"
                                                                           name="ms_3nd_4_grand_stallion_en">
                                                                    @error('ms_3nd_4_grand_stallion_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare En:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_4_grand_mare_en') ?? $anc_en['mother_side']['3nd_4_grand_mare']}}"
                                                                           name="ms_3nd_4_grand_mare_en">
                                                                    @error('ms_3nd_4_grand_mare_en')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                </section>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="fourth_active" role="tabpanel">
                                    <div class="p-15">
                                        <div class="box bt-2 br-2 bb-2 bl-2 border-primary">
                                            <div class="box-header ">
                                                <div class="row justify-content-center">

                                                    <h4 class="box-title">{{$trans_name['en']}}'s Mother Mare Side
                                                        <strong>Arabic</strong></h4>
                                                </div>
                                            </div>

                                            <div class="box-body">
                                                <section id="pedigree">

                                                    <div class="d-flex justify-content-center align-items-center mt-5">
                                                        <ul class="fs-3" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Mother Mare Ar:</label>
                                                                    <input class="form-control" name="mare_ar" value="{{old('mare_ar') ?? $anc_ar['mother_side']['parent']}}">
                                                                    @error('mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 220px">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>Grand Stallion Ar:</label>
                                                                    <input class="form-control"  value="{{old('ms_grand_stallion_ar') ?? $anc_ar['mother_side']['grand_stallion']}}"
                                                                           name="ms_grand_stallion_ar">
                                                                    @error('ms_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>Grand Mare Ar:</label>
                                                                    <input class="form-control" name="ms_grand_mare_ar" value="{{old('ms_grand_mare_ar') ?? $anc_ar['mother_side']['grand_mare']}}">
                                                                    @error('ms_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class="d-flex flex-column" type="none" style="gap: 80px">
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_1_grand_stallion_ar') ?? $anc_ar['mother_side']['2nd_1_grand_stallion']}}"
                                                                           name="ms_2nd_1_grand_stallion_ar">
                                                                    @error('ms_2nd_1_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_1_grand_mare_ar') ?? $anc_ar['mother_side']['2nd_1_grand_mare']}}"
                                                                           name="ms_2nd_1_grand_mare_ar">
                                                                    @error('ms_2nd_1_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_2_grand_stallion_ar') ?? $anc_ar['mother_side']['2nd_2_grand_stallion']}}"
                                                                           name="ms_2nd_2_grand_stallion_ar">
                                                                    @error('ms_2nd_2_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>2nd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_2nd_2_grand_mare_ar') ?? $anc_ar['mother_side']['2nd_2_grand_mare']}}"
                                                                           name="ms_2nd_2_grand_mare_ar">
                                                                    @error('ms_2nd_2_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <ul class=" d-flex flex-column" type="none">
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_1_grand_stallion_ar') ?? $anc_ar['mother_side']['3nd_1_grand_stallion']}}"
                                                                           name="ms_3nd_1_grand_stallion_ar">
                                                                    @error('ms_3nd_1_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_1_grand_mare_ar') ?? $anc_ar['mother_side']['3nd_1_grand_mare']}}"
                                                                           name="ms_3nd_1_grand_mare_ar">
                                                                    @error('ms_3nd_1_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_2_grand_stallion_ar') ?? $anc_ar['mother_side']['3nd_2_grand_stallion']}}"
                                                                           name="ms_3nd_2_grand_stallion_ar">
                                                                    @error('ms_3nd_2_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_2_grand_mare_ar') ?? $anc_ar['mother_side']['3nd_2_grand_mare']}}"
                                                                           name="ms_3nd_2_grand_mare_ar">
                                                                    @error('ms_3nd_2_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_3_grand_stallion_ar') ?? $anc_ar['mother_side']['3nd_3_grand_stallion']}}"
                                                                           name="ms_3nd_3_grand_stallion_ar">
                                                                    @error('ms_3nd_3_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_3_grand_mare_ar') ?? $anc_ar['mother_side']['3nd_3_grand_mare']}}"
                                                                           name="ms_3nd_3_grand_mare_ar">
                                                                    @error('ms_3nd_3_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="stallion">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Stallion Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_4_grand_stallion_ar') ?? $anc_ar['mother_side']['3nd_4_grand_stallion']}}"
                                                                           name="ms_3nd_4_grand_stallion_ar">
                                                                    @error('ms_3nd_4_grand_stallion_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                            <li class="mare">
                                                                <div class="form-group">
                                                                    <label>3rd Grand Mare Ar:</label>
                                                                    <input class="form-control" value="{{old('ms_3nd_4_grand_mare_ar') ?? $anc_ar['mother_side']['3nd_1_grand_mare']}}"
                                                                           name="ms_3nd_4_grand_mare_ar">
                                                                    @error('ms_3nd_4_grand_mare_ar')
                                                                    <p class="text-danger">this is required</p>
                                                                    @enderror
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>


                                                </section>


                                            </div>
                                            <div class="box-footer">
                                                <button class="btn btn-primary float-right" type="submit" onclick="loadingBtn(this)">Insert</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>


        </section>
    </div>

    @if($errors->any())
        @if($errors->has('stallion_en')
|$errors->has('fs_grand_stallion_en')
|$errors->has('fs_grand_mare_en')
|$errors->has('fs_2nd_1_grand_stallion_en')
|$errors->has('fs_2nd_1_grand_mare_en')
|$errors->has('fs_2nd_2_grand_stallion_en')
|$errors->has('fs_2nd_2_grand_mare_en')
|$errors->has('fs_3nd_1_grand_stallion_en')
|$errors->has('fs_3nd_1_grand_mare_en')
|$errors->has('fs_3nd_2_grand_stallion_en')
|$errors->has('fs_3nd_2_grand_mare_en')
|$errors->has('fs_3nd_3_grand_stallion_en')
|$errors->has('fs_3nd_3_grand_mare_en')
|$errors->has('fs_3nd_4_grand_stallion_en')
|$errors->has('fs_3nd_4_grand_mare_en')
)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var element = document.getElementById('first');
                    var element_li = document.getElementById('first_li');
                    element.classList.add('active');
                    element_li.classList.add('active');
                });
            </script>
        @elseif($errors->has('stallion_ar')
|$errors->has('fs_grand_stallion_ar')
|$errors->has('fs_grand_mare_ar')
|$errors->has('fs_2nd_1_grand_stallion_ar')
|$errors->has('fs_2nd_1_grand_mare_ar')
|$errors->has('fs_2nd_2_grand_stallion_ar')
|$errors->has('fs_2nd_2_grand_mare_ar')
|$errors->has('fs_3nd_1_grand_stallion_ar')
|$errors->has('fs_3nd_1_grand_mare_ar')
|$errors->has('fs_3nd_2_grand_stallion_ar')
|$errors->has('fs_3nd_2_grand_mare_ar')
|$errors->has('fs_3nd_3_grand_stallion_ar')
|$errors->has('fs_3nd_3_grand_mare_ar')
|$errors->has('fs_3nd_4_grand_stallion_ar')
|$errors->has('fs_3nd_4_grand_mare_ar'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var element = document.getElementById('second_active');
                    var element_li = document.getElementById('second_li');
                    element.classList.add('active');
                    element_li.classList.add('active');

                });
            </script>
        @elseif(
    $errors->has('mare_en')
|$errors->has('ms_grand_stallion_en')
|$errors->has('ms_grand_mare_en')
|$errors->has('ms_2nd_1_grand_stallion_en')
|$errors->has('ms_2nd_1_grand_mare_en')
|$errors->has('ms_2nd_2_grand_stallion_en')
|$errors->has('ms_2nd_2_grand_mare_en')
|$errors->has('ms_3nd_1_grand_stallion_en')
|$errors->has('ms_3nd_1_grand_mare_en')
|$errors->has('ms_3nd_2_grand_stallion_en')
|$errors->has('ms_3nd_2_grand_mare_en')
|$errors->has('ms_3nd_3_grand_stallion_en')
|$errors->has('ms_3nd_3_grand_mare_en')
|$errors->has('ms_3nd_4_grand_stallion_enr')
|$errors->has('ms_3nd_4_grand_mare_en')
)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var element = document.getElementById('third_active');
                    var element_li = document.getElementById('third_li');
                    element.classList.add('active');
                    element_li.classList.add('active');

                });
            </script>
        @elseif(
    $errors->has('mare_ar')
|$errors->has('ms_grand_stallion_ar')
|$errors->has('ms_grand_mare_ar')
|$errors->has('ms_2nd_1_grand_stallion_ar')
|$errors->has('ms_2nd_1_grand_mare_ar')
|$errors->has('ms_2nd_2_grand_stallion_ar')
|$errors->has('ms_2nd_2_grand_mare_ar')
|$errors->has('ms_3nd_1_grand_stallion_ar')
|$errors->has('ms_3nd_1_grand_mare_ar')
|$errors->has('ms_3nd_2_grand_stallion_ar')
|$errors->has('ms_3nd_2_grand_mare_ar')
|$errors->has('ms_3nd_3_grand_stallion_ar')
|$errors->has('ms_3nd_3_grand_mare_ar')
|$errors->has('ms_3nd_4_grand_stallion_ar')
|$errors->has('ms_3nd_4_grand_mare_ar')
)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var element = document.getElementById('fourth_active');
                    var element_li = document.getElementById('fourth_li');
                    element.classList.add('active');
                    element_li.classList.add('active');

                });
            </script>

        @endif
    @endif
@endsection
