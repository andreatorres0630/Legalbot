import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import DashboardUsuario from './components/DashboardUsuario.vue';
import AdminAbogado from './components/AdminAbogado.vue';
import DashboardAdmin from './components/DashboardAdmin.vue';
import GestionUsuarios from './components/GestionUsuarios.vue';
import ChatLegal from './components/ChatLegal.vue';
import login from './components/login.vue';
import registro from './components/registro.vue';
import MisExpediente from './components/MisExpediente.vue';
import DetalleExpediente from './components/DetalleExpediente.vue';
import Documentos from './components/Documentos.vue';

const app = createApp({})

app.component('login', login)
app.component('registro',registro)
app.component('abogados-component',AdminAbogado)
app.component('dashboard-admin',DashboardAdmin)
app.component('dashboard-usuario',DashboardUsuario)
app.component('gestion-usuarios', GestionUsuarios)
app.component('chat-legal',ChatLegal)
app.component('mis-expediente', MisExpediente)
app.component('detalle-expediente', DetalleExpediente)
app.component('documentos',Documentos)

app.mount('#app')