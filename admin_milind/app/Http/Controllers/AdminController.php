<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\AdminCreated;

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
        //     if (!Auth::check()){
        //         return redirect("login")->withSuccess('You are not allowed to access');
        //    }
        $data = User::where('usertype', '1')->paginate(2);

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
        return view('admin.create');
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
            'hobbies' => 'required|',
            'gender' => 'required',
            'password' => 'required'
        ], [
            'name.required' => 'Admin Name is Required',
            'name.min' => 'Minimum 2 charachers require!!',
            'name.max' => 'Miximum 10 charachers require!!',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already exists!!'
        ]);

        // $input = $request->all();
        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->hobbies = $request->hobbies;
        $admin->password = Hash::make($request->password);
        $admin->save();

        // $admin->hobbies = implode(',',$request->hobbies);
        //  $input['hobbies']=$request->input('hobbies');
        //  User::create($admin);
        //event(new PostCreated($post)); // dispatch event from here
        //We can use the below commented code 
        // AdminCreated::dispatch($admin);

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
        return view('admin.index');
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
            'hobbies' => 'required',
            'gender' => 'required',
            // 'password' => 'required'
        ], [
            'name.required' => 'Admin Name Is Required',
            'name.min' => 'Minimum 2 charachers Required!!',
            'email.required' => 'Email is Required',
            'email.unique' => 'Email is already exists!!'
        ]);

        //$request_data = $request->all();
        //$request_data['gender'] = 'active'; 

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
}
