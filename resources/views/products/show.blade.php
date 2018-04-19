@extends("index")

@section("content")
    <table class="table"
    <tr>
        <th>Name</th>
        <td>{{$product->name}}</td>
    <tr>

    <tr>
        <th>Product Type</th>
        <td>{{$product->producttype->name}}</td>
    <tr>

    <tr>
        <th>Supplier</th>
        <td>{{$product->supplier->name}}</td>
    <tr>

    <tr>
        <th>Unit Price</th>
        <td>{{number_format($product->unit_price,2)}}</td>
    <tr>
    </table>
@endsection