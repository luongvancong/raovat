<div id="modal-rate" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <form id="form-rate" method="POST" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">Đánh giá gian hàng <span class="merchant-name"></span></h5>
                </div>
                <div class="modal-body">
                    <div class="text-center rate-bound">
                        {{-- <select name="rate_value" id="rate_value" class="form-control btn-flat mg-bt-10">
                            <option value="">Chọn giá trị</option>
                            @for($i = 1; $i <= 5; $i ++)
                            <option value="{{ $i }}">{{ $i }} sao</option>
                            @endfor
                        </select> --}}
                        @for($i = 1; $i <= 5; $i ++)
                        <i data-value="{{ $i }}" class="fa fa-star rate-icon rate-star-icon-{{ $i }}"></i>
                        @endfor
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>