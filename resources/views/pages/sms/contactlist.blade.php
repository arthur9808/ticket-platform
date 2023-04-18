@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Contact List'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="card-body p-3">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <h4 class="mb-0">Contact List</h4>
                    <a href="{{ route('contactlist.create') }}" class="btn btn-primary btn-sm ms-auto">Create</a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact_lists as $list)
                                <tr>
                                    <td style="padding-left: 24px">
                                        <p class="text-sm font-weight-bold mb-0">{{ $list['id'] }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $list['name'] }}</p>
                                    </td>
                                    <td style="padding-left: 24px"><a href="{{ route('contacts.add', [$list['id'], $list['name']]) }}"><i class="fas fa-plus"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>           
        </div>
    </div>
@endsection
@push('js')

<script>
     
</script>
@endpush