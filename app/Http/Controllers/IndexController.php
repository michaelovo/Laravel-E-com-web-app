<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(){
    	//$productsAll = Product::get(); //ascending order(default)
    	//$productsAll = Product::orderby('id', 'desc')->get(); //descending order
    	$productsAll = Product::inRandomOrder()->get(); //Random order
        return view('index')->with(compact('productsAll'));
    	
           
    }
}
