@extends('layouts.app')

@section('content')
    <main class="main-content mt-0 events-main">
        <div class="header">
            <img src="{{ asset('img/logos/logo.png') }}" alt="Logo" class="logo">
        </div>
        <div class="container events-container">
            <div class="d-flex justify-content-center mt-5 mb-5">
                <h4 class="subheader">UP COMMING EVENTS</h4>
            </div>
            <div class="d-flex row">
                    @foreach ($events as $event)
                        @unless($event->tickets->isEmpty())
                        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                            <a class="hover-event-list" href="{{ route('event.show', [$event->id])}}">
                                <div class="card-transparent list-event">
                                    <div class="image-container">
                                        <img src="{{ asset('storage/' .  $event->coverimage) }}" class="card-img-top" alt="...">
                                        <div class="row event-title-container">
                                            <div class="event-date-circle">
                                                <p class="event-date">{{ strtoupper(\Carbon\Carbon::parse($event->date_time_start)->format('D d M')) }}</p>
                                            </div>
                                            <div class="event-title">{{ $event->title }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endunless
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection
@push('js')
<script>
  
</script>
@endpush
