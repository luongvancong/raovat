@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách chạy lấy giá ngày thứ {{ $dayStr }}
                <a href="javascript:window.history.back()" class="btn btn-xs btn-default pull-right">Quay lại</a>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">

                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Site</th>
                                <th>Tên</th>
                                <th>Pages</th>
                                <th width="150">--</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $site)
                                <tr>
                                    <td width="30">{{ $site->cron_id }}</td>
                                    <td width="50">{{ $site->getId() }}</td>
                                    <td>{{ $site->getName() }}</td>
                                    <td>{{ $site->links()->sum('max_page') }}</td>
                                    <td>
                                        <select name="day" class="form-control input-sm" data-site="{{ $site->getId() }}" data-cronId="{{ $site->cron_id }}">
                                            <option value="">Đổi ngày</option>
                                            @foreach($arrayDays as $key => $value)
                                                <option value="{{ $key }}" {{ $key == $dayOfWeek ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
<script>
    $(function() {
        $('select[name="day"]').change(function() {
            var $this = $(this);
            $.ajax({
                url : '{{ route('admin.cronjob.ajaxChangeDay') }}',
                data : {
                    cron_id : $this.data('cronid'),
                    site_id : $this.data('site'),
                    day : $this.val(),
                    _token : '{{ csrf_token() }}',

                },
                type : 'POST',
                dataType : 'json',
                success : function(response) {
                    if(response.code <= 0) {
                        alert(response.message);
                    } else {
                        window.location.reload();
                    }
                }
            });
        });
    });
</script>
@stop