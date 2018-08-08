@extends('app_sidebar')

@section('content')

    <h1 class="h5">Пользователи</h1>
    <hr>
    <div class="users-list">
        @forelse ($users as $user)
            @include('users.partials.item_list_users')
        @empty
            <div class="alert alert-primary" role="alert">
                Нет пользователей!
            </div>
        @endforelse
<br>
            {{ $users->links() }}
    </div>

@endsection
