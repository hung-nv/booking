<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Comment Heading</label>
        <div class="col-md-5">
            <input name="comment_heading" class="form-control"
                   value="{{ $option['comment_heading'] or old('comment_heading') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Comment Description</label>
        <div class="col-md-5">
            <textarea name="comment_description" rows="5"
                      class="form-control">{{ $option['comment_description'] or old('comment_description') }}</textarea>
        </div>
    </div>
</div>