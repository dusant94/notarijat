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

        @if($logged->office || $logged->isInOffice)
    <div class="container" style="margin-bottom: 50px">
    <h2 style="text-align: center">Knjige</h2>
    <ul class="nav nav-pills nav-fill" style="margin-top: 40px">
        <li >
          <a class="sub-menu" aria-current="page" href="{{route('office.directory')}}"><i class="fas fa-address-book fa-5x"></i>
          <p class="menu-title">Imenik</p></a>
        </li>
        <li >
            <a class="sub-menu" aria-current="page" href="#"><i class="fas fa-folder-open fa-5x"></i>
            <p class="menu-title">Imenik raspolaganja za slucaj smrti</p></a>
          </li>
          <li >
            <a class="sub-menu" aria-current="page" href="#"><i class="fas fa-folder-plus fa-5x"></i>
            <p class="menu-title">Depozitna knjiga</p></a>
          </li>
          <li >
            <a class="sub-menu" aria-current="page" href="#"><i class="far fa-folder-open fa-5x"></i>
            <p class="menu-title">Upis povjerenih poslova</p></a>
          </li>

      </ul>
    </div>
    <hr class="my-4">

    <div class="container"  style="margin-bottom: 50px">
        <h2 style="text-align: center">Proracuni</h2>
        <ul class="nav nav-pills nav-fill" style=" margin-left: 100px;margin-top: 40px">
            <li >
                <a class="sub-menu" aria-current="page" href="{{route('calculator')}}"><i class="fas fa-calculator fa-5x"></i>
                <p class="menu-title">Kalkulator tarifa</p></a>
              </li>
              <li >
                <a class="sub-menu" aria-current="page" href="#"><i class="fas fa-flag fa-5x"></i>
                <p class="menu-title">Izvjestaji</p></a>
              </li>
              <li >
                <a class="sub-menu" aria-current="page" href="#"><i class="fab fa-buromobelexperte fa-5x"></i>
                <p class="menu-title">Modeli</p></a>
              </li>
              <li >
                <a class="sub-menu" aria-current="page" href="#"><i class="fas fa-key fa-5x"></i>
                <p class="menu-title">Sifrarnici</p></a>
              </li>
          </ul>
        </div>
        <hr class="my-4">


              @endif

</div>
@endsection
