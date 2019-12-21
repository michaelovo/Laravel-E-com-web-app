<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    public function index(){
    	//$productsAll = Product::get(); //ascending order(default)
    	//$productsAll = Product::orderby('id', 'desc')->get(); //descending order
    	$productsAll = Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(6); //Random order and only product whose status and feature_item value=1
    	//dump($productsAll); //alternative to commented lines above for debuging,bt ds will displays output in cmd

    	
    	// get all categories and subcategories along with the 'categories' relationship
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
    	//$categories = json_decode(json_encode($categories));
 		//echo "<pre>"; print_r($categories); die;
 		//dump($categories); //alternative to commented lines above for debuging,bt ds will displays output in cmd
 		
 		/*
 		//* START BASIC APPROACH WITHOUT RELATIONSHIP
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
	    	
			//return view('index')->with(compact('productsAll','categories_menu'));
		//* END BASIC APPROACH WITHOUT RELATIONSHIP
	    	*/
	    $banners = Banner::where('status','1')->get(); //get only enabled slider/banner for display on slider blade file

	    //Meta tags for SEO
	    $meta_title="JayLinks.ng.com";
	    $meta_description="Online shopping site for women, men and children";
	    $meta_keywords="eshop website, online shopping";
	    
        return view('index')->with(compact('productsAll','categories','banners','meta_title','meta_description','meta_keywords'));
    	
           
    }
}
