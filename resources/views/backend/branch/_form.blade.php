<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-4">
        <input type="text" name="name" class="form-control" value="{{ $branch['name'] or old('name') }}"
               placeholder="Enter your branch name" required/></div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">Slug</label>
    <div class="col-md-4">
        <input name="slug" type="text" class="form-control" value="{{ $branch['slug'] or old('slug') }}"
               placeholder="Enter your branch slug"></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Order</label>
    <div class="col-md-2">
        <input name="order" type="number" class="form-control" value="{{ $branch['order'] or old('order') }}">
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile" class="col-md-3 control-label">Image</label>
    <div class="col-md-4">
        <input type="file" id="image" name="image">
        <p class="help-block"> Your branch image. </p>
    </div>
</div>

<?php $status = isset($branch['status']) ? $branch['status'] : old('status'); ?>
<div class="form-group">
    <label class="control-label col-md-3">Status</label>
    <div class="col-md-4">
        <select class="form-control" name="status">
            <option value="1" @if($status === 1) selected @endif>Approved</option>
            <option value="0" @if($status === 0) selected @endif>No</option>
        </select>
    </div>
</div>