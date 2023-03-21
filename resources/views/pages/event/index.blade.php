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
            <div class="row">
                
            </div>
        </div>
    </div>
@endsection
