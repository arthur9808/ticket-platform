@extends('layouts.app')

@section('content')
    <main class="main-content mt-0">  
          <div class="modal fade" id="sucesspage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered desktop">
                <div class="modal-content modal-border">
                    <div class="row">
                        <div class="col-8" style="padding-right: 0px">
                            <div class="row" style="padding-top: 40px;">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-start" style="padding-left:40px;">
                                      <i class="fas fa-check-circle" style="color:#36b571"></i><h6 style="padding-top:5px; padding-left:10px">Thanks for your order! #{{ $order->id }}</h6>
                                    </div>
                                </div>
                            </div>
                            <hr> 
                            <div class="modal-body" style="padding-top: 20px; padding-left:40px">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <h6>YOU'RE GOING TO:</h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <p class="mb-0" style="font-size: 30px"><strong>{{ $event->title . ' - ' . date('j F, Y', strtotime($event->date_time_start))}}</strong></>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top:40px">
                                  <div class="col-6">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>{{ count($codes)  . ' Ticket sent to:'}}</h6>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>Date:</h6>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-6">
                                      <p>{{ $order->email_buyer }}</p>
                                  </div>
                                  <div class="col-6"> 
                                      <p>{{date('j F, Y (h:s a)', strtotime($event->date_time_start)) }}</p>
                                  </div>
                                </div>
                                <div class="row" style="padding-bottom: 80px">
                                  <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>Location:</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                      <p>{{ $location }}</p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex align-items-center justify-content-between" style="padding-top: 50px">
                            <a href="{{ route('event.show', [$event->id]) }}" type="button" class="btn btn-dark">Back</a>
                            <div class="col-4">
                              <div class="d-flex align-items-center justify-content-around">
                                <a class="" href="{{ $event->user->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                                <a class="" href="{{ $event->user->instagram_url }}"><i class="fab fa-instagram"></i></a>
                                <a class="" href="{{ $event->user->web_url }}"><i class="fas fa-globe"></i></a>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="" href="{{ route('event.show', [$event->id]) }}" type="button" style="padding-right: 5px;"><i class="fas fa-times"></i></a>
                            </div>
                            <div class="card">
                                <div class="image-container">
                                    <img src="{{ asset('storage/' .  $event->image) }}" style="height:auto;" class="card-img-top card-no-border" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-dialog modal-fullscreen modal-dialog-centered mobile">
                <div class="modal-content modal-border">
                    <div class="row">
                        <div class="col-12" style="padding-right: 0px">
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-12">
                                  <div class="d-flex align-items-center justify-content-end">
                                    <a href="{{ route('event.show', [$event->id]) }}" type="button" style="padding-right: 5px;"><i class="fas fa-times"></i></a>
                                </div>
                                    <div class="d-flex align-items-center justify-content-start" style="padding-left:40px;">
                                      <i class="fas fa-check-circle" style="color:#36b571"></i><h6 style="padding-top:5px; padding-left:10px">Thanks for your order! #{{ $order->id }}</h6>
                                    </div>
                                </div>
                            </div>
                            <hr> 
                            <div class="modal-body" style="padding-top: 20px; padding-left:40px">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <h6>YOU'RE GOING TO:</h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <p class="mb-0" style="font-size: 30px"><strong>{{ $event->title . ' - ' . date('j F, Y', strtotime($event->date_time_start))}}</strong></>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top:40px">
                                  <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>{{ count($codes)  . ' Ticket sent to:'}}</h6>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <p>{{ $order->email_buyer }}</p>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>Date:</h6>
                                    </div>
                                  </div>
                                  <div class="col-12"> 
                                      <p>{{date('j F, Y (h:s a)', strtotime($event->date_time_start)) }}</p>
                                  </div>
                                </div>
                                <div class="row" style="padding-bottom: 40px">
                                  <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-start">
                                      <h6>Location:</h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                      <p>{{ $location }}</p>
                                    </div>
                                  </div>
                                </div> 
                            </div>
                            <div class="d-flex align-items-center justify-content-around" style="padding-top: 40px">
                              <a href="{{ $event->user->facebook_url }}"><i class="fab fa-facebook-f"></i></a>
                              <a href="{{ $event->user->instagram_url }}"><i class="fab fa-instagram"></i></a>
                              <a href="{{ $event->user->web_url }}"><i class="fas fa-globe"></i></a>
                            </div>
                            <nav class="fixed-bottom navbar-dark" id="getTicketsBottom">    
                              <div class="row" style="padding-top: 40px">
                                  <div class="col-12">
                                      <div class="d-grid gap-2" style="padding-left: 20px; padding-right:20px;">        
                                        <a href="{{ route('event.show', [$event->id]) }}" type="button" class="btn btn-dark  btn-lg">Back</a>
                                      </div>
                                  </div>
                              </div>
                          </nav>
                        </div>
                    </div>
                </div>
              </div>
          </div>               
        
    </main>
    @include('layouts.footers.guest.footer')
@endsection
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
  $( document ).ready(function() {
    $('#sucesspage').modal('toggle')
  });
</script>

@endpush
