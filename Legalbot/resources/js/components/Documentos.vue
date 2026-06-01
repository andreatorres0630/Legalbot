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
        <a href="#" @click.prevent="navigateToInicio" class="nav-item ">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </span> Inicio
        </a>
        <a href="#" @click.prevent="navigateToChatLegal" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </span> Chat Legal
        </a>
        <a href="#" @click.prevent="navigateToExpedientes" class="nav-item">
          <span class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
          </span> Expedientes
        </a>
        <a href="#" class="nav-item active">
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
      
      <div v-if="subview === 'list'" class="view-scroll-content">
        <div class="container-inner-padding">
          <div class="header-action-row">
            <div>
              <h2 class="view-section-main-title">Mis Documentos</h2>
              <p class="view-section-subtitle">Consulta, descarga y administra tus documentos legales generados.</p>
            </div>
            <button class="btn-create-document-primary" @click="subview = 'generator'">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
              Nuevo documento
            </button>
          </div>
 
          <div class="layout-two-columns">
            <div class="left-main-stack">
              <div class="search-and-filters-row">
                <div class="search-input-box-wrapper">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                  <input type="text" v-model="searchQuery" class="clean-search-field" placeholder="Buscar documento..." />
                </div>
                <div class="filters-pills-row">
                  <button v-for="filter in filterOptions" :key="filter"
                    :class="['filter-pill-btn', { active: activeFilter === filter }]"
                    @click="activeFilter = filter">
                    {{ filter }}
                  </button>
                </div>
              </div>
 
              <div class="documents-grid-layout">
                <div v-for="doc in filteredDocuments" :key="doc.id" class="document-item-box-card">
                  <div class="doc-card-top-meta">
                    <div class="doc-card-icon-square" :style="{ background: doc.bg }">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" :stroke="doc.color" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                      </svg>
                    </div>
                    <span :class="['badge-status-pill', doc.status]">
                      {{ doc.status === 'generado' ? 'Generado' : doc.status === 'descargado' ? 'Descargado' : 'Borrador' }}
                    </span>
                  </div>
 
                  <div class="doc-card-body-data">
                    <h4 class="doc-card-title-heading text-truncate">{{ doc.name }}</h4>
                    <div class="doc-card-tags-row">
                      <span class="category-pill-tag">{{ doc.category }}</span>
                      <span class="consulta-number-lbl">Consulta {{ doc.consulta }}</span>
                    </div>
                    <div class="doc-card-footer-info-row">
                      <span class="footer-calendar-flex">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ doc.date }}
                      </span>
                      <span class="footer-size-lbl">{{ doc.size }}</span>
                    </div>
                  </div>
 
                  <div class="doc-card-divider-line"></div>
                  <div class="doc-card-actions-flex-row">
                    <button class="btn-card-action border-btn" @click="verDocumento(doc)">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> 
                      Ver
                    </button>
                    <button class="btn-card-action filled-btn" @click="descargarDocumento(doc)">Descargar</button>
                    <button class="btn-square-share-action">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                    </button>
                  </div>
                </div>
 
                <!-- Estado vacío -->
                <div v-if="filteredDocuments.length === 0" class="empty-state-box">
                  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#CBD5E1" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                  <p>No hay documentos aún.</p>
                  <button class="btn-create-document-primary" style="margin-top:12px" @click="subview = 'generator'">
                    Crear mi primer documento
                  </button>
                </div>
              </div>
            </div>
 
            <aside class="right-summary-sidebar-panels">
              <div class="summary-box-panel border-card">
                <div class="top-gradient-stripe-indicator"></div>
                <p class="panel-section-label">Resumen</p>
                <div class="metrics-rows-stack">
                  <div class="metric-row-item"><span>Generados</span><span class="badge-num-metric blue">{{ countMetrics.generados }}</span></div>
                  <div class="metric-row-item"><span>Borradores</span><span class="badge-num-metric yellow">{{ countMetrics.borradores }}</span></div>
                  <div class="metric-row-item"><span>Descargados</span><span class="badge-num-metric green">{{ countMetrics.descargados }}</span></div>
                </div>
              </div>
 
              <div class="summary-box-panel border-card">
                <p class="panel-section-label">Plantillas más usadas</p>
                <div class="popular-templates-stack">
                  <button v-for="pop in popularTemplates" :key="pop.label" class="popular-template-row-btn"
                    @click="abrirGeneradorConTemplate(pop.templateId)">
                    <div class="pop-icon-container" :style="{ background: pop.color + '18' }">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" :stroke="pop.color" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                    </div>
                    <div class="pop-meta-info min-w-none">
                      <h5 class="text-truncate">{{ pop.label }}</h5>
                      <p>{{ pop.count }} generados</p>
                    </div>
                    <span class="pop-chevron-arrow">›</span>
                  </button>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
 
      <!-- ══ VISTA: GENERADOR ══ -->
      <div v-if="subview === 'generator'" class="view-scroll-content">
        <div class="container-inner-padding">
 
          <div class="header-navigation-back-node">
            <button class="btn-navigation-back-arrow" @click="subview = 'list'">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Mis documentos
            </button>
            <div class="node-title-box">
              <h2 class="view-section-main-title">Generar Documento Legal</h2>
              <p class="view-section-subtitle">Completa la información necesaria para crear tu documento.</p>
            </div>
          </div>
 
          <div class="layout-generator-split">
            <!-- PANEL IZQUIERDO: selector + formulario -->
            <div class="generator-left-form-panel">
 
              <div class="white-card-container border-card">
                <p class="panel-section-label">Plantillas disponibles</p>
                <div class="template-selector-stack-list">
                  <button v-for="t in templatesConfig" :key="t.id"
                    :class="['template-select-row-card', { active: selectedTemplate === t.id }]"
                    @click="seleccionarTemplate(t.id)">
                    <div class="select-icon-square" :style="{ background: t.bg }">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" :stroke="t.color" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                    </div>
                    <div class="select-meta-text">
                      <h5>{{ t.label }}</h5>
                      <p>{{ t.desc }}</p>
                    </div>
                    <div v-if="selectedTemplate === t.id" class="active-check-circle-indicator">
                      <svg width="10" height="8" viewBox="0 0 10 8" fill="none"><path d="M1 4L3.5 6.5L9 1" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                  </button>
                </div>
              </div>
 
              <div class="white-card-container border-card">
                <div class="current-selected-header-row-pill">
                  <div class="pill-avatar-icon" :style="{ background: activeTemplateData.bg }">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" :stroke="activeTemplateData.color" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                  </div>
                  <h5>{{ activeTemplateData.label }}</h5>
                </div>
 
                <div class="inputs-fields-vertical-stack">
                  <div v-for="f in currentFields" :key="f.id" class="input-group-element-box">
                    <label>{{ f.label }}</label>
                    <textarea v-if="f.multiline" rows="3" v-model="formData[f.id]"
                      :placeholder="f.placeholder" class="native-textarea-element doc-input" />
                    <input v-else :type="f.type || 'text'" v-model="formData[f.id]"
                      :placeholder="f.placeholder" class="native-input-element doc-input" />
                  </div>
                </div>
 
                <div class="form-actions-buttons-row">
                  <button class="btn-form-action-trigger purple-filled"
                    :disabled="isGenerating"
                    @click="generarDocumento">
                    <span v-if="isGenerating">Generando...</span>
                    <span v-else>Generar Documento</span>
                  </button>
                  <button class="btn-form-action-trigger white-bordered"  @click="guardarBorrador">Guardar borrador</button>
                </div>
 
                <!-- Error -->
                <p v-if="errorMsg" class="error-inline-msg">{{ errorMsg }}</p>
              </div>
 
            </div>
 
            <!-- PANEL DERECHO: preview -->
            <div class="generator-right-preview-panel">
              <div class="preview-document-rigid-box border-card shadow-sm">
                <div class="modal-stripe-deco"></div>
 
                <div class="preview-box-header-top">
                  <div>
                    <h5>Vista previa</h5>
                    <p>El documento se actualizará automáticamente.</p>
                  </div>
                  <span class="preview-hash-badge-status">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/><line x1="10" y1="3" x2="8" y2="21"/><line x1="16" y1="3" x2="14" y2="21"/></svg>
                    {{ activeTemplateData.label }}
                  </span>
                </div>
 
                <div class="preview-sheet-body-content">
                  <div class="sheet-center-header-title">
                    <p class="sheet-main-uppercase-heading">{{ activeTemplateData.label }}</p>
                    <div class="sheet-decor-accent-line"></div>
                  </div>
 
                  <!-- Preview: Acuerdo Amistoso -->
                  <div v-if="selectedTemplate === 'acuerdo'" class="sheet-paragraphs-stack-flow">
                    <p class="sheet-date-stamp-txt">{{ formData.lugar || '___________' }}, {{ formatSelectedDate(formData.fecha) }}</p>
                    <p>
                      Yo, <strong>{{ formData.conductor1 || '___________' }}</strong>, con placa
                      <strong>{{ formData.placa1 || '___' }}</strong>, y
                      <strong>{{ formData.conductor2 || '___________' }}</strong>, con placa
                      <strong>{{ formData.placa2 || '___' }}</strong>, acordamos resolver de manera amistosa el incidente ocurrido en
                      <strong>{{ formData.lugar || '___________' }}</strong>.
                    </p>
                    <p v-if="formData.descripcion" class="sheet-description-p-block">{{ formData.descripcion }}</p>
                    <p v-if="formData.monto">Monto pactado: <strong class="purple-emphasis-monto">${{ formData.monto }}</strong>.</p>
                    <div class="sheet-signatures-double-row">
                      <div class="signature-block-field"><div class="line-sig"></div><p>{{ formData.conductor1 || 'Firma Parte 1' }}</p></div>
                      <div class="signature-block-field"><div class="line-sig"></div><p>{{ formData.conductor2 || 'Firma Parte 2' }}</p></div>
                    </div>
                  </div>
 
                  <!-- Preview: Reclamo -->
                  <div v-if="selectedTemplate === 'reclamo'" class="sheet-paragraphs-stack-flow">
                    <p class="sheet-date-stamp-txt">San Salvador, {{ formatFechaHoy() }}</p>
                    <p>
                      Yo, <strong>{{ formData.nombre || '___________' }}</strong>, con DUI
                      <strong>{{ formData.dui || '___________' }}</strong>, me dirijo a
                      <strong>{{ formData.empresa || '___________' }}</strong>.
                    </p>
                    <p v-if="formData.motivo">Motivo del reclamo: <strong>{{ formData.motivo }}</strong>.</p>
                    <p v-if="formData.descripcion" class="sheet-description-p-block">{{ formData.descripcion }}</p>
                    <p v-if="formData.solicitud"><strong>Solicitud:</strong> {{ formData.solicitud }}</p>
                    <div class="sheet-signatures-double-row">
                      <div class="signature-block-field container-left-sig"><div class="line-sig"></div><p>{{ formData.nombre || 'Firma del solicitante' }}</p></div>
                    </div>
                  </div>
 
                  <!-- Preview: Denuncia -->
                  <div v-if="selectedTemplate === 'denuncia'" class="sheet-paragraphs-stack-flow">
                    <p class="sheet-date-stamp-txt">{{ formatSelectedDate(formData.fecha) }}</p>
                    <p>
                      Por medio del presente escrito, presento formal denuncia ante
                      <strong>{{ formData.institucion || '___________' }}</strong>.
                    </p>
                    <div v-if="formData.hechos">
                      <p class="sheet-bold-label-inline">Descripción de hechos:</p>
                      <p class="sheet-description-p-block">{{ formData.hechos }}</p>
                    </div>
                    <p v-if="formData.testigos"><strong>Testigos:</strong> {{ formData.testigos }}</p>
                    <div class="sheet-signatures-double-row">
                      <div class="signature-block-field container-left-sig"><div class="line-sig"></div><p>Firma del denunciante</p></div>
                    </div>
                  </div>
 
                  <p class="sheet-system-watermark-footer">Documento generado por LegalBot El Salvador</p>
                </div>
              </div>
 
              <div class="preview-external-actions-column-stack">
                <button class="btn-preview-action-block purple-filled"
                  :disabled="isGenerating"
                  @click="generarDocumento">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                  {{ isGenerating ? 'Generando...' : 'Descargar PDF' }}
                </button>
                <div class="preview-action-double-row-grid">
                  <button class="btn-preview-row-action-white">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                    Compartir
                  </button>
                  <button class="btn-preview-row-action-white">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    Expediente
                  </button>
                </div>
              </div>
            </div>
          </div>
 
        </div>
      </div>
    </div>
 
    <!-- ══ MODAL ÉXITO ══ -->
    <div v-if="showSuccessModal" class="lb-gen-overlay" @click.self="showSuccessModal = false">
      <div class="lb-gen-modal relative flex flex-col w-full max-w-md rounded-3xl shadow-2xl overflow-hidden">
        <div class="modal-stripe-deco"></div>
 
        <div class="flex flex-col items-center px-8 pt-8 pb-6 text-center">
          <div class="lb-check-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-5 shadow-lg">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          </div>
          <h2 class="success-modal-heading-title">Documento generado correctamente</h2>
          <p class="success-modal-heading-subtitle">El documento ya está disponible para descargar o compartir.</p>
        </div>
 
        <div class="mx-8 split-divider-line"></div>
 
        <div class="px-8 py-5">
          <div class="success-inner-document-mini-card-preview">
            <div class="success-card-pdf-icon-bg">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="success-card-meta-details-flex-info min-w-0">
              <div class="success-card-top-title-row">
                <h4 class="text-truncate">{{ lastGeneratedFilename }}</h4>
                <span class="success-badge-tag-pill">Generado exitosamente</span>
              </div>
              <div class="success-card-rows-meta-attributes-stack">
                <div class="attribute-row-item-flex">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span>Fecha generación:</span><strong>{{ fechaGeneracion }}</strong>
                </div>
                <div class="attribute-row-item-flex">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                  <span>Tipo de documento:</span><strong>{{ activeTemplateData.label }}</strong>
                </div>
              </div>
            </div>
          </div>
        </div>
 
        <div class="mx-8 split-divider-line"></div>
 
        <div class="px-8 py-5 success-modal-footer-actions-stack">
          <button class="btn-success-modal-block-action purple-filled" @click="descargarUltimoDoc">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Descargar PDF
          </button>
          <div class="success-modal-double-row-actions">
            <button class="btn-success-modal-row-action-white">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
              Compartir
            </button>
            <button class="btn-success-modal-row-action-white" @click="cerrarModal(); subview = 'list'">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
              Ver expediente
            </button>
          </div>
          <button class="btn-success-modal-cancel-text" @click="cerrarModal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const currentUser = ref({
  nombre: 'Usuario',
  apellido: '',
})

