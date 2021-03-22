@extends('layouts.app')
@section('content')


    <div class="container">
      <main>


        <div class="row g-3">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-muted">Radnici</span>
                  <span class="badge bg-secondary rounded-pill">{{count($workers)}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach ($workers as $worker)
                    <form method="POST"  action="{{ route('remove.worker',$worker->id) }}">
                        @csrf
                  <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                      <h6 class="my-0">{{$worker->name}}</h6>
                      <small class="text-muted" >{{$worker->email}}</small>
                    </div>
                    <button type="submit"><span class="text-muted">UKLONI</span></button>
                  </li>
                </form>
                  @endforeach

                </ul>


              </div>
          <div class="col-md-7 col-lg-8">
            <form method="POST"  action="{{ route('office.edit') }}">
                @csrf

               <div class="row g-3">
                <div class="col-sm-6">
                  <label for="name" class="form-label">Ime</label>
                  <input type="text" class="form-control" name="name" id="name"  value="{{$office->name}}" required>
                  <div class="invalid-feedback">
                    Valid  name is required.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Adresa</label>
                  <input type="text" class="form-control" name="address" id="address"value="{{$office->address}}"  required>
                  <div class="invalid-feedback">
                    Please enter your address.
                  </div>
                </div>
                <div class="col-12">
                    <label for="phone" class="form-label">Broj telefona</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$office->phone}}" required>
                    <div class="invalid-feedback">
                      Upisite broj telefona
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="fax" class="form-label">Broj faksa</label>
                    <input type="text" class="form-control" name="fax" id="fax" value="{{$office->fax}}" required>
                    <div class="invalid-feedback">
                      Upisite broj faksa
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$office->email}}"  required>
                    <div class="invalid-feedback">
                      Upisite email
                    </div>
                  </div>
              </div>
              <hr class="my-4">
              <button class="w-100 btn btn-primary btn-lg" type="submit">Submit</button>
            </form>
          </div>
        </div>
        <hr class="my-4">
        <label class=" col-form-label"><h5>Ako izbrisete vasu kancelariju svi podatci koje ste imali u bazi ce biti trajno izgubljeni!</h5></label>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteOfficeModal" >Izbrisi kancelariju</button>

        <!-- Modal -->
  <div class="modal fade" id="deleteOfficeModal" tabindex="-1" aria-labelledby="deleteOfficeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Unesite svoju sifru da bi izbrisali kancelariju</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST"  action="{{ route('office.delete') }}">
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

    </main>


    </div>


@endsection
