<div class="form-body">
    <div class="row">
        <div class="col-md-9">
            @if(!empty($originArticle))
                <input type="hidden" name="article_id" value="{{ $originArticle->id }}">
                <div class="form-group">
                    <label>Origin Name</label>
                    <input type="text" name="originName" class="form-control" value="{{ $originArticle->name }}"
                           readonly/>
                </div>

                <div class="form-group">
                    <label>Translate To</label>
                    <input type="text" name="language" class="form-control"
                           value="{{ config('const.lang.'.$lang.'.label') }}"
                           readonly/>
                </div>
            @endif

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" v-model="postName"
                       required/>
            </div>

            @if ($lang === 'en' || (!empty($article) && $article->lang === 'en'))
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" :value="postSlug"/>
                </div>
            @endif

            <div class="form-group">
                <label>Meta title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="{{ $page['meta_title'] or old('meta_title') }}"/>
            </div>

            <div class="form-group">
                <label>Meta description</label>
                <input type="text" name="meta_description" class="form-control"
                       value="{{ $page['meta_description'] or old('meta_description') }}"/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            @if ($lang === 'en' || (!empty($article) && $article->lang === 'en'))
                <div class="form-group">
                    <label>Thumbnail</label>
                    @if(isset($page) && $page['image'])
                        <input type="hidden" name="old_image" id="old-image" data-id="{{ $page['id'] }}"
                               value="{{ $page['image'] or '' }}">
                    @endif
                    <input id="image" name="image" type="file" data-show-upload="false">
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Range Price</label>
                <input type="text" name="range-price" value="{{ $field['feature-heading'] or old('feature-heading') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="{{ $field['address'] or old('address') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Hotline</label>
                <input type="text" name="address" value="{{ $field['hotline'] or old('hotline') }}"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>Google Map</label>
                <textarea type="text" name="google-map" rows="5"
                          class="form-control">{{ $field['google-map'] or old('google-map') }}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Overview Title</label>
                <input type="text" name="overview-title" class="form-control"
                       value="{{ $field['overview-title'] or old('overview-title') }}"/>
            </div>

            <div class="form-group">
                <label>Overview Content</label>
                <textarea type="text" name="overview-content" rows="10"
                          class="form-control">{{ $field['overview-content'] or old('overview-content') }}</textarea>
            </div>
        </div>
    </div>
</div>