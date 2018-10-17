<div class="form-body">
    <div class="form-group">
        <label class="col-md-2 control-label">Site Heading</label>
        <div class="col-md-5">
            <input name="site_heading" class="form-control"
                   value="{{ $option['site_heading'] or old('site_heading') }}"/>
        </div>
    </div>

    <?php $homepage_post_id = isset($option['homepage_post_id']) ? $option['homepage_post_id'] : old('homepage_post_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Set Homepage</label>
        <div class="col-md-5">
            <select class="form-control" name="homepage_post_id">
                <option value="">Select Landing Page...</option>
                @if(isset($pages) && $pages)
                    @foreach($pages as $page)
                        <option value="{{ $page['id'] }}"
                                @if($homepage_post_id == $page['id']) selected @endif>{{ $page['name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <?php $main_menu_id = isset($option['main_menu_id']) ? $option['main_menu_id'] : old('main_menu_id') ?>
    <div class="form-group">
        <label class="col-md-2 control-label">Main Menu</label>
        <div class="col-md-5">
            <select class="form-control" name="main_menu_id">
                <option value="">Select Menu...</option>
                @foreach($menus as $mainMenu)
                    <option value="{{ $mainMenu->id }}"
                            @if($mainMenu->id == $main_menu_id) selected @endif>{{ $mainMenu->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Catalog on Index</label>
        <div class="col-md-5">
            <div class="form-control height-auto">
                <div class="scroller" style="height:275px;"
                     data-always-visible="1">
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateCatalog !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Top Selected Catalog on Index</label>
        <div class="col-md-5">
            <div class="form-control height-auto">
                <div class="scroller" style="height:275px;"
                     data-always-visible="1">
                    <div class="mt-checkbox-list"
                         data-error-container="#form_2_services_error">
                        {!! $templateSubCatalog !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">Favico</label>
        <div class="col-md-5">
            @if(isset($option['favico']) && $option['favico'])
                <input type="hidden" name="old_favico" id="old_favico" data-id="" value="{{ $option['favico'] or '' }}">
            @endif
            <input id="favico" name="favico" type="file" data-show-upload="false">
        </div>
    </div>
</div>