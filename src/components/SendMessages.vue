<template>
<div id="display-messages">
  <form @submit.prevent="subMessage">
    <input type="text" placeholder="Envoyer un message" v-model="message">
    <button>⫸</button>
  </form>
</div>
  <div id="is-send" v-if="isSend">Message envoyé</div>
</template>

<script>
import axios from "axios";

export default {
  name: "SendMessages",
  data(){
    return{
      message : '',
      isSend : false
    }
  },
  props: ['username'],
  methods: {
    subMessage(){
      axios.post('http://localhost:8000/add-message.php', {
        message : this.message,
        color : this.recupererCookie('color-name'),
        token : this.recupererCookie('token')
      })
          .then((response)=> {
            this.isSend = response.data
            this.message = ''
          })
          .catch(function (error) {
            console.log(error);
          });
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
#display-messages {
  width: 66%;
  height: 50px;
  border: #00805e 5px solid;
  border-radius: 0 0 20px 0;
  text-align: start;
  display: flex;
  align-content: center;
}

form {
  width: 100%;
  height: 100%;
}

form input[type=text] {
  width: 90%;
  height: 100%;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
  font-size: large;
  padding: 10px;
}

form input[type=text]:focus {
  border: 3px solid #036b58;
  color: #00805e;
}

form button {
  width: 10%;
  height: 95%;
  outline: none;
  padding: 10px;
  border: 5px solid #3bad81;
  background-color: #3bad81;
  border-radius: 0 0 15px 0;
  cursor: pointer;
  box-sizing: border-box;
}

</style>