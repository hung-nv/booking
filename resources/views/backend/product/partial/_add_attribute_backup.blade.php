<?php $color_selected = isset($product_color) ? $product_color : (old('colors') ? old('colors') : []); ?>
<div class="form-group">
    <label for="multi-append-color" class="control-label col-md-2 col-sm-2">Color</label>
    <div class="input-group select2-bootstrap-append col-md-5 col-sm-8" style="padding: 0 15px; float: left;">
        <select id="multi-append-color" class="form-control select2" multiple name="colors[]">
            <option></option>
            @if(isset($colors) && $colors)
                @foreach($colors as $color)
                    <option value="{{ $color['id'] }}" @if(in_array($color['id'], $color_selected)) selected @endif>
                        {{ $color['attr_value'] }}
                    </option>
                @endforeach
            @endif
        </select>
        <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append-color">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
    </div>
    <div class="col-md-5 col-sm-2">
        <a data-toggle="modal" href="#add-color" style="padding: 7px 10px;" class="btn btn-sm green"> Add Color
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>

<?php $size_selected = isset($product_size) ? $product_size : (old('sizes') ? old('sizes') : []); ?>
<div class="form-group">
    <label for="multi-append-size" class="control-label col-md-2 col-sm-2">Size</label>
    <div class="input-group select2-bootstrap-append col-md-5 col-sm-8" style="padding: 0 15px; float: left;">
        <select id="multi-append-size" class="form-control select2" multiple name="sizes[]">
            <option></option>
            @if(isset($sizes) && $sizes)
                @foreach($sizes as $size)
                    <option value="{{ $size['id'] }}" @if(in_array($size['id'], $size_selected)) selected @endif>
                        {{ $size['attr_value'] }}
                    </option>
                @endforeach
            @endif
        </select>
        <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-select2-open="multi-append-size">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
    </div>
    <div class="col-md-5 col-sm-2">
        <a data-toggle="modal" href="#add-size" style="padding: 7px 10px;" class="btn btn-sm green"> Add Size
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>