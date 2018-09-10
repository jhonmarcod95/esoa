@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New User</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => '/users/save', 'method' => 'POST']) !!}

                    <div class="row">
                        <div class="col-md-10 pr-1">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="customer_name" style="text-transform: uppercase" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 pr-1">
                            <div class="form-group">
                                <label>Role</label>
                                {!! Form::select('role', $roles, 2, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 pr-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>
                    </div>
                    @include('layouts.errors')
                    {{ Form::submit('Save', ['class' => 'btn btn-info btn-fill']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection