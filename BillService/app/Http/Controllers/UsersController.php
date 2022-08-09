<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Exports\ArticleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreArticlesRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use DB;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $article = User::select('articles.*', 'categories.cname', 'users.name')->join('categories', 'categories.id', '=', 'category')->join('users', 'users.id', '=', 'created_by')->where('categories.status', '=', 'active')->where('articles.status', '=', 'active')
            ->sortable()->paginate(5);
        // dd($article);
        // $article = DB::table('articles')->join('categories', 'categories.id', '=', 'category')->join('users','users.id', '=', 'created_by')->where('articles.status', '=', 'active')
        // ->get(['articles.*', 'categories.cname','users.name'])->paginate();


        // $data = Product::latest()->paginate(3);

        return view('users.index', compact('article'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $article = Category::where('status', 'active')->get()->all();
        return view('articles.create', compact('article'));
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
            'article_name' => 'required',
            'article_description' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            // 'status' => 'required'
        ]);
        $user = Auth::user()->id;

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $article = $request->all();

        $article['image'] = $imageName;

        $article['created_by'] = $user;

        User::create($article);

        return redirect()->route('articles.index')
            ->with('success', 'Articles Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $article)
    {
        // echo $article;
        // exit;
        return view('articles.single', compact('article'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $article)
    {

        $category = Category::where('status', 'active')->get()->all();
        // $new = Category::get('cname');
        return view('articles.edit', compact('article', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $article)
    {
        $request->validate([
            'article_name' => 'required',
            'article_description' => 'required',
            'category' => 'required',
            // 'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            // 'status' => 'required'
        ]);
        // $user = Auth::user()->id;
        //  $user = Auth::user()->email;
        //  $article= article::find($id);

        if (!empty($request->file('image'))) {

            unlink(public_path('images/' . $article->image));

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/'), $imageName);

            $article->article_name = $request->article_name;

            $article->article_description = $request->article_description;

            $article->category = $request->category;

            $article->status = $request->status;

            //Assign image feild as name and it's extention
            $article['image'] = $imageName;

            $article->update();
            return redirect()->route('articles.index')
                ->with('success', 'Article Updated successfully.');
        } else {

            $article->article_name = $request->article_name;

            $article->article_description = $request->article_description;

            $article->category = $request->category;

            $article->status = $request->status;

            $article->update();

            return redirect()->route('articles.index')
                ->with('success', 'Article Updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(USer $article)
    {
        // unlink image from folder while user delete record

        unlink(public_path('images/' . $article->image));
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Articles deleted successfully');
    }
    public function get_article_data()
    {
        return Excel::download(new ArticleExport, 'articles.xlsx');
    }
}
