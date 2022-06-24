<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaServiceController extends Controller
{
    public function webRegister()
    {
        return view('webRegister');
    }


    public function webRegisterPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
            'CaptchaCode' => 'required|valid_captcha'
        ]);
        return redirect()->back()
            ->with ('success', 'Form Validated Successfully.');
        // print('write your other code here.');
    }
}

