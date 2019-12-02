@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">

                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <p style="width:200px" class="col-form-label text-md-left">{{ Auth::user()->email }}</p>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>

                            <div class="col-md-6">
                                <label for="password-confirm" class="col-form-label text-md-left">
                                    @if(Auth::user()->group === 'master')
                                        Master
                                    @elseif(Auth::user()->group === 'admin')
                                        Admin
                                    @else
                                        User
                                    @endif
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a style="margin:10px" href="{{ route('password.change') }}" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </a>
                                <a style="margin:10px" href="{{ route('email.change') }}" class="btn btn-primary">
                                    {{ __('Change Email') }}
                                </a>
                                <form  method="post" class="delete-form" action="{{ route('delete.account', Auth::user()->id) }}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button style="margin:10px" type="submit" class="btn btn-danger">Delete Account</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
