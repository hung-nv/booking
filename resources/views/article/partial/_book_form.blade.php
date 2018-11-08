<div class="box-widget-item fl-wrap">
    <div class="box-widget">
        <div class="box-widget-content">
            <div class="box-widget-item-header">
                <h3> {{ trans('labels.book_this_room') }}</h3>
            </div>
            <p class="notice-book">
                {!! trans('messages.notice_book') !!}
            </p>
            <form name="bookFormCalc" class="book-form custom-form">
                <fieldset>
                    <div class="cal-item">
                        <div class="bookdate-container  fl-wrap">
                            <label><i class="fal fa-calendar-check"></i> {{ trans('labels.date_range') }} </label>
                            <input type="text" placeholder="{{ trans('labels.date_range') }}" name="bookdates" value=""/>
                        </div>
                    </div>

                    <div class="cal-item">
                        <div class="quantity-item fl-wrap">
                            <label> {{ trans('labels.adult') }}</label>
                            <div class="quantity">
                                <input type="number" name="qty3" min="1" max="3" step="1" value="1">
                            </div>
                        </div>
                        <div class="quantity-item fl-wrap fcit">
                            <label> {{ trans('labels.children') }}</label>
                            <div class="quantity">
                                <input type="number"  name="qty2" min="0" max="3" step="1" value="0">
                                <select name="sale" class="hid-input">
                                    <option value=".7"  selected>sale</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="cal-item">
                        <div class="book-infor fl-wrap">
                            <label><i class="fal fa-mail-forward"></i> {{ trans('labels.email') }} </label>
                            <input type="email" placeholder="{{ trans('labels.email') }}" name="email">
                        </div>
                    </div>

                    <div class="cal-item">
                        <div class="book-infor fl-wrap">
                            <label><i class="fal fa-mail-forward"></i>{{ trans('labels.your_name') }}</label>
                            <input type="text" placeholder="{{ trans('labels.your_name') }}" name="name">
                        </div>
                    </div>

                    <div class="cal-item">
                        <div class="book-infor fl-wrap">
                            <label><i class="fal fa-mail-forward"></i> {{ trans('labels.mobile') }} </label>
                            <input type="text" placeholder="{{ trans('labels.mobile') }}" name="mobile">
                        </div>
                    </div>

                </fieldset>
                <input type="number" id="totaldays" name="qty5" class="hid-input">

                <p class="response-booking"></p>

                <button class="btnaplly color2-bg" id="book-room">
                    {{ trans('labels.book_now') }}
                    <i class="fal fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>