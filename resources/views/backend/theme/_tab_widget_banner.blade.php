<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 1</label>
                    <div class="col-md-9">
                        @if(isset($option['banner_image_1']) && $option['banner_image_1'])
                            <input type="hidden" name="old_banner_image_1" id="old_banner_image_1" data-id=""
                                   value="{{ $option['banner_image_1'] or '' }}">
                        @endif
                        <input id="banner_image_1" name="banner_image_1" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 1</label>
                    <div class="col-md-9">
                        <input name="banner_link_1" type="url" class="form-control"
                               value="{{ $option['banner_link_1'] or old('banner_link_1') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 2</label>
                    <div class="col-md-9">
                        @if(isset($option['banner_image_2']) && $option['banner_image_2'])
                            <input type="hidden" name="old_banner_image_2" id="old_banner_image_2" data-id=""
                                   value="{{ $option['banner_image_2'] or '' }}">
                        @endif
                        <input id="banner_image_2" name="banner_image_2" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 2</label>
                    <div class="col-md-9">
                        <input name="banner_link_2" type="url" class="form-control"
                               value="{{ $option['banner_link_2'] or old('banner_link_2') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 3</label>
                    <div class="col-md-9">
                        @if(isset($option['banner_image_3']) && $option['banner_image_3'])
                            <input type="hidden" name="old_banner_image_3" id="old_banner_image_3" data-id=""
                                   value="{{ $option['banner_image_3'] or '' }}">
                        @endif
                        <input id="banner_image_3" name="banner_image_3" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 3</label>
                    <div class="col-md-9">
                        <input name="banner_link_3" type="url" class="form-control"
                               value="{{ $option['banner_link_3'] or old('banner_link_3') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image 4</label>
                    <div class="col-md-9">
                        @if(isset($option['banner_image_4']) && $option['banner_image_4'])
                            <input type="hidden" name="old_banner_image_4" id="old_banner_image_4" data-id=""
                                   value="{{ $option['banner_image_4'] or '' }}">
                        @endif
                        <input id="banner_image_4" name="banner_image_4" type="file" data-show-upload="false">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Banner Link 4</label>
                    <div class="col-md-9">
                        <input name="banner_link_4" type="url" class="form-control"
                               value="{{ $option['banner_link_4'] or old('banner_link_4') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>