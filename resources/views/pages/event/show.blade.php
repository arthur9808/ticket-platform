@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
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
                </div>     
                <div class="card-body pb-0">
                    <div class="card" style="width: 20rem">
                        <div class="d-flex align-items-center justify-content-start">
                            <i class="far fa-calendar" style="padding-right: 10px"></i>
                            <h6 class="mb-0">Date and Time</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="mb-0" style="font-size: 0.80rem">{{ date('j F, Y (h:s a)', strtotime($event->date_time_start)) . ' - ' . date('j F, Y (h:s a)', strtotime($event->date_time_end)) }}</p>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection
