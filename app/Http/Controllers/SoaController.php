<?php

namespace App\Http\Controllers;

use App\MyClass\GlobalClass;
use App\MyClass\Logger;
use App\SoaDetail;
use App\SoaHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class SoaController extends Controller
{
    /**
     * @return mixed
     */
    public function show(Request $request)
    {
        $request->validate([
            'soa_id' => 'required',
        ]);

        $soa_id = $request->soa_id;

        $soa_header = SoaHeader::join('sap_server', 'soa_headers.sap_server', '=', 'sap_server.id')
            ->where('soa_headers.id', $soa_id)
            ->get()
            ->first();

        $hasPtu = DB::table('ptus')->where('company', $soa_header->company_code)->get();

        $soa_details = SoaDetail::where('customer_code', $soa_header->customer_code)
            ->where('company_code', $soa_header->company_code)
            ->where('cutoff_date', $soa_header->cutoff_date)
            ->where('classification', $soa_header->classification)
            ->get();

        $company_code = $soa_header->company_code;

        $pdf = PDF::loadView('soa', compact(
            'soa_header',
            'soa_details',
            'company_code',
            'hasPtu'
        ));

        if (Auth::user()->isUser()) {
            $event = '{"soa":"' . $soa_id . '"}';
            Logger::store($event);
        }

        return $pdf->stream('document.pdf');
    }

    public function compute($id)
    {
        $soa_header = SoaHeader::where('id', $id)
            ->get()
            ->first();

        $statement_amount = SoaHeader::getStatementAmount($soa_header);

        return $statement_amount;
    }

}
