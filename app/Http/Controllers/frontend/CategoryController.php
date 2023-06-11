<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function showProductsInCategory(Request $request, $slug)
    {
        $title = Category::where('slug', $slug)->first()->name;
        $category = Category::where('slug', $slug)->first();
        if ($request->sort_by == 'price' && $request->sort_order == 'asc') {
            $products = $category->products()/*->whereBetween('price', [$request->min, $request->max])*/->orderBy('price', 'asc')->get();
        } else if ($request->sort_by == 'price' && $request->sort_order == 'desc') {
            $products = $category->products()/*->whereBetween('price', [$request->min, $request->max])*/->orderBy('price', 'desc')->get();
        } else {
            $products = $category->products;
        }


        return view('frontend.shop', compact('title', 'products', 'slug'));
    }

    public function filter(Request $request)
    {
        return response()->json(Product::whereBetween('price', [$request->min, $request->max])->get());
    }
}
