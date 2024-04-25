@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-lg-12" style="width:5px;height:5px">
            <div><strong>{{$subtitle}}</strong></div>
            <div>
                <a  href="{{route('user.create')}}" class="btn btn-success float-right ml-2">Add User</a>
                <a class="btn btn-danger float-right" href="{{route('user.trashed')}}"> Trashed User</a>
                <a href="{{url('admin')}}" class="btn btn-success float-left">Back</a></div></div></div>

    <div class="card">
        <div class="card-header">
            Posts list
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th width="50" >id</th>
                        <th width="150">name</th>
                        <th width="150">email</th>
                        <th width="150">email_verified_at</th>
                        <th width="150">actions</th>
                    </tr></thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr data-enty-id="{{$user->id}}"></tr>
                        <td style="text-align: center;"width="50">{{$user->id ?? ''}}</td>

                        <td style="text-align: center;"width="150">{{$user->name ?? ''}}</td>
                        <td style="text-align: center;" width="150">{{$user->email ?? ''}}</td>
                        <td style="text-align: center;" width="150">{{$user->email_verified_at ?? ''}}</td>
                        <td style="text-align: center;" width="150" >
                            <a href="{{route('user.show',$user->id)}}" class="btn btn-info ">Show</a>
                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary ">Edit</a>
                            <form method='POST' action="{{route('user.delete', $user->id)}}"
                                  style="display:inline-block;" onsubmit="return confirm('Are you sure?');">

                                @csrf
                                @method('DELETE')

                                <input type='submit' class="btn btn-danger" value="Delete">
                            </form>
                        </td></tr>
                    @endforeach
                    </tbody>

                </table>
{{--                {{$users->links()}}--}}
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
