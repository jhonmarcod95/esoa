<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoaDetail extends Model
{
    protected $table = 'soa_details';

    protected $fillable = [
        'invoice_no',
        'posting_date',
        'amount',
        'current',
        'z30',
        'z60',
        'z90',
        'z120',
        'zov120',
        'customer_code',
        'company_code',
        'created_date',
        'cutoff_date',
        'classification',
        'sap_server',
    ];
}
