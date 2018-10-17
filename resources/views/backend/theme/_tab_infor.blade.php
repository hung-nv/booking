<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Hotline</label>
        <div class="col-md-5">
            <input name="hotline" class="form-control" value="{{ $option['hotline'] or old('hotline') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-5">
            <input type="email" name="email" class="form-control" value="{{ $option['email'] or old('email') }}"/>
        </div>
    </div>

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

    <div class="form-group">
        <label class="col-md-2 control-label">Google Map Url</label>
        <div class="col-md-5">
        <textarea name="google_map" class="form-control"
                  rows="4">{{ $option['google_map'] or old('google_map') }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Company Logo</label>
        <div class="col-md-5">
            @if(isset($option['company_logo']) && $option['company_logo'])
                <input type="hidden" name="old_company_logo" id="old_company_logo" data-id=""
                       value="{{ $option['company_logo'] or '' }}">
            @endif
            <input id="company_logo" name="company_logo" type="file" data-show-upload="false">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Main office address</label>
        <div class="col-md-5">
            <input name="main_office" class="form-control" value="{{ $option['main_office'] or  old('main_office') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Sub office address</label>
        <div class="col-md-5">
            <input name="sub_office" class="form-control" value="{{ $option['sub_office'] or  old('sub_office') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Working Desription</label>
        <div class="col-md-5">
            <input name="workingtime_description" class="form-control"
                   value="{{ $option['workingtime_description'] or  old('workingtime_description') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Working time</label>
        <div class="col-md-5">
            <input name="workingtime" class="form-control" value="{{ $option['workingtime'] or  old('workingtime') }}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Sub time</label>
        <div class="col-md-5">
            <input name="sub_time" class="form-control" value="{{ $option['sub_time'] or  old('sub_time') }}"/>
        </div>
    </div>
</div>