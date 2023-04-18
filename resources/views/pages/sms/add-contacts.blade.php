@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Contacts to '. $name])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Add Contacts to {{ $name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm"></p>
                    </div>
                </div> 
            </div>
            <br>
            <form role="form" method="POST" action="{{ route('contactlist.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        
                        <label for="title" class="form-control-label">Select Event or Ticket</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="event" value="event" checked>
                            <label class="form-check-label" for="event">
                            Event
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" value="ticket" id="ticket">
                            <label class="form-check-label" for="ticket">
                            Ticket
                            </label>
                        </div>
                        <div class="form-group" id="divEvents">
                            <label for="events" class="form-control-label">Events</label>
                            <select class="form-control" name="events" id="events">
                                <option value="">Select an event...</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="divTickets" hidden>
                            <label for="tickets" class="form-control-label">Tickets</label>
                            <select class="form-control" name="tickets" id="tickets">
                                <option value="">Select a ticket...</option>
                                @foreach ($tickets as $ticket)
                                    <option value="{{ $ticket->id }}">{{ $ticket->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')

<script>
    $("#event").on("change", function(){
        var checked = $(this).is(':checked');
        if(checked){
            $("#divTickets").prop("hidden", true);
            $("#divEvents").prop("hidden", false);
        }  
    }); 
    $("#ticket").on("change", function(){
        var checked = $(this).is(':checked');
        if(checked){
            $("#divTickets").prop("hidden", false);
            $("#divEvents").prop("hidden", true);
        }
          
    }); 
</script>
@endpush

