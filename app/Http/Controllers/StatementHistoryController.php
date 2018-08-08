<?php

namespace App\Http\Controllers;

use App\SoaHeader;
use Illuminate\Support\Facades\Auth;

class StatementHistoryController extends Controller
{
    public function show()
    {
        session(['header_text' => 'Statement History']);

        $classifications = SoaHeader::join('customers', 'customers.customer_code', '=', 'soa_headers.customer_code')
            ->where('soa_headers.customer_code', session('account'))
            ->where('soa_headers.sap_server', session('sap_server'))
            ->where('customers.email', Auth::user()->email)
            ->get([
                '*',
                'soa_headers.id AS soa_id',
            ])
            ->sortByDesc('cutoff_date')
            ->groupBy('classification');

        return view('history', compact(
            'classifications'
        ));
    }
}
