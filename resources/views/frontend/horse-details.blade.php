@extends('frontend.Base')
@section('content')
    @php
        $anc = json_decode($horse->ancestors,true);
    @endphp
    <link rel="stylesheet" href="{{asset('frontend/styles/horse-details.css')}}" />
    <main>
        <img
            src="{{asset($horse->image()->where('extension','cover')->first()->file)}}"
            alt="horse"
            class="w-100"
            id="horse-bg"
        />
        <section>
            <div class="d-flex flex-column align-items-center" id="horse-name-box">
                @if(Config::get('app.locale') == 'ar')
                    <h1 style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">{{$horse->name}}</h1>
                @elseif(Config::get('app.locale') == 'en')
                    <h1>{{$horse->name}}</h1>
                @endif
                <p class="m-0 mb-2">{{$anc['father_side']['parent']}} X {{$anc['mother_side']['parent']}}</p>
                <p>{{\Carbon\Carbon::now()->year - $horse->age}} {{__('home.Bay')}}</p>
            </div>
        </section>

        <section>
            <div class="container mt-5 pt-5">
                <div class="row" id="details-box">
                    <div class="col">
                        <div class="">
                                <h5 class="fw-bold">{{__('home.Proudly owned by')}} ({{$horse->owner}})</h5>
                            @if(Config::get('app.locale') == 'ar')
                                <p style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">تفاصيل</p>
                            @elseif(Config::get('app.locale') == 'en')
                                <p>DETAILS</p>
                            @endif

                            <ul>
                                <li><pre style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">{!! $horse->disc !!}</pre></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="slider" style="direction: ltr">
            @if(Config::get('app.locale') == 'ar')
                <h1 style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">الصور</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1>PHOTOS</h1>
            @endif

            <div class="mt-5">
                <div class="f-carousel" id="myCarousel" >
                    @foreach($horse->file()->whereNotIn('extension',['cover','main'])->get() as $image)
                    <div
                        class="f-carousel__slide"
                        data-thumb-src="{{asset($image->file)}}"
                    >
                        <img
                            width="640"
                            height="480"
                            alt="horse-image"
                            data-lazy-src="{{asset($image->file)}}"
                        />
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="pedigree">
            @if(Config::get('app.locale') == 'ar')
                <h1 style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">النسب</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1>PEDIGREE</h1>
            @endif


            <div class="d-flex justify-content-center p-2 align-items-center mt-5">
                <ul class="fs-3">
                    <li class="stallion">{{$anc['father_side']['parent']}}</li>
                </ul>
                <ul class="fs-4">
                    <li class="stallions">{{$anc['father_side']['grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['grand_mare']}}</li>
                </ul>
                <ul class="fs-5">
                    <li class="stallion">{{$anc['father_side']['2nd_1_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['2nd_1_grand_mare']}}</li>
                    <li class="stallion">{{$anc['father_side']['2nd_2_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['2nd_1_grand_mare']}}</li>
                </ul>
                <ul class="fs-6">
                    <li class="stallion">{{$anc['father_side']['3nd_1_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['3nd_1_grand_mare']}}</li>
                    <li class="stallion">{{$anc['father_side']['3nd_2_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['3nd_2_grand_mare']}}</li>
                    <li class="stallion">{{$anc['father_side']['3nd_3_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['3nd_3_grand_mare']}}</li>
                    <li class="stallion">{{$anc['father_side']['3nd_4_grand_stallion']}}</li>
                    <li class="mare">{{$anc['father_side']['3nd_4_grand_mare']}}</li>
                </ul>
            </div>

            <div class="d-flex justify-content-center">
                <hr />
            </div>

            <div class="d-flex justify-content-center p-2 align-items-center mt-3">
                <ul class="fs-3">
                    <li class="mare">{{$anc['mother_side']['parent']}}</li>
                </ul>
                <ul class="fs-4">
                    <li class="stallion">{{$anc['mother_side']['grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['grand_mare']}}</li>
                </ul>
                <ul class="fs-5">
                    <li class="stallion">{{$anc['mother_side']['2nd_1_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['2nd_1_grand_mare']}}</li>
                    <li class="stallion">{{$anc['mother_side']['2nd_2_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['2nd_1_grand_mare']}}</li>
                </ul>
                <ul class="fs-6">
                    <li class="stallion">{{$anc['mother_side']['3nd_1_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['3nd_1_grand_mare']}}</li>
                    <li class="stallion">{{$anc['mother_side']['3nd_2_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['3nd_2_grand_mare']}}</li>
                    <li class="stallion">{{$anc['mother_side']['3nd_3_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['3nd_3_grand_mare']}}</li>
                    <li class="stallion">{{$anc['mother_side']['3nd_4_grand_stallion']}}</li>
                    <li class="mare">{{$anc['mother_side']['3nd_4_grand_mare']}}</li>
                </ul>
            </div>
        </section>
    </main>

@endsection
