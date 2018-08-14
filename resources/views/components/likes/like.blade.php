<div class="component component-likes float-right">
    <div class="component-likes__count">{{ $content->like()->count() }}</div>
    @if (Auth::guest())
        <a href="{{ route('login') }}" class="ajax component-likes__button like--false" data-name="Войти" data-url="{{ route('login') }}" data-modal-size="modal-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </a>
    @else
        <a href="#" class="component-likes__button @if($content->liked) like--true @else like--false @endif" data-id="{{ $content->id }}" data-type="{{ $content->type }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </a>
    @endif
</div>