<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-page">
    <thead>
    <tr>
        <th> ID</th>
        <th> Information</th>
        <th> Created At</th>
        <th> Status</th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/United-Kingdom-flag-icon.png') }}" width="20px"></th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/Korea-Flag-icon.png') }}" width="20px"></th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/Vietnam-Flag-icon.png') }}" width="20px"></th>
        <th style="width: 60px;"> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($pages))
        @foreach($pages as $i)
            <tr class="odd gradeX">
                <td> {{ $i['id'] }}</td>
                <td>
                    <p class="font-red-mint">{{ $i['name_'.config('const.lang.en.alias')] }}</p>
                </td>
                <td>{{ $i['created_at'] }}</td>
                <td>
                    @if($i['status'] === 1)
                        <span class="badge badge-info badge-roundless"> Approved </span>
                    @else
                        <span class="badge badge-warning badge-roundless"> No </span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('page.edit', ['page' => $i['id_content_'.config('const.lang.en.alias')]]) }}"
                       class="btn btn-icon-only blue">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
                <td>
                    @if(!empty($i['name_'.config('const.lang.ko.alias')]))
                        <a href="{{ route('page.edit', ['page' => $i['id_content_'.config('const.lang.ko.alias')]]) }}"
                           class="btn btn-icon-only blue">
                            <i class="fa fa-edit"></i>
                        </a>
                    @else
                        <a href="{{ route('page.create', ['lang' => config('const.lang.ko.alias'), 'article_id' => $i['id']]) }}"
                           class="btn btn-icon-only red">
                            <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </td>
                <td>
                    @if(!empty($i['name_'.config('const.lang.vi.alias')]))
                        <a href="{{ route('page.edit', ['page' => $i['id_content_'.config('const.lang.vi.alias')]]) }}"
                           class="btn btn-icon-only blue">
                            <i class="fa fa-edit"></i>
                        </a>
                    @else
                        <a href="{{ route('page.create', ['lang' => config('const.lang.vi.alias'),  'article_id' => $i['id']]) }}"
                           class="btn btn-icon-only red">
                            <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </td>
                <td>
                    <form action="{{ route('page.destroy', $i['id']) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="button" class="btn red btn-sm btn-delete" v-on:click="confirmBeforeDelete">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>