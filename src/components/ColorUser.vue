<template>
  <div id="colors">
    <div id="username">
      <p :style="{color : choice}"><b>{{username}}</b></p>
    </div>
    <div :id="color.data" class="color-choice" v-for="color in colors" :key="color"
         :style="{backgroundColor : color.data}"
         @click="colorClick(color.data)">
    </div>
    <button id="validate-button">Valider</button>
  </div>
  {{ choice }}
</template>

<script>
export default {
  name: "ColorUser",
  data() {
    return {
      colors: [
        {data: 'white'},
        {data: 'black'},
        {data: 'blue'},
        {data: 'red'},
        {data: 'purple'},
        {data: 'coral'},
        {data: 'green'},
        {data: 'brown'},
        {data: 'pink'},
        {data: 'teal'},
      ],
      choice: 'none',
    }
  },

  props : ['username'],

  methods: {
    colorClick(color) {
      this.choice = color;
      document.querySelector('#' + color).style.border = 'white 2px groove';
      document.querySelector('#' + color).style.width = '25px';
      document.querySelector('#' + color).style.height = '25px';
    }
  },
  watch: {
    choice(newvalue, oldvalue) {
      console.log(oldvalue);
      console.log(newvalue)
      if (oldvalue !== 'none'){
        document.querySelector('#'+oldvalue).style.border = 'black 2px solid';
        document.querySelector('#' + oldvalue).style.width = '25px';
        document.querySelector('#' + oldvalue).style.height = '25px';
      }
    }
  }
}
</script>

<style scoped>
#colors {
  width: 170px;
  height: 150px;
  padding: 15px;
  border: #00805e 5px solid;
  border-radius: 20px;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content:center;
  align-content: space-between;
  align-items: center;
  box-shadow: inset 0 0 2000px rgba(44, 53, 61, 0.93);
  background-color: rgb(5, 52, 59);
  backdrop-filter: blur(5px);
}
#username {
  width: 100%;
}

.color-choice {
  width: 25px;
  height: 25px;
  margin: 2px;
  border: 2px solid rgba(35, 35, 35, 0.94);
  border-radius: 50%;
  cursor: pointer;
  z-index: 1;
}

#validate-button {
  background-color: #00805e;
  color: white;
  border-radius: 10px;
  cursor: pointer;
}

#validate-button:hover {
  background-color: #025741;
  border-color: lightgreen;
}

.color-selected {
  width: 28px;
  height: 28px;
  margin-top: 8px;
  border: 2px solid rgba(35, 35, 35, 0.94);
  border-radius: 50%;
  cursor: pointer;
  z-index: 0;
}

</style>