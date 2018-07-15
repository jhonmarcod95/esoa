@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">List of Logs</h4>
                    <p class="card-category">Tabular view of user's logs</p>
                </div>


                <div class="card-body table-responsive">
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

                    <table id="dataTbl" class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Event</th>
                            <th>Date & Time</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->name }}</td>
                                <td>{{ $log->event }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>
                                    @if($log->event == 'login')
                                    @else
                                        {!! Form::open(['url' => '/soa', 'method' => 'POST', 'target' => '_blank']) !!}
                                            {!! Form::hidden('soa_id', $log->soa_id) !!}
                                            {!! Form::submit('View', ['class' => 'btn btn-info btn-fill']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>


            </div>
        </div>

    </div>


@endsection