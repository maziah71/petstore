<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = [1,2,3];
        $products = \App\Product::all();
        //var_dump($products); die;
        
        return view("products/index", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $producttypes = \App\Producttype::all();
        $suppliers = \App\Producttype::all();
        return view("products/create",
            [
            "producttypes"=>$producttypes,
            "suppliers"=>$suppliers
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // var_dump($request->product); die;
        $params = $request->product;

        $params = $request->validate([
            'product.name' => 'required|unique:products,name|max:225',
            'product.producttype_id' => 'required|exists:producttypes,id',
            'product.supplier_id' => 'required|exists:suppliers,id',
            'product.unit_price' => 'required|numeric'
        ]);

        $params = $params["product"];

        $product = new \App\Product;
        $product->name = $params["name"];
        $product->producttype_id = $params["producttype_id"];
        $product->supplier_id = $params["supplier_id"];
        $product->unit_price = $params["unit_price"];

        if($product->save())
        {
            //save success
            return redirect("/products");
            
        } else
            //save failed
            return redirect("/products/create");

        {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = \App\Product::find($id);

        if(!$product) {
            // die("Product with id=" . $id . " not found!");
            \Session::flash('error', "Product with id=" . $id . " not found!");
            return redirect('/products');
        }

        return view("products/show",["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = \App\Product::find($id);

        if(!$product) {
            // die("Product with id=" . $id . " not found!");
            \Session::flash('error', "Product with id=" . $id . " not found!");
            return redirect('/products');
        }

        try {
            $this->authorize('update',$product);
        } catch(Exception $e) {
            \Session::flash('error',$e->getMessage());
            return redirect('/products');
        }

        $producttypes = \App\Producttype::all()->pluck('name','id');
        $suppliers = \App\Supplier::all()->pluck('name','id');

        return view("products/edit",
            compact('product','producttypes','suppliers')
        );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = \App\Product::find($id);

        if(!$product) {
            // die("Product with id=" . $id . " not found!");
            \Session::flash('error', "Product with id=" . $id . " not found!");
            return redirect('/products');
        }

        $this->authorize('update',$product);

        $params = $request->only('name','producttype_id','supplier_id','unit_price');
        // $product->name = $params->name;
        // $product->producttype_id = $params->producttype_id;
        // $product->supplier_id = $params->supplier_id;
        // $product->unit_price = $params->unit_price;
        
        $params["unit_price"] = floatval($params["unit_price"]);

        $file = $request->file('image');
        if(!!$file)
        {
        $file-> move(
            base_path("public/img/uploads/"),
            $file->getClientOriginalName()
        );
        $params["image"] = "/img/uploads/" . $file->getClientOriginalName();
        }
        // $request->file('image')->move(base_path("public/img/uploads/"), $product->id . ".jpg");

        if ($product->update($params))
        {
            //update successful
            \Session::flash('notice',"Product updated successfully!");
            return redirect('/products/'.$product->id);
        }
        else
        {
            //update failed
            \Session::flash('error',"Product updated failed!");
            return redirect('/products/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = \App\Product::find($id);
        if ($product->destroy($id))
        {
            //destroy success
            return redirect("/products");
        } else
        {
            //destroy failed
            die("Failed to delete product");
        }
    }

    public function details(Request $request,$id)
    {
        $product = \App\Product::find($id);

        return response()->json([
            "id" => $product->id,
            "name" => $product->name,
            "producttype" => $product->producttype->name,
            "supplier" => $product->supplier->name,
            "unit_price" => $product->unit_price,
            "image" => $product->image ? url($product->image) : ""
        ]);
    }
}
