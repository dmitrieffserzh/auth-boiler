@foreach($rss as $item)
<item turbo="true">
    <title>{{ $item->title }}</title>
    <link>{{ route('news.show', ['category'=>$item->getCategory->slug, 'slug'=>$item->slug]) }}</link>
    <turbo:content>
        <![CDATA[
        <header>
            <h1>{{ $item->title }}</h1>
            <figure>
                <img src="https://avatars.mds.yandex.net/get-sbs-sd/403988/e6f459c3-8ada-44bf-a6c9-dbceb60f3757/orig">
            </figure>
        </header>
        {!! $item->content !!}
        <div data-block="widget-feedback" data-stick="false">
            <div data-block="chat" data-type="whatsapp" data-url="https://whatsapp.com"></div>
            <div data-block="chat" data-type="telegram" data-url="http://telegram.com/"></div>
            <div data-block="chat" data-type="vkontakte" data-url="https://vk.com/"></div>
        </div>
        ]]>
    </turbo:content>
</item>
@endforeach