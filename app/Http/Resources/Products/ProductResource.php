<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        	'name' => $this->name,
	        'description'   => $this->details,
	        'price'   => $this->price,
	        'totalPrice'    => round((1-($this->discount/100)) * $this->price, 2) ,
	        'stock'   => ($this->stock > 0) ? $this->stock : 'Out of stock',
	        'discount'   => $this->discount,
	        'rating'     => ($this->reviews->count()) ? round($this->reviews->sum('star')/$this->reviews->count(), 2): 'No rating yet',
	        'href'      => [
	        	'reviews' => route('reviews.index', $this->id)
	        ]
        ];
    }
}
