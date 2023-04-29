<template>
  <UserName/>
</template>

<script>

import UserName from "@/components/UserName";


console.log('hello')

export default {
  name: 'App',
  components: {
    UserName


  },
  data() {
    return{
      username : ''
    }
  },

  methods: {

  }
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
</style>
