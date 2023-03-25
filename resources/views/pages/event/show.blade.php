@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-60 pt-5 pb-11 m-6 border-radius-lg"
            style="background-image: url('{{ asset('storage/' .  $event->image) }}'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-3"></span>
        </div>
        <div class="card shadow-lg mt-0">
            <div class="card-body p-3">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">{{ date('j F, Y', strtotime($event->date_time_start)) }}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0">{{ $event->title }}</h3>
                    </div>
                    <div class="d-flex align-items-center" style="padding-top: 20px">
                        <h6 class="mb-0">{{ $event->summary }}</h6>
                    </div>
                </div>     
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-transparent">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="far fa-calendar" style="padding-right: 10px"></i>
                                            <h6 class="mb-0">Date and Time</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0" style="font-size: 0.80rem">{{ date('j F, Y (h:s a)', strtotime($event->date_time_start)) . ' - ' . date('j F, Y (h:s a)', strtotime($event->date_time_end)) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-transparent">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="fas fa-map-pin" style="padding-right: 10px"></i>
                                            <h6 class="mb-0">Location</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0" style="font-size: 0.80rem">{{ $event->ubication }}</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ $event->maps_url }}" target="_blank"><i class="fas fa-map" style="font-weight: 100">Google Maps</i></a>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="col-6 d-flex align-items-center justify-content-end">
                            <div class="card" style="width: 20rem">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h4>$200</h4>
                                    </div>
                                    <div class="d-grid gap-2" style="padding-top: 10px">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">
                                            Get Tickets
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row" style="padding-top: 40px">
                        <div class="card-transparent" style="width: 40rem">
                            <div class="card-header">
                                <h4>About this event</h4>
                            </div>
                            <img src="{{ asset('storage/' .  $event->image) }}" class="card-img-bottom" alt="">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 40px">
                        <div class="card-transparent" style="width: 40rem">
                            <div class="card-header">
                                <h4>Organizer</h4>
                            </div>
                            <div class="card-body" >
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('storage/' .  $event->user->image) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center" style="padding-top: 20px">
                                <p class="mb-0" style="font-size: 0.80rem">Organized by</p>  
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                <h6>{{ $event->user->username }}</h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center" style="padding-top: 40px">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Contact
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Contact Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <h5>Phone</h5>
                                <p>{{ $event->user->phone }}</p>
                            </div>
                            <div class="col-6">
                                <h5>Email</h5>
                                <p>{{ $event->user->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <h5>Social Networks</h5>
                            <div class="d-flex align-items-center justify-content-around">
                                <a href="{{ $event->user->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ $event->user->instagram_url }}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ $event->user->web_url }}"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                      </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection
