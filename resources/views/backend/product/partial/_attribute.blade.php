@foreach($attributes as $attribute)
    <div class="form-group">
        <label for="multi-append-{{ strtolower($attribute->name) }}"
               class="control-label col-md-2 col-sm-2">{{ ucwords($attribute->name) }}</label>
        <div class="input-group select2-bootstrap-append col-md-5 col-sm-8" style="padding: 0 15px; float: left;">
            <select id="multi-append-{{ strtolower($attribute->name) }}" class="form-control select2" multiple
                    name="attribute[]">
                <option></option>
                @if(!empty($attribute->attribute_values))
                    @foreach($attribute->attribute_values as $attrValue)
                        <option value="{{ $attrValue->id }}"
                                @if(!empty($productAttributes) && in_array($attrValue->id, $productAttributes)) selected @endif>
                            {{ $attrValue->attr_value }}
                        </option>
                    @endforeach
                @endif
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"
                        data-select2-open="multi-append-{{ strtolower($attribute->name) }}">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <div class="col-md-5 col-sm-2">
            <a data-attribute-id="{{ $attribute->id }}" data-attribute-name="{{ strtolower($attribute->name) }}"
               style="padding: 7px 10px;" class="btn btn-sm green" v-on:click="openPopupAttribute">
                Add {{ ucwords($attribute->name) }}
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
@endforeach