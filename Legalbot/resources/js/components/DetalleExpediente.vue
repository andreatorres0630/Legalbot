<template>
  <div class="detalle-overlay">
    <div class="detalle-wrapper">
      <aside class="sidebar">
        <div class="sidebar-brand">
          <div class="brand-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#020617" stroke-width="2"><path d="M12 3L3 8.5V15.5L12 21L21 15.5V8.5L12 3Z"/></svg>
          </div>
          <div class="brand-text">
            <p class="brand-name">LegalBot</p>
            <p class="brand-tagline">Asistente Legal Comunitario Digital</p>
          </div>
        </div>
        <nav class="sidebar-nav">
          <a href="/inicio" class="nav-item"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></span> Inicio</a>
          <a href="/chatLegal" class="nav-item"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span> Chat Legal</a>
          <a href="/mis-expedientes" class="nav-item active"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></span> Expedientes</a>
          <a href="#" class="nav-item"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span> Documentos</a>
          <a href="#" class="nav-item"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></span> Directorio</a>
        </nav>
        <div class="sidebar-footer">
          <a @click="handleLogout" class="nav-item logout"><span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span> Cerrar sesion</a>
        </div>
      </aside>

      <div class="main-wrapper">
        <header class="top-header">
          <div class="header-left">
            <button class="btn-volver" @click="$emit('volver')">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
              Mi caso
            </button>
          </div>
          <div class="header-right">
            <span v-if="expediente" :class="['badge-estado', badgeClase(expediente.estado)]">{{ badgeTexto(expediente.estado) }}</span>
            <div class="user-profile">
              <div class="user-avatar">{{ currentUser.nombre ? currentUser.nombre.charAt(0) : 'U' }}</div>
              <span class="user-name">{{ currentUser.nombre }} {{ currentUser.apellido }}</span>
            </div>
          </div>
        </header>

        <div v-if="cargando" class="estado-cargando">
          <div class="spinner"></div>
          <p>Cargando caso...</p>
        </div>

        <div v-else-if="expediente" class="content-row">
          <main class="col-principal">

            <div v-if="esCerrado" class="banner-cerrado">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Estas viendo tu historial en modo consulta. Ya no puedes agregar nuevas consultas a este caso.
            </div>

            <div class="caso-header">
              <span class="exp-numero">{{ expediente.numero }}</span>
              <h1 class="caso-titulo">{{ expediente.descripcion || expediente.numero }}</h1>
              <div class="caso-meta">
                <span>Abierto el {{ formatFecha(expediente.apertura) }}</span>
                <span class="dot">.</span>
                <span>{{ totalConsultas }} consulta{{ totalConsultas !== 1 ? 's' : '' }} registrada{{ totalConsultas !== 1 ? 's' : '' }}</span>
                <span v-if="expediente.cierre" class="dot">.</span>
                <span v-if="expediente.cierre">Cerrado el {{ formatFecha(expediente.cierre) }}</span>
              </div>
            </div>

            <div class="acciones-row">
              <button class="btn-primario" @click="continuarConsulta">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Continuar mi consulta
              </button>
              <button class="btn-borde">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Descargar mi historial
              </button>
              <button v-if="!esCerrado" class="btn-verde" @click="mostrarModal = true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                Ya resolvi mi situacion
              </button>
              <button v-else class="btn-borde" @click="abrirNuevoCaso">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Volver a necesitar ayuda
              </button>
              <button class="btn-rojo" @click="mostrarModalEliminar = true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                Eliminar Expediente
              </button>
            </div>

            <div class="chat-card">
              <p class="chat-card-titulo">Mi conversacion</p>
              <div class="chat-mensajes">
                <div v-if="historial.length === 0" class="chat-vacio">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#C4B5FD" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                  <p>Aun no hay mensajes en este expediente.</p>
                </div>
                <div v-for="(msg, i) in historialPreview" :key="i" :class="['flex-msg', msg.remitente === 'usuario' ? 'msg-usuario' : 'msg-ia']">
                  <div v-if="msg.remitente === 'usuario'" class="burbuja burbuja-usuario">
                    {{ msg.mensaje }}
                    <span class="burbuja-hora">{{ formatHora(msg.enviado_en) }}</span>
                  </div>
                  <template v-else>
                    <div class="ia-icon-wrap">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/></svg>
                    </div>
                    <div class="burbuja burbuja-ia">
                      <p class="burbuja-brand">LegalBot AI</p>
                      {{ msg.mensaje }}
                      <span class="burbuja-hora">{{ formatHora(msg.enviado_en) }}</span>
                    </div>
                  </template>
                </div>
              </div>
              <div v-if="historial.length > 0" class="chat-footer">
                <button v-if="!esCerrado" class="btn-ver-completo" @click="continuarConsulta">Ver conversacion completa</button>
                <div v-else class="chat-bloqueado">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  Chat bloqueado - expediente finalizado
                </div>
              </div>
            </div>

          </main>

          <aside class="col-derecha">
            <div class="panel-block">
              <p class="panel-titulo">Resumen del caso</p>
              <div class="stats-caso">
                <div class="stat-item">
                  <span class="stat-val">{{ totalConsultas }}</span>
                  <span class="stat-lbl">Consultas</span>
                </div>
                <div class="stat-item">
                  <span class="stat-val">{{ diasSeguimiento }}</span>
                  <span class="stat-lbl">Dias activo</span>
                </div>
                <div class="stat-item span-dos">
                  <span :class="['stat-badge', badgeClase(expediente.estado)]">{{ badgeTexto(expediente.estado) }}</span>
                  <span class="stat-lbl">Estado</span>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>

    <!-- MODAL ELIMINAR -->
    <div v-if="mostrarModalEliminar" class="modal-overlay" @click.self="mostrarModalEliminar = false">
      <div class="modal-box">
        <div class="modal-stripe-rojo"></div>
        <div class="modal-body">
          <div class="modal-icono-rojo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/></svg>
          </div>
          <h3 class="modal-titulo">Eliminar este expediente?</h3>
          <p class="modal-num-elim">{{ expediente ? expediente.numero : '' }}</p>
          <p class="modal-texto">Esta accion es permanente. Se eliminaran el expediente y todos sus datos asociados. No podras recuperarlo despues.</p>
          <div class="modal-botones">
            <button class="btn-cancelar" @click="mostrarModalEliminar = false">Cancelar</button>
            <button class="btn-eliminar-confirm" @click="eliminarExpediente" :disabled="eliminando">{{ eliminando ? 'Eliminando...' : 'Si, eliminar' }}</button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL CIERRE -->
    <div v-if="mostrarModal" class="modal-overlay" @click.self="mostrarModal = false">
      <div class="modal-box">
        <div class="modal-stripe"></div>
        <div class="modal-body">
          <div class="modal-icono">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <h3 class="modal-titulo">Ya resolviste tu situacion?</h3>
          <p class="modal-texto">Al confirmar, tu caso quedara marcado como finalizado. Podras seguir viendo tu historial cuando quieras, pero ya no podras agregar nuevas consultas.</p>
          <div class="modal-fecha-box">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Fecha de cierre: <strong>{{ fechaHoy }}</strong>
          </div>
          <div class="modal-botones">
            <button class="btn-cancelar" @click="mostrarModal = false">Todavia no</button>
            <button class="btn-confirmar" @click="cerrarExpediente" :disabled="cerrando">{{ cerrando ? 'Cerrando...' : 'Si, ya lo resolvi' }}</button>
          </div>
        </div>
      </div>
    </div>

    <!-- TOAST -->
    <div v-if="mostrarToast" class="toast-verde">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
      Tu caso fue marcado como finalizado el {{ formatFecha(expediente ? expediente.cierre : null) }}
    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'DetalleExpediente',

  props: {
    numero:      { type: String, required: true },
    currentUser: { type: Object, default: () => ({ nombre: 'Usuario', apellido: '' }) },
  },

  emits: ['volver', 'actualizado'],

  data() {
    return {
      expediente:           null,
      historial:            [],
      cargando:             false,
      cerrando:             false,
      eliminando:           false,
      mostrarModal:         false,
      mostrarModalEliminar: false,
      mostrarToast:         false,
    }
  },

  computed: {
    esCerrado() {
      return ['cerrado', 'resuelto'].includes(this.expediente ? this.expediente.estado : '')
    },
    historialPreview() {
      return this.historial.slice(-4)
    },
    totalConsultas() {
      const ids = [...new Set(this.historial.map(function(m) { return m.consulta_id }))]
      return ids.filter(Boolean).length || Math.ceil(this.historial.length / 2)
    },
    diasSeguimiento() {
      if (!this.expediente || !this.expediente.apertura) return 0
      var inicio = new Date(this.expediente.apertura)
      var fin    = this.expediente.cierre ? new Date(this.expediente.cierre) : new Date()
      return Math.max(1, Math.floor((fin - inicio) / 86400000))
    },
    fechaHoy() {
      return new Date().toLocaleDateString('es-SV', { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })
    },
  },

  mounted() {
    this.cargarDetalle()
  },

  methods: {
    async cargarDetalle() {
      this.cargando = true
      try {
        var responses = await Promise.all([
          axios.get('/api/expedientes/' + this.numero),
          axios.get('/api/expedientes/' + this.numero + '/historial'),
        ])
        this.expediente = responses[0].data
        this.historial  = Array.isArray(responses[1].data) ? responses[1].data : []
      } catch (e) {
        console.error('Error cargando detalle:', e)
      } finally {
        this.cargando = false
      }
    },

    async cerrarExpediente() {
      this.cerrando = true
      try {
        var res       = await axios.patch('/api/expedientes/' + this.numero + '/estado', { estado: 'cerrado' })
        this.expediente   = res.data
        this.mostrarModal = false
        this.mostrarToast = true
        var self = this
        setTimeout(function() { self.mostrarToast = false }, 4000)
        this.$emit('actualizado')
      } catch (e) {
        console.error('Error cerrando expediente:', e)
      } finally {
        this.cerrando = false
      }
    },

    async eliminarExpediente() {
      this.eliminando = true
      try {
        await axios.delete('/api/expedientes/' + this.numero)
        this.mostrarModalEliminar = false
        this.$emit('actualizado')
        this.$emit('volver')
      } catch (e) {
        console.error('Error eliminando expediente:', e)
      } finally {
        this.eliminando = false
      }
    },

    continuarConsulta() {
      window.location.href = '/chatLegal?expediente=' + this.numero
    },

    abrirNuevoCaso() {
      this.$emit('volver')
    },

    async handleLogout() {
      if (!confirm('Estas seguro que quieres cerrar sesion?')) return
      try {
        await axios.post('/logout', { _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') })
        window.location.href = '/login'
      } catch (e) {
        window.location.href = '/login'
      }
    },

    formatFecha(fecha) {
      if (!fecha) return ''
      return new Date(fecha).toLocaleDateString('es-SV', { day: '2-digit', month: 'short', year: 'numeric' })
    },

    formatHora(fecha) {
      if (!fecha) return ''
      return new Date(fecha).toLocaleTimeString('es-SV', { hour: '2-digit', minute: '2-digit' })
    },

    badgeClase(estado) {
      var mapa = { abierto: 'badge-verde', en_proceso: 'badge-morado', cerrado: 'badge-gris', resuelto: 'badge-gris' }
      return mapa[estado] || 'badge-gris'
    },

    badgeTexto(estado) {
      var mapa = { abierto: 'En seguimiento', en_proceso: 'En seguimiento', cerrado: 'Finalizado', resuelto: 'Finalizado' }
      return mapa[estado] || estado
    },
  },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');
* { box-sizing: border-box; margin: 0; padding: 0; }
.detalle-overlay { position: fixed; inset: 0; z-index: 200; background: #F8FAFC; font-family: 'Sora', sans-serif; }
.detalle-wrapper { display: flex; height: 100vh; overflow: hidden; }
.sidebar { width: 260px; background: #DCD0EE; height: 100vh; flex-shrink: 0; display: flex; flex-direction: column; padding: 32px 20px; }
.sidebar-brand { display: flex; align-items: center; gap: 12px; margin-bottom: 48px; }
.brand-icon { background: white; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
.brand-name { font-weight: 700; font-size: 18px; color: #020617; }
.brand-tagline { font-size: 10px; color: #5a4b81; font-weight: 500; }
.sidebar-nav { display: flex; flex-direction: column; gap: 8px; flex: 1; }
.nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; text-decoration: none; color: #5a4b81; font-size: 14px; font-weight: 500; transition: 0.3s; cursor: pointer; }
.nav-item:hover { background: rgba(255,255,255,0.4); }
.nav-item.active { background: #020617; color: white; }
.nav-icon { display: flex; align-items: center; }
.sidebar-footer { margin-top: auto; }
.logout { color: #991b1b; }
.main-wrapper { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
.top-header { height: 80px; background: white; border-bottom: 1px solid #E2E8F0; padding: 0 40px; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
.header-left { display: flex; align-items: center; }
.header-right { display: flex; align-items: center; gap: 16px; }
.user-profile { display: flex; align-items: center; gap: 10px; }
.user-avatar { width: 38px; height: 38px; background: #4F7CF7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; }
.user-name { font-size: 14px; font-weight: 600; color: #020617; }
.btn-volver { display: flex; align-items: center; gap: 6px; background: none; border: none; font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 600; color: #7C3AED; cursor: pointer; padding: 6px 10px; border-radius: 8px; transition: 0.2s; }
.btn-volver:hover { background: #F5F0FF; }
.content-row { display: flex; flex: 1; overflow-y: auto; }
.col-principal { flex: 1; padding: 36px 40px; display: flex; flex-direction: column; gap: 24px; min-width: 0; overflow-y: auto; }
.banner-cerrado { display: flex; align-items: center; gap: 10px; background: #EFF6FF; border: 1px solid #BFDBFE; color: #1d4ed8; padding: 14px 18px; border-radius: 12px; font-size: 13px; font-weight: 500; }
.exp-numero { font-size: 13px; font-weight: 700; color: #7C3AED; display: block; margin-bottom: 6px; }
.caso-titulo { font-size: 26px; font-weight: 700; color: #020617; margin-bottom: 8px; }
.caso-meta { font-size: 13px; color: #64748B; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.dot { color: #CBD5E1; }
.acciones-row { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-primario { display: flex; align-items: center; gap: 8px; background: #7C3AED; color: white; border: none; padding: 11px 20px; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px -1px rgba(124,58,237,0.2); }
.btn-primario:hover { background: #6d28d9; }
.btn-borde { display: flex; align-items: center; gap: 8px; background: white; color: #334155; border: 1.5px solid #E2E8F0; padding: 11px 20px; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-borde:hover { border-color: #7C3AED; color: #7C3AED; }
.btn-verde { display: flex; align-items: center; gap: 8px; background: #F0FDF4; color: #16A34A; border: 1.5px solid #BBF7D0; padding: 11px 20px; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-verde:hover { background: #DCFCE7; }
.btn-rojo { display: flex; align-items: center; gap: 8px; background: #FEF2F2; color: #DC2626; border: 1.5px solid #FECACA; padding: 11px 20px; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-rojo:hover { background: #FEE2E2; border-color: #FCA5A5; }
.chat-card { background: white; border: 1px solid #E2E8F0; border-radius: 20px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
.chat-card-titulo { font-size: 15px; font-weight: 700; color: #020617; margin-bottom: 20px; }
.chat-mensajes { display: flex; flex-direction: column; gap: 14px; }
.chat-vacio { display: flex; flex-direction: column; align-items: center; gap: 8px; padding: 32px; color: #94A3B8; font-size: 13px; text-align: center; }
.flex-msg { display: flex; gap: 10px; }
.msg-usuario { justify-content: flex-end; }
.msg-ia { align-items: flex-start; }
.burbuja { padding: 12px 16px; border-radius: 16px; font-size: 14px; line-height: 1.5; max-width: 75%; position: relative; }
.burbuja-usuario { background: #020617; color: #F8FAFC; border-bottom-right-radius: 4px; }
.burbuja-ia { background: #F8FAFC; border: 1px solid #E2E8F0; color: #334155; border-top-left-radius: 4px; }
.burbuja-brand { font-size: 12px; font-weight: 700; color: #7C3AED; margin-bottom: 4px; }
.burbuja-hora { display: block; font-size: 11px; color: #94A3B8; margin-top: 6px; }
.ia-icon-wrap { width: 30px; height: 30px; flex-shrink: 0; background: #F5F0FF; border: 1px solid #DDD6FE; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
.chat-footer { margin-top: 16px; }
.btn-ver-completo { width: 100%; padding: 12px; background: #7C3AED; color: white; border: none; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-ver-completo:hover { background: #6d28d9; }
.chat-bloqueado { display: flex; align-items: center; justify-content: center; gap: 8px; background: #F8FAFC; border: 1px dashed #E2E8F0; border-radius: 12px; padding: 14px; font-size: 13px; color: #94A3B8; }
.col-derecha { width: 300px; flex-shrink: 0; background: white; border-left: 1px solid #E2E8F0; padding: 36px 24px; display: flex; flex-direction: column; gap: 28px; overflow-y: auto; }
.panel-titulo { font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 14px; }
.stats-caso { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.stat-item { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px; display: flex; flex-direction: column; align-items: center; gap: 4px; }
.span-dos { grid-column: span 2; }
.stat-val { font-size: 1.6rem; font-weight: 700; color: #7C3AED; }
.stat-lbl { font-size: 11px; color: #64748B; font-weight: 500; }
.stat-badge { padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; }
.badge-estado { padding: 6px 16px; border-radius: 999px; font-size: 13px; font-weight: 600; }
.badge-verde  { background: #DCFCE7; color: #16A34A; }
.badge-morado { background: #EDE9FE; color: #7C3AED; }
.badge-gris   { background: #F1F5F9; color: #64748B; }
.estado-cargando { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; color: #64748B; font-size: 14px; }
.spinner { width: 32px; height: 32px; border: 3px solid #E2E8F0; border-top-color: #7C3AED; border-radius: 50%; animation: spin 0.7s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.modal-overlay { position: fixed; inset: 0; z-index: 500; background: rgba(2,6,23,0.55); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; }
.modal-box { background: white; border-radius: 24px; width: 100%; max-width: 440px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; }
.modal-stripe { height: 4px; background: linear-gradient(90deg, #7C3AED, #4F7CF7); }
.modal-stripe-rojo { height: 4px; background: linear-gradient(90deg, #DC2626, #F97316); }
.modal-body { padding: 32px; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 16px; }
.modal-icono { width: 60px; height: 60px; background: #F0FDF4; border: 2px solid #BBF7D0; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.modal-icono-rojo { width: 60px; height: 60px; background: #FEF2F2; border: 2px solid #FECACA; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
.modal-titulo { font-size: 20px; font-weight: 700; color: #020617; }
.modal-num-elim { font-size: 13px; font-weight: 700; color: #7C3AED; }
.modal-texto { font-size: 14px; color: #64748B; line-height: 1.6; }
.modal-fecha-box { display: flex; align-items: center; gap: 8px; background: #EDE9FE; color: #5B21B6; border-radius: 10px; padding: 12px 18px; font-size: 13px; font-weight: 500; width: 100%; justify-content: center; }
.modal-botones { display: flex; gap: 12px; width: 100%; }
.btn-cancelar { flex: 1; padding: 12px; border: 1.5px solid #E2E8F0; background: white; color: #475569; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-cancelar:hover { border-color: #94A3B8; }
.btn-confirmar { flex: 1; padding: 12px; background: #7C3AED; color: white; border: none; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px rgba(124,58,237,0.2); }
.btn-confirmar:hover:not(:disabled) { background: #6d28d9; }
.btn-confirmar:disabled { opacity: 0.6; cursor: not-allowed; }
.btn-eliminar-confirm { flex: 1; padding: 12px; background: #DC2626; color: white; border: none; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px rgba(220,38,38,0.2); }
.btn-eliminar-confirm:hover:not(:disabled) { background: #b91c1c; }
.btn-eliminar-confirm:disabled { opacity: 0.6; cursor: not-allowed; }
.toast-verde { position: fixed; bottom: 32px; left: 50%; transform: translateX(-50%); z-index: 600; display: flex; align-items: center; gap: 10px; background: #16A34A; color: white; padding: 14px 24px; border-radius: 12px; font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 500; box-shadow: 0 8px 24px rgba(22,163,74,0.3); animation: slideUp 0.3s ease; }
@keyframes slideUp { from { opacity: 0; transform: translateX(-50%) translateY(16px); } to { opacity: 1; transform: translateX(-50%) translateY(0); } }
</style>