<template>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          <img :src='logo_img'>
        </div>
        <div class="card-body">
          <form v-on:submit.prevent="login">
            <div class="form-group">
              <input v-model='username' type="text" class="form-control" id="username" placeholder="Username">
            </div>
            <div class="form-group">
              <input v-model='password' type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-check">
              <input type="checkbox" v-model='remember' class="form-check-input" id="remember">
              <label class="form-check-label" for="remember">Salva per il prossimo accesso</label>
            </div>
            <button type="submit" class="btn btn-outline-info" v-show='!loading && !success'>Accedi</button>
            <loader v-show='loading'> </loader>
            <div v-show='error && !loading' class="alert alert-danger" role="alert">
              Dati errati
            </div>
            <div v-show='success && !loading' class="alert alert-success" role="alert">
              Accesso effettuato
            </div>
          </form>
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
      username: '',
      password: '',
      remember: false,
      logo_img: LOGO_IMG,
      loading: false,
      error: false,
      success: false,
    };
  },
  mounted() {},
  methods: {
    login: function() {
      this.loading = true;
      setTimeout(
        function() {
          $.ajax({
            type: 'POST',
            url: API_ENDPOINT_LOGIN,
            data: {
              username: this.username,
              password: this.password,
              remember: this.remember,
            },
            success: function(data) {
              if (data == 'ok') {
                this.error = false;
                this.success = true;
                setTimeout(function() {
                  location.reload();
                }, 1000);
              } else {
                this.success = false;
                this.error = true;
              }
            }.bind(this),
            error: function(xhr) {
              alert("Si è verificato un errore durante la richiesta all'API");
            },
            complete: function() {
              this.loading = false;
            }.bind(this),
          });
        }.bind(this),
        1500,
      );
    },
  },
};
</script>

<style lang="stylus" scoped>
.container {
  width: 460px;
}
.container img {
  width: 150px;
  max-width: 100%;
}
.card-body {
  display: flex;
  justify-content: center;
  align-items: center;
}
.card-body form * {
  margin-top: 15px;
}
.card-body form {
  text-align: center;
}
.btn {
  color: #1670b8 !important;
  border: 1px solid #1670b8 !important;
}
.card-header {
  padding: 50px;
  text-align: center;
}
</style>
