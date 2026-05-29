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
        <a href="#" @click.prevent="navigateToInicio" class="nav-item active">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span> Inicio
        </a>
        <a href="#" @click.prevent="navigateToChatLegal" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span> Chat Legal
        </a>
        <a href="#" class="nav-item">
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

    <div class="main-wrapper">
      <header class="top-header">
        <div class="header-welcome">
          <h2 class="welcome-title">¡Hola! {{ currentUser.nombre }}.</h2>
          <p class="welcome-subtitle">¿En qué podemos ayudarte hoy?</p>
        </div>
        <div class="header-user">
          <button class="notif-btn">
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
          <h1 class="main-title">Bienvenido a LegalBot</h1>
          <p class="main-subtitle">Tu asistente de orientación legal para El Salvador. Selecciona un módulo para comenzar.</p>
        </section>

        <div class="cards-grid">
          <div class="module-card">
            <div class="module-icon bg-blue">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h3 class="module-title">Chat Legal</h3>
            <p class="module-text">Orientación legal inmediata sobre temas laborales, de tránsito y propiedad.</p>
            <button class="btn-module" @click="navigateToChatLegal">Acceder</button>
          </div>

          <div class="module-card">
            <div class="module-icon bg-purple">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h3 class="module-title">Mis Expedientes</h3>
            <p class="module-text">Gestiona y da seguimiento a tus consultas legales anteriores.</p>
            <button class="btn-module">Acceder</button>
          </div>

          <div class="module-card">
            <div class="module-icon bg-green">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            </div>
            <h3 class="module-title">Generar Documentos</h3>
            <p class="module-text">Crea formatos legales básicos listos para usar de forma automática.</p>
            <button class="btn-module">Acceder</button>
          </div>

          <div class="module-card">
            <div class="module-icon bg-orange">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M22 10c0 5.25-10 13-10 13S2 15.25 2 10a10 10 0 1 1 20 0z"/></svg>
            </div>
            <h3 class="module-title">Directorio Legal</h3>
            <p class="module-text">Encuentra instituciones y abogados cercanos según tu caso específico.</p>
            <button class="btn-module">Acceder</button>
          </div>
        </div>

        <section class="areas-section">
          <h4 class="section-label">Áreas Legales Disponibles</h4>
          <div class="areas-row">
            <div class="area-pill">
              <p class="area-name">Laboral</p>
              <p class="area-desc">Despidos, salarios, derechos</p>
            </div>
            <div class="area-pill">
              <p class="area-name">Tránsito</p>
              <p class="area-desc">Accidentes, multas, licencias</p>
            </div>
            <div class="area-pill">
              <p class="area-name">Propiedad</p>
              <p class="area-desc">Alquileres, escrituras, contratos</p>
            </div>
          </div>
        </section>

        <div class="info-box">
          <div class="info-header">
            <h5 class="info-title">Aviso Importante</h5>
          </div>
          <p class="info-text">
            LegalBot es una herramienta de orientación y prevención legal. La información proporcionada no constituye asesoría legal profesional. Para casos de alta complejidad, te recomendamos consultar con un abogado colegiado.
          </p>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const currentUser = ref({
  nombre: 'Usuario',
  apellido: '',
})

const fetchCurrentUser = async () => {
  try {
    const response = await axios.get('/auth/me')
    currentUser.value = response.data
  } catch (error) {
    console.error('Error cargando usuario actual:', error)
  }
}

const navigateToInicio = () => {
  window.location.href = '/inicio'
}

const navigateToChatLegal = () => {
  window.location.href = '/chatLegal'
}

const handleLogout = async () => {
  const confirmed = confirm('¿Estás seguro que quieres cerrar sesión?')
  
  if (!confirmed) {
    return
  }

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

/* SIDEBAR */
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

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 48px;
}

.brand-icon {
  background: white;
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.brand-name { font-weight: 700; font-size: 18px; color: #020617; }
.brand-tagline { font-size: 10px; color: #5a4b81; font-weight: 500; }

.sidebar-nav { display: flex; flex-direction: column; gap: 8px; flex: 1; }

.nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 16px;
  border-radius: 12px;
  text-decoration: none;
  color: #5a4b81;
  font-size: 14px;
  font-weight: 500;
  transition: 0.3s;
}

.nav-item:hover { background: rgba(255, 255, 255, 0.4); }

.nav-item.active {
  background-color: #020617;
  color: white;
}

.logout { margin-top: auto; color: #991b1b; cursor: pointer; }

/* MAIN WRAPPER */
.main-wrapper { margin-left: 260px; flex: 1; }

.top-header {
  height: 80px;
  background: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 40px;
  border-bottom: 1px solid #E2E8F0;
}

.welcome-title { font-size: 20px; font-weight: 700; color: #020617; }
.welcome-subtitle { font-size: 13px; color: #64748B; }

.header-user { display: flex; align-items: center; gap: 24px; }
.user-profile { display: flex; align-items: center; gap: 10px; }
.user-avatar {
  width: 38px; height: 38px;
  background: #4F7CF7;
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

/* CONTENT */
.content { padding: 40px; max-width: 1200px; margin: 0 auto; }

.hero-section { margin-bottom: 40px; }
.main-title { font-size: 32px; font-weight: 800; color: #020617; margin-bottom: 8px; }
.main-subtitle { font-size: 16px; color: #64748B; }

/* CARDS */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
  margin-bottom: 40px;
}

.module-card {
  background: white;
  border: 1px solid #E2E8F0;
  border-radius: 24px;
  padding: 32px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  transition: 0.3s;
}

.module-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }

.module-icon {
  width: 50px; height: 50px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.bg-blue { background: #EEF2FF; color: #4F7CF7; }
.bg-purple { background: #F5F3FF; color: #A855F7; }
.bg-green { background: #F0FDF4; color: #58C86B; }
.bg-orange { background: #FFF7ED; color: #F59E0B; }

.module-title { font-size: 20px; font-weight: 700; margin-bottom: 12px; color: #020617; }
.module-text { font-size: 14px; color: #64748B; line-height: 1.6; margin-bottom: 24px; }

.btn-module {
  width: 100%;
  padding: 12px;
  background: #020617;
  color: white;
  border: none;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.2s;
}

.btn-module:hover { background: #1e293b; }

/* AREAS */
.areas-section { margin-bottom: 40px; }
.section-label { font-size: 14px; font-weight: 700; color: #64748B; text-transform: uppercase; margin-bottom: 16px; }
.areas-row { display: flex; gap: 16px; }

.area-pill {
  background: white;
  border: 1px solid #E2E8F0;
  padding: 16px 24px;
  border-radius: 16px;
  flex: 1;
}

.area-name { font-weight: 700; font-size: 15px; color: #020617; }
.area-desc { font-size: 12px; color: #64748B; }

/* INFO BOX */
.info-box {
  background: #FEFCE8;
  border: 1px solid #FEF08A;
  border-radius: 16px;
  padding: 24px;
}

.info-header { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
.info-title { font-weight: 700; color: #854d0e; }
.info-text { font-size: 13px; color: #a16207; line-height: 1.6; }
</style>