<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends Controller
{
    public function show()
    {
        session(['header_text' => 'User Account']);

        return view('userprofile');
    }

    public function update(Request $request)
    {
        $password =$request->password;

        $validatedData = $request->validate([
            'password' => ['required','string','min:6','confirmed'],
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($password);
        $user->save();


        alert()->success('Account has been updated.', 'Status Message');
        return redirect('userprofile');
    }
}
