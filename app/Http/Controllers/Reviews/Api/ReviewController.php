<?php

namespace App\Http\Controllers\Reviews\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\ReviewRequest;
use App\Http\Resources\Reviews\ReviewResource;
use App\Models\Products\Product;
use App\Models\Reviews\Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
    	return ReviewResource::collection($product->reviews);
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
	
	/**
	 * @param ReviewRequest $request
	 * @param Product $product
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
    public function store(ReviewRequest $request, Product $product)
    {
	    $review = new Review($request->all());
        $product->reviews()->save($review);
        return response([
        	'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reviews\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reviews\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }
	
	/**
	 * @param Request $request
	 * @param Product $product
	 * @param Review $review
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
    public function update(Request $request, Product $product, Review $review)
    {
    	$review->update($request->all());
	    return response([
		    'data' => new ReviewResource($review)
	    ], Response::HTTP_OK) ;
    }

    
    public function destroy(Product $product, Review $review)
    {
	    $review->delete();
	    return response(null, Response::HTTP_NO_CONTENT);
    }
}
