<?php namespace Omashu\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\LoginFormRequest;
use Omashu\Http\Requests\ResetPasswordRequest;

class AuthController extends Controller {

    public function showLogin()
    {
        return view('admin.auth.login');
	}

    public function doLogin(LoginFormRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('admin/');
        }

        return back()->withInput($request->except('password'));
    }

    public function showPasswordReset()
    {
        return view('admin.auth.resetpassword');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        if(! Auth::validate(['email' => Auth::user()->email, 'password' => $request->get('current_password')]))
        {
            return back();
        }

        $user = Auth::user();
        $user->password = $request->get('new_password');
        $user->save();

        return redirect()->to('admin/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }

}
