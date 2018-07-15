<?php

namespace App\Http\Controllers;

use App\SoaHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        session(['header_text' => 'Accounts']);

        $classifications = SoaHeader::join('customers', 'customers.customer_code', '=', 'soa_headers.customer_code')
            ->where('customers.user_id', Auth::user()->id)
            ->get([
                '*',
                'soa_headers.id AS soa_id',
            ])
            ->sortByDesc('cutoff_date')
            ->groupBy('classification');

        return view('account', compact(
            'classifications'
        ));
    }
}
