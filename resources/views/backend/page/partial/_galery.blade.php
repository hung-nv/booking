<div class="form-body">
    <div class="caption">
        <i class="icon-diamond"></i> Gallery
        <div class="c-line-left bg-dark"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Gallery Heading</label>
                <input type="text" name="gallery-heading" class="form-control"
                       value="{{ $field['gallery-heading'] or old('gallery-heading') }}"/>
            </div>
        </div>
    </div>

    @if ($lang === 'en' || (!empty($article) && $article->lang === 'en'))
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 1</label>
                    @if(!empty($field['gallery-image-1']))
                        <input type="hidden" name="old-gallery-image-1" id="old-gallery-image-1"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-1'] or '' }}">
                    @endif
                    <input id="gallery-image-1" name="gallery-image-1" type="file" data-show-upload="false">
                </div>

                <div class="form-group last">
                    <label>Image 4</label>
                    @if(!empty($field['gallery-image-4']))
                        <input type="hidden" name="old-gallery-image-4" id="old-gallery-image-4"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-4'] or '' }}">
                    @endif
                    <input id="gallery-image-4" name="gallery-image-4" type="file" data-show-upload="false">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 2</label>
                    @if(!empty($field['gallery-image-2']))
                        <input type="hidden" name="old-gallery-image-2" id="old-gallery-image-2"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-2'] or '' }}">
                    @endif
                    <input id="gallery-image-2" name="gallery-image-2" type="file" data-show-upload="false">
                </div>

                <div class="form-group last">
                    <label>Image 5</label>
                    @if(!empty($field['gallery-image-5']))
                        <input type="hidden" name="old-gallery-image-5" id="old-gallery-image-5"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-5'] or '' }}">
                    @endif
                    <input id="gallery-image-5" name="gallery-image-5" type="file" data-show-upload="false">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Image 3</label>
                    @if(!empty($field['gallery-image-3']))
                        <input type="hidden" name="old-gallery-image-3" id="old-gallery-image-3"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-3'] or '' }}">
                    @endif
                    <input id="gallery-image-3" name="gallery-image-3" type="file" data-show-upload="false">
                </div>

                <div class="form-group last">
                    <label>Image 6</label>
                    @if(!empty($field['gallery-image-6']))
                        <input type="hidden" name="old-gallery-image-6" id="old-gallery-image-6"
                               data-id="{{ $page['id'] }}" value="{{ $field['gallery-image-6'] or '' }}">
                    @endif
                    <input id="gallery-image-6" name="gallery-image-6" type="file" data-show-upload="false">
                </div>
            </div>
        </div>
    @endif
</div>