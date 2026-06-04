<template>
  <div class="dashboard-layout">
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
        <a href="/inicio" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span> Inicio
        </a>
        <a href="/chatLegal" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span> Chat Legal
        </a>
        <a href="/mis-expedientes" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
          </span> Expedientes
        </a>
        <a href="/documentos?view=generator" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </span> Documentos
        </a>
        <a href="/directorio" class="nav-item active">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10Z"/></svg>
          </span> Directorio
        </a>
      </nav>

      <div class="sidebar-footer">
        <button @click="handleLogout" class="nav-item logout">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </span> Cerrar sesión
        </button>
      </div>
    </aside>

    <div class="main-wrapper">
      <header class="top-header">
        <div class="header-welcome">
          <h2 class="welcome-title">Directorio Legal</h2>
          <p class="welcome-subtitle">Encuentra instituciones y tu ubicación en El Salvador.</p>
        </div>
        <div class="header-user">
          <button class="notif-btn" type="button" aria-label="Notificaciones">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          </button>
          <div class="user-profile">
            <div class="user-avatar">{{ currentUser.nombre.charAt(0) || 'U' }}</div>
            <span class="user-name">{{ currentUser.nombre }} {{ currentUser.apellido }}</span>
          </div>
        </div>
      </header>

      <main class="content">
        <section class="hero-section">
          <h3 class="section-title">Instituciones legales cercanas</h3>
          <p class="section-subtitle">Visualiza el mapa, detecta tu ubicación y localiza las sedes más próximas.</p>
        </section>

        <div class="page-card">
          <map-component />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import MapComponent from './MapComponent.vue'

const currentUser = ref({ nombre: 'Usuario', apellido: '' })

const handleLogout = async () => {
  const confirmed = confirm('¿Estás seguro que quieres cerrar sesión?')
  if (!confirmed) return

  try {
    await axios.post('/logout', {
      _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    })
    window.location.href = '/login'
  } catch (error) {
    console.error('Error al cerrar sesión:', error)
    window.location.href = '/login'
  }
}

const fetchCurrentUser = async () => {
  try {
    const response = await axios.get('/auth/me')
    currentUser.value = response.data
  } catch (error) {
    console.error('Error cargando usuario actual:', error)
  }
}

onMounted(fetchCurrentUser)
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

.dashboard-layout {
  display: flex;
  min-height: 100vh;
  background-color: #F8FAFC;
  font-family: 'Sora', sans-serif;
}

.sidebar {
  width: 260px;
  background-color: #DCD0EE;
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
.nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; text-decoration: none; color: #5a4b81; font-size: 14px; font-weight: 500; transition: 0.3s; background: transparent; border: none; cursor: pointer; }
.nav-item:hover { background: rgba(255,255,255,0.5); }
.nav-item.active { background-color: #020617; color: white; }
.nav-icon { display: flex; align-items: center; }
.sidebar-footer { margin-top: auto; }
.logout { color: #991b1b; width: 100%; text-align: left; }

.main-wrapper { margin-left: 260px; flex: 1; display: flex; flex-direction: column; overflow: hidden; }
.top-header { height: 80px; background: white; border-bottom: 1px solid #E2E8F0; padding: 0 40px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
.header-welcome { display: flex; flex-direction: column; gap: 4px; }
.welcome-title { font-size: 22px; font-weight: 700; color: #020617; }
.welcome-subtitle { font-size: 14px; color: #64748B; }
.header-user { display: flex; align-items: center; gap: 16px; }
.notif-btn { width: 40px; height: 40px; border: 1px solid #E2E8F0; border-radius: 12px; background: white; display: grid; place-items: center; cursor: pointer; }
.user-profile { display: flex; align-items: center; gap: 10px; }
.user-avatar { width: 38px; height: 38px; background: #4F7CF7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }
.user-name { font-size: 14px; font-weight: 600; color: #020617; }

.content { padding: 40px; max-width: 1200px; margin: 0 auto; }
.hero-section { margin-bottom: 32px; }
.info-pill { display: inline-flex; align-items: center; gap: 8px; background: #F5F3FF; color: #7C3AED; border-radius: 999px; padding: 8px 14px; font-size: 12px; font-weight: 700; }
.section-title { margin-top: 18px; font-size: 28px; font-weight: 800; color: #020617; }
.section-subtitle { margin-top: 10px; font-size: 15px; color: #64748B; line-height: 1.75; }

.page-card { background: white; border-radius: 28px; border: 1px solid #E2E8F0; box-shadow: 0 15px 40px rgba(15, 23, 42, 0.08); padding: 32px; }
</style>
