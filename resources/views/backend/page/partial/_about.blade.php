<div class="form-body">
    <div class="caption">
        <i class="icon-diamond"></i> About Us
        <div class="c-line-left bg-dark"></div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>About Title 1</label>
                <input type="text" name="about1-title" class="form-control"
                       value="{{ $field['about1-title'] or old('about1-title') }}"/>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Description 1</label>
                <textarea name="about1-description" class="form-control"
                      rows="4">{{ $field['about1-description'] or old('about1-description') }}</textarea>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Title 2</label>
                <input type="text" name="about2-title" class="form-control"
                       value="{{ $field['about2-title'] or old('about2-title') }}"/>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Description 2</label>
                <textarea name="about2-description" class="form-control"
                      rows="4">{{ $field['about2-description'] or old('about2-description') }}</textarea>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Title 3</label>
                <input type="text" name="about3-title" class="form-control"
                       value="{{ $field['about3-title'] or old('about3-title') }}"/>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Description 3</label>
                <textarea name="about3-description" class="form-control"
                      rows="4">{{ $field['about3-description'] or old('about3-description') }}</textarea>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Title 4</label>
                <input type="text" name="about4-title" class="form-control"
                       value="{{ $field['about4-title'] or old('about4-title') }}"/>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Description 4</label>
                <textarea name="about4-description" class="form-control"
                      rows="4">{{ $field['about4-description'] or old('about4-description') }}</textarea>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Title 5</label>
                <input type="text" name="about5-title" class="form-control"
                       value="{{ $field['about5-title'] or old('about5-title') }}"/>
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>About Description 5</label>
                <textarea name="about5-description" class="form-control"
                      rows="4">{{ $field['about5-description'] or old('about5-description') }}</textarea>
            </div>
        </div>
    </div>
</div>