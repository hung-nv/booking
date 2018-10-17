<div class="form-body">
    <div class="form-group">
        <div class="col-md-12">
            @if(!empty($productImages))
                <input type="hidden" name="old_product_image" id="old_product_image" data-id="{{ $product->id }}"
                       value="{{ $productImages or '' }}">
            @endif
            <input id="product_image" name="product_image[]" type="file" multiple>
        </div>
    </div>
</div>