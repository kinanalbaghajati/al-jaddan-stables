@extends('frontend.Base')
@section('content')
    <link rel="stylesheet" href="{{asset('frontend/styles/stallions.css')}}"/>
    <main>
        <img src="{{asset('frontend/images/stallions-horse-bg.jpg')}}" alt="horse" class="w-100"/>
        @if($type == 'stallion')
            @if(Config::get('app.locale') == 'ar')
                <h1 class=" almarai-regular">{{__('home.Stallions')}}</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1>{{__('home.Stallions')}}</h1>
            @endif

        @elseif($type == 'mare')
            @if(Config::get('app.locale') == 'ar')
                <h1 class=" almarai-regular">{{__('home.Mares')}}</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1>{{__('home.Mares')}}</h1>
            @endif
        @else
            @if(Config::get('app.locale') == 'ar')
                <h1 class=" almarai-regular">{{__('home.Offsprings')}}</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1>{{__('home.Offsprings')}}</h1>
            @endif
        @endif

        <div class="container">
            <div class="row">
                <div
                    class="col d-flex justify-content-center column-gap-3 row-gap-5 flex-wrap"
                >
                    @foreach($horses as $key => $item)
                        @php
                            $anc = json_decode($item->ancestors,true);

                        @endphp
                        <div id="horse-box">
                            <div>
                                <a href="{{route('horse.details',$item->id)}}">
                                    <img
                                        src="{{asset($item->image()->where('extension','main')->first()->file)}}"
                                        class="img-fluid"
                                        alt="horse"
                                    />
                                    <div id="horse-details">
                                        @if(Config::get('app.locale') == 'ar')
                                            <h2 style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">{{$item->name}}</h2>
                                        @elseif(Config::get('app.locale') == 'en')
                                            <h2>{{$item->name}}</h2>
                                        @endif

                                        <div
                                            class="d-flex align-items-center justify-content-center gap-3 flex-wrap"
                                        >
                                            <img
                                                src="{{asset('frontend/icons/stallion.png')}}"
                                                alt="stallion"
                                                width="35"
                                                class="img-fluid"
                                            />
                                            <span>{{$anc['father_side']['parent']}} </span>
                                            <span>X</span>
                                            <span>{{$anc['mother_side']['parent']}}</span>
                                            <img
                                                src="{{asset('frontend/icons/mere.png')}}"
                                                alt="mere"
                                                width="35"
                                                class="img-fluid"
                                            />
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if(Config::get('app.locale') == 'ar')
                                <h5 style="font-family:Almarai,Sans-Serif,sans-serif;font-weight: 400;font-style: normal;">{{$item->name}}</h5>
                            @elseif(Config::get('app.locale') == 'en')
                                <h5>{{$item->name}}</h5>
                            @endif
                            <p>{{$anc['father_side']['parent']}} X {{$anc['mother_side']['parent']}}</p>
                            <p>{{\Carbon\Carbon::now()->year - $item->age}} {{__('home.Bay')}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
