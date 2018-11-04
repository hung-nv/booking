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