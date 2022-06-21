<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function singleProduct($productID,$productName)
    {
        $product = Product::find($productID);
        $product->load('productImages');
        $categories = Category::where('id',$product->category_id)->with(['subCategories'])->get();
        $IDs = [];
        foreach($categories as $category)
        {
            $IDs [] = $category->id;
            foreach($category->subCategories as $sub)
                $IDs [] = $sub->id;

        }
        $newestProducts = Product::orderBy('id','desc')->take(3)->get();
        $newestProducts->load('productImages');
        $productComments = Comment::where('product_id',$product->id)->where('status', 1)->get();
        return view('public.singleProduct.singleProductIndex',
            compact('product','categories','newestProducts','productComments'));
    }

    public function postComment(CommentRequest $request,$productID)
    {
        $newComment = new Comment();
        $newComment->user_id = Auth::user()->id;
        $newComment->product_id = $productID;
        $newComment->description = $request->safe()['description'];
        $newComment->save();
        return back();
    }
}
