<template>
  <div class="dashboard-layout">

    <!-- ════════════════════ SIDEBAR ════════════════════ -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="brand-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#020617" stroke-width="2">
            <path d="M12 3L3 8.5V15.5L12 21L21 15.5V8.5L12 3Z"/>
          </svg>
        </div>
        <div class="brand-text">
          <p class="brand-name">LegalBot</p>
          <p class="brand-tagline">Asistente Legal Comunitario Digital</p>
        </div>
      </div>

      <nav class="sidebar-nav">
        <a href="#" @click.prevent="navigateTo('/inicio')" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span> Inicio
        </a>
        <a href="#" @click.prevent="navigateTo('/chatLegal')" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span> Chat Legal
        </a>
        <a href="/mis-expedientes" class="nav-item active">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
          </span> Expedientes
        </a>
        <a href="#" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </span> Documentos
        </a>
        <a href="#" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </span> Directorio
        </a>
      </nav>

      <div class="sidebar-footer">
        <a @click="handleLogout" class="nav-item logout">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </span> Cerrar sesión
        </a>
      </div>
    </aside>

    <!-- ════════════════════ MAIN ════════════════════ -->
    <div class="main-wrapper">

      <!-- HEADER -->
      <header class="top-header">
        <div class="header-left">
          <h2 class="page-title">Mis expedientes</h2>
          <p class="page-subtitle">Seguimiento de tus casos legales</p>
        </div>
        <div class="header-right">
          <button class="btn-nuevo" @click="crearExpediente" :disabled="creando">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            {{ creando ? 'Creando...' : 'Nuevo caso' }}
          </button>
          <div class="header-user">
            <button class="notif-btn">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </button>
            <div class="user-profile">
              <div class="user-avatar">{{ currentUser.nombre ? currentUser.nombre.charAt(0) : 'U' }}</div>
              <span class="user-name">{{ currentUser.nombre }} {{ currentUser.apellido }}</span>
            </div>
          </div>
        </div>
      </header>

      <!-- CONTENIDO -->
      <main class="content">

        <!-- TARJETAS ESTADÍSTICAS -->
        <div class="stats-grid">
          <div class="stat-card">
            <p class="stat-label">Mis casos</p>
            <p class="stat-num purple">{{ expedientes.length }}</p>
          </div>
          <div class="stat-card">
            <p class="stat-label">En seguimiento</p>
            <p class="stat-num green">{{ enSeguimiento }}</p>
          </div>
          <div class="stat-card">
            <p class="stat-label">Finalizados</p>
            <p class="stat-num gray">{{ finalizados }}</p>
          </div>
        </div>

        <!-- BÚSQUEDA -->
        <div class="search-bar-wrapper">
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input
            v-model="busqueda"
            type="text"
            class="search-input"
            placeholder="Buscar por número o descripción..."
          />
        </div>

        <!-- FILTROS -->
        <div class="filtros-row">
          <button
            v-for="f in filtros"
            :key="f.valor"
            :class="['filtro-pill', filtroActivo === f.valor ? 'activo' : '']"
            @click="filtroActivo = f.valor"
          >
            {{ f.label }}
          </button>
        </div>

        <!-- ESTADO CARGANDO -->
        <div v-if="cargando" class="estado-cargando">
          <div class="spinner"></div>
          <p>Cargando tus casos...</p>
        </div>

        <!-- ESTADO VACÍO -->
        <div v-else-if="expedientesFiltrados.length === 0 && !cargando" class="estado-vacio">
          <div class="vacio-icono">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#C4B5FD" stroke-width="1.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
          </div>
          <p class="vacio-titulo">{{ busqueda ? 'No se encontraron resultados' : 'Aún no tienes casos' }}</p>
          <p class="vacio-sub">{{ busqueda ? 'Intenta con otro término de búsqueda.' : '¿En qué podemos ayudarte hoy?' }}</p>
          <button v-if="!busqueda" class="btn-nuevo" @click="crearExpediente" :disabled="creando">
            Hacer mi primera consulta
          </button>
        </div>

        <!-- LISTA DE EXPEDIENTES -->
        <div v-else class="expedientes-lista">
          <div
            v-for="exp in expedientesFiltrados"
            :key="exp.id"
            class="exp-card"
            @click="verDetalle(exp.numero)"
          >
            <div class="exp-card-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" :stroke="iconColor(exp.estado)" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="exp-card-info">
              <span class="exp-numero">{{ exp.numero }}</span>
              <span class="exp-descripcion">{{ exp.descripcion || exp.numero }}</span>
              <div class="exp-meta">
                <span>Abierto el {{ formatFecha(exp.apertura) }}</span>
                <span class="exp-dot">·</span>
                <span>{{ tiempoRelativo(exp.apertura) }}</span>
              </div>
            </div>
            <div class="exp-card-right">
              <span :class="['badge-estado', badgeClase(exp.estado)]">{{ badgeTexto(exp.estado) }}</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
            </div>
          </div>
        </div>

      </main>
    </div>

    <!-- DETALLE (overlay completo) -->
    <detalle-expediente
      v-if="numeroSeleccionado"
      :numero="numeroSeleccionado"
      :current-user="currentUser"
      @volver="numeroSeleccionado = null"
      @actualizado="cargarExpedientes"
    />

  </div>
