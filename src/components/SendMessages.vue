<template>
<div id="display-messages">
  <form>
    <input type="text" placeholder="Envoyer un message">
    <button>⫸</button>
  </form>
</div>
</template>

<script>
export default {
  name: "SendMessages"
}
</script>

<style scoped>
#display-messages {
  width: 65%;
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
  border: 3px solid #3bad81;
  background-color: #3bad81;
  border-radius: 0 0 15px 0;
  cursor: pointer;
  box-sizing: border-box;
}

</style>