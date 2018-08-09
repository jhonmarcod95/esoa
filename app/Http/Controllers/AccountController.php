<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        if(Auth::user()->isUser()){
            session(['header_text' => 'Accounts']);
            $accounts = Customer::where('email', Auth::user()->email)->get();

            return view('accounts', compact(
                'accounts'
            ));
        }
        else{
            return redirect('/log');
        }
    }

    public function switchAccount(){
        session(['account' => '']);
        return redirect('/');
    }

    public function setAccount(Request $request){
        session(['account_count' =>
            Customer::where('customer_code', $request->customer_code)
            ->where('sap_server', $request->sap_server)
            ->count()
        ]);

        session(['account' => $request->customer_code]);
        session(['account_name' => $request->customer_name]);
        session(['account_address' => $request->address]);
        session(['sap_server' => $request->sap_server]);

        return redirect('/dashboard');
    }


}
