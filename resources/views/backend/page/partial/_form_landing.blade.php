<div class="form-body">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" v-model="postName"
                       required/>
            </div>

            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" :value="postSlug"/>
            </div>

            <div class="form-group">
                <label>Meta title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="{{ $page['meta_title'] or old('meta_title') }}"/>
            </div>

            <div class="form-group">
                <label>Meta description</label>
                <input type="text" name="meta_description" class="form-control"
                       value="{{ $page['meta_description'] or old('meta_description') }}"/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="form-group">
                <label>Select Category</label>
                <div class="mt-checkbox-list"
                     data-error-container="#form_2_services_error">
                    {!! $templateCategory !!}
                </div>
                <div id="form_2_services_error"></div>
            </div>
        </div>
    </div>
</div>