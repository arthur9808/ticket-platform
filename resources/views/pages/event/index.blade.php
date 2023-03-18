@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Events'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Events
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            
                        </p>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection
