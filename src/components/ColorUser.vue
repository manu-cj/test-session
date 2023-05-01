<template>
  <div id="colors" v-if="modif">
    <div id="close-display">
      <button id="close-button" @click="closeButton">❌</button>
    </div>
    <div id="username">
      <p v-if="choice === 'none'" :style="{color : colorCookie}"><b>{{username}}</b></p>
      <p v-if="choice !== 'none'" :style="{color : choice}"><b>{{username}}</b></p>
    </div>
    <div :id="color.data" class="color-choice" v-for="color in colors" :key="color"
         :style="{backgroundColor : color.data}"
         @click="colorClick(color.data)">
    </div>
    <div id="btn-display">
      <button id="validate-button">Valider</button>
    </div>
  </div>
  <div id="user-color" v-if="username && modif === false">
    <p>Se déconnecter</p>
    <p @click="colorDisplay">Changer la couleur</p>
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
        {data: 'cyan'},
        {data: 'red'},
        {data: 'purple'},
        {data: 'coral'},
        {data: 'green'},
        {data: 'brown'},
        {data: 'pink'},
        {data: 'teal'},
      ],
      choice: 'none',
      modif : false,
    }
  },

  props : ['username', 'colorCookie'],

  methods: {
    colorClick(color) {
      this.choice = color;
      document.querySelector('#' + color).style.border = 'white 2px groove';
      document.querySelector('#' + color).style.width = '35px';
      document.querySelector('#' + color).style.height = '35px';
      document.cookie = `color-name=${this.choice}; path=/`
    },
    colorDisplay(){
      this.modif = true
      document.querySelector('#user-color').display = 'none';
    },
    closeButton(){
      this.modif = false

    }
  },
  watch: {
    choice(newvalue, oldvalue) {
      console.log(oldvalue);
      console.log(newvalue)
      if (oldvalue !== 'none'){
        document.querySelector('#'+oldvalue).style.border = 'black 2px solid';
        document.querySelector('#' + oldvalue).style.width = '35px';
        document.querySelector('#' + oldvalue).style.height = '35px';
      }
    }
  },


}
</script>

<style scoped>
#colors {
  width: 94%;
  height: 37%;
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
  width: 35px;
  height: 35px;
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
  margin-top: 15px;
}

#validate-button:hover {
  background-color: #025741;
  border-color: lightgreen;
}

#close-display {
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: end;
  align-content: end;
}

#close-button {
  color: red;
  border: none;
  background-color: #37383f;
  cursor: pointer;
}

#user-color {
  width: 94%;
  height: 37%;
  border: #00805e 5px solid;
  border-top: 3px #00805e solid;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content:center;
  align-content: space-between;
  align-items: end;
  box-shadow: inset 0 0 2000px #37383f;
  background-color: #37383f;
  backdrop-filter: blur(5px);
}

#user-color p {
  color: #00805e;
  cursor: pointer;
  margin-bottom: 5px;
}

#btn-display {
  width: 100%;
}

</style>