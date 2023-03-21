@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Events'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h4 class="mb-0">Events</h4>
                    <a href="{{ route('event.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date and Time start</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)    
                            <tr>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $event->title }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $event->ubication }}</p>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0">{{ $event->date_time_start }}</p>
                                </td>
                                <td><a href="{{ route('ticket.create', [$event->id]) }}">Add Tickets</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>           
        </div>
    </div>
@endsection
