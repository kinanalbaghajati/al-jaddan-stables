@extends('backend.base_dashboard')
@section('content')
    <section class="content">
        <div class="row">



            <div class="col-xl-6 col-12">
                <div class="box  bg-img" >
                    <div class="box-body text-center">
                        <div class="max-w-500 mx-auto">
                            <h2 class="text-white mb-20 font-weight-500">AL-Jaddan Stables Content Dashboard </h2>
                            <p class="text-white-50 mb-10 font-size-20">You've got <STRONG>{{\App\Models\Horse::count()}}</STRONG> Horses On Your Stable</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <img src="{{asset('frontend/icons/stallion.png')}}" class="py-2 px-2">
                        </div>
                        <div class="">
                            <p class="text-mute mt-20 mb-0 font-size-16">Stallions Num</p>
                            <h3 class="text-white mb-0 font-weight-500">{{\App\Models\Horse::where('type','stallion')->count()}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <img src="{{asset('frontend/icons/stallion.png')}}" class="py-2 px-2">
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Mares Num</p>
                            <h3 class="text-white mb-0 font-weight-500">{{\App\Models\Horse::where('type','mare')->count()}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-secondary-light  rounded w-60 h-60">
                            <img src="{{asset('frontend/icons/stallion.png')}}" class="py-2 px-2">
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Offsprings Num</p>
                            <h3 class="text-white mb-0 font-weight-500">{{\App\Models\Horse::where('type','offspring')->count()}}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
