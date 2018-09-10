<?php

namespace App\Http\Controllers;


use App\SoaHeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #external links ----------
        $about_us = DB::table('links')->where('id', '1')->pluck('link')->first(); //about us
        $cp = DB::table('links')->where('id', '2')->pluck('link')->first(); //copyright

        session(['about_us' => $about_us]);
        session(['copyright' => $cp]);
        #-------------------------

        if(Auth::user()->isUser()){

            session(['header_text' => 'Dashboard']);

            $soaHeaders = SoaHeader::where('customer_code', session('account'))->get();

            $soaHeaders = SoaHeader::join('customers', 'customers.customer_code', '=', 'soa_headers.customer_code')
                ->where('soa_headers.customer_code', session('account'))
                ->where('soa_headers.sap_server', session('sap_server'))
                ->where('customers.email', Auth::user()->email)
                ->get([
                    '*',
                    'soa_headers.id AS soa_id',
                ])
                ->sortByDesc('cutoff_date')
                ->take(5);


            if(count($soaHeaders)){
                $latestSoa = $soaHeaders->first();
                $latestSoaAmount = (object) SoaHeader::getStatementAmount($latestSoa);
                $sendMessage = Carbon::parse($latestSoa->cutoff_date)->diffForHumans();
            }

            return view('home', compact(
                'soaHeaders',
                'latestSoa',
                'latestSoaAmount',
                'sendMessage'
            ));
        }
        else{
            return redirect('/log');
        }
    }

}
