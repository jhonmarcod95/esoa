<?php

namespace App;

use App\MyClass\Format;
use Illuminate\Database\Eloquent\Model;

class SoaHeader extends Model
{
    protected $table = 'soa_headers';

    protected $fillable = [
        'customer_code',
        'company_code',
        'company_name',
        'company_address',
        'company_telephone',
        'company_tin',
        'created_date',
        'created_time',
        'username',
        'customer_name',
        'customer_address',
        'customer_tin',
        'customer_credit',
        'customer_credit_tin',
        'cutoff_date',
        'classification',
        'pdc_on_hand',
        'cwt_on_hand',
        'bounce_check',
        'pdc_non_trade',
        'currency',
        'soa_number',
        'pay_term_description',
        'sap_server',
    ];

    public static function getStatementAmount($soa_header)
    {
        $statement_amount = SoaDetail::where('customer_code', $soa_header->customer_code)
            ->where('company_code', $soa_header->company_code)
            ->where('cutoff_date', $soa_header->cutoff_date)
            ->where('classification', $soa_header->classification)
            ->groupBy('cutoff_date')
            ->selectRaw('
                ROUND(sum(amount) - sum(current), 2) as total_amount_past_due,
                ROUND(sum(amount), 2) as total_amount_due'
            )
            ->first();

        $statement_amount = [
            'total_amount_due' => Format::toMonetary($statement_amount->total_amount_due),
            'total_amount_past_due' => Format::toMonetary($statement_amount->total_amount_past_due)
        ];

        return $statement_amount;
    }
}
