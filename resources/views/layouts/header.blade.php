<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <a href="/?lang={{ $lang }}" class="header-logo d-none d-md-block">
                    @if(!empty($option['company_logo']))
                        <img class="logo" src="{{ $option['company_logo'] }}">
                    @endif
                </a>
            </div>
            <div class="col-md-8 col-xs-6 logo-translate">
                <div class="pull-right">
                    <div class="flag @if($lang === config('const.lang.en.alias')) active @endif"
                         data-lang="{{ config('const.lang.en.alias') }}">
                        <img src="{{ asset('images/icon/United-Kingdom-flag-icon.png') }}"/>
                    </div>

                    <div class="flag @if($lang === config('const.lang.ko.alias')) active @endif"
                         data-lang="{{ config('const.lang.ko.alias')  }}">
                        <img src="{{ asset('images/icon/Korea-Flag-icon.png') }}"/>
                    </div>

                    <div class="flag @if($lang === config('const.lang.vi.alias')) active @endif"
                         data-lang="{{ config('const.lang.vi.alias') }}">
                        <img src="{{ asset('images/icon/Vietnam-Flag-icon.png') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>