const navigateToExpedientes = () => {
  window.location.href = '/mis-expedientes'
}

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

const fetchDocuments = async () => {
  try {
    const response = await axios.get('/api/documentos')
    documents.value = response.data
  } catch (error) {
    console.error(error)
  }
}

onMounted(() => {
  fetchCurrentUser()
  fetchDocuments()
})


const subview = ref('list')
 
// ── LISTA DE DOCUMENTOS ─────────────────────────────────────────────────────
const searchQuery  = ref('')
const activeFilter = ref('Todos')
const filterOptions = ['Todos', 'Generados', 'Borradores', 'Descargados']
const documents = ref([])
 
const filteredDocuments = computed(() => {
  let list = documents.value
 
  if (searchQuery.value.trim()) {
    const q = searchQuery.value.toLowerCase()
    list = list.filter(d => d.name.toLowerCase().includes(q) || d.category.toLowerCase().includes(q))
  }
 
  if (activeFilter.value !== 'Todos') {
    const map = { Generados: 'generado', Borradores: 'borrador', Descargados: 'descargado' }
    list = list.filter(d => d.status === map[activeFilter.value])
  }
 
  return list
})
 
const countMetrics = computed(() => ({
  generados:   documents.value.filter(d => d.status === 'generado').length,
  borradores:  documents.value.filter(d => d.status === 'borrador').length,
  descargados: documents.value.filter(d => d.status === 'descargado').length,
}))
 
