<template>
  <div id="body" @mousemove="UpdateCookie">
    <div id="message-box">
      <div id="display">
        <ChatBox/>
        <div id="user-display">
          <UserList/>
          <ColorUser :username="username" :color-cookie="recupererCookie('color-name')"></ColorUser>
        </div>
      </div>
      <SendMessages v-if="connected"></SendMessages>
    </div>


    <h1>{{this.username}}</h1>
    <div v-if="!connected">
      <input type="text" v-model="username">
      <button @click="setUsername">Choisir ce nom</button>
    </div>
  </div>
  <h3 :style="{color : recupererCookie('color-name')}" v-if="seconds < 10  && minutes">{{ minutes }} :
    0{{ seconds }} </h3>
  <h3 :style="{color : recupererCookie('color-name')}" v-if="minutes < 10"> 0{{ minutes }} : {{ seconds }} </h3>
  <h3 :style="{color : recupererCookie('color-name')}" v-if="minutes < 10 && seconds <10"> 0{{ minutes }} :
    0{{ seconds }} </h3>
  <h3 :style="{color : recupererCookie('color-name')}" v-if="minutes> 9 && seconds > 9"> {{ minutes }} :
    {{ seconds }} </h3>


</template>

<script>
import ColorUser from "@/components/ColorUser";
import ChatBox from "@/components/ChatBox";
import UserList from "@/components/UserList";
import SendMessages from "@/components/SendMessages";

const axios = require('axios');

export default {
  name: 'App',
  components: {
    SendMessages,
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
      timer: 3600,
      timerStart: '',
      chrono: null
    }
  },

  // watch: {
  //   timer: {
  //     handler(value) {
  //       if (value > 0) {
  //         setTimeout(() => {
  //           this.timer--
  //         }, 1000);
  //       }
  //     },
  //     immediate: true
  //   }
  // },


  computed: {
    datefix() {
      let now = new Date();
      let time = now.getTime();
      let expireTime = time + 100 * 36000;
      now.setTime(expireTime);
      return now;
    },

    minutes() {
      return Math.floor(this.timer / 60);
    },
    seconds() {
      return this.timer % 60;
    },


  },

  methods: {
    setUsername() {
      if (this.username !== '') {
        axios.post('http://localhost:8000/login.php', {
          username: this.username,
          color: this.recupererCookie('color-name')
        }).then((response) => {
          console.log(response.data)
          if (response.data.username === this.username) {
            let now = new Date();
            let time = now.getTime();
            let expireTime = time + 100 * 36000;
            now.setTime(expireTime);
            document.cookie = `token=${response.data.token};expires=${now}; path=/`
            sessionStorage['user'] = response.data.username
            sessionStorage['Connected'] = 'connected'
            this.connected = sessionStorage['Connected']
            this.token = response.data.token
          } else {
            alert('Please enter username');
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
      let expireTime = time + 100 * 36000;
      now.setTime(expireTime);
      this.token = this.recupererCookie('token')
      this.timer = 3600
      this.startTimer()

      if (this.token !== '') {
        axios.post('http://localhost:8000/update-date.php', {
          token : this.token
        })
            .then(()=> {
              document.cookie = `token=${this.token}; expires=${now}; path=/;`;
              clearTimeout(this.chrono);
              this.chrono = setTimeout(this.expireCookie, 3600000);
            })
            .catch(function (error) {
              console.log(error);
            });


      }
    },
    startTimer() {
      clearTimeout(this.timerStart)
      this.timerStart = setInterval(() => {
        this.timer--
      }, 1000)

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


    async deleteInactifUser() {
      try {
        const response = await axios.get('http://localhost:8000/delete-inactif-user.php');
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
  },


  created() {
    this.getConnect();
    this.startTimer();
    if (!this.recupererCookie('color-name')) {
      document.cookie = `color-name=white; path=/`
    }
    this.deleteInactifUser();

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
  background-color: #0d263a;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-content: center;
  align-items: center;
}

#display {
  width: 100%;
  height: 550px;
  display: flex;
  flex-direction: row;
  align-content: center;
  justify-content: center;
  align-items: center;
}

#user-display {
  width: 16.4%;
  height: 550px;
  display: flex;
  flex-direction: column;
}

#message-box {
  width: 80%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>
