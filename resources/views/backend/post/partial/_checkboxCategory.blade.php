<label class="mt-checkbox mt-level-{{ $level }}">
    <input type="checkbox" value="{{ $item->id }}" name="{{ $name }}[]"
           @if(is_array($selectedId) && in_array($item->id, $selectedId)) checked @endif />
    {{ $item->name }}
    <span></span>
</label>
