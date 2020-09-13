<template lang='pug'>
div
 .container
  .row.justify-content-center
   .col-12
    .card.card-default
     .card-header
      a(href='/')
       img(:src='logo_img')
      .name
       b {{ agente }} - {{ agenzia }}
      .logout
       span.dotted
        a(:href='logoutUrl') Logout
     .card-body
      loader(v-show='loading')
      form
       .row.justify-content-center
        h2 Dati del cliente
        .circle-button.relative.remove(v-show='showClient' @click='toggleClient')
         i.fa.fa-angle-up
        .circle-button.relative.remove(v-show='!showClient' @click='toggleClient')
         i.fa.fa-angle-down
        .circle-button.relative.remove(v-show='offer.client && offer.client.Email && offer.client.Email.length > 0 && offer.status != "Firmata"')
         i.fa.fa-eraser(@click='cleanClient')
       .row.justify-content-center.align-items-center(v-show='(offer.status != "Firmata") && (!offer.client || !offer.client.Email) && showClient')
        .col-auto(v-show='!isNewClient')
         label
          b Inserisci la ragione sociale:
        .col-auto(v-show='!isNewClient')
         autocomplete(:url="searchClientEndpoint",  anchor="nome", label="nome", :on-select="getClient", :classes="{ input: 'form-control' }" id="autocomplete")
        .col-auto(v-show='!isNewClient')
         .btn.btn-primary(@click="newClient") Aggiungi nuovo
        .col-12(v-show='isNewClient')
         .row.align-items-center
          .col-md-3.col-6(v-for="(value, key) in offer.client").form-group
           label.bmd-label-static {{ key }}
           input.form-control(v-model='clientForm[key]' v-if='key != "Nome"')
           input.form-control(v-if='key == "Nome"' disabled v-model='clientForm[key]')
          .col-12
           .row
            .col-6
             .btn.btn-danger(@click='isNewClient = false') X
            .col-6
             .btn.btn-primary(@click='createClient()') Salva
       .row(v-show='offer.client && offer.client.Email && offer.client.Email.length > 0')
        .col-md-3.col-6(v-for="(value, key) in offer.client").form-group
         label.bmd-label-static {{ key }}
         input.form-control(disabled, v-bind:value='value')
       hr
       .row.services-title.justify-content-center(v-show='!isNewClient')
        h2 Servizi dell'offerta
       .row.services.no-padding-bottom
        .col-6(v-show="offer.services && offer.services.length > 0 && offer.status != 'Firmata'")
         a(:href='offer.pdf' target='_blank')
          .service.pdf
           i.fa.fa-file-pdf
           | Visualizza l'anteprima dell'offerta 
        .col-md-3.col-6(v-for="service in offer.services")
         .service.added
          .service-title {{ service.service_category.name }}
          .service-subtitle
           a(:href='service.url' target='_blank') {{ service.name }}
          .service-price {{ service.price }} €
          .circle-button.remove(v-show='offer.status != "Firmata"', @click="removeService(service.id)")
           i.fa.fa-trash
       .row.services(v-show='!isNewClient')
        .col-md-3.col-6(v-show="offer.status != 'Firmata'" v-for="service in offer.all_services")
         .service
          .service-title {{ service.name }}
          select.form-control(@change="selectEvent(service.id, $event)")
           option(selected='selected', disabled, hidden) Seleziona un'opzione
           option(v-for="type in service.services", :value='type.id')  {{ type.name }} - € {{ type.price }}
          .circle-button.add(@click='addService(service.id)')
           i.fa.fa-plus
       section(v-if="offer.status=='Creata'")
        hr(v-show='!isNewClient')
        .row.justify-content-center.sig
         h2 Firma l'offerta 
         .circle-button.relative.remove
          i.fa.fa-eraser(@click='cleanSig')
        .row
          vueSignature(ref="signature",:sigOption="option" style='max-width: 300px;border: 1px solid #eee; margin: 0 auto')
       hr(v-show='!isNewClient')
       .row.align-items-center(v-show='!isNewClient')
        .col-12.col-md-6
         .row.text-left
          .col-6
           b Stato: 
           | {{ offer.status }}
          .col-6
           b Servizi: 
           span(v-if='offer.services') {{ offer.services.length }}
           span(v-else) 0
          .col-6
           b Creazione: 
           | {{ offer.created_at }}
          .col-6
           b Ultima modifica: 
           | {{ offer.updated_at }}
          .col-6
           b Utente: 
           | {{ offer.username }}
          .col-6
           b Agenzia: 
           | {{ offer.agenzia }}
        .col-12.col-md-6
         .row(v-show="!completed")
          .col.col-lg-4
           a(:href='offerListUrl')
            .btn.btn-success
             i.fa.fa-backward 
          .col(v-show='offer.status == "In creazione"')
           .btn.btn-embossed(@click="updateOffer") Salva e invia l'e-mail 
          .col(v-show='offer.status == "Creata"')
           .btn.btn-embossed(@click="updateOffer") Firma e invia l'e-mail 
          .col-8(v-show='offer.status == "Firmata"')
           a(:href='offer.pdf' target='_blank')
            .btn.btn-embossed Visualizza il PDF
          .col(v-show='offer.status != "Firmata"')
           .btn.btn-danger(v-confirm="{ok: deleteOffer, message: 'Questa offerta verrà eliminata. Sei sicuro di procedere?'}") Elimina 
         .row(v-show="completed")
          .col
           .alert.alert-success.text-center Operazione completata con successo.
