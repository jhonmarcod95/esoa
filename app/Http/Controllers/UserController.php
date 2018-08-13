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
        session(['header_text' => 'User Profile']);

        return view('userprofile');
    }

    public function update(Request $request)
    {
        $customer_name = $request->customer_name;
        $password =$request->password;

        $request->validate([
            'customer_name' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = strtoupper($customer_name);

        #------------------ validates if user inputs a password ----------------------------
        if(!empty($password)){
            $request->validate([
                'password' => ['required','string','min:6','confirmed'],
            ]);

            $user->password = bcrypt($password);
        }
        #-----------------------------------------------------------------------------------


        $user->save();


        alert()->success('Account has been updated.', 'Status Message');
        return redirect('userprofile');
    }
}
