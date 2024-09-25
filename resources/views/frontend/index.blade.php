@extends('frontend.Base')
@section('content')
    <main>

        <section id="home-bg">

            <img @if(isset($firstsection->file->file)) src="{{asset($firstsection->file->file) }}" @endif alt="horses" class="w-100"/>

            <h1 id="home-bg-title">
                {!! $title->text !!}
            </h1>

        </section>


        <section id="home-article">
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        @if(Config::get('app.locale') == 'ar')
                            <h1 class="section-heading almarai-regular">{{ __('home.W') }}{{ __('home.ho We Are') }}</h1>
                        @elseif(Config::get('app.locale') == 'en')
                            <h1 class="section-heading "><span>{{ __('home.W') }}</span>{{ __('home.ho We Are') }}</h1>
                        @endif

                        {!! $firstsection->text ?? '' !!}

                    </div>
                </div>
            </div>
        </section>

        <section id="home-pure-horses">

            <img  @if(isset($secondsection->file->file)) src="{{asset($secondsection->file->file)}}" @endif alt="pure-horses"/>

            <div id="box" style="margin-right: 3%">
            {!! $secondsection->text ?? '' !!}
        </section>

        <section id="home-gallery" style="direction: ltr">
            @if(Config::get('app.locale') == 'ar')
                <h1 class="section-heading text-center almarai-regular">المعرض</h1>
            @elseif(Config::get('app.locale') == 'en')
                <h1 class="section-heading text-center"><span>G</span>allery</h1>
            @endif

            <div class="mt-5">
                <div class="f-carousel" id="myCarousel">
                    @foreach($gallery->file as $file)
                        <div
                            class="f-carousel__slide"
                            data-thumb-src="{{asset($file->file)}}"
                        >
                            <img
                                width="640"
                                height="480"
                                alt="horse-image"
                                data-lazy-src="{{asset($file->file)}}"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <section id="home-contactus">
            <div class="d-flex flex-column align-items-center">
                @if(Config::get('app.locale') == 'ar')
                    <h1 class="section-heading almarai-regular">تواصل معنا </h1>
                @elseif(Config::get('app.locale') == 'en')
                    <h1 class="section-heading "><span>C</span>ontact us</h1>
                @endif
                <p class="fs-5 fw-medium text-center">
                    {{ __('home.first') }}
                </p>
                @if(session()->has('message_danger'))
                    <div class="alert">
                        <p style="color: red">{{ session()->get('message_danger') }}</p>
                    </div>
                @endif
                @if(session()->has('message_suc'))
                    <div class="alert">
                        <p style="color: green">{{ session()->get('message_suc') }}</p>
                    </div>
                @endif.
                <form class="d-flex flex-column gap-3" method="post" action="{{route('contact.mail')}}">
                    @csrf
                    <div>
                        <input
                            type="text"
                            name="name"
                            aria-label="hidden"
                            autocomplete="off"
                            required
                        />
                        <label>{{ __('home.Your name') }}</label>
                    </div>
                    <div>
                        <input
                            type="email"
                            name="email"
                            aria-label="hidden"
                            autocomplete="off"
                            required
                        />
                        <label>{{ __('home.Your email') }}</label>
                    </div>
                    <div>
              <textarea
                  name="message"
                  rows="4"
                  aria-label="hidden"
                  required
              ></textarea>
                        <label>{{ __('home.Your message') }}</label>
                    </div>
                    <button type="submit" onclick="loadingBtn(this)">{{__('home.Send')}}</button>
                </form>
            </div>
        </section>
    </main>

    <script>
        function loadingBtn(element) {
            if (element.tagName.toLowerCase() == "button") {
                event.target.form.submit();
                element.disabled = true;
                element.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...';
                element.setAttribute('type', 'button');
            } else if (element.tagName.toLowerCase() == "a") {
                element.disabled = true;
                element.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...';
            } else if (element.tagName.toLowerCase() == "input") {
                element.disabled = true;
                element.value = 'Loading...';
                event.target.form.submit();
            }
        }

    </script>
@endsection


