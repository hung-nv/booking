<div class="form-body">
    @if($lang === config('const.lang.en.alias'))
        <div class="form-group">
            <label class="col-md-2 control-label">Promotion Background</label>
            <div class="col-md-5">
                @if(isset($option['promotion_background']) && $option['promotion_background'])
                    <input type="hidden" name="old_promotion_background" id="old_promotion_background" data-id=""
                           value="{{ $option['promotion_background'] or '' }}">
                @endif
                <input id="promotion_background" name="promotion_background" type="file" data-show-upload="false">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-2 control-label">Promotion Heading</label>
        <div class="col-md-5">
            <input name="promotion_heading" class="form-control"
                   value="{{ $option['promotion_heading'] or old('promotion_heading') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Promotion Description</label>
        <div class="col-md-5">
            <textarea name="promotion_description" rows="5"
                      class="form-control">{{ $option['promotion_description'] or old('promotion_description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Promotion Booking Label</label>
        <div class="col-md-5">
            <input name="promotion_booking_label" class="form-control"
                   value="{{ $option['promotion_booking_label'] or old('promotion_booking_label') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Promotion Booking URL</label>
        <div class="col-md-5">
            <input type="url" name="promotion_booking_url" class="form-control"
                   value="{{ $option['promotion_booking_url'] or old('promotion_booking_url') }}"/>
        </div>
    </div>

</div>