@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Users
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>


                            <th>User id</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>verified</th>
                            <th>created at</th>

                        </tr>
                    </thead>
                    <tbody>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->profile->first_name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->email_verified_at}}</td>
                            <td>{{ $user->created_at}}</td>
                    </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back to list
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