// Plantillas populares — usa el campo templateId para abrir el generador
const popularTemplates = ref([
  { label: 'Acuerdo Amistoso', count: 0, color: '#22C55E', templateId: 'acuerdo' },
  { label: 'Carta de Reclamo',  count: 0, color: '#7C3AED', templateId: 'reclamo' },
  { label: 'Denuncia Formal',   count: 0, color: '#EF4444', templateId: 'denuncia' },
])
 
const abrirGeneradorConTemplate = (templateId) => {
  seleccionarTemplate(templateId)
  subview.value = 'generator'
}
 
const descargarDocumento = (doc) => {
  if (doc.downloadUrl) window.open(doc.downloadUrl, '_blank')
}

const guardarBorrador = async () => {
  try {

    await axios.post('/api/documentos/borrador', {
      plantilla: selectedTemplate.value,
      datos: formData.value
    })

    alert('Borrador guardado correctamente')

  } catch (error) {

    console.error(error)
    alert('Error al guardar borrador')

  }
}

// ── CONFIG DE PLANTILLAS ────────────────────────────────────────────────────
const templatesConfig = [
  {
    id:    'acuerdo',
    label: 'Acuerdo Amistoso',
    desc:  'Resolución amistosa de accidentes de tránsito',
    color: '#22C55E',
    bg:    '#DCFCE7',
  },
  {
    id:    'reclamo',
    label: 'Carta de Reclamo',
    desc:  'Reclamo formal ante empresa o institución',
    color: '#7C3AED',
    bg:    '#EDE9FE',
  },
  {
    id:    'denuncia',
    label: 'Denuncia Formal',
    desc:  'Denuncia ante FGR, PNC, PDDH u otra entidad',
    color: '#EF4444',
    bg:    '#FEE2E2',
  },
]
 
