<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productDetails($slug, $code)
    {
        $product = Product::where('slug', $slug)->where('code', $code)->first();
        $product->view_count = $product->view_count + 1;
        $product->update();

        $popularProducts = Product::orderBy('view_count', 'desc')->take(5)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return view('frontend.detail', compact('product', 'popularProducts', 'relatedProducts'));
    }



    public function search(Request $request)
    {
        $keyword = $request->q;

        $title = 'tìm kiếm sản phẩm';

        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->get();

        return view('frontend.search', compact('title', 'products', 'keyword'));
    }
}