</template>

<script>
import Autocomplete from 'vue2-autocomplete-js';

export default {
  components: {Autocomplete},
  data() {
    return {
      clientForm: {},
      showClient: true,
      isNewClient: false,
      autocomplete: '',
      logo_img: LOGO_IMG,
      logoutUrl: URL_LOGOUT,
      offerId: [],
      loading: false,
      agente: USER,
      agenzia: USER_AGENCY,
      offerId: OFFER_ID,
      searchClientEndpoint: API_ENDPOINT_SEARCH_CLIENT,
      offerListUrl: URL_OFFER_LIST,
      offer: {},
      servicesTemp: [],
      option: {
        penColor: 'rgb(0,0,0)',
        //backgroundColor: 'rgb(245,245,245)',
      },
      completed: false,
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    toggleClient() {
      this.showClient = !this.showClient;
    },
    newClient() {
      var autocomplete = $('#autocomplete').val();
      this.clientForm['Nome'] = autocomplete;
      this.isNewClient = true;
    },
    createClient() {
      this.loading = true;
      console.log(this.clientForm);
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_ADD_CLIENT,
        data: {offerid: this.offer.id, form: this.clientForm},
        success: function(data) {
          this.getData();
          this.isNewClient = false;
        }.bind(this),
        error: function(xhr) {},
      });
    },
    cleanClient() {
      this.loading = true;
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_REMOVE_CLIENT,
        data: {offerid: this.offer.id},
        success: function(data) {
          this.getData();
        }.bind(this),
        error: function(xhr) {},
      });
    },
    deleteOffer() {
      this.loading = true;
      setTimeout(
        function() {
          $.ajax({
            type: 'DELETE',
            url: API_ENDPOINT_OFFER_REMOVE,
            data: {offerid: this.offer.id},
            success: function(data) {
              this.completed = true;
              this.loading = false;
              setTimeout(function() {
                location.replace(URL_OFFER_LIST);
              }, 1000);
            }.bind(this),
            error: function(xhr) {},
          });
        }.bind(this),
        12,
      );
    },
    updateOffer() {
      this.loading = true;
      if (this.offer.status == 'Creata') {
        this.saveSig();
      } else this.updateCall();
    },
    updateCall() {
      setTimeout(
        function() {
          $.ajax({
            type: 'POST',
            url: API_ENDPOINT_OFFER_UPDATE,
            data: {offerid: this.offer.id},
            success: function(data) {
              this.completed = true;
              this.loading = false;
              setTimeout(function() {
                location.replace(URL_OFFER_LIST);
              }, 1000);
            }.bind(this),
            error: function(xhr) {},
          });
        }.bind(this),
        10,
      );
    },
    saveSig() {
      var png = this.$refs.signature.save();
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_OFFER_SIGNATURE,
        data: {offerid: this.offer.id, signature: png},
        success: function(data) {
          this.completed = true;
          this.loading = false;
          this.updateCall();
        }.bind(this),
      });
    },
    selectEvent: function(serviceid, event) {
      this.servicesTemp[serviceid] =
        event.target.options[event.target.selectedIndex].value;
    },
    addService: function(serviceid) {
      if (!this.servicesTemp[serviceid]) {
        alert("Seleziona un' opzione prima di aggiungere il servizio");
        return;
      }
      this.loading = true;
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_OFFER_ADD_SERVICE,
        data: {service_id: this.servicesTemp[serviceid]},
        success: function(data) {
          this.getData();
        }.bind(this),
        error: function(xhr) {},
      });
    },
    doNothing() {},
    removeService: function(serviceid) {
      this.loading = true;
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_OFFER_REMOVE_SERVICE,
        data: {service_id: serviceid},
        success: function(data) {
          this.getData();
        }.bind(this),
        error: function(xhr) {},
      });
    },
    includeId: function(id) {
      return this.offer.service_ids.indexOf(id) > -1;
    },
    cleanSig: function() {
      this.$refs.signature.clear();
    },
    getClient: function(obj) {
      this.loading = true;
      $.ajax({
        type: 'POST',
        url: API_ENDPOINT_GET_CLIENT,
        data: {name: obj.nome, offerid: this.offer.id},
        success: function(data) {
          this.getData();
        }.bind(this),
        error: function(xhr) {},
      });
    },
    getData: function() {
      this.loading = true;
      setTimeout(
        function() {
          $.ajax({
            type: 'GET',
            url: API_ENDPOINT_OFFER,
            success: function(data) {
              console.log(data);
              this.offer = data.data;
            }.bind(this),
            error: function(xhr) {
              alert("Si è verificato un errore durante la richiesta all'API");
            },
            complete: function() {
              this.loading = false;
            }.bind(this),
          });
        }.bind(this),
        10,
      );
    },
  },
};
</script>

