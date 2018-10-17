<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Meta Title:</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="meta_title" maxlength="100"
                   placeholder="" value="{{ $option['meta_title'] or old('meta_title') }}">
            <span class="help-block"> max 100 chars </span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Meta Description:</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8" name="meta_description"
                      maxlength="255">{{ $option['meta_description'] or old('meta_description') }}</textarea>
            <span class="help-block"> max 255 chars </span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Meta Keywords:</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8" name="meta_keywords"
                      maxlength="1000">{{ $option['meta_keywords'] or old('meta_keywords') }}</textarea>
            <span class="help-block"> max 255 chars </span>
        </div>
    </div>
</div>