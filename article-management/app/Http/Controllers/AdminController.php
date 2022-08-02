<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\AdminExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

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

         $data = User::where('usertype', '1')->sortable()->paginate(5);

         // $data = User::get()->all();
        // dd($data);

        return view('admin.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.register');
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
            'name' => 'required|min:2|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ], [
            'name.required' => 'Admin Name is Required',
            'name.min' => 'Minimum 2 charachers Require!!',
            'name.max' => 'Miximum 10 charachers Require!!',
            'email.required' => 'Email is Required',
            'email.unique' => 'Email is already exists!!',
            'password.required' => 'Password is Required',
            'password.min' => 'Minimum 5 charachers Required!!',


        ]);

        // $input = $request->all();
        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.index')
            ->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $article = Article::where('status', 'inactive')->get()->all();
        return view('admin.approve',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        //echo $admin->id; exit;
        $request->validate([
            'name' => 'required|min:2|max:10',
            'email' => 'required|unique:users,email,' . $admin->id . ',id',
        ], [
            'name.required' => 'Admin Name Is Required',
            'name.min' => 'Minimum 2 charachers Required!!',
            'email.required' => 'Email is Required',
            'email.unique' => 'Email is already exists!!'
        ]);


        $admin->update($request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Admin deleted successfully');
    }
    public function accept($id)
    {

        $res = Article::find($id)->update(['status' => 'active']);

        return back()->with('success', 'Request Approved Successfully.');

    }

    public function get_admin_data()
    {
        return Excel::download(new AdminExport, 'admin.xlsx');
    }
}
