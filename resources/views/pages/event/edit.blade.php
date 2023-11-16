@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Event'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Edit Event
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm"></p>
                    </div>
                </div> 
            </div>
            <br>
            <div id="alert">
                @include('components.alert')
            </div>
            <form role="form" method="POST" action="{{ route('event.update', [$event->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-control-label">Event Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $event->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="summary" class="form-control-label">Event Description</label>
                            <textarea  class="form-control" name="summary" id="summary" cols="30" rows="5" required>{{ $event->summary }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="location" class="form-control-label">Place</label>
                            <input class="form-control" type="text" name="ubication" value="{{ $event->ubication }}" required>
                        </div>
                        <div class="form-group">
                            <label for="street_address" class="form-control-label">Street Address</label>
                            <input class="form-control" type="text" name="street_address" value="{{ $event->street_address }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address_locality" class="form-control-label">Address Locality</label>
                            <input class="form-control" type="text" name="address_locality" value="{{ $event->address_locality }}" required>
                        </div>
                        <div class="form-group">
                            <label for="postal_code" class="form-control-label">Postal Code</label>
                            <input class="form-control" type="text" name="postal_code" value="{{ $event->postal_code }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address_region" class="form-control-label">Adress Region</label>
                            <input class="form-control" type="text" name="address_region" value="{{ $event->address_region }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address_country" class="form-control-label">Adress Country</label>
                            <input class="form-control" type="text" name="address_country" value="{{ $event->address_country }}" required>
                        </div>
                        <div class="form-group">
                            <label for="maps_url" class="form-control-label">Maps URL</label>
                            <input class="form-control" type="text" name="maps_url" value="{{ $event->maps_url }}" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeStart" class="form-control-label">Date and Time Start</label>
                            <input class="form-control" type="text" name="date_time_start" id="dateTime" value="{{ $event->date_time_start }}" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTimeEnd" class="form-control-label">Date and Time End</label>
                            <input class="form-control" type="text" name="date_time_end" id="dateTime" value="{{ $event->date_time_end }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-control-label">Main Event Image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                            style="background-image: url('{{ asset('storage/' .  $event->image) }}'); background-position: top;">
                        </div>
                        <div class="form-group">
                            <label for="about" class="form-control-label">About Event</label>
                            <textarea class="form-control" name="about" id="about" cols="30" rows="5" required>{!! $event->about !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_title" class="form-control-label">Meta Title</label>
                            <input class="form-control" type="text" name="meta_title" value="{{ $event->meta_title }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_description" class="form-control-label">Meta Description</label>
                            <input class="form-control" type="text" name="meta_description" value="{{ $event->meta_description }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
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
    tinymce.init({
        selector: 'textarea#about',
        plugins: 'code',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code',
    });
</script>
@endpush

