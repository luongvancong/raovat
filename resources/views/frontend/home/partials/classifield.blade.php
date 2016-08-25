<section class="contentOuter post-home list-posts col-sm-6">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="hp-post newspaper">
                <a href="{{ route('raovat.index') }}" title="Rao vặt">Rao vặt</a>
            </h3>
        </div>
    </div>
    <div class="row">
        @foreach($classifields as $cf)
            @include('frontend/home/raovat-item')
        @endforeach
    </div>
</section>