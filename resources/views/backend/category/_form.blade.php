<div class="form-group">
    <label class="control-label col-md-3">Name</label>
    <div class="col-md-9">
        <input name="name" v-model="categoryName" value="{{ $category['name'] or old('name') }}" class="form-control"
               placeholder="Enter your category name" id="category-name" required/>
    </div>
</div>

@if ($lang === 'en')
    <div class="form-group">
        <label class="control-label col-md-3">Slug</label>
        <div class="col-md-9">
            <input name="slug" :value="categorySlug" class="form-control"
                   placeholder="Enter your category slug"></div>
    </div>
@endif

<div class="form-group">
    <label class="control-label col-md-3">Parent</label>
    <div class="col-md-9">
        <select class="form-control" name="parent_id">
            <option value="">Select...</option>
            {!! $templateCategory !!}
        </select>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile" class="col-md-3 control-label">Image</label>
    <div class="col-md-9">
        @if(isset($category) && $category['image'])
            <input type="hidden" name="old_image" id="old-image" data-id="{{ $category['id'] }}"
                   value="{{ $category['image'] or '' }}">
        @endif
        <input id="image" name="image" type="file" data-show-upload="false">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Meta title</label>
    <div class="col-md-9">
        <input type="text" value="{{ $category['meta_title'] or old('meta_title') }}" name="meta_title"
               class="form-control"
               placeholder="Enter your category meta_title"></div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Meta description</label>
    <div class="col-md-9">
        <input value="{{ $category['meta_description'] or old('meta_description') }}" name="meta_description"
               class="form-control"
               placeholder="Enter your category meta_description"></div>
</div>

<input type="hidden" name="lang" value="{{ $lang }}">