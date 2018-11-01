@if(!empty($originServices))
    <input name="services_id" type="hidden" value="{{ $originServices->id }}"/>

    <div class="form-group">
        <label class="control-label col-md-3">Origin Name (English Version)</label>
        <div class="col-md-9">
            <input name="originName" value="{{ $originServices->name }}" class="form-control" readonly/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Translate To: </label>
        <div class="col-md-9">
            <input name="language" value="{{ config('const.lang.'.$lang.'.label') }}" class="form-control" readonly/>
        </div>
    </div>
@endif

<div class="form-group">
    <label class="control-label col-md-3">Name of Services</label>
    <div class="col-md-9">
        <input name="name" value="{{ $services['name'] or old('name') }}" class="form-control"
               placeholder="Enter name" id="services-name" required/>
    </div>
</div>

@if ($lang === 'en' || (!empty($services) && $services['lang'] === 'en'))
    <div class="form-group">
        <label class="col-md-3 control-label">Icon</label>
        <div class="col-md-9">
            <input name="icon" value="{{ $services['icon'] or old('icon') }}" class="form-control"
                   placeholder="Enter icon alias" required/>
        </div>
    </div>
@endif

<input type="hidden" name="lang" value="{{ $lang }}">