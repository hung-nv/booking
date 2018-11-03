<div class="form-body">
    @if($lang === config('const.lang.en.alias'))
        <div class="form-group">
            <label class="col-md-2 control-label">Search Background</label>
            <div class="col-md-5">
                @if(isset($option['search_background']) && $option['search_background'])
                    <input type="hidden" name="old_search_background" id="old_search_background" data-id=""
                           value="{{ $option['search_background'] or '' }}">
                @endif
                <input id="search_background" name="search_background" type="file" data-show-upload="false">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-2 control-label">Search Heading</label>
        <div class="col-md-5">
            <input name="search_heading" class="form-control"
                   value="{{ $option['search_heading'] or old('search_heading') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Search Description</label>
        <div class="col-md-5">
            <textarea name="search_description" rows="5"
                      class="form-control">{{ $option['search_description'] or old('search_description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Search When Label</label>
        <div class="col-md-5">
            <input name="search_when_label" class="form-control"
                   value="{{ $option['search_when_label'] or old('search_when_label') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Search Where Label</label>
        <div class="col-md-5">
            <input type="url" name="search_where_label" class="form-control"
                   value="{{ $option['search_where_label'] or old('search_where_label') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Search Label Direct</label>
        <div class="col-md-5">
            <input type="url" name="search_label_direct" class="form-control"
                   value="{{ $option['search_label_direct'] or old('search_label_direct') }}"/>
        </div>
    </div>

</div>