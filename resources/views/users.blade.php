@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">User Master</h4>
                    <p class="card-category">Tabular view of user's</p>
                    <div class="pull-right">
                        <a class="btn btn-info btn-fill" href="{{ url('/users/add') }}">Add New</a>

                    </div>
                </div>


                <div class="card-body table-responsive">

                    <table id="dataTbl" class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Login</th>
                            <th></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->last_login_at }}</td>
                                <td><a href="{{ url('/users/edit/' . $user->id) }}">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection