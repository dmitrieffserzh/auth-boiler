@extends('app_sidebar')

@section('content')

    <h1 class="h1">П</h1>

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
