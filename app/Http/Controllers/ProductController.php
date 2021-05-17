<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function get_all_products()
    {
        $products=Product::get();
        return view('product',['products' => $products]);
        $data[]=date(interval(-7));
        echo $data;
    }
}
