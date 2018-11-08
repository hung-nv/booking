<footer>
    <div class="footer">
        <div class="row">
            <div class="col-xs-12">
                <p class="title">{{ $option['company_name'] or '' }}</p>
                <div class="footer-information">
                    @if(!empty($option['company_description']))
                        {!! str_replace("\n", "<br />", $option['company_description']) !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>© 2018 iStay Hotel Apartment</p>
        </div>
    </div>
</footer>

<div class="phonering-alo-phone phonering-alo-green phonering-alo-show hidden-sm hidden-md hidden-lg"
     id="phonering-alo-phoneIcon">
    <div class="phonering-alo-ph-circle"></div>
    <div class="phonering-alo-ph-circle-fill"></div>
    <div class="phonering-alo-ph-img-circle"><a href="tel:{{ $option['hotline'] or '0981688118' }}" class="pps-btn-img" title="Liên hệ"> <img
                    src="https://i.imgur.com/v8TniL3.png" alt="Liên hệ" width="50"
                    onmouseover="this.src='https://i.imgur.com/v8TniL3.png';"
                    onmouseout="this.src='https://i.imgur.com/v8TniL3.png';" class="callme lazyloading"
                    data-was-processed="true"> </a></div>
</div>