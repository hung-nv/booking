<table class="table table-striped table-bordered table-hover" id="data-products">
    <thead>
    <tr>
        <th> ID</th>
        <th style="width: 30%;"> Information</th>
        <th> Attributes</th>
        <th> Created time</th>
        <th> Copy Product & Events</th>
        <th> Status</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($products))
        @foreach($products as $i)
            <tr class="odd gradeX">
                <td> {{ $i->id }}</td>
                <td class="td-product-img">
                    <div class="backend-img">
                        @if($i->cover_image)
                            <img src="{{ asset($i->cover_image) }}"/>
                        @else
                            <img src="{{ asset('admin/images/no-image.png') }}"/>
                        @endif
                    </div>
                    <p class="product-info">
                        Name: <b>{{ $i->name }}</b> <br/>
                        Sku: {{ $i->sku }} <br/>
                        Price: <span class="font-red-mint">{{ number_format($i->price) }}</span> vnđ
                        <br/>
                        @if($i->new_price)
                            New Price: <span
                                    class="font-red-mint">{{ number_format($i->new_price) }}</span>
                            vnđ<br/>
                        @endif
                        @if(count($i->images) > 1)
                            <a class="green" v-on:click="changeCoverImage">Change Cover Image</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    @if(count($i->images) > 1)
                        <div class="product-image-thumb">
                            @foreach($i->images as $image)
                                <div class="img-thumb">
                                    <img src="{{ asset($image->image) }}"
                                         data-img="{{ $image->image }}" data-id="{{ $i->id }}"
                                         v-on:click="updateCoverImage"/>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </td>
                <td>
                    <p class="backend-attribute">Size:
                        @foreach($i->product_attributes_sizes as $size)
                            <i class="btn btn-xs blue">{{ $size->attr_value }}</i>
                        @endforeach
                    </p>
                    <p class="backend-attribute">
                        Color:
                        @foreach($i->product_attributes_colors as $color)
                            <i class="btn btn-xs blue">{{ $color->attr_value }}</i>
                        @endforeach
                    </p>
                </td>
                <td>{{ $i->created_at }}</td>
                <td>
                    <p>
                        <a class="btn btn-default btn-sm"
                           href="{{ route('product.copy', ['id' => $i->id]) }}">Copy product</a>
                        <a class="btn btn-sm yellow"
                           href="{{ route('product.copyedit', ['id' => $i->id]) }}">Copy and edit
                            product</a>
                    </p>
                    <a class="btn btn-sm yellow" v-on:click="openPopupEvent" data-id="{{ $i->id }}">Add to
                        event</a>
                </td>
                <td>
                    @if($i->status === 1)
                        <span class="label label-sm label-success"> Approved </span>
                    @else
                        <span class="label label-sm label-warning"> No </span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('product.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('product.edit', ['product' => $i->id]) }}"
                           class="btn red btn-sm">Update</a>
                        <button type="button" class="btn red btn-sm" v-on:click="confirmBeforeDelete">Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>