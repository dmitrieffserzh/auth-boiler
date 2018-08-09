@section('meta_tags')
    <title>{{ $data->title or "" }}
        @if (count($data->seoNested) > 0)
    @foreach ($data->seoNested as $item)
            - {{$item->title or ""}} -


                @foreach($item->seoNested as $item)
                    @include('components.seo.meta_tags', ['data'=>$item->seoNested ])
                @endforeach


        @endforeach
        @endif
        {{env('APP_NAME')}}
    </title>
    <meta name="description" content="{{ $data->description, env('APP_NAME') }}"/>
@endsection