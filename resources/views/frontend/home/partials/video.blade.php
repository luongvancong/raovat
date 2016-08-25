<div class="mg-bt-30">
    <h3 class="hp-phone-block mg-bt-15">
        <a href="{{ route('video.index') }}" title="Video">Video</a>
    </h3>
    <div id="video-slider-flex" class="flexslider">
        <ul class="slides">
            @foreach($videos as $vid)
                @include('frontend/home/video-item')
            @endforeach
        </ul>
    </div>
</div>