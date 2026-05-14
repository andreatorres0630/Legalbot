import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import DashboardAdmin from './components/DashboardAdmin.vue';
import GestionUsuarios from './components/GestionUsuarios.vue';
import login from './components/login.vue';

const app = createApp({})

app.component('login', login)
app.component('dashboard-admin',DashboardAdmin)
app.component('gestion-usuarios', GestionUsuarios)

app.mount('#app')