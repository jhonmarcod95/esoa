@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => '/users/accounts/update', 'method' => 'POST']) !!}

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" style="text-transform: uppercase" type="text" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Role</label>
                                {!! Form::select('role', $roles, $user->roles->first()->id, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>
                    </div>


                    @include('layouts.errors')
                    {{ Form::submit('Save Changes', ['class' => 'btn btn-info btn-fill']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Accounts</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => '/users/accounts/save', 'method' => 'POST']) !!}

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Account #</label>
                                <input name="customer_code" style="text-transform: uppercase" type="text" class="form-control" value="">
                            </div>
                        </div>

                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Server</label>
                                {!! Form::select('sap_server', $sapServers, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input name="name" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company</label>
                                <input type="text" class="form-control" name="company">
                            </div>
                        </div>
                    </div>

                    @include('layouts.errors')
                    {{ Form::hidden('email', $user->email) }}
                    {{ Form::submit('Add', ['class' => 'btn btn-info btn-fill']) }}
                    {!! Form::close() !!}

                    <div class="row">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Account #</th>
                                    <th>Account Name</th>
                                    <th>Address</th>
                                    <th>Company</th>
                                    <th>Server</th>
                                    <th></th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->customer_code }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->company }}</td>
                                        <td>{{ $customer->sap_server }}</td>
                                        <td>
                                            {!! Form::open(['url' => '/users/accounts/delete/' . $customer->id, 'method' => 'POST']) !!}
                                                {{ Form::submit('Remove', ['class' => 'btn btn-danger btn-fill']) }}
                                            {!! Form::close() !!}
                                        </td>
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
@endsection