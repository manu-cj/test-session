<template>
<div id="chatBox" ref="chatbox">
  <h3 id="messages" v-if="messagesList.length < 1">Aucun message pour le moment</h3>
  <div class="messages" v-else v-for="(messageList, index) in messagesList.reverse()" :key="index">
    <p><b><span style="color: #ffffff">{{ messageList.hours}}</span> {{ messageList.username }} :
    </b> <span style="color: #fff6f6; word-break: break-word;
    white-space: normal;">{{ messageList.text }}</span></p>
  </div>
</div>
</template>

<script>
import axios from "axios";

export default {
  name: "ChatBox",
  data() {
    return {
      messagesList : [
        {id:"",
          text:"q",
          color:"",
          username:"",
          date:"",
          hours:"",
        }
      ]
    }
  },
  methods: {
    async getMessages() {
      try {
        const response = await axios.get('http://localhost:8000/get-messages.php');
        this.messagesList = response.data
        console.log(response);
      } catch (error) {
        console.error(error);
      }
    },
    scrollToBottom() {
      // eslint-disable-next-line vue/no-async-in-computed-properties
      this.$nextTick(() => {
        const chatbox = this.$refs.chatbox;
        chatbox.scrollTop = chatbox.scrollHeight;
      });
    }
  },

  mounted() {
    this.getMessages()
    setTimeout(()=>{
      this.scrollToBottom()
    }, 100)
    setInterval(()=>{
      this.getMessages()
    }, 2500)
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
  overflow-y: scroll;
  overscroll-behavior-y: auto;
}

#chatBox::-webkit-scrollbar {
  width: 10px;
}

/* Track */
#chatBox::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}

/* Handle */
#chatBox::-webkit-scrollbar-thumb {
  background: #3bad81;
  border-radius: 10px;
}

#messages {
  margin: 10px;
}
</style>