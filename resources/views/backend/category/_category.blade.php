<table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable-category">
    <thead>
    <tr>
        <th> ID</th>
        <th> Name</th>
        <th> Slug</th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/United-Kingdom-flag-icon.png') }}" width="20px"></th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/Korea-Flag-icon.png') }}" width="20px"></th>
        <th style="width: 30px"> <img src="{{ asset('images/icon/Vietnam-Flag-icon.png') }}" width="20px"></th>
        <th style="width: 60px;"> Actions</th>
    </tr>
    </thead>
    <tbody>
    {!! $category !!}
    </tbody>
</table>