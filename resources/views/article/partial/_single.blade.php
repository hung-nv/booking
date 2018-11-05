<section class="grey-blue-bg small-padding scroll-nav-container" id="sec2">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-single-main-container ">
                    <div class="list-single-main-media fl-wrap">
                        <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">

                            @for($i = 1; $i <= 6; $i++)
                                @if(!empty($room['gallery-image-'.$i]))
                                    <div class="gallery-item @if($i == 3) gallery-item-second @endif">
                                        <div class="grid-item-holder">
                                            <div class="box-item">
                                                <img src="{{ $room['gallery-image-'.$i] }}">
                                                <a href="{{ $room['gallery-image-'.$i] }}" class="gal-link popup-image"><i
                                                            class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        </div>
                        <!-- end gallery items -->
                    </div>

                    <!--   list-single-main-item -->
                    <div class="list-single-main-item fl-wrap">
                        <div class="list-single-main-item-title fl-wrap">
                            <h3>About Hotel </h3>
                        </div>
                        <p>Praesent eros turpis, commodo vel justo at, pulvinar mollis eros. Mauris aliquet eu quam id
                            ornare. Morbi ac quam enim. Cras vitae nulla condimentum, semper dolor non, faucibus dolor.
                            Vivamus adipiscing eros quis orci fringilla, sed pretium lectus viverra. Pellentesque
                            habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec nec
                            velit non odio aliquam suscipit. Sed non neque faucibus, condimentum lectus at, accumsan
                            enim. Fusce pretium egestas cursus. Etiam consectetur, orci vel rutrum volutpat, odio odio
                            pretium nisiodo tellus libero et urna. Sed commodo ipsum ligula, id volutpat risus vehicula
                            in. Pellentesque non massa eu nibh posuere bibendum non sed enim. Maecenas lobortis nulla
                            sem, vel egestas . </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus
                            suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla
                            diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a
                            consequat .</p>
                    </div>
                    <!--   list-single-main-item end -->
                    <!--   list-single-main-item -->
                    <div class="list-single-main-item fl-wrap" id="sec3">
                        <div class="list-single-main-item-title fl-wrap">
                            <h3>Amenities</h3>
                        </div>
                        <div class="listing-features fl-wrap">
                            <ul>
                                <li><i class="fal fa-rocket"></i> Elevator in building</li>
                                <li><i class="fal fa-wifi"></i> Free Wi Fi</li>
                                <li><i class="fal fa-parking"></i> Free Parking</li>
                                <li><i class="fal fa-snowflake"></i> Air Conditioned</li>
                                <li><i class="fal fa-plane"></i>Airport Shuttle</li>
                                <li><i class="fal fa-paw"></i> Pet Friendly</li>
                                <li><i class="fal fa-utensils"></i> Restaurant Inside</li>
                                <li><i class="fal fa-wheelchair"></i> Wheelchair Friendly</li>
                            </ul>
                        </div>
                    </div>
                    <!--   list-single-main-item end -->
                    <!-- accordion-->
                    <div class="accordion mar-top">
                        <a class="toggle" href="#"> Details option <span></span></a>
                        <div class="accordion-inner visible" style="display: none;">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.
                                Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae
                                lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis
                                fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                facilisis massa, a consequat purus viverra.</p>
                        </div>
                        <a class="toggle act-accordion" href="#"> Details option 2 <span></span></a>
                        <div class="accordion-inner" style="display: none;">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.
                                Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae
                                lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis
                                fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                facilisis massa, a consequat purus viverra.</p>
                        </div>
                        <a class="toggle" href="#"> Details option 3 <span></span></a>
                        <div class="accordion-inner" style="">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque.
                                Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae
                                lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis
                                fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum
                                facilisis massa, a consequat purus viverra.</p>
                        </div>
                    </div>
                    <!-- accordion end -->
                </div>
            </div>
            <!--   datails end  -->
            <!--   sidebar  -->
            <div class="col-md-4">
                <!--box-widget-wrap -->
                <div class="box-widget-wrap">
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget">
                            <div class="box-widget-content">
                                <div class="box-widget-item-header">
                                    <h3> Book This Hotel</h3>
                                </div>
                                <form name="bookFormCalc" class="book-form custom-form">
                                    <fieldset>
                                        <div class="cal-item">
                                            <div class="bookdate-container  fl-wrap">
                                                <label><i class="fal fa-calendar-check"></i> When </label>
                                                <input type="text" placeholder="Date In-Out" name="bookdates" value="">
                                                <div class="bookdate-container-dayscounter"><i
                                                            class="far fa-question-circle"></i><span>Days : <strong>0</strong></span>
                                                </div>
                                                <div class="daterangepicker ltr show-calendar opensright">
                                                    <div class="ranges"></div>
                                                    <div class="drp-calendar left">
                                                        <div class="calendar-table"></div>
                                                        <div class="calendar-time" style="display: none;"></div>
                                                    </div>
                                                    <div class="drp-calendar right">
                                                        <div class="calendar-table"></div>
                                                        <div class="calendar-time" style="display: none;"></div>
                                                    </div>
                                                    <div class="drp-buttons"><span class="drp-selected"></span>
                                                        <button class="cancelBtn btn btn-sm btn-default" type="button">
                                                            Clear
                                                        </button>
                                                        <button class="applyBtn btn btn-sm btn-primary"
                                                                disabled="disabled" type="button">Apply
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cal-item">
                                            <div class="quantity-item fl-wrap">
                                                <label> Adults</label>
                                                <div class="quantity">
                                                    <input type="number" name="qty3" min="0" max="3" step="1" value="0">
                                                    <div class="quantity-nav">
                                                        <div class="quantity-button quantity-up">+</div>
                                                        <div class="quantity-button quantity-down">-</div>
                                                    </div>
                                                    <input type="text" name="item_total" class="hid-input" value="0"
                                                           data-form="{qty3} * {repopt} - {repopt}" readonly="readonly"
                                                           _jac="_jac">
                                                    <div class="quantity-nav">
                                                        <div class="quantity-button quantity-up">+</div>
                                                        <div class="quantity-button quantity-down">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="quantity-item fl-wrap fcit">
                                                <label> Children</label>
                                                <div class="quantity">
                                                    <input type="number" name="qty2" min="0" max="3" step="1" value="0">
                                                    <div class="quantity-nav">
                                                        <div class="quantity-button quantity-up">+</div>
                                                        <div class="quantity-button quantity-down">-</div>
                                                    </div>
                                                    <select name="sale" class="hid-input">
                                                        <option value=".7" selected="">sale</option>
                                                    </select>
                                                    <input type="text" name="item_total" class="hid-input" value="0"
                                                           data-form="({repopt} * {sale})*{qty2}" readonly="readonly"
                                                           _jac="_jac">
                                                    <div class="quantity-nav">
                                                        <div class="quantity-button quantity-up">+</div>
                                                        <div class="quantity-button quantity-down">-</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cal-item">
                                            <div class="book-infor fl-wrap">
                                                <label><i class="fal fa-mail-forward"></i> Email </label>
                                                <input type="text" placeholder="Email" value="">
                                            </div>
                                        </div>

                                        <div class="cal-item">
                                            <div class="book-infor fl-wrap">
                                                <label><i class="fal fa-mail-forward"></i> Your name </label>
                                                <input type="text" placeholder="Your name" value="">
                                            </div>
                                        </div>

                                        <div class="cal-item">
                                            <div class="book-infor fl-wrap">
                                                <label><i class="fal fa-mail-forward"></i> Mobile </label>
                                                <input type="text" placeholder="Mobile" value="">
                                            </div>
                                        </div>


                                    </fieldset>
                                    <input type="number" id="totaldays" name="qty5" class="hid-input">

                                    <button class="btnaplly color2-bg">Book Now<i class="fal fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget">
                            <div class="box-widget-content">
                                <div class="box-widget-item-header">
                                    <h3> Price Range </h3>
                                </div>
                                <div class="claim-price-wdget fl-wrap">
                                    <div class="claim-price-wdget-content fl-wrap">
                                        <div class="pricerange fl-wrap"><span>Price : </span> 81$ - 320$</div>
                                        <div class="claim-widget-link fl-wrap"><span>Own or work here?</span><a
                                                    href="#">Claim Now!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->
                    <!--box-widget-item end -->
                    <!--box-widget-item -->
                    <div class="box-widget-item fl-wrap">
                        <div class="box-widget">
                            <div class="box-widget-content">
                                <div class="box-widget-item-header">
                                    <h3>Similar Listings</h3>
                                </div>
                                <div class="widget-posts fl-wrap">
                                    <ul>
                                        <li class="clearfix">
                                            <a href="#" class="widget-posts-img"><img src="images/gal/3.jpg"
                                                                                      class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Park Central</a>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                                class="fas fa-map-marker-alt"></i> 40 JOURNAL SQUARE
                                                        PLAZA, NJ, US</a></div>
                                                <span class="rooms-price">$80 <strong> /  Awg</strong></span>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#" class="widget-posts-img"><img src="images/gal/1.jpg"
                                                                                      class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Holiday Home</a>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                                class="fas fa-map-marker-alt"></i> 75 PRINCE ST, NY, USA</a>
                                                </div>
                                                <span class="rooms-price">$50 <strong> /   Awg</strong></span>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#" class="widget-posts-img"><img src="images/gal/2.jpg"
                                                                                      class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Moonlight Hotel</a>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                                class="fas fa-map-marker-alt"></i> 70 BRIGHT ST NEW
                                                        YORK, USA</a></div>
                                                <span class="rooms-price">$105 <strong> /  Awg</strong></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--box-widget-item end -->
                </div>
                <!--box-widget-wrap end -->
            </div>
            <!--   sidebar end  -->
        </div>
        <!--   row end  -->
    </div>
    <!--   container  end  -->
</section>