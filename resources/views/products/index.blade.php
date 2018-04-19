@extends('index')

@section('content')

@auth
{{link_to_action('ProductsController@create','New Product',[],['class'=>'btn btn-primary'])}}
@endauth

<table border="1" class="table">
    <thead>
        <tr>
            <td align="center">Id</td>
            <td align="center">Name</td> 
            <td align="center">Product Type</td>
            <td align="center">Supplier</td>
            <td align="center">Price</td>
            <td align="center">Image</td>
            @auth
                <td align="center" width="200">Action</td>
            @endauth
        </tr>
    </thead>
<tbody>
@foreach($products as $product)
    <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$product["name"]}}</td>
        <td>{{$product->producttype->name}}</td>
        <td>{{$product->supplier->name}} <br>
            {{$product->supplier->address}}</td>
        <td>{{number_format($product["unit_price"],2)}}</td>
        
        <td align="center"> 

        <a href="#" data-toggle="modal" data-target="#myModal"
            onclick="loadProductDetails({{$product->id}})">
            <img src="{{$product->image ?url($product->image) : ""}}
            "width="100" height="100"/></a>
     

        </td>
        @if (Auth::check())
        <td>
            <form action="/products/{{$product->id}}/destroy" method="POST">
                 {{csrf_field()}}
                 @can('delete',$product)
                 <button type="button" class="btn btn-default"
                      onclick="confirm('Are you sure?') && this.parentNode.submit()">
                      <span class="glyphicon glyphicon-trash"></span>
                      Delete
                 </button>
                 @endcan

                 @can('update',$product)
                 <a class="btn btn-default" href="/products/{{$product->id}}/edit">
                      <span class="glyphicon glyphicon-edit"></span>
                    Edit
                 </a>
                 @endcan

                 <a class="btn btn-default" href="/products/{{$product->id}}/edit">
                      <span class="glyphicon glyphicon-edit"></span>
                    Edit

            </form>

            <!-- <button type="button"
                onclick="window.location.replace('/products/{{$product->id}}/edit')">
                Edit
            </button> -->

        </td>
        @endif
    </tr>

@endforeach
</table>

@include("shared/dialogs/image_detail")

@endsection

@section("script")
    <script type="text/javascript">
        function loadProductDetails(product_id)
        {
            $.get("/products/" + product_id + "/details")
            .then(function(data){
                $('#product_name').html(data.name);
                $('#producttype_name').html(data.producttype);
                $('#supplier_name').html(data.supplier);
                $('#full_image').attr('src',data.image);
            });
        }
    </script>
@endsection