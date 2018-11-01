<tr class="odd gradeX">
    <td>{{ $item['id'] }}</td>
    <td>
        {{ $character . ' ' . $item['name_en'] }}
    </td>
    <td>{{ $item['slug'] }}</td>
    <td>
        <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.en.alias')]]) }}"
           class="btn btn-icon-only blue">
            <i class="fa fa-edit"></i>
        </a>
    </td>
    <td>
        @if(!empty($item['name_'.config('const.lang.ko.alias')]))
            <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.ko.alias')]]) }}"
               class="btn btn-icon-only blue">
                <i class="fa fa-edit"></i>
            </a>
        @else
            <a href="{{ route('category.create', ['lang' => config('const.lang.ko.alias'), 'category_id' => $item['id']]) }}"
               class="btn btn-icon-only red">
                <i class="fa fa-plus"></i>
            </a>
        @endif
    </td>
    <td>
        @if(!empty($item['name_'.config('const.lang.vi.alias')]))
            <a href="{{ route('category.edit', ['category' => $item['id_content_'.config('const.lang.vi.alias')]]) }}"
               class="btn btn-icon-only blue">
                <i class="fa fa-edit"></i>
            </a>
        @else
            <a href="{{ route('category.create', ['lang' => config('const.lang.vi.alias'),  'category_id' => $item['id']]) }}"
               class="btn btn-icon-only red">
                <i class="fa fa-plus"></i>
            </a>
        @endif
    </td>
    <td style="text-align: center;">
        <form action="{{ route('category.destroy', $item['id']) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="button" class="btn red btn-sm" v-on:click="confirmBeforeDelete">Delete</button>
        </form>
    </td>
</tr>