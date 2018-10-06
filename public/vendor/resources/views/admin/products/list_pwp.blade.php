@if ($products->isEmpty())
No Product Found!
@else
 <table class="table checkout-table table-responsive">
<thead>
    <tr>
        <th width="1%"><input type="checkbox"/></th>
        <th class="table-title">Product Name</th>
        <th class="table-title">Product Code</th>
        <th class="table-title">Sale Price</th>
        <th class="table-title">Quantity</th>
    </tr>
</thead>
<tbody>
@foreach ($products as $product)
<tr>
    <td><input name="pwp_product_id[]" value="{{$product->id}}" type="checkbox"/></td>
    <td class="item-name-col">
        <figure>
        @if($product->thumbnail_image_1 != '')
        <a href="product_edit.html"><img src="{{ asset('/public/admin/products/medium/'. $product->thumbnail_image_1) }}" alt="<?php echo htmlspecialchars($product->product_name,ENT_QUOTES); ?>" class="img-responsive"></a>
        @endif
        </figure>
        <header class="item-name">
            <a href="product_edit.html">{{$product->product_name}}</a>
        </header>
        <ul>
          <li>Color: {{$product->colors}}</li>
        </ul>
    </td>
    <td class="item-code">{{$product->product_code}}</td>
    <td class="item-price-col"><span class="item-price-special">RM {{number_format($product->sale_price, 2)}}</span></td>
    <td>{{$product->quantity_in_stock}}</td>
</tr>
@endforeach
</tbody>
</table>
@endif