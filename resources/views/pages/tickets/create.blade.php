@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Tickets'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Create Tickets for Event {{ $event->title }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm"></p>
                    </div>
                </div> 
            </div>
            <br>
            <form role="form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Name Ticket</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="form-control-label">Available Quantity</label>
                            <input class="form-control" type="number" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeStart" class="form-control-label">Sales Date and Time Start</label>
                            <input class="form-control" type="text" name="date_time_start" id="dateTime" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeEnd" class="form-control-label">Sales Date and Time End</label>
                            <input class="form-control" type="text" name="date_time_end" id="dateTime" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paid" id="paid" checked>
                            <label class="form-check-label" for="paid">
                            Paid
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paid" id="free">
                            <label class="form-check-label" for="free">
                            Free
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-control-label">Price</label>
                            <input class="form-control" type="text" name="price" id="price" placeholder="$" required>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<!-- Datepicker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    flatpickr("#dateTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y (h:S K)",
    });
    
    
    $("#free").on("change", function(){
        var checked = $(this).is(':checked');
        if(checked){
            $("#price").prop("disabled", true);
        }
        else{
            $("#price").prop("disabled", false);
        }    
    }); 
    $("#paid").on("change", function(){
        var checked = $(this).is(':checked');
        if(checked){
            $("#price").prop("disabled", false);
        }
        else{
            $("#price").prop("disabled", true);
        }    
    }); 
</script>
@endpush

