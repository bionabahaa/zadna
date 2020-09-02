<div class="top-bar">
        <h6>
            @foreach ($links as $link)
                <a href="{{$link['url']}}">{{ $link['title'] }}</a> >
            @endforeach
              {{ $main_page }} 
        </h6>
    </div>