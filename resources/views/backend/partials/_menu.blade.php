<li class="dd-item dd3-item" data-id="{{ $item->id }}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content">
        {{ $item->name }}
        <i class="fa fa-times pull-right" onclick="mainComponent.deleteMenu({{ $item->id }})"></i>
    </div>