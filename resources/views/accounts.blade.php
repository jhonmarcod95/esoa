@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Registered Accounts</h4>
                    <p class="card-category">Please click the item below to select an account.</p>
                </div>
                <div class="card-body table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                        <th></th>
                        <th>Account #</th>
                        <th>Account Info</th>
                        <th>Address</th>
                        <th>Company Code</th>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr style="cursor: pointer;" onclick="document.getElementById('btn-{{ $account->id }}').click()">
                                <td><i class="fa fa-circle text-success"></i>
                                    {!! Form::open(['url' => '/account', 'method' => 'POST']) !!}
                                        {!! Form::hidden('customer_code', $account->customer_code) !!}
                                        {!! Form::hidden('customer_name', $account->name) !!}
                                        {!! Form::hidden('address', $account->address) !!}
                                        {!! Form::hidden('sap_server', $account->sap_server) !!}
                                        <button id="btn-{{ $account->id }}" type="submit" hidden></button>
                                    {!! Form::close() !!}
                                </td>
                                <td>{{ $account->customer_code }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->address }}</td>
                                <td>{{ $account->company }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-info-circle"></i>&nbsp; Record of {{ $accounts->count() }} Account(s)
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
