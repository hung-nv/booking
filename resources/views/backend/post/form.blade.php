<div class="col-md-9">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" v-model="postName" required/>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" :value="postSlug"/>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"
                  rows="4">{{ $post['description'] or old('description') }}</textarea>
    </div>

    <div class="form-group last">
        <label>Content</label>
        <textarea class="ckeditor form-control" name="content" rows="6"
                  data-error-container="#editor2_error">{{ $post['content'] or old('content') }}</textarea>
        <div id="editor2_error"></div>
    </div>
</div>

@php($status = isset($post) ? $post['status'] : (old('status') ? old('status') : 1))
<div class="col-md-3">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" @if($status == 1) selected @endif>Approved</option>
                    <option value="0" @if($status == 0) selected @endif>No</option>
                </select>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn blue"
                        style="margin-top: 23px;">Submit
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Select Category</label>
        <div class="mt-checkbox-list"
             data-error-container="#form_2_services_error">
            {!! $templateCategory !!}
        </div>
        <div id="form_2_services_error"></div>
    </div>

    <div class="form-group">
        <label>Keywords</label>
        <input type="text" name="meta_keywords" class="form-control"
               value="{{ $post['meta_keywords'] or  old('meta_keywords') }}"/>
    </div>

    <div class="form-group">
        <label>Meta title</label>
        <input type="text" name="meta_title" class="form-control"
               value="{{ $post['meta_title'] or old('meta_title') }}"/>
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <input type="text" name="meta_description" class="form-control"
               value="{{ $post['meta_description'] or old('meta_description') }}"/>
    </div>

    <div class="form-group">
        <label>Image</label>
        @if(isset($post) && $post['image'])
            <input type="hidden" name="old_image" id="old-image" data-id="{{ $post['id'] }}"
                   value="{{ $post['image'] or '' }}">
        @endif
        <input id="image" name="image" type="file" data-show-upload="false">
    </div>
</div>