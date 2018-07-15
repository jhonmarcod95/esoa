<?php

namespace App;

use App\MyClass\Format;
use Illuminate\Database\Eloquent\Model;

class SoaHeader extends Model
{
    protected $table = 'soa_headers';

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
