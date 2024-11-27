@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0 min-vh-90">
        <div class="header">
            <h2>{{ $header }}</h2>
        </div>
        <div class="container">
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-start mt-5">
                <h3>Next Events</h3>
            </div>
            <div class="d-flex row">
                    @foreach ($events as $event)
                        @unless($event->tickets->isEmpty())
                        <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-start">
                            <a class="hover-event-list" href="{{ route('event.show', [$event->id])}}">
                                <div class="card-transparent list-event" style="width: 18rem;">
                                    <img src="{{ asset('storage/' .  $event->coverimage) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="date-event">{{ date('j F (h:s a)', strtotime($event->date_time_start)) }}</p>
                                        <p class="ubication">{{ $event->ubication }}</p>
                                        <p class="price">{{ $event->tickets[0]->type == 'free' ? 'Free' : '$' . $event->tickets[0]->price }}</p>
                                        <p class="createdBy">{{ $event->user->firstname . ' ' . $event->user->lastname }}</p>
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
