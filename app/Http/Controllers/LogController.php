<?php

namespace App\Http\Controllers;

use App\Logs;
use App\MyClass\Format;
use Carbon\Carbon;
use App\User;
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
        
        public function log_history (Request $request){
            
            session(['header_text' => 'User Logs']);
            
            $dateFrom = $request->dateFrom;
            $dateTo = $request->dateTo;
          
            
            
          
            $user_id = User::orderBy('name','asc')->get(['id','name','email']);
       
            $userLogsa = Logs::join('users', 'logs.user_id', '=', 'users.id')
            ->whereBetween('logs.created_at', [$dateFrom, $dateTo])
            ->get([
                'user_id',
                'name',
                'event',
                'logs.created_at'
                ]);
                
                $logs = [];
                foreach ($userLogsa as $log){
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
                        'user_id' => $log->user_id,
                        'name' => $log->name,
                        'event' => $events,
                        'soa_id' => $soa_id,
                        'created_at' => $log->created_at,
                    ];
                    
                }

                $logs = collect($logs);
               

                while (strtotime($dateFrom) <= strtotime($dateTo)) {
                    $dates[]=$dateFrom;
                    $dateFrom = date ("Y-m-d", strtotime("+1 day", strtotime($dateFrom)));
                }


           
            
            
             return view('log_history', array
             (
                    'logs' => $logs,
                    'dates' => $dates,
                    'user_id' => $user_id,
                )); 
                
            }
        }
        