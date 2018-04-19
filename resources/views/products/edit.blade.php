@extends("index")

@section("content")
    {{
        Form::model($product,
        [
        "action" => ["ProductsController@update",$product->id],
        "files" => true
        ])
    }}

    <div class="row">
        <div class="col-md-6">
            {{Form::label('Product Name')}}
            {{Form::text('name',$product->name,["class"=>"form-control"])}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{Form::label('Product Type')}}
            {{Form::select('producttype_id',$producttypes,$product->producttype_id,["class"=>"form-control"])}}
         </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{Form::label('Supplier')}}
            {{Form::select('supplier_id',$suppliers,$product->supplier_id,["class"=>"form-control"])}}
         </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{Form::label('Unit Price')}}
            {{Form::text('unit_price',number_format($product->unit_price,2,'.',''),["class"=>"form-control"])}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{Form::label('Image')}}
            {{Form::file('image',["class"=>"form-control"])}}
        </div>
    </div>

    {{Form::submit('Submit',["class"=>"btn btn-danger"])}}
    {{Form::close()}}
@endsection