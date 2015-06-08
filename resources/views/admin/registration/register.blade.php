@extends('admin.base')

@section('content')
    <h1>Register a New User</h1>
    @include('admin.partials.errors')
    @foreach($users as $user)
        <div class="user-box">
            <p class="user-name">{{ $user->name }}</p>
            <p class="user-email">{{ $user->email }}</p>

            <button type="button" class="btn btn-danger pull-right" data-usersname="{{ $user->name }}" data-action="/admin/registration/delete/{{ $user->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
            </button>
        </div>
    @endforeach
    @include('admin.registration.registrationform')
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