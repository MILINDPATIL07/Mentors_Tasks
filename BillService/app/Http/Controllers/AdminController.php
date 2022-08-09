<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\ExportUser;
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
        if (auth()->user()->usertype == '0') {
            $services = Service::all();

            $data = User::with('services')->where('usertype', '1')->orwhere('approve', 'F')->sortable()->paginate(3);

            return view('admin.index', compact('data', 'services'))->with('i', (request()->input('page', 1) - 1) * 5);

        } elseif (auth()->user()->usertype == '1') {
            if (auth()->user()->approve == 'F' || auth()->user()->approve == 'E') {
                $data = User::where('id', auth()->user()->id)
                    ->where('status', 'active')
                    ->sortable()
                    ->paginate(5);
                return view('admin.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 2);
            } else {
                $data = User::where('usertype', '1')
                    ->where('status', 'active')
                    ->where('approve', 'T')
                    ->sortable()
                    ->paginate(5);
                return view('admin.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 2);
            }
        }

        // return view('admin.index', compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 2);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->usertype == 0) {
            return view('admin.create');
        } else {
            return back()->with('error', 'You Are not allowd to access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:2|max:10',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5',
                'status' => 'required',
            ],
            [
                'name.required' => 'Admin Name is Required',
                'name.min' => 'Minimum 2 charachers Require!!',
                'name.max' => 'Miximum 10 charachers Require!!',
                'email.required' => 'Email is Required',
                'email.unique' => 'Email is already exists!!',
                'password.required' => 'Password is Required',
                'password.min' => 'Minimum 5 charachers Required!!',
            ],
        );

        // $input = $request->all();
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        // $admin->approve =$request->approve;
        $admin->status = $request->status;
        $admin->save();

        return redirect()
            ->route('admin.index')
            ->with('success', 'person created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $admin = User::where('approve', 'false')->get();
        // //  dd($admin);
        // return view('admin.approve', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $services = Service::all();
        $user_services = $admin->services->pluck('id')->toArray();
        //  dd($user_services);
        // return view('admin.edit',compact('services','user_services','admin'));

        if (auth()->user()->usertype == '1' && auth()->user()->id == $admin->id) {
            return view('admin.edit', compact('admin', 'services', 'user_services'));
        } else {
            // return redirect('category') ->with('error', 'You Are not allowd to access');
            return back()->with('error', 'You Are not allowd to access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     * *
     *
     *
     *
     *
     *
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'photo' => 'required|mimes:jpg,jpeg,png|max:2048',
            'gender' => 'required',
            'age' => 'required',
        ]);
        // $user = Auth::user()->id;
        //  $user = Auth::user()->email;
        //  $admin= article::find($id);
        // dd($request->file('photo'));

        if (!empty($request->file('photo'))) {
            // unlink(public_path('photos/' . $admin->photo));

            $photoName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('photos/'), $photoName);

            $admin->name = $request->name;

            $admin->email = $request->email;

            $admin->photo = $request->photo;

            $admin->gender = $request->gender;

            $admin->age = $request->age;

            // $admin->Service_Type = $request->Service_Type;

            //Assign photo feild as name and it's extention
            $admin['photo'] = $photoName;

            $admin['approve'] = 'F';

            $admin->update();

            $ss = $request->services;

            $admin->services()->attach($ss);

            return redirect()
                ->route('admin.index')
                ->with('success', 'Profile Updated successfully.');
        } else {
            $admin->name = $request->name;

            $admin->email = $request->email;

            $admin->gender = $request->gender;

            $admin->age = $request->age;

            $admin['approve'] = 'F';

            $admin->update();

            $ss = $request->services;

            $admin->services()->sync($ss);

            return redirect()
                ->route('admin.index')
                ->with('success', 'Profile Updated successfully.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        // unlink(public_path('photos/' . $admin->photo));

        $admin->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Admin deleted successfully');
    }
    public function accept($id)
    {
        $test = User::find($id)->update(['approve' => 'T']);

        // $test = User::find($id)->where('approve', 'F')->update(['approve', 'T']);
        // die($test);
        // $test = User::find($id)->update(['approve' => 'T']);

        return back()->with('success', 'Request Approved Successfully.');
    }
    public function active($id)
    {
        $test = User::find($id)->update(['status' => 'active']);

        return back()->with('success', 'Request Activated');
        // die($test);
    }
    public function inactive($id)
    {
        $test = User::find($id)->update(['status' => 'inactive']);
        // die($test);

        return back()->with('success', 'Request Deactivated');
    }

    public function get_admin_data()
    {
        return Excel::download(new ExportUser(), 'admin.xlsx');
    }
}
