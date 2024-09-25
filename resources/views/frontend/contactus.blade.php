@extends('frontend.Base')
@section('content')
  <link rel="stylesheet" href="{{asset('frontend/styles/contactus.css')}}" />
    <main>
      <section class="text-center">
          @if(Config::get('app.locale') == 'ar')
              <h1 class=" almarai-regular">{{__('home.contact us')}}</h1>
          @elseif(Config::get('app.locale') == 'en')
              <h1>{{__('home.contact us')}}</h1>
          @endif
        <div
          class="d-flex gap-4 justify-content-center"
          style="margin-top: 5rem"
        >
          <a
            href="mailto:Info@aljadaanstables.com"
            class="d-flex gap-4 justify-content-center align-items-center"
          >
            <img src="{{asset('frontend/icons/gmail.svg')}}" alt="gmail" width="40" />
            <p class="m-0 fs-1">aljadaanstables</p>
          </a>
        </div>
      </section>
    </main>
@endsection