// ── CAMPOS POR PLANTILLA ────────────────────────────────────────────────────
const fieldsByTemplate = {
  acuerdo: [
    { id: 'fecha',       label: 'Fecha del acuerdo',        type: 'date'},
    { id: 'conductor1',  label: 'Nombre del Conductor 1',   placeholder: 'Ej: Juan Carlos Pérez' },
    { id: 'conductor2',  label: 'Nombre del Conductor 2',   placeholder: 'Ej: María López' },
    { id: 'placa1',      label: 'Placa del vehículo 1',     placeholder: 'Ej: P-123456' },
    { id: 'placa2',      label: 'Placa del vehículo 2',     placeholder: 'Ej: N-654321' },
    { id: 'lugar',       label: 'Lugar del accidente',      placeholder: 'Ej: San Salvador, Blvd. de los Héroes' },
    { id: 'descripcion', label: 'Descripción del incidente',placeholder: 'Describa brevemente lo ocurrido...', multiline: true },
    { id: 'monto',       label: 'Monto acordado (USD)',     placeholder: 'Ej: 350.00', type: 'number' },
  ],
  reclamo: [
    { id: 'nombre',      label: 'Su nombre completo',       placeholder: 'Ej: Carlos Antonio Ramos' },
    { id: 'dui',         label: 'DUI',                      placeholder: 'Ej: 01234567-8' },
    { id: 'empresa',     label: 'Empresa / Institución',    placeholder: 'Ej: Claro El Salvador S.A.' },
    { id: 'motivo',      label: 'Motivo del reclamo',       placeholder: 'Ej: Cobro indebido en factura' },
    { id: 'descripcion', label: 'Descripción detallada',    placeholder: 'Explique los hechos con detalle...', multiline: true },
    { id: 'solicitud',   label: 'Lo que solicita',          placeholder: 'Ej: Devolución del monto cobrado de más' },
  ],
  denuncia: [
    { id: 'institucion', label: 'Institución receptora',    placeholder: 'Ej: Fiscalía General de la República (FGR)' },
    { id: 'hechos',      label: 'Narración de los hechos',  placeholder: 'Describa los hechos en orden cronológico...', multiline: true },
    { id: 'testigos',    label: 'Testigos (nombres)',        placeholder: 'Ej: Ana García, Pedro Martínez' },
    { id: 'fecha',       label: 'Fecha del hecho',          placeholder: '', type: 'date' },
  ],
}
 
// ── ESTADO DEL FORMULARIO ───────────────────────────────────────────────────
const selectedTemplate = ref('acuerdo')
const formData = ref({})
const isGenerating = ref(false)
const errorMsg = ref('')
 
