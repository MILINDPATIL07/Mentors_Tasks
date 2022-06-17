<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function dashboard(Request $request)
    {
        $query= Product::query();
        
        $categories= Category::all();
        if($request->ajax()){
            $products = $query->join('categories', 'categories.id', '=', 'category_id')->where(['category_id'=>$request->category])->get(['products.*', 'categories.cname']);
            return response()->json(['products'=> $products]);
        }
        
         $products = $query->join('categories', 'categories.id', '=', 'category_id')->where('products.active','=','Yes')->get(['products.*', 'categories.cname']);

        // $data = Product::where('active','Yes')->latest()->paginate(5);
    //   dd($products);

        return view('dashboard',compact('products','categories'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function filterproduct(request $request)
    {
        $query= Product::query();
        
        $categories= Category::all();
        if($request->ajax())
        {
            $products = $query->join('categories', 'categories.id', '=', 'category_id')->where(['category_id'=>$request->category])->get();
            return response()->json(['products'=> $products]);
        }
        
              $products = $query->join('categories', 'categories.id', '=', 'category_id')->get(['products.*', 'categories.cname']);
       
        return view('dashboard',compact('products','categories'));
    }

}