</template>

<script>
import axios from 'axios'
import DetalleExpediente from './DetalleExpediente.vue'

export default {
  name: 'MisExpedientes',
  components: { DetalleExpediente },

  data() {
    return {
      currentUser: { nombre: 'Usuario', apellido: '' },
      expedientes: [],
      cargando: false,
      creando: false,
      busqueda: '',
      filtroActivo: 'todos',
      numeroSeleccionado: null,
      filtros: [
        { label: 'Todos',          valor: 'todos'   },
        { label: 'En seguimiento', valor: 'abierto' },
        { label: 'Finalizado',     valor: 'cerrado' },
      ],
    }
  },

  computed: {
    enSeguimiento() {
      return this.expedientes.filter(e => ['abierto','en_proceso'].includes(e.estado)).length
    },
    finalizados() {
      return this.expedientes.filter(e => ['cerrado','resuelto'].includes(e.estado)).length
    },
    expedientesFiltrados() {
      return this.expedientes.filter(exp => {
        const texto = (exp.numero + ' ' + (exp.descripcion || '')).toLowerCase()
        const coincideBusqueda = texto.includes(this.busqueda.toLowerCase())
        const coincideFiltro =
          this.filtroActivo === 'todos' ||
          (this.filtroActivo === 'abierto' && ['abierto','en_proceso'].includes(exp.estado)) ||
          (this.filtroActivo === 'cerrado' && ['cerrado','resuelto'].includes(exp.estado))
        return coincideBusqueda && coincideFiltro
      })
    },
  },

  async mounted() {
    await this.fetchCurrentUser()
    await this.cargarExpedientes()
  },

  methods: {
    async fetchCurrentUser() {
      try {
        const res = await axios.get('/auth/me')
        this.currentUser = res.data
      } catch (e) {
        console.error('Error cargando usuario:', e)
      }
    },

    async cargarExpedientes() {
      this.cargando = true
      try {
        const res = await axios.get('/api/expedientes')
        this.expedientes = res.data
      } catch (e) {
        console.error('Error cargando expedientes:', e)
      } finally {
        this.cargando = false
      }
    },

    async crearExpediente() {
      this.creando = true
      try {
        const res = await axios.post('/api/expedientes')
        this.expedientes.unshift(res.data)
        this.numeroSeleccionado = res.data.numero
      } catch (e) {
        console.error('Error creando expediente:', e)
      } finally {
        this.creando = false
      }
    },

    verDetalle(numero) {
      this.numeroSeleccionado = numero
    },

    async handleLogout() {
      if (!confirm('¿Estás seguro que quieres cerrar sesión?')) return
      try {
        await axios.post('/logout', {
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        })
        window.location.href = '/login'
      } catch (e) {
        window.location.href = '/login'
      }
    },

    navigateTo(ruta) {
      window.location.href = ruta
    },

    formatFecha(fecha) {
      if (!fecha) return ''
      return new Date(fecha).toLocaleDateString('es-SV', { day: '2-digit', month: 'short', year: 'numeric' })
    },

    tiempoRelativo(fecha) {
      if (!fecha) return ''
      const diff = Date.now() - new Date(fecha).getTime()
      const h = Math.floor(diff / 3600000)
      const d = Math.floor(h / 24)
      if (d > 0) return `Hace ${d} día${d > 1 ? 's' : ''}`
      if (h > 0) return `Hace ${h} hora${h > 1 ? 's' : ''}`
      return 'Hace unos minutos'
    },

    badgeClase(estado) {
      return {
        abierto:    'badge-verde',
        en_proceso: 'badge-morado',
        cerrado:    'badge-gris',
        resuelto:   'badge-gris',
      }[estado] || 'badge-gris'
    },

    badgeTexto(estado) {
      return {
        abierto:    'En seguimiento',
        en_proceso: 'En seguimiento',
        cerrado:    'Finalizado',
        resuelto:   'Finalizado',
      }[estado] || estado
    },

    iconColor(estado) {
      return ['cerrado','resuelto'].includes(estado) ? '#94A3B8' : '#7C3AED'
    },
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');
* { box-sizing: border-box; margin: 0; padding: 0; }

.dashboard-layout {
  display: flex;
  min-height: 100vh;
  background: #F8FAFC;
  font-family: 'Sora', sans-serif;
}

/* ── SIDEBAR ── */
.sidebar {
  width: 260px;
  background: #DCD0EE;
  height: 100vh;
  position: fixed;
  display: flex;
  flex-direction: column;
  padding: 32px 20px;
  z-index: 100;
}
.sidebar-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 48px; }
.brand-icon { background: white; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
.brand-name { font-weight: 700; font-size: 18px; color: #020617; }
.brand-tagline { font-size: 10px; color: #5a4b81; font-weight: 500; }
.sidebar-nav { display: flex; flex-direction: column; gap: 8px; flex: 1; }
.nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; text-decoration: none; color: #5a4b81; font-size: 14px; font-weight: 500; transition: 0.3s; cursor: pointer; }
.nav-item:hover { background: rgba(255,255,255,0.4); }
.nav-item.active { background: #020617; color: white; }
.nav-icon { display: flex; align-items: center; }
.logout { color: #991b1b; }
.sidebar-footer { margin-top: auto; }

/* ── MAIN WRAPPER ── */
.main-wrapper { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* ── HEADER ── */
.top-header {
  background: white;
  border-bottom: 1px solid #E2E8F0;
  padding: 0 40px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 50;
}
.page-title { font-size: 22px; font-weight: 700; color: #020617; }
.page-subtitle { font-size: 13px; color: #64748B; margin-top: 2px; }
.header-right { display: flex; align-items: center; gap: 20px; }
.header-user { display: flex; align-items: center; gap: 16px; }
.user-profile { display: flex; align-items: center; gap: 10px; }
.user-avatar { width: 38px; height: 38px; background: #4F7CF7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; }
.user-name { font-size: 14px; font-weight: 600; color: #020617; }
.notif-btn { background: none; border: none; cursor: pointer; display: flex; align-items: center; }

.btn-nuevo {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #7C3AED;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 12px;
  font-family: 'Sora', sans-serif;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.2s;
  box-shadow: 0 4px 6px -1px rgba(124,58,237,0.2);
}
.btn-nuevo:hover:not(:disabled) { background: #6d28d9; transform: translateY(-1px); }
.btn-nuevo:disabled { opacity: 0.6; cursor: not-allowed; }

/* ── CONTENT ── */
.content { padding: 36px 40px; flex: 1; }

/* STATS */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-bottom: 28px;
}
.stat-card {
  background: white;
  border: 1px solid #E2E8F0;
  border-radius: 16px;
  padding: 24px 28px;
  box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.stat-label { font-size: 13px; color: #64748B; font-weight: 500; margin-bottom: 8px; }
.stat-num { font-size: 2.2rem; font-weight: 700; }
.stat-num.purple { color: #7C3AED; }
.stat-num.green  { color: #16A34A; }
.stat-num.gray   { color: #94A3B8; }

/* BÚSQUEDA */
.search-bar-wrapper {
  position: relative;
  margin-bottom: 16px;
}
.search-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}
.search-input {
  width: 100%;
  padding: 12px 16px 12px 44px;
  background: white;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  font-family: 'Sora', sans-serif;
  font-size: 14px;
  color: #020617;
  outline: none;
  transition: 0.2s;
}
.search-input:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,0.08); }
.search-input::placeholder { color: #94A3B8; }

/* FILTROS */
.filtros-row { display: flex; gap: 8px; margin-bottom: 24px; }
.filtro-pill {
  padding: 8px 20px;
  border-radius: 999px;
  border: 1.5px solid #E2E8F0;
  background: white;
  font-family: 'Sora', sans-serif;
  font-size: 13px;
  font-weight: 500;
  color: #64748B;
  cursor: pointer;
  transition: 0.2s;
}
.filtro-pill:hover { border-color: #7C3AED; color: #7C3AED; }
.filtro-pill.activo { background: #7C3AED; color: white; border-color: #7C3AED; font-weight: 600; }

/* ESTADOS */
.estado-cargando {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  padding: 60px;
  color: #64748B;
  font-size: 14px;
}
.spinner {
  width: 32px; height: 32px;
  border: 3px solid #E2E8F0;
  border-top-color: #7C3AED;
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.estado-vacio {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: 60px 20px;
  text-align: center;
}
.vacio-icono {
  width: 72px; height: 72px;
  background: #F5F0FF;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 8px;
}
.vacio-titulo { font-size: 18px; font-weight: 700; color: #020617; }
.vacio-sub { font-size: 14px; color: #64748B; }

/* LISTA EXPEDIENTES */
.expedientes-lista { display: flex; flex-direction: column; gap: 12px; }

.exp-card {
  background: white;
  border: 1px solid #E2E8F0;
  border-radius: 16px;
  padding: 18px 22px;
  display: flex;
  align-items: center;
  gap: 16px;
  cursor: pointer;
  transition: 0.2s;
  box-shadow: 0 1px 4px rgba(0,0,0,0.03);
}
.exp-card:hover {
  border-color: #C4B5FD;
  box-shadow: 0 4px 12px rgba(124,58,237,0.08);
  transform: translateY(-1px);
}

.exp-card-icon {
  width: 44px; height: 44px;
  background: #F5F0FF;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.exp-card-info { flex: 1; min-width: 0; }
.exp-numero { display: block; font-size: 12px; font-weight: 700; color: #7C3AED; margin-bottom: 3px; }
.exp-descripcion { display: block; font-size: 15px; font-weight: 600; color: #020617; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.exp-meta { font-size: 12px; color: #94A3B8; display: flex; align-items: center; gap: 6px; }
.exp-dot { font-size: 10px; }

.exp-card-right { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }

/* BADGES */
.badge-estado { padding: 5px 14px; border-radius: 999px; font-size: 12px; font-weight: 600; }
.badge-verde  { background: #DCFCE7; color: #16A34A; }
.badge-morado { background: #EDE9FE; color: #7C3AED; }
.badge-gris   { background: #F1F5F9; color: #64748B; }
</style>