// Rutas del backend por plantilla
const endpointByTemplate = {
  acuerdo:  '/api/documentos/generar-acuerdo',
  reclamo:  '/api/documentos/generar-reclamo',
  denuncia: '/api/documentos/generar-denuncia',
}
 
const filenameByTemplate = {
  acuerdo:  'acuerdo_amistoso.pdf',
  reclamo:  'carta_reclamo.pdf',
  denuncia: 'denuncia.pdf',
}
 
const activeTemplateData = computed(
  () => templatesConfig.find(t => t.id === selectedTemplate.value) || templatesConfig[0]
)
 
const currentFields = computed(() => fieldsByTemplate[selectedTemplate.value] || [])
 
const seleccionarTemplate = (id) => {
  selectedTemplate.value = id
  formData.value = {}   // limpia el formulario al cambiar de plantilla
  errorMsg.value = ''
}
 
// ── GENERAR PDF ─────────────────────────────────────────────────────────────
const lastGeneratedFilename = ref('')
const lastGeneratedUrl      = ref('')
const fechaGeneracion       = ref('')
const showSuccessModal      = ref(false)
 
const generarDocumento = async () => {
  errorMsg.value   = ''
  isGenerating.value = true
 
  try {
    const endpoint = endpointByTemplate[selectedTemplate.value]
    const validarFormulario = () => {
        for (const field of currentFields.value) {
            if (!formData.value[field.id]) {
                errorMsg.value = `El campo "${field.label}" es obligatorio`
                return false
            }
        }
        return true
    }

    if (!validarFormulario()) {
        isGenerating.value = false
        return
    }
    const payload = buildPayload()
    const response = await axios.post(
        endpoint,
        payload,
        {
            responseType: 'blob'
        }
    )

    const blob = new Blob([response.data], {
    type: 'application/pdf'})
    
    const url = window.URL.createObjectURL(blob)
    const filename =
      filenameByTemplate[selectedTemplate.value]
    
    const a = document.createElement('a')
    a.href = url
    a.download = filename
    document.body.appendChild(a)
    a.click()
    document.body.removeChild(a)

    URL.revokeObjectURL(url)

    // Datos para modal
    lastGeneratedFilename.value = filename
    fechaGeneracion.value = new Date()
      .toLocaleString('es-SV')


    // Mostrar modal de éxito
    showSuccessModal.value = true
 
  } catch (e) {
    console.error('Error generando documento:', e)
    errorMsg.value = 'Ocurrió un error al generar el documento. Verifica los datos e inténtalo de nuevo.'
  } finally {
    isGenerating.value = false
  }
}
 
// Construye el payload según la plantilla activa
const buildPayload = () => {
  const d = formData.value
  if (selectedTemplate.value === 'acuerdo') {
    return {
      fecha:       d.fecha, 
      conductor1:  d.conductor1,
      conductor2:  d.conductor2,
      placa1:      d.placa1,
      placa2:      d.placa2,
      lugar:       d.lugar,
      descripcion: d.descripcion,
      monto:       d.monto,
    }
  }
  if (selectedTemplate.value === 'reclamo') {
    return {
      nombre:      d.nombre,
      dui:         d.dui,
      empresa:     d.empresa,
      motivo:      d.motivo,
      descripcion: d.descripcion,
      solicitud:   d.solicitud,
    }
  }
  if (selectedTemplate.value === 'denuncia') {
    return {
      institucion: d.institucion,
      hechos:      d.hechos,
      testigos:    d.testigos ? d.testigos.split(',').map(t => t.trim()) : [],
      fecha:       d.fecha,
    }
  }
  return d
}
 
const descargarUltimoDoc = () => {
  if (!lastGeneratedUrl.value) return
  const a = document.createElement('a')
  a.href     = lastGeneratedUrl.value
  a.download = lastGeneratedFilename.value
  a.click()
}

const cerrarModal = () => {
  if (lastGeneratedUrl.value) {
    URL.revokeObjectURL(lastGeneratedUrl.value)
    lastGeneratedUrl.value = ''
  }

  showSuccessModal.value = false
}

const verDocumento = (doc) => {
  if (!doc.downloadUrl) {
    alert('No hay documento disponible')
    return
  }

  window.open(doc.downloadUrl, '_blank')
}
 
// ── HELPERS DE FECHA ────────────────────────────────────────────────────────
const formatSelectedDate = (fecha) => {
  if (!fecha) return '___________'
  const [y, m, d] = fecha.split('-')
  const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
  return `${parseInt(d)} de ${meses[parseInt(m) - 1]} de ${y}`
}
 
