<?php

namespace App\Http\Controllers;

use illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // fetch category and product table records using join
        $data = Product::join('categories', 'categories.id', '=', 'category_id')->where('products.active','=','Yes')
            ->get(['products.*', 'categories.cname']);
        // $data = Product::latest()->paginate(3);      

        return view('product.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new = Category::where('active', 'Yes')->get()->all();
        return view('product.create', compact('new'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pname' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'active' => 'required'
        ], [
            'pname.required' => 'Product Name is Required!',
            'active.required' => 'Active Required!'
        ]);

        // $user = Auth::user()->id;
        $user = Auth::user()->email;
        // $product = new Product;
        // $request->file('image'); 

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('public/images'), $imageName);

        $product = $request->all();

        $product['image'] = $imageName;

        $product['createdbyuserid'] = $user;

        Product::create($product);

        return redirect()->route('product.index')
            ->with('success', 'product Added successfully.');
    }

    public function show()
    {
        // return view ('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     *  @param  int  $id
     *  @param \app\models\Product $product
     *  @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $new = Category::where('active', 'Yes')->get()->all();
        // $new = Category::get('cname');
        return view('product.edit', compact('product', 'new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \app\models\Product $product
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'pname' => 'required',
            // 'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'active' => 'required'
        ], [
            'pname.required' => 'product Name is Required!',
            'active.required' => 'Active Required!'
        ]);

        // $user = Auth::user()->id;
        //  $user = Auth::user()->email;
        //  $product= Product::find($id);
        if (!empty($request->file('image'))) {

            unlink(public_path('public/images/' . $product->image));

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('public/images'), $imageName);

            $product->pname = $request->pname;

            $product->category_id = $request->category_id;

            $product->active = $request->active;

            //Assign image feild as name and it's extention  
            $product['image'] = $imageName;

            $product->update();
            return redirect()->route('product.index')
                ->with('success', 'Product Updated successfully.');
        } else {

            $product->pname = $request->pname;

            $product->category_id = $request->category_id;

            $product->active = $request->active;

            $product->update();

            return redirect()->route('product.index')
                ->with('success', 'Product Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *@param \app\models\Product $product
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Delete image from folder while user delete record 
        unlink(public_path('public/images/' . $product->image));

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');
    }
}
