@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Create Event'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Create Event
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm"></p>
                    </div>
                </div> 
            </div>
            <br>
            <form role="form" method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Event Title</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="location" class="form-control-label">Location</label>
                            <input class="form-control" type="text" name="ubication" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeStart" class="form-control-label">Date and Time Start</label>
                            <input class="form-control" type="text" name="date_time_start" id="dateTime" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeEnd" class="form-control-label">Date and Time End</label>
                            <input class="form-control" type="text" name="date_time_end" id="dateTime" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-control-label">Main Event Image</label>
                            <input class="form-control" type="file" name="image" id="image" required>
                        </div>
                        <div class="form-group">
                            <label for="summary" class="form-control-label">Summary</label>
                            <textarea  class="form-control" name="summary" id="summary" cols="30" rows="5" required></textarea>
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
<script>
    flatpickr("#dateTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y (h:S K)",
    });
</script>
@endpush

