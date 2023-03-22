@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Event'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h4 class="mb-0">Event</h4>
                    
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <p>{{ $event->title }}</p>
                </div>
            </div>           
        </div>
    </div>
@endsection
