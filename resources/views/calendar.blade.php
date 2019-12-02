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
                        
                    @if (Auth::check())
                    <div class="40520" data-user-id="{{ Auth::user()->id }}" id="calendar"></div>
                    @else
                    <div class="haha" id="calendar"></div>
                    @endif
                    <script src="/js/app.js">
                    </script>

            </div>
        </div>
</div>
@endsection