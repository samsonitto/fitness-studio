@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Booking Control Panel</h2></div>
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
                                <th scope="col">Booking ID</th>
                                <th scope="col">Class Name</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Start at</th>
                                <th scope="col">End at</th>
                                <th scope="col">Cancel</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $course)
                            @if($course->start > Carbon\Carbon::now())
                            <tr>
                                <th scope="row">{{ $course->id }}</th>
                                <td>{{ $course->class }}</td>
                                <td>{{ $course->teacher }}</td>
                                <td>{{ $course->start }}</td>
                                <td>{{ $course->end }}</td>
                                <td>
                                    <form method="post" class="edit-form" action="{{ action('ClassIsAvailableController@destroy', $course->id) }}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
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