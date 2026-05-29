<template>
  <div class="admin-layout">


    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="brand-icon">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M12 3L3 8.5V15.5L12 21L21 15.5V8.5L12 3Z"/>
          </svg>
        </div>
        <div>
          <p class="brand-name">LegalBot</p>
          <p class="brand-sub">El Salvador</p>
        </div>
      </div>

      <nav class="sidebar-nav">
        <a href="#" class="nav-item active" @click.prevent="navigateTo('/dashboard')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
          Dashboard
        </a>
        <a href="#" class="nav-item" @click.prevent="navigateTo('/usuarios')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
          Gestión de Usuarios
        </a>
        <a href="#" class="nav-item" @click.prevent="navigateTo('/abogados')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
            <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
          </svg>
          Gestión de Abogados
        </a>
        <a href="#" class="nav-item" @click.prevent="handleFeaturePaused('Gestión de Consultas')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
          Gestión de Consultas
        </a>
        <a href="#" class="nav-item" @click.prevent="handleFeaturePaused('Gestión de Expedientes')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
          </svg>
          Gestión de Expedientes
        </a>
      </nav>

      <div class="sidebar-logout">
        <a @click="handleLogout" class="nav-item logout-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
          </svg>
          Cerrar sesión
        </a>
      </div>
    </aside>


    <main class="main-content">
      <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Bienvenido al panel administrativo de LegalBot</p>
      </div>

  
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon icon-blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-label">Total Usuarios</p>
            <p class="stat-value">{{ totalUsuarios }}</p>
          </div>
          <div class="stat-change positive">+12%</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon icon-purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-label">Total Abogados</p>
            <p class="stat-value">{{ totalAbogados }}</p>
          </div>
          <div class="stat-change positive">+2</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon icon-green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-label">Consultas activas</p>
            <p class="stat-value">{{ consultasAbogado }}</p>
          </div>
          <div class="stat-change positive">+5%</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon icon-amber">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
            </svg>
          </div>
          <div class="stat-info">
            <p class="stat-label">Expedientes</p>
            <p class="stat-value">{{ expedientes }}</p>
          </div>
          <div class="stat-change neutral">0%</div>
        </div>
      </div>

      <!-- Recent activity + quick links -->
      <div class="dashboard-grid">
        <div class="dashboard-card">
          <div class="card-header">
            <h3 class="card-title">Actividad reciente</h3>
          </div>
          <div class="activity-list">
            <div class="activity-item" v-for="item in actividadReciente" :key="item.id">
              <div :class="['activity-dot', item.tipo]"></div>
              <div class="activity-info">
                <p class="activity-text">{{ item.texto }}</p>
                <p class="activity-time">{{ item.tiempo }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="dashboard-card">
          <div class="card-header">
            <h3 class="card-title">Accesos rápidos</h3>
          </div>
          <div class="quick-links">
            <a href="#" class="quick-link" @click.prevent="navigateTo('/usuarios')">
              <div class="quick-icon icon-blue">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/>
                  <line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
              </div>
              <div>
                <p class="quick-label">Gestionar Usuarios</p>
                <p class="quick-sub">Abrir sección de usuarios</p>
              </div>
            </a>
            <a href="#" class="quick-link" @click.prevent="navigateTo('/abogados')">
              <div class="quick-icon icon-purple">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                  <line x1="12" y1="12" x2="12" y2="12"/>
                </svg>
              </div>
              <div>
                <p class="quick-label">Catálogo Abogados</p>
                <p class="quick-sub">Ver registro de abogados</p>
              </div>
            </a>
            <a href="#" class="quick-link" @click.prevent="handleFeaturePaused('Crear expediente')">
              <div class="quick-icon icon-green">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
                  <line x1="12" y1="11" x2="12" y2="17"/><line x1="9" y1="14" x2="15" y2="14"/>
                </svg>
              </div>
              <div>
                <p class="quick-label">Crear Expediente</p>
                <p class="quick-sub">Funcionalidad en pausa</p>
              </div>
            </a>
            <a href="#" class="quick-link" @click.prevent="handleFeaturePaused('Ver consultas')">
              <div class="quick-icon icon-amber">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
                  <line x1="12" y1="11" x2="12" y2="17"/><line x1="9" y1="14" x2="15" y2="14"/>
                </svg>
              </div>
              <div>
                <p class="quick-label">Ver Consultas</p>
                <p class="quick-sub">Funcionalidad en pausa</p>
              </div>
            </a>
          </div>
        </div>
      </div>

    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const totalUsuarios = ref(0)
const totalAbogados = ref(0)
const consultasAbogado = ref(0) // módulo en pausa, sin funcionalidad activa aún
const expedientes = ref(0) // módulo en pausa, sin funcionalidad activa aún

const actividadReciente = ref([])

const fetchActividadReciente = async () => {
  try {
    const response = await axios.get('/actividad-reciente')
    actividadReciente.value = response.data
  } catch (error) {
    console.error('Error cargando actividad reciente:', error)
    actividadReciente.value = [
      { id: 1, texto: 'No se pudo cargar la actividad reciente', tiempo: 'Ahora', tipo: 'red' },
    ]
  }
}

const mapCount = (responseData) => {
  if (Array.isArray(responseData)) {
    return responseData.length
  }

  const value = responseData?.count ?? responseData?.total ?? responseData
  return Number(value ?? 0)
}

const fetchDashboardData = async () => {
  try {
    const usuariosResponse = await axios.get('/usuarios/list')
    totalUsuarios.value = mapCount(usuariosResponse.data)
  } catch (error) {
    console.error('Error cargando usuarios:', error)
  }

  try {
    const abogadosResponse = await axios.get('/abogados/list')
    totalAbogados.value = mapCount(abogadosResponse.data)
  } catch (error) {
    console.error('Error cargando abogados:', error)
  }
}

const navigateTo = (path) => {
  window.location.href = path
}

const handleFeaturePaused = (feature) => {
  window.alert(`La funcionalidad \"${feature}\" está en pausa por el avance actual.`)
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

onMounted(async () => {
  await fetchDashboardData()
  await fetchActividadReciente()
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

.admin-layout {
  display: flex;
  min-height: 100vh;
  font-family: 'Sora', sans-serif;
  background: #f3f4f6;
}

.sidebar {
  width: 210px;
  min-height: 100vh;
  background: #0f172a;
  display: flex;
  flex-direction: column;
  padding: 0;
  position: fixed;
  left: 0; top: 0; bottom: 0;
  z-index: 100;
}

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 22px 20px 20px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
}

.brand-icon {
  width: 36px; height: 36px;
  background: #7c6ff7;
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.brand-name {
  font-size: 15px; font-weight: 700; color: #fff; line-height: 1.2;
}
.brand-sub {
  font-size: 11px; color: rgba(255,255,255,0.4); font-weight: 300;
}

.sidebar-nav {
  display: flex;
  flex-direction: column;
  padding: 16px 12px;
  gap: 2px;
  flex: 1;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 400;
  color: rgba(255,255,255,0.55);
  text-decoration: none;
  transition: background 0.15s, color 0.15s;
  cursor: pointer;
}

.nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
.nav-item.active { background: #7c6ff7; color: #fff; font-weight: 500; }

.sidebar-logout {
  padding: 12px;
  border-top: 1px solid rgba(255,255,255,0.07);
}

.logout-item { color: rgba(255,100,100,0.7); }
.logout-item:hover { background: rgba(255,80,80,0.1); color: rgba(255,120,120,0.9); }


.main-content {
  margin-left: 210px;
  flex: 1;
  padding: 36px 32px;
  min-height: 100vh;
}

.page-header { margin-bottom: 28px; }
.page-title { font-size: 26px; font-weight: 700; color: #111827; letter-spacing: -0.02em; }
.page-subtitle { font-size: 13px; color: #6b7280; margin-top: 4px; font-weight: 300; }


.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}

.stat-card {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 14px;
  border: 1px solid #e5e7eb;
}

.stat-icon {
  width: 44px; height: 44px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.icon-blue   { background: #eff6ff; color: #2563eb; }
.icon-purple { background: #f3f0ff; color: #7c3aed; }
.icon-green  { background: #f0fdf4; color: #16a34a; }
.icon-amber  { background: #fffbeb; color: #d97706; }

.stat-info { flex: 1; }
.stat-label { font-size: 12px; color: #6b7280; font-weight: 400; }
.stat-value { font-size: 26px; font-weight: 700; color: #111827; line-height: 1.2; letter-spacing: -0.02em; }

.stat-change {
  font-size: 12px; font-weight: 500; padding: 3px 8px; border-radius: 20px;
}
.stat-change.positive { background: #f0fdf4; color: #16a34a; }
.stat-change.neutral  { background: #f3f4f6; color: #6b7280; }


.dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.dashboard-card {
  background: #fff;
  border-radius: 12px;
  border: 1px solid #e5e7eb;
  overflow: hidden;
}

.card-header {
  padding: 18px 20px 14px;
  border-bottom: 1px solid #f3f4f6;
}

.card-title { font-size: 15px; font-weight: 600; color: #111827; }

/* Actividad */
.activity-list { padding: 8px 0; }
.activity-item {
  display: flex; align-items: flex-start; gap: 12px;
  padding: 12px 20px;
  border-bottom: 1px solid #f9fafb;
}
.activity-item:last-child { border-bottom: none; }

.activity-dot {
  width: 8px; height: 8px; border-radius: 50%; margin-top: 5px; flex-shrink: 0;
}
.activity-dot.blue   { background: #2563eb; }
.activity-dot.green  { background: #16a34a; }
.activity-dot.purple { background: #7c3aed; }
.activity-dot.amber  { background: #d97706; }
.activity-dot.red    { background: #dc2626; }

.activity-text { font-size: 13px; color: #374151; font-weight: 400; }
.activity-time { font-size: 11px; color: #9ca3af; margin-top: 2px; }


.quick-links { padding: 8px 0; }
.quick-link {
  display: flex; align-items: center; gap: 14px;
  padding: 14px 20px;
  text-decoration: none;
  border-bottom: 1px solid #f9fafb;
  transition: background 0.15s;
}
.quick-link:last-child { border-bottom: none; }
.quick-link:hover { background: #f9fafb; }

.quick-icon {
  width: 40px; height: 40px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}

.quick-label { font-size: 13px; font-weight: 500; color: #111827; }
.quick-sub   { font-size: 12px; color: #9ca3af; margin-top: 2px; }
</style>