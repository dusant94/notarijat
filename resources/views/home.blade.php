@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user() && !Auth::user()->email_verified_at)
                    <div class="alert alert-success" role="alert">
                        <h3>Verify your account email address.Look for the verification email in your inbox. </h3>
                        <form method="POST"  action="{{ route('verification.send') }}">
                            @csrf
                                 <button type="submit" class="btn btn-primary btn-rounded float-right mt-4">Resend verification email</button>
                          </form>
                    </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            {{-- </div>
        </div>
    </div> --}}





<h1>SAJT ZA NOTARE</h1>
 </div>
@endsection
