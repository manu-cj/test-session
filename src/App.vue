<template>
  <h1>Username</h1>
  <div v-if="!connected">
    <input type="text" v-model="username">
    <button @click="setUsername">Send</button>
  </div>
</template>

<script>
const axios = require('axios');

export default {
  name: 'App',
  components: {

  },
  data() {
    return {
      username: '',
      connected: 0
    }
  },

  methods: {
    setUsername() {
      if (this.username !== '') {
        axios.post('http://localhost:8000/login.php', {
          username: this.username,
        })
            .then((response) => {
              console.log(response.data)
              if (response.data.username === this.username) {
                alert('connected')
                document.cookie = `token=${response.data.token}; path=/`
                document.cookie = 'connected = true'
                sessionStorage['user'] = response.data.username
                sessionStorage['Connected'] = 'connected'
                this.connected = this.recupererCookie('connected')
              } else {
                alert('Please enter username & password');
              }
            })
            .catch(function (error) {
              console.log(error);
            });
      }
    },

    getConnect() {
      console.log('Check-Connect')
      axios.get('http://localhost:8000/get-user.php', {
        params: {
          username: sessionStorage['user'],
        }
      })
          .then((response) => {
            console.log(response)
              this.connected = response.data[0].etat;
              this.username = response.data[0].username;
          })
          .catch(function (error) {
            console.log(error);
          })

    },

    recupererCookie(nom) {
      nom = nom + "=";
      let liste = document.cookie.split(';');
      for (let i = 0; i < liste.length; i++) {
        let c = liste[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nom) === 0) return c.substring(nom.length, c.length);
      }
      return null;
    },
  },

  created() {
    this.getConnect();
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
h1 {
  color : #006d80;
}
</style>
