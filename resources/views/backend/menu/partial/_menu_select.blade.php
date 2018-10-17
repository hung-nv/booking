<select class="form-control" v-model="idMenuGroup">
    <option value="0">Select...</option>
    @foreach($menuGroups as $menu)
        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
    @endforeach
</select>