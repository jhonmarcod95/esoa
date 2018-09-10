<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = [
        'customer_code',
        'name',
        'address',
        'email',
        'company',
        'sap_server',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
