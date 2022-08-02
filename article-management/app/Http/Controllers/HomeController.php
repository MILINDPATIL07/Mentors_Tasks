<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
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
        // $id = User::all();
        // fetch category and product table records using join
        $articles = Article::join('categories', 'categories.id', '=', 'category')->join('users','users.id', '=', 'created_by')->where('articles.status', '=', 'active')
            ->get(['articles.*', 'categories.cname','users.name']);

        $cat = Category::latest()->get();

        return view('dashboard', compact('articles', 'cat'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
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
        $query = Article::query();

        $categories = Category::all();
        if ($request->ajax()) {
            $article = $query->join('categories', 'categories.id', '=', 'category')->join('users','users.id','=', 'created_by')->where(['category' => $request->category])->get();
            return response()->json(['articles' => $article]);
        }

        $article = $query->join('categories', 'categories.id', '=', 'category')->join('users','users.id','=', 'created_by')->get(['articles.*', 'categories.cname','users.name']);

        return view('dashboard', compact('article', 'categories'));
    }
}
