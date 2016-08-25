@extends('admin/layouts/master')

@section('main-content')
    <h3>Video Youtube</h3>

    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="POST" action enctype="multipart/form-data">

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Keyword</label>
                <div class="col-sm-6">
                    <input class="form-control" name="keyword" value="{{ Request::get('keyword') }}" >
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Sort</label>
                <div class="col-sm-6">
                    <?php
                        $sort = ['relevance', 'date', 'rating', 'title', 'videoCount', 'viewCount'];
                    ?>
                    <select name="order" class="form-control">
                        @foreach($sort as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Max Results</label>
                <div class="col-sm-6">
                    <?php
                        $results = [25, 50, 75, 100];
                    ?>
                    <select name="maxResults" class="form-control">
                        @foreach($results as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>

    @if(isset($videos))
        @include('admin/videos/list_video_youtube')
        <div class="text-right">
            <button class="btn btn-danger btn-sm" id="act-add-video">Thêm video</button>
        </div>
    @endif
@stop

@section('scripts')
<script>
    $(function() {
        $('.act-remove-item').click(function() {
            var $this = $(this);
            var $target = $($this.data('target'));
            $target.animate({
                opacity: 0
            }, 500, function() {
                $target.remove();
            });
        });

        $('#act-add-video').click(function() {
            var $this = $(this);
            var data = [];
            $('.video-item').each(function() {
                var $item = $(this);
                data.push({
                    'video_id' : $item.data('yid'),
                    'channel_name' : $item.data('channel-name'),
                    'channel_id' : $item.data('channel-id'),
                    'title' : $item.data('title'),
                    'teaser' : $item.data('teaser'),
                    'created_at' : "{{ date('y-m-d H:i:s') }}",
                    'updated_at' : "{{ date('y-m-d H:i:s') }}"
                });
            });

            $.ajax({
                url : '{{ route('admin.video.create') }}',
                type : 'POST',
                dataType : 'json',
                data : {
                    _token : '{{ csrf_token() }}',
                    data : data
                },
                success : function(response) {
                    if(response.code > 0) {
                        alert(response.message);
                        window.location.href = '{{ route('admin.video.findFromYoutube') }}';
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script>
@stop