const formatFechaHoy = () => {
  const hoy = new Date()
  const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre']
  return `${hoy.getDate()} de ${meses[hoy.getMonth()]} de ${hoy.getFullYear()}`
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

.logout { margin-top: auto; color: #991b1b; }

/* MAIN WRAPPER */
.main-wrapper { 
    margin-left: 260px; 
    flex: 1;
    display: flex; 
    flex-direction: column; 
    height: 100vh; 
    min-width: 0;
    position: relative;
    overflow: hidden;
}

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


/* COMPONENT SCROLL BASE */
.view-scroll-content { flex: 1; overflow-y: auto; background: #F8FAFC; scrollbar-width: none; }
.view-scroll-content::-webkit-scrollbar { display: none; }
.container-inner-padding { padding: 30px 40px; display: flex; flex-direction: column; gap: 28px; }

/* REUTILIZACIÓN DE CLASES COMUNES */
.panel-section-label { font-size: 11px; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 14px; }
.text-truncate { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.min-w-none { min-width: 0; }
.border-card { background: white; border: 1px solid rgba(0,0,0,0.07); border-radius: 24px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }

/* VISTA LISTA COMPONENTE */
.header-action-row { display: flex; justify-content: space-between; align-items: center; }
.view-section-main-title { font-size: 24px; font-weight: 700; color: #020617; }
.view-section-subtitle { font-size: 14px; color: #64748B; margin-top: 2px; }
.btn-create-document-primary { background: #7C3AED; color: white; border: none; padding: 12px 20px; border-radius: 12px; font-family: 'Sora'; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; gap: 8px; align-items: center; box-shadow: 0 4px 10px rgba(124, 58, 237, 0.2); transition: 0.2s; }
.btn-create-document-primary:hover { opacity: 0.9; transform: translateY(-1px); }

.layout-two-columns { display: flex; gap: 24px; align-items: flex-start; }
.left-main-stack { flex: 1; display: flex; flex-direction: column; gap: 20px; min-width: 0; }

.search-and-filters-row { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }
.search-input-box-wrapper { flex: 1; min-width: 220px; background: white; border: 1px solid rgba(0,0,0,0.09); border-radius: 12px; padding: 10px 16px; display: flex; align-items: center; gap: 10px; }
.clean-search-field { flex: 1; border: none; outline: none; font-family: 'Sora'; font-size: 14px; color: #111827; }
.filters-pills-row { display: flex; gap: 6px; flex-wrap: wrap; }
.filter-pill-btn { padding: 8px 16px; border-radius: 12px; font-family: 'Sora'; font-size: 12.5px; font-weight: 500; border: 1px solid rgba(0,0,0,0.09); background: white; color: #374151; cursor: pointer; transition: 0.15s; }
.filter-pill-btn.active { background: #7C3AED; color: white; border-color: #7C3AED; }

/* GRID DE DOCUMENTOS */
.documents-grid-layout { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px; }
.document-item-box-card { background: white; border: 1px solid rgba(0,0,0,0.07); border-radius: 24px; padding: 20px; display: flex; flex-direction: column; gap: 16px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); transition: 0.2s; }
.document-item-box-card:hover { border-color: #DDD6FE; box-shadow: 0 4px 20px rgba(124, 58, 237, 0.08); }

.doc-card-top-meta { display: flex; justify-content: space-between; align-items: start; }
.doc-card-icon-square { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.badge-status-pill { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
.badge-status-pill.generado { background: #DBEAFE; color: #1E40AF; }
.badge-status-pill.descargado { background: #DCFCE7; color: #166534; }
.badge-status-pill.borrador { background: #FEF3C7; color: #92400E; }

.doc-card-body-data { display: flex; flex-direction: column; }
.doc-card-title-heading { font-size: 14.5px; font-weight: 700; color: #111827; line-height: 1.4; }
.doc-card-tags-row { display: flex; align-items: center; gap: 8px; margin-top: 8px; flex-wrap: wrap; }
.category-pill-tag { font-size: 11px; font-weight: 500; background: #F1F5F9; color: #475569; padding: 2px 8px; border-radius: 20px; }
.consulta-number-lbl { font-size: 12px; color: #94A3B8; }
.doc-card-footer-info-row { display: flex; justify-content: space-between; font-size: 12px; color: #9CA3AF; margin-top: 10px; }
.footer-calendar-flex { display: flex; align-items: center; gap: 6px; }
.doc-card-divider-line { height: 1px; background: rgba(0,0,0,0.05); }

.doc-card-actions-flex-row { display: flex; gap: 8px; align-items: center; }
.btn-card-action { padding: 8px 14px; border-radius: 10px; font-family: 'Sora'; font-size: 12px; font-weight: 600; cursor: pointer; border: none; display: flex; align-items: center; gap: 6px; }
.btn-card-action.border-btn { background: #F9FAFB; color: #374151; border: 1px solid rgba(0,0,0,0.09); }
.btn-card-action.filled-btn { background: #7C3AED; color: white; flex: 1; justify-content: center; }
.btn-square-share-action { width: 32px; height: 32px; background: #F9FAFB; border: 1px solid rgba(0,0,0,0.09); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94A3B8; cursor: pointer; flex-shrink: 0; }

/* PANELS METRICAS PANEL DERECHO */
.right-summary-sidebar-panels { width: 260px; display: flex; flex-direction: column; gap: 16px; flex-shrink: 0; }
.summary-box-panel { position: relative; overflow: hidden; display: flex; flex-direction: column; }
.top-gradient-stripe-indicator { position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #7C3AED, #4F7CF7); }

.metrics-rows-stack { display: flex; flex-direction: column; gap: 12px; }
.metric-row-item { display: flex; justify-content: space-between; align-items: center; font-size: 13.5px; color: #374151; }
.badge-num-metric { font-size: 11.5px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
.badge-num-metric.blue { background: #DBEAFE; color: #1E40AF; }
.badge-num-metric.yellow { background: #FEF3C7; color: #92400E; }
.badge-num-metric.green { background: #DCFCE7; color: #166534; }

.popular-templates-stack { display: flex; flex-direction: column; gap: 12px; }
.popular-template-row-btn { background: transparent; border: none; text-align: left; display: flex; align-items: center; gap: 10px; cursor: pointer; font-family: 'Sora'; width: 100%; }
.pop-icon-container { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.pop-meta-info h5 { font-size: 12px; font-weight: 600; color: #111827; }
.pop-meta-info p { font-size: 11px; color: #9CA3AF; margin-top: 1px; }
.pop-chevron-arrow { color: #CBD5E1; font-size: 14px; margin-left: auto; }

/* ─────────────────────────────────────────────────────────────────────────────
   VISTA GENERADOR / FORMULARIO (SCREEN B)
   ───────────────────────────────────────────────────────────────────────────── */
.header-navigation-back-node { display: flex; align-items: start; gap: 16px; }
.btn-navigation-back-arrow { font-family: 'Sora'; font-size: 12.5px; font-weight: 600; color: #374151; border: 1px solid rgba(0,0,0,0.1); background: white; padding: 8px 14px; border-radius: 12px; cursor: pointer; display: flex; gap: 6px; align-items: center; flex-shrink: 0; margin-top: 2px; }
.layout-generator-split { display: flex; gap: 24px; align-items: flex-start; }
.generator-left-form-panel { flex: 1; display: flex; flex-direction: column; gap: 20px; min-width: 0; }

.white-card-container { background: white; }
.template-selector-stack-list { display: flex; flex-direction: column; gap: 10px; }
.template-select-row-card { width: 100%; background: #F9FAFB; border: 1px solid rgba(0,0,0,0.07); border-radius: 14px; padding: 12px 16px; display: flex; align-items: center; gap: 14px; text-align: left; font-family: 'Sora'; cursor: pointer; transition: 0.2s; }
.template-select-row-card:hover { border-color: #C4B5FD; background: #FAF8FF; }
.template-select-row-card.active { background: #FAF8FF; border-color: #7C3AED; box-shadow: 0 0 0 1px rgba(124, 58, 237, 0.12); }
.select-icon-square { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.select-meta-text h5 { font-size: 13.5px; font-weight: 700; color: #111827; }
.select-meta-text p { font-size: 11.5px; color: #6B7280; margin-top: 1px; line-height: 1.3; }
.active-check-circle-indicator { width: 18px; height: 18px; background: #7C3AED; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: auto; flex-shrink: 0; }

.current-selected-header-row-pill { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
.pill-avatar-icon { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.current-selected-header-row-pill h5 { font-size: 14px; font-weight: 700; color: #111827; }

.inputs-fields-vertical-stack { display: flex; flex-direction: column; gap: 14px; }
.input-group-element-box { display: flex; flex-direction: column; gap: 6px; }
.input-group-element-box label { font-size: 12px; font-weight: 500; color: #374151; }
.doc-input { width: 100%; padding: 10px 14px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.1); background: #F9FAFB; font-family: 'Sora'; font-size: 13px; color: #111827; transition: 0.15s; }
.doc-input:focus { outline: none; border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12); }
.native-textarea-element { resize: none; }

.form-actions-buttons-row { display: flex; gap: 12px; margin-top: 24px; }
.btn-form-action-trigger { flex: 1; padding: 12px; border-radius: 12px; font-family: 'Sora'; font-size: 13.5px; font-weight: 600; cursor: pointer; border: none; transition: 0.2s; }
.btn-form-action-trigger.purple-filled { background: #7C3AED; color: white; box-shadow: 0 4px 6px rgba(124, 58, 237, 0.15); }
.btn-form-action-trigger.purple-filled:hover { opacity: 0.9; }
.btn-form-action-trigger.white-bordered { background: white; color: #374151; border: 1px solid rgba(0,0,0,0.1); }
.btn-form-action-trigger.white-bordered:hover { background: #F9FAFB; }

/* COLUMNA DE VISTA PREVIA RIGIDA */
.generator-right-preview-panel { width: 320px; display: flex; flex-direction: column; gap: 16px; flex-shrink: 0; }
.preview-document-rigid-box { background: white; border-radius: 24px; overflow: hidden; display: flex; flex-direction: column; }
.preview-box-header-top { padding: 16px 20px; border-bottom: 1px solid rgba(0,0,0,0.06); display: flex; justify-content: space-between; align-items: start; }
.preview-box-header-top h5 { font-size: 12px; font-weight: 700; color: #020617; }
.preview-box-header-top p { font-size: 10.5px; color: #94A3B8; margin-top: 1px; line-height: 1.3; }
.preview-hash-badge-status { background: #EFF6FF; color: #1E40AF; font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 20px; display: flex; align-items: center; gap: 4px; flex-shrink: 0; }

/* HOJA DE PREVISUALIZACION INTERNA */
.preview-sheet-body-content { padding: 24px 20px; font-size: 11.5px; line-height: 1.6; color: #111827; display: flex; flex-direction: column; gap: 12px; min-height: 320px; position: relative; }
.sheet-center-header-title { display: flex; flex-direction: column; align-items: center; margin-bottom: 8px; }
.sheet-main-uppercase-heading { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #020617; }
.sheet-decor-accent-line { width: 50px; height: 1.5px; background: #7C3AED; margin-top: 4px; }
.sheet-paragraphs-stack-flow { display: flex; flex-direction: column; gap: 10px; }
.sheet-date-stamp-txt { color: #6B7280; margin-bottom: 2px; }
.sheet-description-p-block { color: #374151; background: #F8FAFC; padding: 8px 10px; border-radius: 8px; border-left: 2px solid #CBD5E1; }
.purple-emphasis-monto { color: #7C3AED; font-weight: 700; }

.sheet-signatures-double-row { display: flex; gap: 16px; margin-top: 16px; border-top: 1px solid rgba(0,0,0,0.06); padding-top: 12px; }
.signature-block-field { flex: 1; text-align: center; display: flex; flex-direction: column; gap: 4px; }
.line-sig { height: 1px; background: #CBD5E1; width: 100%; }
.signature-block-field p { color: #6B7280; font-size: 10.5px; }
.container-left-sig { max-width: 130px; text-align: left; }

.sheet-system-watermark-footer { text-align: center; color: #9CA3AF; font-size: 9.5px; margin-top: auto; padding-top: 16px; }

.preview-external-actions-column-stack { display: flex; flex-direction: column; gap: 8px; }
.btn-preview-action-block { width: 100%; padding: 12px; border-radius: 12px; border: none; font-family: 'Sora'; font-size: 13.5px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; transition: 0.2s; }
.btn-preview-action-block.purple-filled { background: #7C3AED; color: white; box-shadow: 0 4px 6px rgba(124, 58, 237, 0.15); }
.preview-action-double-row-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.btn-preview-row-action-white { background: white; color: #374151; border: 1px solid rgba(0,0,0,0.1); padding: 8px; border-radius: 10px; font-family: 'Sora'; font-size: 11.5px; font-weight: 500; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; }

/* ─────────────────────────────────────────────────────────────────────────────
   MODAL POPUP EXITO COMPONENTE (SCREEN C)
   ───────────────────────────────────────────────────────────────────────────── */
.modal-stripe-deco { height: 4px; width: 100%; background: linear-gradient(90deg, #7C3AED, #4F7CF7); }
.lb-gen-overlay { position: fixed; inset: 0; background: rgba(2, 6, 23, 0.55); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; z-index: 2000; animation: fadeArea 0.2s ease both; }
.lb-gen-modal { background: white; animation: scaleModal 0.25s cubic-bezier(0.34, 1.2, 0.64, 1) both; }

.lb-check-icon { background: linear-gradient(135deg, #7C3AED, #4F7CF7); display: flex; align-items: center; justify-content: center; }
.success-modal-heading-title { font-size: 19px; font-weight: 700; color: #020617; }
.success-modal-heading-subtitle { font-size: 13.5px; color: #64748B; margin-top: 2px; }
.split-divider-line { height: 1px; background: rgba(0,0,0,0.06); }

.success-inner-document-mini-card-preview { background: #F9FAFB; border: 1px solid rgba(0,0,0,0.07); border-radius: 16px; padding: 16px; display: flex; gap: 14px; align-items: start; }
.success-card-pdf-icon-bg { width: 44px; height: 44px; background: #F0FDF4; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.success-card-meta-details-flex-info { flex: 1; display: flex; flex-direction: column; }
.success-card-top-title-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap; }
.success-card-top-title-row h4 { font-size: 13.5px; font-weight: 700; color: #111827; }
.success-badge-tag-pill { font-size: 11px; font-weight: 500; background: #DCFCE7; color: #166534; padding: 1px 8px; border-radius: 20px; flex-shrink: 0; }
.success-card-rows-meta-attributes-stack { display: flex; flex-direction: column; gap: 6px; margin-top: 10px; }
.attribute-row-item-flex { display: flex; align-items: center; gap: 6px; font-size: 11.5px; color: #374151; }
.attribute-row-item-flex span { color: #9CA3AF; }

.success-modal-footer-actions-stack { display: flex; flex-direction: column; gap: 10px; }
.btn-success-modal-block-action { width: 100%; padding: 12px; border-radius: 12px; border: none; font-family: 'Sora'; font-size: 13.5px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
.btn-success-modal-block-action.purple-filled { background: #7C3AED; color: white; box-shadow: 0 4px 6px rgba(124, 58, 237, 0.15); }
.success-modal-double-row-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.btn-success-modal-row-action-white { background: white; color: #374151; border: 1px solid rgba(0,0,0,0.09); padding: 10px; border-radius: 12px; font-family: 'Sora'; font-size: 12.5px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; }
.btn-success-modal-cancel-text { background: transparent; border: none; font-family: 'Sora'; font-size: 13px; color: #94A3B8; font-weight: 500; cursor: pointer; margin-top: 4px; }

@keyframes fadeArea { from { opacity: 0; } to { opacity: 1; } }
@keyframes scaleModal { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }


</style>