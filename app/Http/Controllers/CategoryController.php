<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() //all category
    {
        $tag = null;
        $categories = null;
        $allProducts = Tool::getAllProducts();
        $newestMenProducts = Product::where('category_id',3)->orderBy('id','desc')->take(3)->get();
        $newestMenProducts->load('productImages');
        $newestWomenProducts = Product::where('category_id',4)->orderBy('id','desc')->take(3)->get();
        $newestWomenProducts->load('productImages');
        return view('public.showProduct.showProductIndex',
            compact('allProducts','newestMenProducts','newestWomenProducts','categories','tag'));
    }

    public function show($id) //selected category
    {
        $tag = null;
        $checkCategory = Category::find($id);
        if (!$checkCategory) {
            return redirect(route('categories.index'));
        }else
        {
            $categories = Category::where('id',$id)->with(['subCategories'])->get();
            $IDs = [];
            foreach($categories as $category)
            {
                $IDs [] = $category->id;
                foreach($category->subCategories as $sub)
                    $IDs [] = $sub->id;

            }
            $allProducts = Product::whereIn('category_id',$IDs)->get();
            $allProducts->load('productImages');
            $newestMenProducts = Product::where('category_id',3)->orderBy('id','desc')->take(3)->get();
            $newestMenProducts->load('productImages');
            $newestWomenProducts = Product::where('category_id',4)->orderBy('id','desc')->take(3)->get();
            $newestWomenProducts->load('productImages');
            return view('public.showProduct.showProductIndex',
                compact('allProducts','newestMenProducts','newestWomenProducts','categories','tag'));
        }
    }

    public function edit($id) //selected tag
    {
        if (ProductTag::find($id))
        {
            $tag = ProductTag::find($id);
            $categories = null;
            $allProducts = Product::where('product_tag_id',$id)->get();
            $allProducts->load('productImages');
            $newestMenProducts = Product::where('category_id',3)->orderBy('id','desc')->take(3)->get();
            $newestMenProducts->load('productImages');
            $newestWomenProducts = Product::where('category_id',4)->orderBy('id','desc')->take(3)->get();
            $newestWomenProducts->load('productImages');
            return view('public.showProduct.showProductIndex',
                compact('allProducts','newestMenProducts','newestWomenProducts','categories','tag'));
        }else
            return redirect(route('publicHome'));
    }

    public function update()
    {
        return redirect(route('publicHome'));
    }

    public function destroy()
    {
        return redirect(route('publicHome'));
    }
}
