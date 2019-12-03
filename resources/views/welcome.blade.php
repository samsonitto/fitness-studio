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
                        <div class="card-header">{{ __('Welcome, now you can be as jacked as me!') }}</div>
                        <div class="container-fluid">
                        <div class="row" style="padding: 10px;">    
                        <div class="column">
                                <img src="images\welcome.jpg" style="width:300px; margin:10px; border:1px solid gray; float:left">
                            </div>
                            <div class="column">
                                <img src="images\bjj.jpg" style="width:300px; margin:10px; border:1px solid gray; float:left">
                            </div>
                        </div>
</div>
                            <div class="card-body">
                                <h3>Fitness Studio v0.1</h3><br>
                                Physical fitness is a state of health and well-being and, more specifically, the ability to perform aspects of sports, occupations and daily activities. Physical fitness is generally achieved through proper nutrition, moderate-vigorous physical exercise, and sufficient rest.

Before the industrial revolution, fitness was defined as the capacity to carry out the day’s activities without undue fatigue. However, with automation and changes in lifestyles physical fitness is now considered a measure of the body's ability to function efficiently and effectively in work and leisure activities, to be healthy, to resist hypokinetic diseases, and to meet emergency situations.
                            </div>
                        </div>
                    </div>

            </div>
        </div>
</div>
@endsection