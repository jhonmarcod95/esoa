@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Account</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => '/userprofile/update', 'method' => 'POST']) !!}
                        @role('user')
                        <div class="row">
                            <div class="col-md-10 pr-1">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>

                        {{--<div class="row">--}}
                            {{--<div class="col-md-10 pr-1">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Address</label>--}}
                                    {{--<textarea rows="4" cols="80" class="form-control" disabled>{{ Auth::user()->customers()->first()->address }}</textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" disabled="" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                        </div>
                        @endrole

                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password:</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        @include('layouts.errors')
                        {{ Form::submit('Update Profile', ['class' => 'btn btn-info btn-fill pull-right']) }}
                    {!! Form::close() !!}
                </div>



            </div>
        </div>
    </div>
@endsection