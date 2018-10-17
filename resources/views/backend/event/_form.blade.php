<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-4">
        <input name="name" value="{{ $event['name'] or old('name') }}" class="form-control"
               placeholder="Enter your event name" required/></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Description</label>
    <div class="col-md-4">
        <textarea name="description" class="form-control">{{ $event['description'] or old('description') }}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Start time</label>
    <div class="col-md-4">
        <input type="text" name="start_at" id="start-time" class="form-control" value="{{ $event['start_at'] or old('start_at') }}">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">End time</label>
    <div class="col-md-4">
        <input type="text" name="end_at" id="end-time" class="form-control" value="{{ $event['end_at'] or old('end_at') }}">
    </div>
</div>

<?php $status = isset($event) ? $event['status'] : (old('status') ? old('status') : 1) ?>
<div class="form-group">
    <label class="control-label col-md-3">Status</label>
    <div class="col-md-4">
        <select class="form-control" name="status">
            <option value="0" @if($status === 0) selected @endif>No</option>
            <option value="1" @if($status === 1) selected @endif>Approved</option>
        </select>
    </div>
</div>