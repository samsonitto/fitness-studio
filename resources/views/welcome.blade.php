@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">{{ __('Welcome') }}</div>
                            <img class="front-img" src="images\welcome.jpg" style="width:300px; margin:10px; border:1px solid gray">
                            <div class="card-body">
                                Fitness Studio v1.0 - Root folder [ / ]<br>
                                Login is not required to view this page
                            </div>
                        </div>
                    </div>

            </div>
        </div>
</div>
@endsection