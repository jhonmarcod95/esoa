<?php

namespace App\Http\Controllers;

use App\Customer;
use App\SapServer;
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

    public function users(){
        $users = User::all();

        return view('users' ,compact(
            'users'
        ));
    }

    public function add(){
        $roles = Role::all()->pluck('name', 'id');

        return view('userAdd', compact(
            'roles'
        ));
    }

    public function edit($id)
    {
        session(['user_id' => $id]);

        $user = User::where('id', $id)->first();

        session(['email' => $user->email]);

        $roles = Role::all()->pluck('name', 'id');

        $sapServers = SapServer::all()->pluck('server', 'id');
        $customers = Customer::where('email', $user->email)->get();

        return view('userEdit', compact(
            'roles',
            'sapServers',
            'customers',
            'user'
        ));
    }

    public function save(Request $request){
        $request->validate([
            'customer_name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer_name = $request->customer_name;
        $role = $request->role;
        $email = $request->email;
        $password = $request->password;

        $user = new User();
        $user->name = $customer_name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $role = Role::where('id', $role)->first();
        $user->save();
        $user->attachRole($role);

        alert()->success('New User has been added.', 'Status Message');

        return redirect('/users');
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

    public function saveAccount(Request $request)
    {
        $request->validate([
            'customer_code' => 'required',
            'sap_server' => 'required',
            'name' => 'required',
            'address' => 'required',
            'company' => 'required',
        ]);

        Customer::create($request->all());

        alert()->success('New account has been added.', 'Status Message');
        return redirect('/users/edit/' . session('user_id'));
    }

    public function updateAccount(Request $request)
    {
        $customer_name = $request->name;
        $password =$request->password;
        $role = $request->role;
        $email = $request->email;

        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
        ]);

        $user = User::find(session('user_id'));
        $user->name = strtoupper($customer_name);
        $user->email = $email;
        #------------------ validates if user inputs a password ----------------------------
        if(!empty($password)){
            $request->validate([
                'password' => ['required','string','min:6'],
            ]);

            $user->password = bcrypt($password);
        }
        #-----------------------------------------------------------------------------------
        $user->save();
        $user->syncRoles($role);

        alert()->success('Account has been updated.', 'Status Message');
        return redirect('/users/edit/' . session('user_id'));
    }

    public function deleteAccount($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        alert()->success('Account has been deleted.', 'Status Message');
        return redirect('/users/edit/' . session('user_id'));
    }
}
