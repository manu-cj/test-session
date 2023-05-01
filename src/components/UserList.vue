<template>
  <div id="user-list-title">En ligne ({{ usersList.length }})</div>
  <div id="user-list">

    <div id="users" v-for="(userList, index) in usersList" :key="index">
      <p :style="{color : userList.color}">{{ userList.username }}</p>
    </div>
  </div>
</template>

<script>
const axios = require('axios');

export default {
  name: "UserList",
  data() {
    return {
      usersList: []

    }
  },
  methods: {
    async userListConnected() {
      try {
        const response = await axios.get('http://localhost:8000/user-list.php');
        this.usersList = response.data
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
  },

  mounted() {
    console.log(this.users)
    this.userListConnected();
    setInterval(() => {
      this.userListConnected();
    }, 60000)
  }
}
</script>

<style scoped>
#user-list {
  width: 95%;
  min-height: 60%;
  border: #00805e 5px solid;
  border-bottom: 0;
  background-color: #37383f;
  overflow-y: scroll;
  overscroll-behavior-y: auto;
}

#user-list-title {
  width: 98%;
  height: 15px;
  color: white;
  border: 1px solid #00805e;
  background-color: #00805e;
}

#user-list::-webkit-scrollbar {
  width: 10px;
}

/* Track */
#user-list::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
#user-list::-webkit-scrollbar-thumb {
  background: #3bad81;
  border-radius: 10px;
}
</style>