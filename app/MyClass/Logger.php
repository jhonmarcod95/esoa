<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/13/2018
 * Time: 10:38 AM
 */

namespace App\MyClass;

use App\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class Logger
{
    public static function store($event){
        $loginLog = new Logs();
        $loginLog->user_id = Auth::user()->id;
        $loginLog->ip_address = Request::ip();
        $loginLog->event = $event;
        $loginLog->save();

    }
}
