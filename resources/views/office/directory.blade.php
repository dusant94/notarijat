@extends('layouts.app')

@section('content')
<div class="container">
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Unesi stranku-fizicko lice</a>
      <a class="nav-link " id="nav-pravno-tab" data-toggle="tab" href="#nav-pravno" role="tab" aria-controls="nav-pravno" aria-selected="false">Unesi stranku-pravno lice</a>
      <a class="nav-link" id="nav-pretraga-tab" data-toggle="tab" href="#nav-pretraga" role="tab" aria-controls="nav-pretraga" aria-selected="false">Pretrazi stranke</a>
     </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <form method="POST"  action="{{route('natural.client.store')}}">
            @csrf
        <div class="container">
            <main>


              <div class="row g-3" >

                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                      <span class="text-muted">Napomena</span>
                     </h4>
                          <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
                          <hr class="my-4">

                          <span class="text-muted">Identitet utvrdjen:</span>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_established" value="na osnovu licne karte" id="identity_established">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Na osnovu licne karte
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_established" value="na osnovu pasosa" id="identity_established"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                              Na osnovu pasosa
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_established" value="pomocu drugog notara" id="identity_established"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                              Pomocu drugog notara
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_established" value="pomocu dva svjedoka" id="identity_established"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                               Pomocu dva svjedoka
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="identity_established" value="licno poznat" id="identity_established"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                              Licno poznat
                            </label>
                          </div>
                          <hr class="my-4">
                          <span class="text-muted">Uloga:</span>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Stranka" id="role">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Stranka
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Tumac" id="role"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                              Tumac
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Svjedok" id="role"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                              Svjedok
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Prevodilac" id="role"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                               Prevodilac
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" value="Osoba od povjerenja" id="role"  >
                            <label class="form-check-label" for="flexRadioDefault2">
                               Osoba od povjerenja
                            </label>
                          </div>


                          <hr class="my-4">


                          <button type="submit" class="btn btn-primary btn-lg">Sacuvaj stranku</button>

                  </div>
                <div class="col-md-7 col-lg-8">


                     <div class="row g-3">

                      <div class="col-sm-4">
                        <label for="first_name" class="form-label">Ime</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Valid first name is required.
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="fathers_name" class="form-label">Ime oca</label>
                        <input type="text" class="form-control" id="fathers_name" name="fathers_name" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Upisite ime oca.
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="lastName" class="form-label">Prezime</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Valid last name is required.
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <label for="ordinal_number" class="form-label">Redni broj</label>
                        <input type="text" class="form-control" id="ordinal_number" name="ordinal_number" placeholder="" value=""  >

                      </div>
                      <div class="col-sm-6">
                        <label for="jmbg" class="form-label">JMBG</label>
                        <input type="text" class="form-control" id="jmbg" name="jmbg" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Required
                        </div>
                      </div>


                      <div class="col-6">
                        <label for="address" class="form-label">Mjesto</label>
                        <input type="text" class="form-control" id="place" name="place"   required>

                      </div>

                      <div class="col-6">
                        <label for="street_address" class="form-label">Ulica i broj </label>
                        <input type="text" class="form-control" id="street_address" name="street_address"  >
                      </div>

                      <div class="col-sm-3">
                        <label for="date_of_birth" class="form-label">Datum rodjenja</label>
                        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="" value="" required>

                      </div>
                      <div class="col-sm-6">
                        <label for="place_of_birth" class="form-label">Mjesto rodjenja</label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="" value="" required>

                      </div>
                      <div class="row" style="margin-left: 30px">
                        <label for="gender" class="form-label">Pol:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="{{1}}">
                            <label class="form-check-label" for="inlineRadio1">M</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender" value="{{0}}">
                            <label class="form-check-label" for="inlineRadio2">Z</label>
                          </div>
                      </div>
                      <div class="col-12">
                        <label for="profession" class="form-label">Zanimanje</label>
                        <input type="text" class="form-control" id="profession" name="profession" placeholder="" value=""  >

                      </div>
                      <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">

                      </div>
                      <div class="col-sm-4">
                        <label for="phone_no" class="form-label">Broj fiksnog</label>
                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="" value=""  >

                    </div>

                        <div class="col-sm-4">
                            <label for="mobile_no" class="form-label">Broj mobilnog</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="" value=""  >

                        </div>

                            <div class="col-sm-4">
                                <label for="fax" class="form-label">Broj faksa</label>
                                <input type="text" class="form-control" id="fax" name="fax" placeholder="" value=""  >

                            </div>




                    </div>

                    <label class="form-label">Bracno stanje:</label>

                    <div class="my-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital_status" id="marital_status" value="ozenjen/udata">
                            <label class="form-check-label" for="inlineRadio1">ozenjen/udata</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital_status" id="marital_status" value="neozenjen/neudata">
                            <label class="form-check-label" for="inlineRadio2">neozenjen/neudata</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital_status" id="marital_status" value="razveden/razvedena">
                            <label class="form-check-label" for="inlineRadio2">razveden/razvedena</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="marital_status" id="marital_status" value="udovac/udovica">
                            <label class="form-check-label" for="inlineRadio2">udovac/udovica</label>
                          </div>

                      </div>






                 </div>
              </div>
            </main>


          </div>

          <h6 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Podatci o licnoj karti</span>
           </h6>
          <div class="row g-3">
          <div class="col-md-2">
            <label for="identity_card_number" class="form-label">Broj:</label>
            <input type="text" class="form-control" id="identity_card_number" name="identity_card_number" placeholder="" required>

          </div>
          <div class="col-md-2">
            <label for="identity_card_issued" class="form-label">Datum izdavanja:</label>
            <input type="text" class="form-control" id="identity_card_issued" name="identity_card_issued" placeholder="" required>

          </div>
          <div class="col-md-2">
            <label for="identity_card_expiration" class="form-label">Vazi do:</label>
            <div class="custom-control custom-checkbox" style="float: right">
                <input class="form-check-input" type="checkbox" value="{{1}}" name="identity_card_permanently" id="identity_card_permanently">
                <label class="form-check-label" for="defaultCheck1">Trajno</label>
              </div>
            <input type="text" class="form-control" id="identity_card_expiration" name="identity_card_expiration" placeholder=""  required>
          </div>
          <div class="col-md-2">
            <label for="identity_card_issue_place" class="form-label">Izdata u:</label>
            <input type="text" class="form-control" id="identity_card_issue_place" name="identity_card_issue_place" placeholder="" required >

          </div>
        </form>
          <div class="col-md-2">

          <button class="btn btn-primary" type="button">Skeniraj licnu kartu</button>
          </div>
          </div>





         </div>



         <div class="tab-pane fade" id="nav-pravno" role="tabpanel" aria-labelledby="nav-pravno-tab">
            <form method="POST"  action="{{route('legalentities.client.store')}}">
                @csrf
            <div class="container">
                <main>


                  <div class="row g-3" >
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                          <span class="text-muted">Napomena</span>
                         </h4>
                              <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
                              <hr class="my-4">


                               <button type="submit" class="btn btn-primary btn-lg">Sacuvaj stranku</button>

                      </div>
                    <div class="col-md-7 col-lg-8">


                         <div class="row g-3">
                          <div class="col-sm-6">
                            <label for="name" class="form-label">Naziv</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
                            <div class="invalid-feedback">
                              Valid first name is required.
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <label for="registration_number" class="form-label">Registarski broj</label>
                            <input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="" value="" required>
                            <div class="invalid-feedback">
                              Valid first name is required.
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <label for="organizational_form" class="form-label">Org. oblik</label>
                            <input type="text" class="form-control" id="organizational_form" name="organizational_form" placeholder="" value="" required>
                            <div class="invalid-feedback">
                              Valid last name is required.
                            </div>
                          </div>
                          <div class="col-8">
                            <label for="court" class="form-label">Sud</label>
                            <input type="text" class="form-control" id="court" name="court"  required>
                            <div class="invalid-feedback">
                              Please enter your shipping address.
                            </div>
                          </div>
                          <div class="col-6">
                            <label for="settlement_number" class="form-label">Br. rijesenja</label>
                            <input type="text" class="form-control" id="settlement_number" name="settlement_number"  required>

                          </div>
                          <div class="col-6">
                            <label for="settlement_date" class="form-label">Datum rijesenja</label>
                            <input type="text" class="form-control" id="settlement_date" name="settlement_date"  required>

                          </div>
                          <div class="col-6">
                            <label for="jib" class="form-label">jib </label>
                            <input type="text" class="form-control" id="jib" name="jib"   required>
                          </div>  <div class="col-6">
                            <label for="pib" class="form-label">pib</label>
                            <input type="text" class="form-control" id="pib" name="pib"   required>
                          </div>

                          <div class="col-6">
                            <label for="place" class="form-label">Mjesto </label>
                            <input type="text" class="form-control" id="place" name="place" >
                          </div>

                          <div class="col-6">
                            <label for="street_address" class="form-label">Ulica i broj </label>
                            <input type="text" class="form-control" id="street_address" name="street_address"  >
                          </div>


                          <div class="col-12">
                            <label for="email" class="form-label">Email  </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">

                          </div>
                          <div class="col-sm-4">
                            <label for="phone_no" class="form-label">Broj fiksnog</label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="" value=""  >

                        </div>

                            <div class="col-sm-4">
                                <label for="mobile_no" class="form-label">Broj mobilnog</label>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="" value=""  >

                            </div>

                                <div class="col-sm-4">
                                    <label for="fax" class="form-label">Broj faksa</label>
                                    <input type="text" class="form-control" id="fax" name="fax" placeholder="" value=""  >

                                </div>




                        </div>








                     </div>
                  </div>
                </main>
                <hr class="my-4">

                <h5 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Djelatnost</span>
                   </h5>

                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="activities_key">Sifra djelatnosti</label>
                    </div>
                    <select class="custom-select" id="activities_key" name="activities_key">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                </form>
                    <button class="btn btn-primary" type="submit" style="margin-left: 10px">Nova djelatnost</button>
                    <button class="btn btn-dark" type="submit" style="margin-left: 10px">Obrisi djelatnost</button>

                  </div>



              </div>



             </div>


     <div class="tab-pane fade" id="nav-pretraga" role="tabpanel" aria-labelledby="nav-pretraga-tab">
        <clients-search></clients-search>


  </div>
</div>

</div>
  @endsection
