<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Hotline</label>
        <div class="col-md-5">
            <input name="hotline" class="form-control" value="{{ $option['hotline'] or old('hotline') }}"/>
        </div>
    </div>

    @if($lang === config('const.lang.en.alias'))
        <div class="form-group">
            <label class="col-md-2 control-label">Email</label>
            <div class="col-md-5">
                <input type="email" name="email" class="form-control" value="{{ $option['email'] or old('email') }}"/>
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-2 control-label">Company Name</label>
        <div class="col-md-5">
            <input name="company_name" class="form-control"
                   value="{{ $option['company_name'] or  old('company_name') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Description</label>
        <div class="col-md-5">
        <textarea name="company_description" class="form-control"
                  rows="4">{{ $option['company_description'] or old('company_description') }}</textarea>
        </div>
    </div>

    @if($lang === config('const.lang.en.alias'))
        <div class="form-group">
            <label class="col-md-2 control-label">Logo</label>
            <div class="col-md-5">
                @if(isset($option['company_logo']) && $option['company_logo'])
                    <input type="hidden" name="old_company_logo" id="old_company_logo" data-id=""
                           value="{{ $option['company_logo'] or '' }}">
                @endif
                <input id="company_logo" name="company_logo" type="file" data-show-upload="false">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Favico</label>
            <div class="col-md-5">
                @if(isset($option['favico']) && $option['favico'])
                    <input type="hidden" name="old_favico" id="old_favico" data-id=""
                           value="{{ $option['favico'] or '' }}">
                @endif
                <input id="favico" name="favico" type="file" data-show-upload="false">
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-2 control-label">Meta Title:</label>
        <div class="col-md-5">
            <input type="text" class="form-control maxlength-handler" name="meta_title" maxlength="100"
                   placeholder="" value="{{ $option['meta_title'] or old('meta_title') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Meta Description:</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="8" name="meta_description"
                      maxlength="255">{{ $option['meta_description'] or old('meta_description') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Script Support:</label>
        <div class="col-md-5">
            <textarea class="form-control maxlength-handler" rows="10" name="script_support"
                      maxlength="255">{{ $option['script_support'] or old('script_support') }}</textarea>
        </div>
    </div>
</div>