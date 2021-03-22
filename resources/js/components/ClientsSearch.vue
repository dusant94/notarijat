<template>
  <div class="container">
       <h2>Odabrani klijenti</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>redni broj</th>
                <th>Ime/Naziv</th>
                 <th>Mjesto</th>
                <th>Uloga</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in selected">
                <td v-if="client.jmbg">{{client.ordinal_number}}</td>
                <td v-if="client.jib">{{client.registration_number}}</td>
                <td v-if="client.jmbg">{{client.first_name}} {{ client.last_name}}</td>
                <td v-if="client.jib">{{client.name}}</td>
                 <td>{{client.place}}</td>
                <td v-if="client.jmbg">{{client.role}}</td>
                 <td v-if="client.jib">Pravno lice</td>

              </tr>


            </tbody>
          </table>

        </div>

      <div style="margin-top:20px;text-align:center">
      <label class="radio-inline">
      <input type="radio" id="natural_people" v-model="type" value="natural_people" name="optradio"   >Fizicko lice
    </label>
    <label class="radio-inline">
      <input type="radio" id="legal_entity" v-model="type" value="legal_entity" name="optradio"  >Pravno lice
    </label>
    </div>


                <div class="input-group">
                  <input v-if="type == 'natural_people'" type="text" class="form-control" v-model="first_name" placeholder="IME">
                  <input v-if="type == 'natural_people'" type="text" class="form-control" v-model="last_name" placeholder="PREZIME">
                  <input v-if="type == 'natural_people'" type="text" class="form-control"  v-model="jmbg"placeholder="JMBG">
                   <input v-if="type == 'legal_entity'" type="text" class="form-control" v-model="name" placeholder="NAZIV">
                  <input v-if="type == 'legal_entity'" type="text" class="form-control"  v-model="jib"placeholder="JIB">
                  <input type="text" class="form-control" v-model="place" placeholder="MJESTO">



                  <div class="input-group-append">
                    <button   class="btn btn-secondary" @click="searchClients">Pretrazi</button>
                  </div>
                </div>

            <hr class="my-4">

        <h2>Rezultati pretrage</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>redni broj</th>
                <th>Ime/Naziv</th>
                 <th>Mjesto</th>
                <th>Uloga</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="client in clients">
                <td v-if="client.jmbg">{{client.ordinal_number}}</td>
                <td v-if="client.jib">{{client.registration_number}}</td>
                <td v-if="client.jmbg">{{client.first_name}} {{ client.last_name}}</td>
                <td v-if="client.jib">{{client.name}}</td>
                 <td>{{client.place}}</td>
                <td v-if="client.jmbg">{{client.role}}</td>
                 <td v-if="client.jib">Pravno lice</td>
                <button @click="AddtoList(client)">Dodaj<i class="fas fa-arrow-up"></i></button>
              </tr>


            </tbody>
          </table>

        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            type: 'natural_people',
            first_name: '',
            last_name: '',
            jmbg: '',
            place: '',
            clients: [],
            all: '',
            name: '',
            jib: '',
            selected: [],



        };
    },
    methods: {
           searchClients() {

                axios.post('/office/search/clients', {
                        type: this.type,
                        name : this.name,
                        jmbg: this.jmbg,
                        place: this.place,
                        jib: this.jib,
                        first_name: this.first_name,
                        last_name: this.last_name,

                }).then((response) => {
                          this.clients = response.data;
                        this.all = this.clients.length;

                });

        },
        AddtoList(client){
           var exists = this.selected.some(function(field) {
            return field === client
            });

            if (!exists) {
            this.selected.push(client);}
        },
    },
}
</script>

<style>

</style>
