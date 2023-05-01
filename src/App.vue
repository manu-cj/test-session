<template>
  <div id="body" @mousemove="UpdateCookie">
    <div id="display">
      <ChatBox/>
      <div id="user-display">
        <UserList/>
        <ColorUser :username="username"></ColorUser>
      </div>
    </div>

    <h1>Username</h1>
    <div v-if="!connected">
      <input type="text" v-model="username">
      <button @click="setUsername">Send</button>
    </div>
  </div>
{{timer}}

</template>

<script>
import ColorUser from "@/components/ColorUser";
import ChatBox from "@/components/ChatBox";
import UserList from "@/components/UserList";
const axios = require('axios');

export default {
  name: 'App',
  components: {
    UserList,
    ChatBox,
    ColorUser

  },
  data() {
    return {
      username: '',
      connected: 0,
      date: '',
      token: '',
      timeInMilliseconde: 10000,
      timer : 600,
      timerStart : false,
      chrono : null
    }
  },

  watch: {
    timer: {
      handler(value) {
          if (value > 0) {
            setTimeout(()=>{
              this.timer--
            }, 1000);
          }
      },
      immediate : true
    }
  },


  computed: {
    datefix() {
      let now = new Date();
      let time = now.getTime();
      let expireTime = time + 100 * 36000;
      now.setTime(expireTime);
      return now;
    },



  },

  methods: {
    setUsername() {
      if (this.username !== '') {
        axios.post('http://localhost:8000/login.php', {
          username: this.username,
        }).then((response) => {
              console.log(response.data)
              if (response.data.username === this.username) {
                let now = new Date();
                let time = now.getTime();
                let expireTime = time +  100 * 36000;
                now.setTime(expireTime);
                document.cookie = `token=${response.data.token};expires=${now}; path=/`
                sessionStorage['user'] = response.data.username
                sessionStorage['Connected'] = 'connected'
                this.connected = sessionStorage['Connected']
                this.token = response.data.token
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

        axios.get('http://localhost:8000/get-user.php', {
          params: {
            token: this.recupererCookie('token'),
          }
        }).then((response) => {
          this.connected = response.data[0].etat;
          this.username = response.data[0].username;
          this.token = response.data[0].token;
        })
            .catch(function (error) {
              console.log(error);
            })
    },

    UpdateCookie() {
      let now = new Date();
      let time = now.getTime();
      let expireTime = time +  100 * 36000;
      now.setTime(expireTime);
      this.token = this.recupererCookie('token')

      if (this.token !== ''){
        document.cookie = `token=${this.token}; expires=${now}; path=/;`;
        this.timerStart = true
        clearTimeout(this.chrono);
        this.chrono = setTimeout(this.expireCookie, 600000);
      }

    },

    expireCookie() {
      document.cookie = `token=${this.token}; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
      location.href = 'http://localhost:8080/';
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
  color: #006d80;
}

#body {
  width: 100%;
  height: 100%;
  background-color: #12374b;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-content: center;
  align-items: center;
}

#display {
  width: 100%;
  height: 500px;
  display: flex;
  flex-direction: row;
  align-content: center;
  justify-content: center;
  align-items: center;
}

#user-display {
  height: 510px;
  display: flex;
  flex-direction: column;
}
</style>
