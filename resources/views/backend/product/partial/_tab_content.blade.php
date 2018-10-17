<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">
            Special
        </label>
        <div class="col-md-8">
            <textarea name="special" class="form-control" rows="4">{{ $product['special'] or old('special') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">
            Description
            <span class="required"> * </span>
        </label>
        <div class="col-md-8">
            <textarea name="description" class="form-control" rows="4">{{ $product['description'] or old('description') }}</textarea>
        </div>
    </div>

    <div class="form-group last">
        <label class="col-md-2 control-label">
            Content
            <span class="required"> * </span>
        </label>
        <div class="col-md-8">
            <textarea class="ckeditor form-control" name="content" rows="6"
                      data-error-container="#editor2_error">{{ $product['content'] or old('content') }}</textarea>
            <div id="editor2_error"></div>
        </div>
    </div>
</div>