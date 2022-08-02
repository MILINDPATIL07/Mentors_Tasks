<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\models\Article;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;


class CategoryController extends Controller
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
        $data = Category::latest()->paginate(4);

        return view('category.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $value = Article::all();
        // if (auth()->user()->id == 'created_by' || auth()->user()->usertype ==0){

        if (auth()->user()->usertype == 0) {
            return view('category.create');
        } else {
            // return redirect('category') ->with('error', 'You Are not allowd to access');
            return back()->with('error', 'You Are not allowd to access');

            // echo 'not valid';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required',
            'status' => 'required',

        ], [
            'cname.required' => 'Category Name is Required!',
            'status.required' => 'Status Required!'
        ]);

        $category = $request->all();
        Category::create($category);
        //event(new PostCreated($post)); // dispatch event from here

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Category  $category
     */
    public function edit(Category $category)
    {
        if (auth()->user()->usertype == 0) {
            return view('category.edit', compact('category'));
        } else {
            return back()->with('error', 'You Are not allowd to access');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'cname' => 'required',
            'status' => 'required',

        ], [
            'cname.required' => 'Category is Required',
            'status.required' => 'Status Required!'

        ]);

        $category->update($request->all());
        return redirect()->route('category.index')
            ->with('success', 'category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (auth()->user()->usertype == 0) {
            $category->delete();
            return redirect()->route('category.index')
                ->with('success', 'category deleted successfully');
        }
        return back()->with('error', 'You Are not allowd to access');
    }
    public function get_category_data()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }
}
