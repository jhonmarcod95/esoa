<?php

namespace App\Http\Controllers\Api;

use App\SoaDetail;
use App\SoaHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoaController extends Controller
{
    public function saveSoa(Request $request){
        $existingIds = [];
        $addedIds = [];
        $failedIds = [];

        $soaHeaders = $request->soaHeaders;
        $soaDetails = collect($request->soaDetails);


        foreach ($soaHeaders as $soaHeader){

            /*------------- existing soa header  will not proceed to saving ---------------*/
            if(SoaHeader::where('customer_code', $soaHeader['customer_code'])
                        ->where('company_code', $soaHeader['company_code'])
                        ->where('cutoff_date', $soaHeader['cutoff_date'])
                        ->where('classification', $soaHeader['classification'])
                        ->where('sap_server', $soaHeader['sap_server'])
                        ->exists()){

                $existingIds[] = $soaHeader['id'];
            }
            /*-------------------------------------------------------------------------------*/


            else{
                /*-------------------------- save soa header---------------------------------*/
                $saveSoaHeader = SoaHeader::create($soaHeader);
                /*---------------------------------------------------------------------------*/

                /*------------- save details if header successfully saved -------------------*/
                if($saveSoaHeader){

                    foreach ($soaDetails->where('customer_code', $soaHeader['customer_code'])
                                         ->where('company_code', $soaHeader['company_code'])
                                         ->where('cutoff_date', $soaHeader['cutoff_date'])
                                         ->where('classification', $soaHeader['classification'])
                                         ->where('sap_server', $soaHeader['sap_server'])
                                         ->all() as $soaDetail){

                        SoaDetail::create($soaDetail);
                    }

                    $addedIds[] = $soaHeader['id'];
                }
                else{
                    $failedIds[] = $soaHeader['id'];
                }
                /*----------------------------------------------------------------------------*/
            }
        }


        return [
            "existing" => $existingIds,
            "added" => $addedIds,
            "failed" => $failedIds
        ];
    }

}
