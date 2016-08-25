@extends('account/layout/default')

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Đấu giá click', '', true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row mg-bt-30">
    <div class="col-sm-12">
        <div class="mg-bt-10">
            <div class="pull-right">
                <a href="{{ route('account.auction.create') }}" class="btn btn-xs btn-danger">Tạo chiến dịch</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <table class="display table table-bordered table-striped">
            <thead>
                <th>ID</th>
                <th>Giá click</th>
                <th>Ngân sách</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Thống kê</th>
                <th>Sửa</th>
                <th>Hủy</th>
            </thead>
            <tbody>
                @foreach($auctions as $auction)
                <tr>
                    <td>{{ $auction->getId() }}</td>
                    <td>{{ $auction->getMoneyPerClick() }}</td>
                    <td>{{ $auction->getBudget() }}</td>
                    <td>{{ $auction->getStartDate() }}</td>
                    <td>{{ $auction->getEndDate() }}</td>
                    <td>
                        <a href="{{ route('account.auction.statistic', [$auction->getId()]) }}" class="btn btn-xs btn-info"><i class="fa fa-line-chart"></i> Thống kê</a>
                    </td>
                    <td>
                        <a href="{{ route('account.auction.edit', [$auction->getId()]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> Chỉnh sửa</a>
                    </td>
                    <td>{!! makeDeleteButton(route('account.auction.destroy', [$auction->getId()])) !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(function() {
        $('.btn-delete-action').click(function(e) {

            if(confirm("Bạn có chắc chắn muốn xóa chiến dịch này")) {
                return true;
            }

            return false;
        });
    });
</script>
@stop