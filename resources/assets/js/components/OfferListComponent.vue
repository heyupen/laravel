<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="card card-default">
        <div class="card-header">
          <img :src='logo_img'>
          <div class="name"> <b>{{ agente }} - {{ agenzia }} </b>
          </div>
          <div class="logout">
           <span class="dotted">
            <a :href='logoutUrl'> 
            Logout
            </a></span>
          </div>
        </div>
        <div class="card-body">
         <div class="row align-items-center">
          <div class="col">
         <form class="form-inline" v-on:submit.prevent="getData">
  <div class="form-group">
    <label class="bmd-label-floating">Cerca offerte</label>
    <input type="text" v-model="search" class="form-control">
  </div>
  <span class="form-group">
   <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
  </span>
</form>
          </div>
          <div class='col-sm-auto'>
           <div style='margin-top: 10px'>
    <a :href="createOfferUrl">
     <button type="submit" class="btn btn-embossed"><i class="fa fa-plus"></i> Aggiungi nuova offerta</button></a>
          </div>
          </div>
          </div>
         <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ragione sociale</th>
      <th scope="col">Servizi</th>
      <th scope="col">Ultima modifica</th>
      <th scope="col">Stato</th>
      <th scope="col">Azioni</th>
    </tr>
  </thead>
  <tbody v-show='!loading'>
    <tr v-for="offer in offers">
     <th scope="row"> {{ offer.id }}</th>
     <td> {{ offer.client.Nome }}</td>
     <td> {{ offer.services.length }}
     </td>
     <td> {{ offer.updated_at }} </td>
     <td> {{ offer.status }}</td>
      <td>
       <a :href='offer.link'>
       <i class="fa fa-eye" v-show="offer.status == 'Firmata'"></i>
       </a>
       <a :href='offer.link'>
       <i v-show="offer.status!='Firmata'" class="fa fa-edit"></i>
       </a>
       <!--<a :v-confirm="{ok: deleteOffer(offer.id), cancel: doNothing, message: 'Questa offerta verra\' eliminata. Sei sicuro di procedere?'}">
       <i v-show="offer.status!='Firmata'" class="fa fa-trash"></i>
       </a>
       -->
      </td>
    </tr>
  </tbody>
</table>
            <loader v-show='loading'> </loader>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      logo_img: LOGO_IMG,
      offers: [],
      loading: false,
      search: '',
      agente: USER,
      agenzia: USER_AGENCY,
      createOfferUrl: URL_OFFER_CREATE,
      logoutUrl: URL_LOGOUT,
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    doNothing: function() {
      return true;
    },
    getData: function() {
      this.loading = true;
      setTimeout(
        function() {
          $.ajax({
            type: 'GET',
            url: API_ENDPOINT_OFFERS,
            data: {search: this.search},
            success: function(data) {
              console.log(data);
              this.offers = data.data;
            }.bind(this),
            error: function(xhr) {
              alert("Si è verificato un errore durante la richiesta all'API");
            },
            complete: function() {
              this.loading = false;
            }.bind(this),
          });
        }.bind(this),
        1000,
      );
    },
  },
};
</script>

<style scoped>
.container img {
  width: 100px;
}
.card-header {
  text-align: center;
}
.card-body form {
  text-align: center;
}
.btn {
  color: #1670b8 !important;
  border: 1px solid #1670b8 !important;
}
.btn-embossed {
  color: #fff !important;
  background: #1670b8 !important;
}
.card-body {
  padding-bottom: 20px;
}
i {
  padding: 0 10px;
  cursor: pointer;
}
form * {
  flex-grow: 1 !important;
  margin: 5px;
}
.card-header div.name {
  position: absolute;
  top: 25px;
  left: 25px;
}
.card-header div.page {
  position: absolute;
  top: 25px;
  left: 25px;
}
.card-header div.logout {
  position: absolute;
  top: 25px;
  right: 25px;
}
.dotted {
  text-decoration-line: underline;
  text-decoration-style: dotted;
}
.badge-primary {
  color: white !important;
  background: #1670b8 !important;
  border: 1px solid #1670b8 !important;
}
.card-header {
  padding: 50px;
}
form {
  margin-bottom: 0;
}
</style>
