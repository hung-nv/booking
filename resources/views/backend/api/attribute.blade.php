<option></option>
@if(isset($attribute) && $attribute)
    @foreach($attribute as $i)
        <option value="{{ $i->id }}">{{ $i->attr_value }}</option>
    @endforeach
@endif