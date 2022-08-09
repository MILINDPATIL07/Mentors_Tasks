<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\AdminExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('admin');
        // $data = User::where('usertype', '1')->paginate(3);
        // return view('home', compact('data'))
        //     ->with('i', (request()->input('page', 1) - 1) * 2);
    }

    public function editprofile(){



    }
}
