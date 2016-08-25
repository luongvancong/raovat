<div class="panel-body">
    <table class="table">
        <thead>
            <th>Youtube ID</th>
            <th>Channel</th>
            <th>Title</th>
            <th>Description</th>
            <th>--</th>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr id="video-{{ $video['video_id'] }}" class="video-item"
                data-title="{{ $video['title'] }}" data-yid="{{ $video['video_id'] }}"
                data-channel-name="{{ $video['channel_name'] }}" data-channel-id="{{ $video['channel_id'] }}"
                data-teaser="{{ $video['teaser'] }}">
                    <td>{{ $video['video_id'] }}</td>
                    <td>{{ $video['channel_name'] }}</td>
                    <td>{{ $video['title'] }}</td>
                    <td>{{ $video['teaser'] }}</td>
                    <td><a href="javascript:;" class="act-remove-item" data-target="#video-{{ $video['video_id'] }}"><i class="text-danger fa fa-trash-o"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

