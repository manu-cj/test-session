<template>

  {{ username }}

</template>
<script>
const axios = require('axios');

export default {

  name: "UserName",
  data() {
    return {
      username: '',
      connected: false
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
              if (response.data === this.username) {
                alert('connected')
                document.cookie = 'username=' + response.data
                document.cookie = 'connected = true'
                sessionStorage['user'] = response.data
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

}
</script>

<style scoped>

</style>