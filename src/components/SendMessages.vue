<template>
<div id="display-messages">
  <textarea></textarea>
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

textarea {
  width: 100%;
  height: auto;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
  font-size: large;
  padding: 10px;
  border-radius: 0 0 15px 0;
}

textarea:focus {
  border: 3px solid #036b58;
  color: #00805e;
}

</style>