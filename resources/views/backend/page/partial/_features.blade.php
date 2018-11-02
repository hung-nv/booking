<div class="form-body">
    <div class="caption">
        <i class="icon-diamond"></i> Features
        <div class="c-line-left bg-dark"></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Feature Heading</label>
                <input type="text" name="feature-heading" class="form-control"
                       value="{{ $field['feature-heading'] or old('feature-heading') }}"/>
            </div>
        </div>
    </div>

    @if ($lang === 'en' || (!empty($article) && $article->lang === 'en'))
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Features</label>
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateFeatures !!}
                    </div>
                    <div id="form_2_services_error"></div>
                </div>
            </div>
        </div>
    @endif
</div>