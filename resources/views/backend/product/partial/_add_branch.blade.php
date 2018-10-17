<?php $branch_selected = isset($product) ? $product['branch_id'] : old('branch_id'); ?>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2">Branch</label>
    <div class="col-md-5 col-sm-8">
        @if(isset($branch) && $branch)
            <select class="bs-select form-control" data-live-search="true" data-size="8" name="branch_id">
                <option value="" selected>Select...</option>
                @foreach($branch as $item_branch)
                    <option value="{{ $item_branch['id'] }}" @if($item_branch['id'] == $branch_selected) selected @endif>
                        {{ $item_branch['name'] }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>
    <div class="col-md-5 col-sm-2">
        <a href="{{ route('branch.create') }}" style="padding: 7px 10px;" class="btn btn-sm green"> Add Branch
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>