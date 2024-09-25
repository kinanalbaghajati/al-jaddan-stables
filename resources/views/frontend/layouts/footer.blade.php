<script>
    const footerContent = `
<div class="container p-5 pb-3 pb-md-5 px-md-0 px-lg-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-4 d-flex d-md-block justify-content-center">
            <img
                src="{{asset('frontend/images/main-logo.svg')}}"
                alt="Logo"
                class="img-fluid"
                id="footer-logo"
            />
        </div>

        <div
            class="col-12 col-md-6 col-lg-5 row row-cols-2 row-cols-md-3 mt-5 mt-md-0 text-center text-md-start text-nowrap"
        >
            <div class="d-flex flex-column gap-2 gap-md-0">
                <a href="{{url('/')}}">{{__('home.Home')}}</a>
                <a href="">{{__('home.The indigenous breed')}}</a>
            </div>
            <div class="d-flex flex-column gap-2 gap-md-0">

                <a href="{{route('front.horses.index','stallion')}}">{{__('home.Stallions')}}</a>
                <a href="{{route('front.horses.index','mare')}}">{{__('home.Mares')}}</a>
            </div>
            <div
                class="d-flex flex-row flex-md-column gap-4 gap-md-0 flex-grow-1 mt-2 mt-md-0"
            >
                <a href="{{route('front.horses.index','offspring')}}" class="last-two-anchors">{{__('home.Offsprings')}}</a>
                <a href="./contactus.html" class="last-two-anchors">{{__('home.contact us')}}</a>
            </div>
        </div>
        <div
            class="col d-flex gap-4 justify-content-center justify-content-lg-end mt-5 mt-md-0"
        >
        @php
        $contact = App\Models\Contact::all();
        @endphp
        @foreach($contact as $item)
            <a href="{{$item->name}}">
                <img
                    src="{{asset($item->type)}}"
                    alt="image"
                    class="img-fluid"
                />
            </a>
            @endforeach
        </div>
    </div>
</div>
`;
    const footer = document.createElement("footer");
    footer.innerHTML = footerContent;
    main.insertAdjacentElement("afterend", footer);
</script>