<style lang='stylus' scoped>
h2
 padding-bottom 30px
 text-transform uppercase
 opacity 0.6
hr
 margin-top 40px
 padding-bottom 40px
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
  color: var(--blue) !important;
  border: 1px solid var(--blue) !important;
}
.btn-embossed {
  color: #fff !important;
  background: var(--blue) !important;
}
.card-body {
  padding-bottom: 20px;
}
i {
  padding: 0 10px;
  cursor: pointer;
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
select
 cursor pointer
.pdf
 display flex
 align-items center
 justify-content center
 flex 1
 color var(--blue)
 font-size 1.25em
 border 1px solid var(--blue)
 box-shadow none !important
 cursor pointer
 transition all .5s ease
 i
  font-size 3em
.service
 position relative
 height 80%
.pdf:hover
 background var(--blue)
 color white
.btn-danger
 background var(--red) !important
 border none !important
 color white !important
.row 
 margin 20px 0
.service 
 display flex
 flex-direction column 
 justify-content space-between
 margin 30px 0 0 
 box-shadow 0 0 5px 5px var(--light)
 border-radius 10px
 padding 20px
.service-subtitle
 padding-bottom 10px
.service-title
 color var(--blue)
 text-transform uppercase
 font-weight bolder
 font-size 1.1em
.service-price
 font-weight bolder
 padding-top 10px
 border-top 1px solid var(--light)
input 
 padding 8px
.services-title
 margin-bottom 0
.services
 margin-top 0 
.services .col
 display flex
 flex-direction column
.circle-button
 background var(--blue)
 border-radius 50%
 color white
 width 20px
 padding 20px
 height 20px
 display flex
 justify-content center
 align-items center
 flex-grow 0 !important
 position absolute
 bottom -10px
 right -15px 
 cursor pointer
 transition all .5s ease
.circle-button:hover
 transform scale(1.3)
.circle-button.relative
 position relative
 top 0
 margin-left 20px
.circle-button.remove
 background var(--light)
.circle-button.remove i
 color var(--dark)
.service.added
 background var(--blue)
 select
  background var(--blue)
 *
  color white
 .circle-button.add
  display none
 .circle-button.remove
  display flex
.services
 padding-bottom 40px 
.no-padding-bottom
 padding-bottom 0 !important
.btn
 width 100%
.sig
 cursor pointer
.service.pdf
 background #e9f5ff
.service.pdf:hover
 background var(--blue) !important
.service.pdf *
 margin 3px
</style>
