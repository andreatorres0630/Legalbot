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
        <a href="#" @click.prevent="navigateToInicio" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span> Inicio
        </a>
        <a href="#" class="nav-item active">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span> Chat Legal
        </a>
        <a href="/mis-expedientes" class="nav-item">
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

      <div class="content-row">
        <main class="chat-area">
          <div class="chat-messages-scroll" ref="chatScroll">
            <div v-for="(mensaje, index) in historialMensajes" :key="`msg-${index}-${mensaje.enviado_en}`" :class="['flex-message', mensaje.remitente === 'Usuario' ? 'user' : 'ai']">
              <template v-if="mensaje.remitente === 'Usuario'">
                <div class="message-bubble bg-dark">{{ mensaje.contenido }}</div>
                <div class="chat-avatar-circle mini-purple">{{ currentUser.nombre.charAt(0) || 'U' }}</div>
              </template>

              <template v-else>
                <div class="ai-icon-wrapper">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
                    <rect x="3" y="11" width="18" height="10" rx="2"/>
                    <circle cx="12" cy="5" r="2"/>
                    <path d="M12 7v4"/>
                  </svg>
                </div>
                <div class="message-bubble bg-white border shadow-sm">
                  <p class="bubble-brand-name">LegalBot AI</p>
                  <p class="bubble-text">{{ mensaje.contenido }}</p>

                  <div v-if="mensaje.requiereAbogado" class="contact-lawyers-card">
                    <div class="contact-lawyers-header">
                      <div>
                        <p class="contact-lawyers-badge">Caso penal crítico</p>
                        <h4>Contactar abogados especialistas</h4>
                      </div>
                      <span class="contact-lawyers-type">{{ mensaje.especialidadRequerida || 'Derecho Penal' }}</span>
                    </div>

                    <button class="btn-ver-abogados" @click="mensaje.showAbogados = !mensaje.showAbogados">
                      {{ mensaje.showAbogados ? 'Ocultar abogados especializados' : 'Ver abogados especializados' }}
                    </button>

                    <div v-if="mensaje.showAbogados" class="contact-lawyers-list">
                      <div v-if="mensaje.listaAbogados && mensaje.listaAbogados.length > 0">
                        <div v-for="(abogado, idx) in mensaje.listaAbogados" :key="`abogado-${idx}-${abogado.telefono}`" class="contact-lawyer-item">
                          <img :src="getAbogadoImageUrl(abogado.imagen)" alt="Foto de abogado" class="contact-lawyer-avatar" />
                          <div class="contact-lawyer-info">
                            <p class="contact-lawyer-name">{{ abogado.nombre }}</p>
                            <p class="contact-lawyer-specialty">{{ abogado.especialidad }}</p>
                            <a :href="'tel:' + abogado.telefono" class="contact-lawyer-phone">📞 {{ abogado.telefono }}</a>
                          </div>
                          <a :href="'tel:' + abogado.telefono" class="btn-contact-lawyer">Llamar</a>
                        </div>
                      </div>
                      <div v-else class="contact-lawyers-empty">
                        <p>No se encontraron abogados disponibles en este momento.</p>
                      </div>
                    </div>
                  </div>

                  <template v-if="mensaje.inicial">
                    <ol class="legal-steps-list">
                      <li><span class="step-num">1</span> Verifica que todos estén bien.</li>
                      <li><span class="step-num">2</span> Mueve los vehículos si es seguro hacerlo.</li>
                      <li><span class="step-num">3</span> Toma fotografías del área afectada.</li>
                      <li><span class="step-num">4</span> Intenta llegar a un acuerdo amistoso con el otro conductor.</li>
                      <li><span class="step-num">5</span> Reporta a la PNC si no hay acuerdo o hay lesionados.</li>
                    </ol>

                    <div class="warning-alert">
                      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                      <p><span>Aviso:</span> Este caso podría requerir asesoría legal profesional.</p>
                    </div>

                    <button class="btn-ver-abogados" @click="toggleLawyers">
                      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                      {{ showLawyers ? 'Ocultar abogados' : 'Ver abogados especializados' }}
                    </button>
                  </template>
                </div>
              </template>
            </div>

            <div v-if="cargando" class="typing-indicator">
              <span class="bubble-text">Escribiendo...</span>
            </div>

            <div v-if="historialMensajes.length === 0" class="empty-chat-placeholder">
              <p class="bubble-text">Escribe tu consulta legal para empezar.</p>
            </div>

            <div v-if="showLawyers" class="recommended-lawyers-wrapper">
              <div class="recommended-header">
                <h3>Abogados recomendados</h3>
                <button class="close-section" @click="showLawyers = false">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
              </div>

              <div class="lawyers-stack">
                <div v-if="lawyersLoading" class="lawyers-loading-state">
                  <p>Cargando abogados desde la base de datos...</p>
                </div>
                <div v-else-if="lawyers.length === 0" class="lawyers-loading-state">
                  <p>No se encontraron abogados disponibles en este momento.</p>
                </div>
                <div v-else>
                  <div v-for="abogado in lawyers" :key="abogado.id" class="lawyer-card-horizontal">
                    <div class="lawyer-avatar-container" :style="{ background: abogado.color }">
                      {{ abogado.avatar }}
                    </div>
                    <div class="lawyer-info-flex">
                      <div class="lawyer-header-meta">
                        <h4>{{ abogado.nombre }}</h4>
                        <span :class="['badge-status-pill', abogado.status]">
                          {{ abogado.estado === 'available' ? '● Disponible ahora' : '● En consulta' }}
                        </span>
                      </div>
                      <p class="lawyer-specialty-txt">{{ abogado.especialidad }}</p>
                      <div class="lawyer-footer-meta">
                        <span>✉️ {{ abogado.correo }}</span>
                        <span>📞 {{ abogado.telefono }}</span>
                      </div>
                    </div>
                    <div class="lawyer-actions-column">
                      <button class="btn-lawyer-action contact">Contactar</button>
                      <button class="btn-lawyer-action profile">Ver perfil</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="sticky-chat-input-bar">
            <div class="input-wrapper-flex">
              <input type="text" v-model="nuevoMensaje" placeholder="Escribe tu consulta legal..." class="bottom-chat-input" :disabled="cargando" @keyup.enter.prevent="enviarMensaje" />
              <button class="btn-send-chat" :style="{ background: nuevoMensaje.trim() && !cargando ? '#7C3AED' : '#CBD5E1' }" :disabled="cargando || !nuevoMensaje.trim()" @click.prevent="enviarMensaje">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              </button>
            </div>
          </div>
        </main>

        <aside class="right-info-panel">
          
          <section class="panel-block">
            <p class="section-block-title">Mis acciones</p>
            <div class="actions-grid-mini">
              <div class="action-mini-box bg-purple-tint">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <p>Nueva Consulta</p>
              </div>
              <div class="action-mini-box bg-blue-tint">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4F7CF7" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                <p>Generar Documento</p>
              </div>
            </div>
          </section>

          <section class="panel-block">
            <p class="section-block-title">Instituciones cercanas</p>
            <div class="visual-minimap">
              <div class="map-graphic-layer">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4F7CF7" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span class="map-tag-label">San Miguel, El Salvador</span>
              </div>
              <div class="minimap-footer-card">
                <div class="institution-avatar">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#4F7CF7" stroke-width="2"><rect x="2" y="10" width="20" height="12" rx="2"/><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg>
                </div>
                <div>
                  <h5>PNC (Policía Nacional Civil)</h5>
                  <p>0.4 km · 4a Calle Poniente, San Miguel</p>
                </div>
              </div>
            </div>
            <a href="#" class="panel-purple-link">Ver más instituciones ›</a>
          </section>

          <section class="panel-block">
            <p class="section-block-title">Abogados sugeridos</p>
            <div class="suggested-stack-list">
              <div v-for="sug in suggestedLawyers" :key="sug.name" class="suggested-row-item">
                <div class="sug-left-meta">
                  <div class="sug-avatar-circle">{{ sug.name.split(' ').pop()[0] }}</div>
                  <div>
                    <h5 class="text-truncate">{{ sug.name }}</h5>
                    <p>{{ sug.specialty }} · <span :style="{ color: sug.status === 'available' ? '#22C55E' : '#F59E0B' }">●</span></p>
                  </div>
                </div>
                <button class="btn-sug-contact-mini">Contactar</button>
              </div>
            </div>
          </section>

          <section class="panel-block">
            <p class="section-block-title">Mis últimas consultas</p>
            <div class="recent-queries-stack">
              <button v-for="query in recentQueries" :key="query.label" class="recent-query-row-btn" @click.prevent="handleSuggestedQuery(query.label)">
                <span class="query-icon-wrap">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" :stroke="query.color" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </span>
                <span class="query-label-text">{{ query.label }}</span>
                <span class="query-arrow-icon">›</span>
              </button>
            </div>
            <button class="btn-trigger-all-history-modal" @click="window.location.href = '/mis-expedientes'">
              Ver todas las consultas
            </button>
          </section>

          <section class="panel-block">
            <p class="panel-section-label">Áreas Legales Disponibles</p>
            <div class="legal-areas-mini-stack">
                <div class="area-mini-pill">
                    <span class="area-icon-dot">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#4F7CF7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </span>
                    <span class="area-title-lbl">Laboral</span>
                    <span class="area-arrow-lbl" style="color: #4F7CF7;"></span>
                </div>
                <div class="area-mini-pill">
                    <span class="area-icon-dot">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                            <circle cx="7" cy="17" r="2"/>
                            <circle cx="17" cy="17" r="2"/>
                        </svg>
                    </span>
                    <span class="area-title-lbl">Tránsito</span>
                    <span class="area-arrow-lbl" style="color: #F59E0B;"></span>
                </div>
                <div class="area-mini-pill">
                    <span class="area-icon-dot">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"/>
                            <line x1="9" y1="22" x2="9" y2="16"/>
                            <line x1="15" y1="22" x2="15" y2="16"/>
                            <line x1="9" y1="16" x2="15" y2="16"/>
                            <path d="M9 6h6M9 10h6M9 14h6"/>
                        </svg>
                    </span>
                    <span class="area-title-lbl">Propiedad</span>
                    <span class="area-arrow-lbl" style="color: #22C55E;"></span>
                </div>
            </div>
        </section>
        </aside>
      </div>
    </div>

    <div v-if="showModal" class="modal-blur-overlay-layer" @click.self="showModal = false">
      <div class="history-modal-container">
        <div class="modal-stripe-deco" />
        
        <div class="history-modal-header-top">
          <div>
            <h3>Mis Consultas</h3>
            <p>Historial reciente de consultas legales realizadas</p>
          </div>
          <button class="btn-close-modal-x" @click="showModal = false">×</button>
        </div>

        <div class="history-modal-body-scroll">
          <div class="modal-history-cards-stack">
            <div v-for="c in consultasHistory" :key="c.id" class="history-item-row-card">
              <div class="h-card-left-info">
                <div class="h-card-icon-badge" :style="{ background: c.iconBg }">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" :stroke="c.iconColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <div>
                  <h4>{{ c.title }}</h4>
                  <p>Categoría: <span class="txt-purple-accent">{{ c.category }}</span> · {{ c.date }}</p>
                </div>
              </div>
              <div class="h-card-right-actions">
                <span class="badge-status-history" :style="{ background: statusConfig[c.status].bg, color: statusConfig[c.status].color }">
                  {{ statusConfig[c.status].label }}
                </span>
                <button :class="['btn-history-action-trigger', c.status]">
                  {{ c.action }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="history-modal-footer-bottom">
          <button class="btn-modal-footer-close" @click="showModal = false">Cerrar</button>
          <button class="btn-modal-footer-create-new">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nueva Consulta
          </button>
        </div>
    </div>
</div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ChatLegal',
  data() {
    return {
      // ← CORREGIDO: expedienteNumero y consultaId al nivel raíz, NO dentro de currentUser
      expedienteNumero: null,
      consultaId: null,

      currentUser: {
        nombre: 'Usuario',
        apellido: '',
      },
      nuevoMensaje: '',
      historialMensajes: [],
      showModal: false,
      cargando: false,
      showLawyers: false,
      lawyers: [],
      lawyersFetched: false,
      lawyersLoading: false,
      suggestedLawyers: [
        { name: 'Laura Méndez', specialty: 'Accidentes', status: 'available' },
        { name: 'María López', specialty: 'Daños Materiales', status: 'busy' },
      ],
      recentQueries: [
        { label: '¿Qué hacer tras un choque?', color: '#4F7CF7' },
        { label: 'Reclamar daños materiales', color: '#F59E0B' },
        { label: 'Asesoría penal urgente', color: '#22C55E' },
      ],
      consultasHistory: [
        { id: 1, title: 'Choque leve en San Salvador', category: 'Tránsito', date: '30 May 2026', iconBg: '#E0E7FF', iconColor: '#4F7CF7', status: 'proceso', action: 'Revisar' },
        { id: 2, title: 'Accidente con heridos', category: 'Penal', date: '28 May 2026', iconBg: '#FEF3C7', iconColor: '#F59E0B', status: 'pendiente', action: 'Seguir' },
      ],
      statusConfig: {
        proceso: { bg: '#EFF6FF', color: '#2563EB', label: 'En proceso' },
        pendiente: { bg: '#FFEDD5', color: '#EA580C', label: 'Pendiente' },
      },
    }
  },
  async mounted() {
    await this.fetchCurrentUser()
    await this.cargarHistorialSiExiste()
    this.scrollAlFinal()
  },
  methods: {
    async fetchCurrentUser() {
      try {
        const response = await axios.get('/auth/me')
        this.currentUser = response.data
      } catch (error) {
        console.error('Error cargando usuario actual:', error)
      }
    },
    async fetchLawyers() {
      if (this.lawyersFetched || this.lawyersLoading) return

      this.lawyersLoading = true
      try {
        const response = await axios.get('/abogados/list')
        this.lawyers = response.data.map((abogado, index) => ({
          id: abogado.id,
          nombre: abogado.nombre,
          especialidad: abogado.especialidad,
          correo: abogado.correo,
          telefono: abogado.telefono,
          estado: abogado.disponible ? 'available' : 'busy',
          status: abogado.disponible ? 'available' : 'busy',
          color: ['#7C3AED', '#4F7CF7', '#22C55E'][index % 3],
          avatar: abogado.nombre.charAt(0).toUpperCase() || 'A',
        }))
        this.lawyersFetched = true
      } catch (error) {
        console.error('Error cargando abogados desde la BD:', error)
      } finally {
        this.lawyersLoading = false
      }
    },
    async cargarHistorialSiExiste() {
    // Leer el número de expediente de la URL
    const params = new URLSearchParams(window.location.search)
    const numero = params.get('expediente')
    if (!numero) return

    // Guardar el número para que los siguientes mensajes lo usen
    this.expedienteNumero = numero

    try {
        const res = await axios.get(`/api/expedientes/${numero}/historial`)
        const mensajes = res.data

        if (mensajes && mensajes.length > 0) {
            // Obtener el consulta_id del primer mensaje
            this.consultaId = mensajes[0].consulta_id

            // Mapear los mensajes al formato del historial del chat
            this.historialMensajes = mensajes.map(m => ({
                remitente: m.remitente === 'usuario' ? 'Usuario' : 'Bot',
                contenido: m.mensaje,
                enviado_en: m.enviado_en,
                requiereAbogado: false,
                listaAbogados: [],
                especialidadRequerida: null,
                showAbogados: false
            }))
        }
    } catch (error) {
        console.error('Error cargando historial:', error)
    }
    },
    toggleLawyers() {
      this.showLawyers = !this.showLawyers
      if (this.showLawyers) this.fetchLawyers()
    },
    navigateToInicio() {
      window.location.href = '/inicio'
    },
    async handleLogout() {
      const confirmed = confirm('¿Estás seguro que quieres cerrar sesión?')
      if (!confirmed) return

      try {
        await axios.post('/logout', {
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        });
        window.location.href = '/login';
      } catch (error) {
        console.error('Error al cerrar sesión:', error);
        window.location.href = '/login';
      }
    },
    async enviarMensaje() {
      const mensajeTexto = this.nuevoMensaje.trim()
      if (!mensajeTexto || this.cargando) return

      const horaEnvio = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
      this.historialMensajes.push({ remitente: 'Usuario', contenido: mensajeTexto, enviado_en: horaEnvio })
      this.nuevoMensaje = ''
      this.cargando = true
      this.scrollAlFinal()

      try {
        const formData = new FormData();
        formData.append('mensaje', mensajeTexto);

        // Historial reciente para mantener el hilo
        const recent = this.historialMensajes.slice(-8).map(m => ({
          role: m.remitente === 'Usuario' ? 'user' : 'assistant',
          content: m.contenido
        }));
        formData.append('historial', JSON.stringify(recent));

        // ← CORREGIDO: ahora sí existe this.expedienteNumero y this.consultaId
        if (this.expedienteNumero) {
          formData.append('expediente_numero', this.expedienteNumero)
        }
        if (this.consultaId) {
          formData.append('consulta_id', this.consultaId)
        }

        const response = await axios.post('http://127.0.0.1:8000/api/chat/consulta', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        console.log("Respuesta del backend:", response.data);

        let textoFinal = '';
        let requiereAbogado = false;
        let listaAbogados = [];
        let especialidadRequerida = null;

        if (response && response.data) {
          requiereAbogado       = response.data.requiere_abogado ?? false;
          listaAbogados         = Array.isArray(response.data.abogados) ? response.data.abogados : [];
          especialidadRequerida = response.data.especialidad_requerida || null;

          // ← CORREGIDO: guardar expediente y consulta ANTES de asignar textoFinal
          if (response.data.expediente_numero) {
            this.expedienteNumero = response.data.expediente_numero
          }
          if (response.data.consulta_id) {
            this.consultaId = response.data.consulta_id
          }

          // ← CORREGIDO: if/else limpio sin mezclar con las asignaciones anteriores
          if (response.data.respuesta) {
            textoFinal = response.data.respuesta;
          } else if (typeof response.data === 'string') {
            textoFinal = response.data;
          } else if (response.data.data && response.data.data.respuesta) {
            textoFinal = response.data.data.respuesta;
          } else {
            textoFinal = JSON.stringify(response.data);
          }
        }

        // Limpieza de marcadores de la IA
        if (textoFinal.includes('---')) {
          textoFinal = textoFinal.split('---')[1] || textoFinal;
        }
        if (textoFinal.includes('JSON_METADATA:')) {
          textoFinal = textoFinal.replace(/JSON_METADATA:\{.*?\}/g, '');
        }

        this.historialMensajes.push({
          remitente: 'Bot',
          contenido: textoFinal.trim(),
          enviado_en: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
          requiereAbogado,
          listaAbogados,
          especialidadRequerida,
          showAbogados: false
        });

      } catch (error) {
        console.error("Error en Axios:", error);

        let errorDetalle = "Lo siento, hubo un error de comunicación.";
        if (error.response && error.response.data) {
          if (error.response.data.error)          errorDetalle = error.response.data.error;
          else if (error.response.data.respuesta) errorDetalle = error.response.data.respuesta;
          else if (error.response.data.message)   errorDetalle = error.response.data.message;
          else if (typeof error.response.data === 'string') errorDetalle = error.response.data;

          if (error.response.status && !errorDetalle.includes('HTTP')) {
            errorDetalle += ` (HTTP ${error.response.status})`;
          }
        } else if (error.message) {
          errorDetalle = error.message;
        }

        if (errorDetalle.includes('---')) {
          errorDetalle = errorDetalle.split('---')[1] || errorDetalle;
        }

        this.historialMensajes.push({
          remitente: 'Bot',
          contenido: errorDetalle.trim(),
          requiereAbogado: false,
          listaAbogados: [],
          especialidadRequerida: null,
          showAbogados: false
        });
      } finally {
        this.cargando = false;
        this.scrollAlFinal();
      }
    },
    async handleSuggestedQuery(texto) {
      if (this.cargando) return
      this.nuevoMensaje = texto
      await this.$nextTick()
      await this.enviarMensaje()
    },
    scrollAlFinal() {
      this.$nextTick(() => {
        const container = this.$refs.chatScroll
        if (container) container.scrollTop = container.scrollHeight
      })
    },
    getAbogadoImageUrl(imagen) {
      return imagen ? `/storage/${imagen}` : '/storage/abogados/default-avatar.png'
    },
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

.dashboard-layout {
  display: flex;
  height: 100vh;
  width: 100%;
  overflow: hidden;
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

.nav-item {
  display: flex; align-items: center; gap: 12px; padding: 12px 16px;
  border-radius: 12px; text-decoration: none; color: #5a4b81;
  font-size: 14px; font-weight: 500; transition: 0.3s;
}
.nav-item:hover { background: rgba(255, 255, 255, 0.4); }
.nav-item.active { background-color: #020617; color: white; }
.logout { margin-top: auto; color: #991b1b; cursor: pointer; }

.main-wrapper { margin-left: 260px; flex: 1; display: flex; flex-direction: column; height: 100vh; min-width: 0; position: relative; }

.top-header { height: 80px; background: white; display: flex; justify-content: space-between; align-items: center; padding: 0 40px; border-bottom: 1px solid #E2E8F0; }
.welcome-title { font-size: 20px; font-weight: 700; color: #020617; }
.welcome-subtitle { font-size: 13px; color: #64748B; }
.header-user { display: flex; align-items: center; gap: 24px; }
.user-profile { display: flex; align-items: center; gap: 10px; }
.user-avatar { width: 38px; height: 38px; background: #4F7CF7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }

.content-row { display: flex; flex: 1; overflow: hidden; }
.text-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.chat-area { flex: 1; display: flex; flex-direction: column; background: #F8FAFC; position: relative; border-right: 1px solid rgba(0,0,0,0.07); }
.chat-messages-scroll { flex: 1; padding: 30px; overflow-y: auto; display: flex; flex-direction: column; gap: 20px; padding-bottom: 100px; scrollbar-width: none; }
.chat-messages-scroll::-webkit-scrollbar { display: none; }

.flex-message { display: flex; gap: 12px; max-width: 85%; }
.flex-message.user { justify-content: flex-end; align-self: flex-end; }
.flex-message.ai { align-self: flex-start; width: 100%; max-width: 90%; }

.message-bubble { padding: 14px 20px; border-radius: 20px; font-size: 14px; line-height: 1.5; }
.message-bubble.bg-dark { background: #020617; color: #F8FAFC; border-bottom-right-radius: 4px; }
.message-bubble.bg-white { background: white; border-top-left-radius: 4px; width: 100%; }

.contact-lawyers-card { margin-top: 18px; padding: 18px; border: 1px solid #E5E7EB; border-radius: 18px; background: #F8FAFC; }
.contact-lawyers-header { display: flex; justify-content: space-between; gap: 16px; align-items: flex-start; margin-bottom: 16px; }
.contact-lawyers-badge { display: inline-flex; padding: 5px 10px; border-radius: 999px; background: #FEE2E2; color: #B91C1C; font-size: 11px; font-weight: 700; margin-bottom: 6px; }
.contact-lawyers-header h4 { margin: 0; font-size: 16px; color: #111827; }
.contact-lawyers-type { font-size: 12px; color: #4B5563; background: #E0F2FE; padding: 6px 10px; border-radius: 999px; }
.contact-lawyers-list { display: flex; flex-direction: column; gap: 12px; }
.contact-lawyer-item { display: flex; align-items: center; gap: 14px; padding: 14px; border-radius: 16px; background: white; border: 1px solid #E5E7EB; }
.contact-lawyer-avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #7C3AED; }
.contact-lawyer-info { flex: 1; }
.contact-lawyer-name { margin: 0 0 4px; font-size: 15px; font-weight: 700; color: #111827; }
.contact-lawyer-specialty { margin: 0 0 6px; font-size: 13px; color: #4B5563; }
.contact-lawyer-phone { font-size: 13px; color: #0F172A; text-decoration: none; }
.contact-lawyer-phone:hover { text-decoration: underline; }
.btn-contact-lawyer { display: inline-flex; align-items: center; justify-content: center; padding: 10px 16px; color: white; background: #16A34A; border: none; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: 700; }
.btn-contact-lawyer:hover { background: #15803d; }
.contact-lawyers-empty { padding: 12px; border-radius: 12px; background: #FEF3C7; color: #92400E; font-size: 13px; }

.chat-avatar-circle { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: white; margin-bottom: 2px; align-self: flex-end; }
.mini-purple { background: #7C3AED; }
.ai-icon-wrapper { width: 32px; height: 32px; background: #F5F0FF; border: 1px solid #DDD6FE; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.bubble-brand-name { font-size: 14px; font-weight: 700; color: #020617; margin-bottom: 4px; }
.bubble-text { color: #334155; margin-bottom: 12px; }

.legal-steps-list { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px; }
.legal-steps-list li { display: flex; align-items: start; gap: 12px; color: #334155; }
.step-num { width: 20px; height: 20px; background: #4F7CF7; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; flex-shrink: 0; margin-top: 1px; }

.panel-section-label { font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 12px; }
.legal-areas-mini-stack { display: flex; flex-direction: column; gap: 6px; }
.area-mini-pill { border: 1px solid rgba(0, 0, 0, 0.02); border-radius: 12px; padding: 10px 14px; display: flex; align-items: center; width: 100%; }
.area-icon-dot { margin-right: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.area-title-lbl { font-size: 13px; color: #020617; font-weight: 600; flex: 1; }
.area-arrow-lbl { font-size: 16px; font-weight: 700; line-height: 1; }

.warning-alert { background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 12px; padding: 10px 14px; display: flex; gap: 10px; align-items: center; margin-bottom: 16px; }
.warning-alert p { font-size: 12px; color: #92400E; }
.warning-alert span { font-weight: 600; }
.btn-ver-abogados { background: #7C3AED; color: white; border: none; padding: 10px 18px; border-radius: 12px; font-family: 'Sora'; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; gap: 8px; align-items: center; box-shadow: 0 4px 6px -1px rgba(124, 111, 247, 0.2); transition: 0.15s; }
.btn-ver-abogados:hover { opacity: 0.9; transform: translateY(-1px); }

.recommended-lawyers-wrapper { border-top: 1px dashed #E2E8F0; margin-top: 24px; padding-top: 20px; margin-left: 44px; }
.recommended-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
.recommended-header h3 { font-size: 14px; font-weight: 700; color: #020617; }
.close-section { background: none; border: none; cursor: pointer; }
.lawyers-stack { display: flex; flex-direction: column; gap: 12px; }
.lawyer-card-horizontal { background: white; border: 1px solid rgba(0,0,0,0.07); border-radius: 20px; padding: 18px; display: flex; align-items: center; gap: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
.lawyer-avatar-container { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px; flex-shrink: 0; }
.lawyer-info-flex { flex: 1; min-width: 0; }
.lawyer-header-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.lawyer-header-meta h4 { font-size: 14px; font-weight: 700; color: #020617; }
.badge-status-pill { font-size: 11px; font-weight: 500; padding: 2px 8px; border-radius: 20px; }
.badge-status-pill.available { background: #DCFCE7; color: #166534; }
.badge-status-pill.busy { background: #FEF3C7; color: #92400E; }
.lawyer-specialty-txt { font-size: 12px; color: #7C3AED; margin-top: 1px; font-weight: 500; }
.lawyer-footer-meta { display: flex; gap: 16px; font-size: 12px; color: #64748B; margin-top: 6px; }
.lawyer-actions-column { display: flex; flex-direction: column; gap: 6px; flex-shrink: 0; }
.btn-lawyer-action { border: none; padding: 6px 14px; border-radius: 8px; font-family: 'Sora'; font-size: 12px; font-weight: 600; cursor: pointer; }
.btn-lawyer-action.contact { background: #7C3AED; color: white; }
.btn-lawyer-action.profile { background: white; color: #020617; border: 1px solid rgba(0,0,0,0.1); }

.sticky-chat-input-bar { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px 30px; background: linear-gradient(to top, #F8FAFC 80%, transparent); }
.input-wrapper-flex { background: white; border: 1px solid rgba(0,0,0,0.1); border-radius: 16px; padding: 6px 6px 6px 18px; display: flex; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
.bottom-chat-input { flex: 1; border: none; outline: none; font-family: 'Sora'; font-size: 14px; color: #020617; background: transparent; }
.btn-send-chat { width: 36px; height: 36px; border: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; }
.typing-indicator { margin-left: auto; display: inline-flex; align-items: center; background: #F8FAFC; border-radius: 999px; padding: 10px 14px; border: 1px solid rgba(0,0,0,0.08); max-width: fit-content; }
.typing-indicator .bubble-text { margin: 0; color: #64748B; font-size: 13px; }

.right-info-panel { width: 288px; background: white; border-left: 1px solid rgba(0,0,0,0.07); padding: 24px; overflow-y: auto; display: flex; flex-direction: column; gap: 24px; scrollbar-width: none; }
.right-info-panel::-webkit-scrollbar { display: none; }
.panel-block { display: flex; flex-direction: column; }
.section-block-title { font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px; }

.actions-grid-mini { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.action-mini-box { border: 1px solid rgba(0,0,0,0.04); padding: 14px 10px; border-radius: 12px; text-align: center; cursor: pointer; transition: 0.2s; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.action-mini-box svg { flex-shrink: 0; }
.action-mini-box:hover { transform: translateY(-2px); box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
.action-mini-box p { font-size: 11px; font-weight: 600; color: #020617; margin-top: 8px; line-height: 1.2; }
.bg-purple-tint { background: #F5F0FF; border-color: rgba(124, 111, 247, 0.1); }
.bg-blue-tint { background: #EFF6FF; border-color: rgba(79, 124, 247, 0.1); }

.visual-minimap { border: 1px solid rgba(0,0,0,0.06); border-radius: 16px; overflow: hidden; margin-bottom: 8px; background: #F8FAFC; }
.map-graphic-layer { height: 84px; background: #E0E7FF; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; }
.map-tag-label { background: #020617D9; color: white; font-size: 10px; font-weight: 500; padding: 2px 8px; border-radius: 6px; }
.minimap-footer-card { padding: 12px; background: white; display: flex; gap: 10px; align-items: center; border-top: 1px solid rgba(0,0,0,0.04); }
.institution-avatar { width: 32px; height: 32px; background: #EFF6FF; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.minimap-footer-card h5 { font-size: 11.5px; font-weight: 700; color: #020617; }
.minimap-footer-card p { font-size: 10px; color: #64748B; margin-top: 1px; }
.panel-purple-link { font-size: 11.5px; color: #7C3AED; text-decoration: none; font-weight: 600; }

.suggested-stack-list { display: flex; flex-direction: column; gap: 10px; }
.suggested-row-item { display: flex; justify-content: space-between; align-items: center; border: 1px solid rgba(0,0,0,0.04); padding: 8px 12px; border-radius: 12px; background: #F8FAFC; }
.sug-left-meta { display: flex; gap: 10px; align-items: center; min-width: 0; }
.sug-avatar-circle { width: 30px; height: 30px; background: #7C3AED; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 11px; }
.sug-left-meta h5 { font-size: 12px; font-weight: 700; color: #020617; }
.sug-left-meta p { font-size: 11px; color: #64748B; }
.btn-sug-contact-mini { background: #7C3AED; color: white; border: none; padding: 4px 10px; border-radius: 6px; font-family: 'Sora'; font-size: 11px; font-weight: 600; cursor: pointer; }

.recent-queries-stack { display: flex; flex-direction: column; gap: 6px; }
.recent-query-row-btn { background: #F8FAFC; border: 1px solid rgba(0,0,0,0.05); border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; text-align: left; width: 100%; cursor: pointer; font-family: 'Sora'; }
.query-icon-wrap { margin-right: 10px; display: flex; align-items: center; }
.query-label-text { font-size: 12px; color: #334155; flex: 1; font-weight: 500; }
.query-arrow-icon { color: #CBD5E1; font-size: 14px; }
.btn-trigger-all-history-modal { background: #7C3AED; color: white; border: none; padding: 10px; border-radius: 12px; font-family: 'Sora'; font-size: 12px; font-weight: 600; cursor: pointer; margin-top: 10px; box-shadow: 0 4px 6px -1px rgba(124, 111, 247, 0.1); }

.modal-blur-overlay-layer { position: fixed; inset: 0; background: rgba(2, 6, 23, 0.55); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; z-index: 2000; }
.history-modal-container { background: white; width: 100%; max-width: 500px; border-radius: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); display: flex; flex-direction: column; overflow: hidden; max-height: 86vh; }
.modal-stripe-deco { height: 4px; width: 100%; background: linear-gradient(90deg, #7C3AED, #4F7CF7); }
.history-modal-header-top { padding: 24px 28px 16px; display: flex; justify-content: space-between; align-items: start; }
.history-modal-header-top h3 { font-size: 20px; font-weight: 700; color: #111827; }
.history-modal-header-top p { font-size: 13px; color: #6B7280; margin-top: 2px; }
.btn-close-modal-x { background: none; border: none; font-size: 26px; color: #9CA3AF; cursor: pointer; line-height: 1; }
.history-modal-body-scroll { padding: 4px 28px 20px; overflow-y: auto; flex: 1; background: #FAFAFA; border-top: 1px solid rgba(0,0,0,0.03); border-bottom: 1px solid rgba(0,0,0,0.03); scrollbar-width: none; }
.history-modal-body-scroll::-webkit-scrollbar { display: none; }
.modal-history-cards-stack { display: flex; flex-direction: column; gap: 10px; padding: 12px 0; }
.history-item-row-card { background: white; border: 1px solid rgba(0,0,0,0.06); border-radius: 18px; padding: 14px 16px; display: flex; justify-content: space-between; align-items: center; transition: all 0.15s; }
.history-item-row-card:hover { background: #F5F0FF; border-color: #DDD6FE; }
.h-card-left-info { display: flex; gap: 12px; align-items: center; }
.h-card-icon-badge { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.h-card-left-info h4 { font-size: 14px; font-weight: 700; color: #111827; }
.h-card-left-info p { font-size: 12px; color: #6B7280; margin-top: 1px; }
.txt-purple-accent { color: #7C3AED; font-weight: 500; }
.h-card-right-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 6px; }
.badge-status-history { font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
.btn-history-action-trigger { background: #F5F0FF; color: #7C3AED; border: 1px solid #DDD6FE; padding: 5px 12px; border-radius: 8px; font-family: 'Sora'; font-size: 11px; font-weight: 600; cursor: pointer; }
.btn-history-action-trigger.proceso { background: #EFF6FF; color: #2563EB; border-color: #BFDBFE; }
.btn-history-action-trigger.pendiente { background: #FFF7ED; color: #EA580C; border-color: #FFEDD5; }
.history-modal-footer-bottom { padding: 16px 28px; display: flex; gap: 12px; background: white; }
.btn-modal-footer-close { flex: 1; border: 1px solid rgba(0,0,0,0.1); background: white; padding: 10px; border-radius: 12px; font-family: 'Sora'; font-size: 13px; font-weight: 600; color: #475569; cursor: pointer; }
.btn-modal-footer-create-new { flex: 1; background: #7C3AED; color: white; border: none; padding: 10px; border-radius: 12px; font-family: 'Sora'; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; gap: 6px; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(124, 111, 247, 0.15); }
</style>