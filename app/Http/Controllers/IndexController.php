<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
    	//$productsAll = Product::get(); //ascending order(default)
    	//$productsAll = Product::orderby('id', 'desc')->get(); //descending order
    	$productsAll = Product::inRandomOrder()->get(); //Random order

    	
    	$Categories = Category::where(['parent_id'=>0])->get(); // get all categories and subcategories
    	//$Categories = json_decode(json_encode($Categories));
 		//echo "<pre>"; print_r($Categories); die;
 		// $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
 		$categories_menu="";
	    	foreach ($Categories as $cat) {
	    		$categories_menu.="<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$cat->name."
										</a>
									</h4>
								</div>
								<div id='".$cat->id."' class='panel-collapse collapse'>
									<div class='panel-body'>
										<ul>";
										$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
							    		foreach ($sub_categories as $sub_cat) {
							    			$categories_menu.="<li><a href='".$sub_cat->url."'>".$sub_cat->name." </a></li>";
							    		}
											
											$categories_menu.="</ul>
									</div>
								</div>";		
	    	 	
	    	}
        return view('index')->with(compact('productsAll','categories_menu'));
    	
           
    }
}
