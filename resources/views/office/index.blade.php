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

                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            {{-- </div>
        </div>
    </div> --}}
    <div class="container" style="margin-bottom: 50px">
         <ul class="nav nav-pills nav-fill">
            @if(  Auth::user()->isInOffice && !Auth::user()->office  )
             <li class="nav-item">
                <a class="nav-link " type="button"  data-toggle="modal" data-target="#exampleModal">NAPUSTI KANCELARIJU</a>
              </li>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Unesite svoju sifru da bi napustili kancelariju</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST"  action="{{ route('office.leave') }}">
            @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">


                </div>
            </div>
        </div>
        <div class="modal-footer">
           <button type="submit" class="btn btn-danger">Nastavi</button>
        </div>
    </form>
      </div>
    </div>
  </div>
              @endif
             <li class="nav-item">
              <a class="nav-link {{Auth::user()->isInOffice ? 'disabled' : ''}}"  aria-current="page" href="{{ route('show.office.create') }}">KREIRAJ KANCELARIJU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Auth::user()->isInOffice ? 'disabled' : ''}}" aria-current="page" href="{{ route('show.offices') }}">PRISTUPI ODREDJENOJ KANCELARIJI</a>
              </li>

            @if(Auth::user()->office && Auth::user()->office->user_id === Auth::user()->id)
            <li class="nav-item">
              <a class="nav-link" href="{{ route('office.workers') }}">DODAJ RADNIKE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('office.edit')}}">UREDI KACELARIJU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('office.access.requests')}}">ZAHTJEVI ZA CLANSTVO</a>
              </li>
            @endif

          </ul>
        </div>
        <hr class="my-4">

            </div>
</div>
@endsection
