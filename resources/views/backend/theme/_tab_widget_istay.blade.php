<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">About Heading</label>
        <div class="col-md-5">
            <input name="about_heading" class="form-control"
                   value="{{ $option['about_heading'] or old('about_heading') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">About Description</label>
        <div class="col-md-5">
            <textarea name="about_description" rows="5"
                      class="form-control">{{ $option['about_description'] or old('about_description') }}</textarea>
        </div>
    </div>
</div>