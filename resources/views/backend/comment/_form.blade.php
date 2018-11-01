@if(!empty($originComment))
    <input name="comment_id" type="hidden" value="{{ $originComment->id }}"/>

    <div class="form-group">
        <label class="control-label col-md-3">Origin Name (English Version)</label>
        <div class="col-md-9">
            <input name="originName" value="{{ $originComment->name }}" class="form-control" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Translate To: </label>
        <div class="col-md-9">
            <input name="language" value="{{ config('const.lang.'.$lang.'.label') }}" class="form-control" readonly/>
        </div>
    </div>
@endif

<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-9">
        <input name="name" value="{{ $comment['name'] or old('name') }}" class="form-control"
               placeholder="Enter name" id="comment-name" required/>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile" class="col-md-3 control-label">Image</label>
    <div class="col-md-9">
        @if(isset($comment) && $comment['avatar'])
            <input type="hidden" name="old_avatar" id="old-avatar" data-id="{{ $comment['id'] }}"
                   value="{{ $comment['avatar'] or '' }}">
        @endif
        <input id="avatar" name="avatar" type="file" data-show-upload="false">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Message</label>
    <div class="col-md-9">
        <textarea name="content" class="form-control"
                  placeholder="Enter your message" required>{{ $comment['content'] or old('content') }}</textarea>
    </div>
</div>

<input type="hidden" name="lang" value="{{ $lang }}">