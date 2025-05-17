import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'

import { OhVueIcon, addIcons } from "oh-vue-icons";
import { CoTrash, CoReload   } from "oh-vue-icons/icons";
addIcons(CoTrash, CoReload )

const app = createApp(App)
app.component("v-icon", OhVueIcon);
app.mount('#app')