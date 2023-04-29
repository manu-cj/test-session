<template>
<h1>Username</h1>

    <input type="text" v-model="username">
    <button @click="setUsername">Send</button>

  {{username}}
</template>

<script>
const axios = require('axios');



export default {

  name: "UserName",
  data() {
    return{
      username : '',
      connected : ''
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
                sessionStorage['user'] = response.data
                sessionStorage['Connected'] = 'connected'
              } else {
                alert('Please enter username & password');
              }
            })
            .catch(function (error) {
              console.log(error);
            });
      }
    },

    login: function() {
      if (this.username !== '') {

        axios.post('http://localhost:8000/login.php', {
          request: 1,
          username: this.username,

        })
            .then((response) => {
              if (response.data === this.username) {
                alert('connected')
                sessionStorage['user'] = response.data
                document.cookie = response.data
                sessionStorage['Connected'] = 'connected'
                window.location.href = "http://localhost:8080";
              } else {
                alert('Please enter username & password');
              }
            })
            .catch(function (error) {
              console.log(error);
            });
      }
    }
  }
}
</script>

<style scoped>

</style>