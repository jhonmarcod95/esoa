@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <div class="card-header ">
                <h4 class="card-title">List of Logs</h4>
                <p class="card-category">Tabular view of user's logs</p>
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
                    <div class="col-md-12">
                        <div class="table table-responsive">
                            <table  class="table table-hover table-striped" style="white-space: nowrap;width:1%;">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        @foreach($dates as $date)
                                        <th>{{ $date}}</th>
                                        @endforeach
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    @foreach($user_id as $id)
                                    <tr>     
                                        <td>
                                            {{ $id->name}}<br>
                                            <small>{{ $id->email}}</small>
                                        </td>
                                        @foreach($dates as $date)
                                        <td>
                                            @foreach($logs as $log)
                                            
                                            @if(($log->user_id==$id->id)&&($log->created_at->format('Y-m-d')==$date))
                                            {{" ".$log->event." ".$log->created_at->format('h:i:s')." "}}
                                            <br>
                                            @endif
                                            
                                            @endforeach
                                        </td>
                                        @endforeach
                                        
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
