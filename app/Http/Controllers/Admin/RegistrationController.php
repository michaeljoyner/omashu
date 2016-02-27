<?php namespace Omashu\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Omashu\Http\Requests\RegistrationFormRequest;
use Omashu\User;

class RegistrationController extends Controller {

    public function showRegister()
    {
        $users = User::all();
        return view('admin.registration.register')->with(compact('users'));
	}

    public function register(RegistrationFormRequest $request)
    {
        $user = User::create($request->all());
        return redirect()->to('/');
    }

    public function delete($id)
    {
//        $users = User::all();

        if(User::count() < 2) {
            return back();
        }

        $userToDelete = User::findOrFail($id);
        $userToDelete->delete();

        return redirect()->to('admin/register');
    }
}
