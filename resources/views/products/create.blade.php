@extends("index")

@section("content")
<form action="/products" method="POST">
    {{csrf_field()}}
    <fieldset>
        <div class="row">

            <div class="col-md-6">
                <label>
                    Product Name
                </label>
                <input type="text" class="form-control" name = "product[name]"/>
            </div>

            <div class="col-md-6">
                <label>
                    Product Type
                </label>
                <select class="form-control" name = "product[producttype_id]">
                @foreach($producttypes as $producttype)
                <option value="{{$producttype->id}}">{{$producttype->name}}</option>
                @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label>
                    Supplier
                </label>
                <select class="form-control" name = "product[supplier_id]"/>
                @foreach($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label>
                    Unit Price
                </label>
                <input type="text" class="form-control" name = "product[unit_price]"/>
            </div>

            <div class="row">
                <div class="action col-md-12">
                    <input type="submit" value="Submit" class="btn btn-danger pull-right"/>
                    <input type="button" value="Reset" class="btn btn-default"/>
                </div>
            </div>

        </div>
    </fieldset>
</form>
@endsection