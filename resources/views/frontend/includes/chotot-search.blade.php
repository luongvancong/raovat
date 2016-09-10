<div class="col-md-12 tim-kiem">
    <div class="row">
        <form method="get" action="{!! route('postSearch') !!}">
            <div class="form-group col-md-4">
                <label class="sr-only" for="Search">Tìm kiếm</label>
                <input type="text" class="form-control" id="Search" name="tukhoa" placeholder="Tìm kiếm">
            </div>
            <div class="form-group col-md-3">
                <label class="sr-only" for="Danhmuc">Danh mục</label>
                <select name="category_id" class="form-control">
                    <option value="">Tất cả danh mục</option>
                    <?php cate_parent($categories, 0, "--", 0) ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="sr-only" for="Danhmucvung">Danh mục vùng</label>
                <select name="city_id" class="form-control">
                    <?php city_parent($cities, 0, "--", $city->getId()) ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-danger">Tìm</button>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
</div>