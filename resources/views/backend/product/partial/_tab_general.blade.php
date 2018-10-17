<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Name:
            <span class="required"> * </span>
        </label>
        <div class="col-md-5 col-sm-10">
            <input type="text" class="form-control" name="name" v-model="productName"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Slug:<span class="required"> * </span></label>
        <div class="col-md-5 col-sm-10">
            <input type="text" class="form-control" name="slug" :value="productSlug"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">SKU:
            <span class="required"> * </span>
        </label>
        <div class="col-md-5 col-sm-10">
            <input type="text" class="form-control" name="sku" value="{{ $product['sku'] or old('sku') }}"
                   placeholder=""></div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Price:
            <span class="required"> * </span>
        </label>
        <div class="col-md-5 col-sm-10">
            <input type="number" class="form-control" name="price" value="{{ $product['price'] or old('price') }}"
                   min="0"></div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">New Price:</label>
        <div class="col-md-5 col-sm-10">
            <input type="number" class="form-control" name="new_price"
                   value="{{ $product['new_price'] or old('new_price') }}"></div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Made in:</label>
        <div class="col-md-5 col-sm-10">
            <input type="text" class="form-control" name="xuat_xu" value="{{ $product['xuat_xu'] or old('xuat_xu') }}"
                   placeholder=""></div>
    </div>

    @include('backend.product.partial._attribute')

    <div class="form-group">
        <label class="col-md-2 control-label">Category:
            <span class="required"> * </span>
        </label>
        <div class="col-md-5 col-sm-10">
            <div class="form-control height-auto">
                <div class="scroller" style="height:275px;"
                     data-always-visible="1">
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateCatalog !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $status = isset($product) ? $product['status'] : (old('status') ? old('status') : 1) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Status:</label>
        <div class="col-md-10">
            <select class="table-group-action-input form-control input-medium"
                    name="status">
                <option value="1" @if($status == 1) selected @endif>Approved</option>
                <option value="0" @if($status == 0) selected @endif>No</option>
            </select>
        </div>
    </div>
</div>

@include('backend.product.partial._add_attribute')