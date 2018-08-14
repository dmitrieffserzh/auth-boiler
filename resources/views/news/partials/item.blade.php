@php($count = 1)
@forelse ($news as $item)

    <div class="@if( $count == 99 || $count == 99 || $count == 99 ) col-lg-8 @else col-lg-6 @endif">
        <div class="mb-4 bg-white item-test">
            <div class="p-3
                    @if( $count == 99 || $count == 99 || $count == 99 )
                    position-absolute abs-pos
                    @endif
                    ">
                <a href="{{ route('news.show', ['category'=>$item->getCategory->slug, 'slug'=>$item->slug]) }}"
                   class="h6 d-block text-dark font-weight-bold">{{$item->title or ""}}</a>
                <h6 class="d-inline-block small text-light p-1" style="background: {{ $item->getCategory->color }}"><a
                            href="{{ route('news.category', $item->getCategory->slug ) }}"
                            class="text-light p-1 font-weight-bold text-uppercase">{{ $item->getCategory->title }}</a></h6>
                <br>
                <a href="{{ route('users.profile', $item->getAuthor->id) }}" class="author-widget d-inline-block text-dark" title="Автор {{ $item->getAuthor->nickname }}">
                    <img src="{{ getAvatar('micro', $item->getAuthor->profile->avatar) }}" style="height: 23px;width: 23px" class="rounded-circle" alt="{{ $item->getAuthor->nickname }}">
                    {{ $item->getAuthor->nickname }}
                </a>
                <div class="col">
                    <div class="row">
                    <p>{!! strip_tags(str_limit($item->content, 160,'...')) !!}</p>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        @include('components.views.view_count', ['content'=>$item])
                        @include('components.likes.like', ['content'=>$item])
                    </div>
                </div>

            </div>
        </div>
    </div>

    @php( $count++ )
@empty
    <div class="col">
        <div class="alert alert-primary" role="alert">
            {{ 'Новости не найдены' }}
        </div>
    </div>
@endforelse