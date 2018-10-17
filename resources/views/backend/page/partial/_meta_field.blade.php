<div class="form-body">
    <div class="caption">
        <i class="icon-diamond"></i> Features
        <div class="c-line-left bg-dark"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Feature Heading</label>
                <input type="text" name="feature-heading" class="form-control"
                       value="{{ $field['feature-heading'] or old('feature-heading') }}"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Title 1</label>
                <input type="text" name="feature1-title" class="form-control"
                       value="{{ $field['feature1-title'] or old('feature1-title') }}"/>
            </div>

            <div class="form-group">
                <label>Description 1</label>
                <input type="text" name="feature1-description" class="form-control"
                       value="{{ $field['feature1-description'] or old('feature1-description') }}"/>
            </div>

            <div class="form-group last">
                <label>Image 1</label>
                @if(!empty($field['feature1-image']))
                    <input type="hidden" name="old_feature1-image" id="old-feature1-image" data-id="{{ $page['id'] }}" value="{{ $field['feature1-image'] or '' }}">
                @endif
                <input id="feature1-image" name="feature1-image" type="file" data-show-upload="false">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Title 2</label>
                <input type="text" name="feature2-title" class="form-control"
                       value="{{ $field['feature2-title'] or old('feature2-title') }}"/>
            </div>

            <div class="form-group">
                <label>Description 2</label>
                <input type="text" name="feature2-description" class="form-control"
                       value="{{ $field['feature2-description'] or old('feature2-description') }}"/>
            </div>

            <div class="form-group last">
                <label>Image 2</label>
                @if(!empty($field['feature2-image']))
                    <input type="hidden" name="old_feature2-image" id="old-feature2-image" data-id="{{ $page['id'] }}" value="{{ $field['feature2-image'] or '' }}">
                @endif
                <input id="feature2-image" name="feature2-image" type="file" data-show-upload="false">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Title 3</label>
                <input type="text" name="feature3-title" class="form-control"
                       value="{{ $field['feature3-title'] or old('feature3-title') }}"/>
            </div>

            <div class="form-group">
                <label>Description 3</label>
                <input type="text" name="feature3-description" class="form-control"
                       value="{{ $field['feature3-description'] or old('feature3-description') }}"/>
            </div>

            <div class="form-group last">
                <label>Image 3</label>
                @if(!empty($field['feature3-image']))
                    <input type="hidden" name="old_feature3-image" id="old-feature3-image" data-id="{{ $page['id'] }}" value="{{ $field['feature3-image'] or '' }}">
                @endif
                <input id="feature3-image" name="feature3-image" type="file" data-show-upload="false">
            </div>
        </div>
    </div>
</div>