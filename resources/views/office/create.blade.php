@extends('layouts.app')
@section('content')


    <div class="container">
      <main>


        <div class="row g-3">

          <div class="col-md-7 col-lg-8">
            <form method="POST"  action="{{ route('office.create') }}">
                @csrf
               <div class="row g-3">
                <div class="col-sm-6">
                  <label for="name" class="form-label">Ime</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Valid  name is required.
                  </div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Adresa</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="..." required>
                  <div class="invalid-feedback">
                    Please enter your address.
                  </div>
                </div>
                <div class="col-12">
                    <label for="phone" class="form-label">Broj telefona</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="..." required>
                    <div class="invalid-feedback">
                      Upisite broj telefona
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="fax" class="form-label">Broj faksa</label>
                    <input type="text" class="form-control" name="fax" id="fax" placeholder="..." required>
                    <div class="invalid-feedback">
                      Upisite broj faksa
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="..." required>
                    <div class="invalid-feedback">
                      Upisite email
                    </div>
                  </div>
              </div>


              {{-- <hr class="my-4">

              <h4 class="mb-3">Payment</h4>

              <div class="my-3">
                <div class="form-check">
                  <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                  <label class="form-check-label" for="credit">Credit card</label>
                </div>
                <div class="form-check">
                  <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                  <label class="form-check-label" for="debit">Debit card</label>
                </div>
                <div class="form-check">
                  <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                  <label class="form-check-label" for="paypal">PayPal</label>
                </div>
              </div>

              <div class="row gy-3">
                <div class="col-md-6">
                  <label for="cc-name" class="form-label">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="cc-number" class="form-label">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="cc-expiration" class="form-label">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="cc-cvv" class="form-label">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div> --}}

              <hr class="my-4">

              <button class="w-100 btn btn-primary btn-lg" type="submit">Kreiraj</button>
            </form>
          </div>
        </div>
      </main>


    </div>


@endsection
