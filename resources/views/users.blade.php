@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>User Control Panel</h2></div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
                @endif

                @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
                @endif

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Registered</th>
                                <th scope="col">Group</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)

                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @if ($user->group == null)
                                        User
                                    @elseif ($user->group == 'admin')
                                        Admin
                                    @else
                                        Master
                                    @endif
                                </td>
                                
                                @if (Auth::user()->group !== null && $user->group == null || Auth::user()->group === 'master')
                                    @if ($user->status == 'BANNED')
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@unban', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-success">Unban</button>
                                    </form>
                                    </td>
                                    @else
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@ban', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-warning">Ban</button>
                                    </form>
                                    </td>
                                    @endif
                                    <td>
                                        <form method="post" class="delete-form" action="{{ action('UserController@destroy', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                @endif
                                @if (Auth::user()->group == 'master')
                                    @if($user->group == 'master' && Auth::user()->id == 1)
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@unmaster', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-danger">Unmaster</button>
                                    </form>
                                    </td>
                                    @else
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@make_master', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-success">Master</button>
                                    </form>
                                    </td>
                                    @endif

                                    @if($user->group == 'admin')
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@unadmin', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-danger">Unadmin</button>
                                    </form>
                                    </td>
                                    @else
                                    <td>
                                    <form method="post" class="edit-form" action="{{ action('UserController@make_admin', $user['id']) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="POST" />
                                        <button type="submit" class="btn btn-success">Admin</button>
                                    </form>
                                    </td>
                                    @endif
                                @else
                                    <td>
                                    </td>
                                    <td>
                                    </td>
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
<script>
    $(document).ready(function(){
        $('.delete_form').on('submit', function(){
            if(confirm("Are you sure you want to delete it?"))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    });
</script>
@endsection