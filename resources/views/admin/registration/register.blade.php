@extends('admin.base')

@section('content')
    <div class="container">
        <h1>Omashu Users and Abusers</h1>
        <div class="row">
            <div class="col-md-6 users-list">
                @foreach($users as $user)
                    <div class="user-box business-card">
                        <img src="{{ asset('images/website_logo.png') }}" alt=""/>
                        <p class="user-name">{{ $user->name }}</p>
                        <p class="user-email">{{ $user->email }}</p>
                        <button type="button" class="btn omashu-btn warning-btn" data-usersname="{{ $user->name }}" data-action="/admin/users/{{ $user->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                            Delete
                        </button>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6 register-form-box">
                <h3>Register a New User</h3>
                @include('admin.partials.errors')
                @include('admin.registration.registrationform')
            </div>
        </div>
    </div>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    <script>
        $('#confirm-delete-modal').on('show.bs.modal', function(e) {
            $(this).find('.delete-form').attr('action', $(e.relatedTarget).data('action'));
            $(this).find('.users-name').html($(e.relatedTarget).data('usersname'));
        });
    </script>
@endsection