<?php

namespace App\Http\Controllers;

use App\Logs;
use App\MyClass\Format;
use Carbon\Carbon;
use Illuminate\Http\Request;


class LogController extends Controller
{
    public function show(Request $request){

        session(['header_text' => 'User Logs']);

        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $userLogs = Logs::join('users', 'logs.user_id', '=', 'users.id')
            ->whereBetween('logs.created_at', [$dateFrom, $dateTo])
            ->get([
                'name',
                'event',
                'logs.created_at'
            ]);

        $logs = [];
        foreach ($userLogs as $log){

            $events = collect( json_decode($log->event));
            $soa_id = "";

            #view soa log
            if(!empty($events['soa'])){
                $soa_id = $events['soa'];
                $events = 'view soa : ' . $events['soa'];
            }
            else{
                $events = $log->event;
            }

            $logs[] = (object)[
                'name' => $log->name,
                'event' => $events,
                'soa_id' => $soa_id,
                'created_at' => Format::toLongDateTime($log->created_at)
            ];

        }

        $logs = collect($logs)->sortByDesc('created_at');

        return view('log', compact(
            'logs'
        ));
    }
}
