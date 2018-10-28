<input type="hidden" name="lang" value="{{ $lang }}"/>
<div class="col-md-9">
    @if(!empty($originArticle))
        <input type="hidden" name="article_id" value="{{ $originArticle->id }}">
        <div class="form-group">
            <label>Origin Name</label>
            <input type="text" name="originName" class="form-control" value="{{ $originArticle->name }}" readonly/>
        </div>

        <div class="form-group">
            <label>Translate To</label>
            <input type="text" name="language" class="form-control" value="{{ config('const.lang.'.$lang.'.label') }}"
                   readonly/>
        </div>
    @endif
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" v-model="postName" required/>
    </div>

    @if ($lang === 'en' || (!empty($article) && $article->lang === 'en'))
        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" :value="postSlug"/>
        </div>
    @endif

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"
                  rows="4">{{ $article['description'] or old('description') }}</textarea>
    </div>

    <div class="form-group last">
        <label>Content</label>
        <textarea class="ckeditor form-control" name="content" rows="6"
                  data-error-container="#editor2_error">{{ $article['content'] or old('content') }}</textarea>
        <div id="editor2_error"></div>
    </div>
</div>

@php($status = isset($article) ? $article['status'] : (old('status') ? old('status') : 1))

<div class="col-md-3">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="1" @if($status == 1) selected @endif>Approved</option>
                    <option value="0" @if($status == 0) selected @endif>No</option>
                </select>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn blue"
                        style="margin-top: 23px;">Submit
                </button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Meta title</label>
        <input type="text" name="meta_title" class="form-control"
               value="{{ $article['meta_title'] or old('meta_title') }}"/>
    </div>

    <div class="form-group">
        <label>Meta description</label>
        <input type="text" name="meta_description" class="form-control"
               value="{{ $article['meta_description'] or old('meta_description') }}"/>
    </div>

    <div class="form-group">
        <label>Image</label>
        @if(isset($article) && $article['image'])
            <input type="hidden" name="old_image" id="old-image" data-id="{{ $article['id'] }}"
                   value="{{ $article['image'] or '' }}">
        @endif
        <input id="image" name="image" type="file" data-show-upload="false">
    </div>
</div>