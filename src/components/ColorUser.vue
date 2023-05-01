<template>
  <div id="colors">
    <div id="username">
      <p :style="{color : colorCookie}"><b>{{username}}</b></p>
    </div>
    <div :id="color.data" class="color-choice" v-for="color in colors" :key="color"
         :style="{backgroundColor : color.data}"
         @click="colorClick(color.data)">
    </div>
    <div id="btn-display">
      <button id="validate-button">Valider</button>
    </div>
  </div>
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

  props : ['username', 'colorCookie'],

  methods: {
    colorClick(color) {
      this.choice = color;
      document.querySelector('#' + color).style.border = 'white 2px groove';
      document.querySelector('#' + color).style.width = '22px';
      document.querySelector('#' + color).style.height = '22px';
      document.cookie = `color-name=${this.choice}; path=/`
    }
  },
  watch: {
    choice(newvalue, oldvalue) {
      console.log(oldvalue);
      console.log(newvalue)
      if (oldvalue !== 'none'){
        document.querySelector('#'+oldvalue).style.border = 'black 2px solid';
        document.querySelector('#' + oldvalue).style.width = '22px';
        document.querySelector('#' + oldvalue).style.height = '22px';
      }
    }
  },


}
</script>

<style scoped>
#colors {
  width: 94%;
  height: 35%;
  border: #00805e 5px solid;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content:center;
  align-items: center;
  box-shadow: inset 0 0 2000px #37383f;
  background-color: #37383f;
  backdrop-filter: blur(5px);
}
#username {
  width: 100%;
}

.color-choice {
  width: 22px;
  height: 22px;
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

#btn-display {
  width: 100%;
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