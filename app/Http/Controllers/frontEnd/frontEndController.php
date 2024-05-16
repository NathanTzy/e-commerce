<?php

namespace App\Http\Controllers\frontEnd;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Cache\RateLimiting\Limit;

class frontEndController extends Controller
{

    public function index()
    {
        $category = category::select('id', 'name')->latest()->get();
        $product = product::with('product_galleries')->select('id', 'name', 'price', 'slug')->latest()->Limit(8)->get();
        return view('pages.frontEnd.index', compact('category', 'product'));
    }

    public function detailProduct($slug)
    {
        $category = category::select('id', 'name')->latest()->get();
        $product = product::with('product_galleries')->where('slug', $slug)->first();
        return view('pages.frontEnd.detail',  compact('product', 'category'));
    }
}
