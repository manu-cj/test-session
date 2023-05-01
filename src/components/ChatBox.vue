<template>
<div id="chatBox">
  <h3 id="messages" v-if="messagesList.length < 1">Aucun message pour le moment</h3>
</div>
</template>

<script>
export default {
  name: "ChatBox",
  data() {
    return {
      messagesList : []
    }
  }
}
</script>

<style scoped>
#chatBox {
  width: 50%;
  height: 100%;
  background-color: #37383f;
  border: #00805e 5px solid;
  border-radius: 20px 0 0 0;
  color: wheat;
  text-align: start;
}

#messages {
  margin: 10px;
}
</style>