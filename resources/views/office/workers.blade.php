@extends('layouts.app')
@section('content')


<div class="container">
    <main>


      <div class="row g-3">

        <div class="col-md-7 col-lg-8">
          <form method="POST"  action="{{ route('add.worker') }}">
              @csrf
             <div class="row g-3">
              <div class="col-sm-6">
                <label for="name" class="form-label">Ime radnika</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid  name is required.
                </div>
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email radnika</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="..." required>
                <div class="invalid-feedback">
                  Upisite email
                </div>
              </div>

            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Posalji zahtjev za pristup kancelariji</button>
          </form>
        </div>
      </div>
    </main>


  </div>


@endsection
