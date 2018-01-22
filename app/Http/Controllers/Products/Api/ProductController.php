<?php

namespace App\Http\Controllers\Products\Api;

use App\Exceptions\ProductNotBelongToUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Models\Products\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(ProductRequest $request)
    {
    	$product = new Product();
    	$product->name = $request->name;
    	$product->details = $request->description;
    	$product->price = $request->price;
    	$product->stock = $request->stock;
    	$product->discount = $request->discount;
    	$product->save();
        return response([
        	'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
    	$this->productUserCheck($product);
    	if(isset($request['description']))
	    {
	    	$request['details'] = $request['description'];
	    	unset($request['description']);
	    }
        $product->update($request->all());
	    return response([
		    'data' => new ProductResource($product)
	    ], Response::HTTP_OK);
    	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
	    $this->productUserCheck($product);
	    $product->delete();
	    return response(null,Response::HTTP_NO_CONTENT );
    }
    
    public function productUserCheck($product)
    {
        if(Auth::id() !== $product->user_id)
        {
        	throw new ProductNotBelongToUser;
        }
    }
}
