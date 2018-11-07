@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">Logs History</h4>
                <p class="card-category">Tabular view of Log's History</p>
            </div>
            
            
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <label>Date From</label>
                                {!! Form::date('dateFrom', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <label>Date To</label>
                                {!! Form::date('dateTo', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <br>
                                {!! Form::submit('Filter', ['class' => 'btn btn-info btn-fill']) !!}
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-14">
                        <div class="table table-responsive">
                            <table  class="table table-hover table-bordered" style="white-space: nowrap;width:1%;">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>User</td>
                                        @if($dateformats!=Null)
                                        @foreach($dateformats as $dateformat)
                                        <td >{{ $dateformat }}</td>
                                        @endforeach
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    @foreach($user_id as $key=> $id)
                                    <tr>  
                                        <td>
                                            {{$key+1}}
                                        </td>
                                        <td class="w-100 p-3">
                                            {{$id->name}}
                                            <br>
                                            <small>{{$id->email}}</small>
                                            
                                        </td>
                                        @if($dates!=Null)
                                        @foreach($dates as $keya => $date)
                                        <td  class="w-100 p-3">
                                          
                                            @foreach($logs as $log)
                                            @if(($log->user_id==$id->id)&&($log->created_at->format('Y-m-d')==$date))
                                            {{$log->event." at ".$log->created_at->format('h:m a')}}
                                            <br>
                                            @endif
                                            @endforeach
                                            
                                        </td>
                                        @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
        </div>
    </div>
    
</div>


@endsection
