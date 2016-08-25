@extends('admin/layouts/master')

@section('styles')
    <link rel="stylesheet" href="/js/iCheck/skins/minimal/minimal.css">
@endsection

@section('scripts')
    <script type="text/javascript" src="/js/iCheck/jquery.icheck.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('input').iCheck({
                 checkboxClass: 'icheckbox_minimal',
            });


            $('#check-all').on('ifChanged', function(event){
                $(this).on('ifChecked', function(event){
                    $('input').iCheck('check');
                });
                $(this).on('ifUnchecked', function(event){
                    $('input').iCheck('uncheck');
                });
            });
        })
    </script>
@endsection

@section('main-content')
    <h3>{{ $site->getName() }}</h3>
    <section class="panel">
        <div class="panel-body">
            <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
                <table class="display table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Check All</th>
                            <th>Thứ 2</th>
                            <th>Thứ 3</th>
                            <th>Thứ 4</th>
                            <th>Thứ 5</th>
                            <th>Thứ 6</th>
                            <th>Thứ 7</th>
                            <th>Chủ Nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input id="check-all" type="checkbox">
                            </td>
                            @for($i = 0; $i < 7; $i++)

                                @if( in_array($i, $cron) )
                                    <td><input type="checkbox" name="day[]" value="{{$i}}" checked></td>
                                @else
                                    <td><input type="checkbox" name="day[]" value="{{$i}}"></td>
                                @endif

                            @endfor
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                        <a href="{{ route('admin.site.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                    </div>
                </div>
                {!! csrf_field() !!}

            </form>
        </div>
    </section>
@stop
