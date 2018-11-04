<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-6">
                <a href="/" class="header-logo d-none d-md-block">
                    @if(!empty($option['company_logo']))
                        <img class="logo" src="{{ $option['company_logo'] }}">
                    @endif
                </a>
            </div>
        </div>
    </div>
</header>