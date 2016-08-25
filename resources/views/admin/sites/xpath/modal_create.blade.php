<div class="modal fade" id="modal-create-xpath">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add xpath</h4>
            </div>
            <div class="modal-body">
                <form id="form-create-xpath" class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

                    <div class="form-group group-link">
                        <label for="input" class="col-sm-2 control-label">Link (Xpath or Text)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="xpath_link_detail" required="true" placeholder="Link" required="required">
                        </div>
                    </div>

                    <div class="form-group group-price">
                        <label for="input" class="col-sm-2 control-label">Giá (Xpath or Text)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="xpath_price" required="true" placeholder="Giá" required="required">
                        </div>
                    </div>

                    <div class="form-group group-name">
                        <label for="input" class="col-sm-2 control-label">Tên (Xpath or Text)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" name="xpath_name" required="true" placeholder="Tên" required="required">
                        </div>
                    </div>

                    {!! csrf_field() !!}

                    <input type="hidden" name="site_id" value="{{ $site->getId() }}">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" type="submit" id="save-xpath-action" form="form-create-xpath">Cập nhật</button>
                <button class="btn btn-default btn-sm" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>