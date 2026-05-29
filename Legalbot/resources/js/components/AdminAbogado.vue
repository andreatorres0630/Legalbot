<template>
  <div class="admin-layout">
    <!-- Sidebar Izquierdo Fijo (Estilo LegalBot) -->
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
        <a href="/dashboard" class="nav-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
          Dashboard
        </a>
        <a href="/usuarios" class="nav-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
          Gestión de Usuarios
        </a>
        <a href="/abogados" class="nav-item active">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
          </svg>
          Gestión de Abogados
        </a>
        <a href="#" class="nav-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
          </svg>
          Gestión de Consultas
        </a>
        <a href="#" class="nav-item">
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

    <!-- Main -->
    <main class="main-content">
      <div class="page-header">
        <div>
          <h1 class="page-title">Gestión de Abogados</h1>
          <p class="page-subtitle">Administra el directorio legal registrado en la plataforma</p>
        </div>
        <button class="btn-nuevo" @click="abrirModal">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Nuevo abogado
        </button>
      </div>

      <!-- Filters -->
      <div class="filters-bar">
        <div class="search-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input v-model="busqueda" type="text" class="search-input" placeholder="Buscar abogado..." />
        </div>
        <select v-model="filtroEspecialidad" class="select-filter">
          <option value="">Todas las especialidades</option>
          <option>Derecho Civil</option>
          <option>Derecho Penal</option>
          <option>Derecho Laboral</option>
          <option>Derecho de Familia</option>
          <option>Derecho Mercantil</option>
          <option>Derecho Tributario</option>
        </select>
      </div>

      <!-- Stats -->
      <div class="stats-row">
        <div class="stat-pill">
          <div class="stat-icon-sm blue">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            </svg>
          </div>
          <div>
            <p class="stat-label">Total Abogados</p>
            <p class="stat-val">{{ abogados.length }}</p>
          </div>
        </div>
        <div class="stat-pill">
          <div class="stat-icon-sm green">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
          </div>
          <div>
            <p class="stat-label">Activos</p>
            <p class="stat-val">{{ abogados.filter(a => a.disponible).length }}</p>
          </div>
        </div>
        <div class="stat-pill">
          <div class="stat-icon-sm amber">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
          </div>
          <div>
            <p class="stat-label">Pendientes</p>
            <p class="stat-val">1</p>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="table-card">
        <table class="data-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Especialidad</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="abogado in abogadosFiltrados" :key="abogado.id">
              <td class="cell-id">#{{ abogado.id }}</td>
              <td class="cell-nombre">{{ abogado.nombre }}</td>
              <td>{{ abogado.especialidad }}</td>
              <td class="cell-correo">{{ abogado.correo }}</td>
              <td>{{ abogado.telefono }}</td>
              <td>
                <span :class="['badge-estado', abogado.estado.toLowerCase()]">{{ abogado.estado }}</span>
              </td>
              <td>
                <div class="acciones">
                  <button class="btn-accion ver" title="Ver" @click="editarAbogado(abogado)">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                  </button>
                  <button class="btn-accion editar" title="Editar" @click="editarAbogado(abogado)">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                  </button>
                  <button class="btn-accion eliminar" title="Eliminar" @click="eliminarAbogado(abogado)">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                      <path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modal Nuevo Abogado -->
      <div v-if="modalAbierto" class="modal-backdrop" @click.self="cerrarModal">
        <div class="modal">
          <div class="modal-header">
            <h3 class="modal-title">{{ modoEdicion ? 'Editar abogado' : 'Nuevo abogado' }}</h3>
            <button class="modal-close" @click="cerrarModal">×</button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group">
                <label>Nombre completo</label>
                <input v-model="abogadoForm.nombre" type="text" placeholder="Ej. Lic. Roberto Flores" />
              </div>
              <div class="form-group">
                <label>Especialidad</label>
                <input v-model="abogadoForm.especialidad" type="text" placeholder="Ej. Penalista" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Teléfono</label>
                <input v-model="abogadoForm.telefono" type="text" placeholder="2200-0000" />
              </div>
              <div class="form-group">
                <label>WhatsApp</label>
                <input v-model="abogadoForm.whatsapp" type="text" placeholder="7000-0000" />
              </div>
            </div>
            <div class="form-group">
              <label>Correo electrónico</label>
              <input v-model="abogadoForm.correo" type="email" placeholder="abogado@legalbot.sv" />
            </div>
            <div class="form-group">
              <label>Dirección</label>
              <input v-model="abogadoForm.direccion" type="text" placeholder="San Miguel, El Salvador" />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Disponible</label>
                <select v-model="abogadoForm.disponible">
                  <option :value="true">Sí</option>
                  <option :value="false">No</option>
                </select>
              </div>
              <div class="form-group">
                <label>Verificado</label>
                <select v-model="abogadoForm.verificado">
                  <option :value="false">No</option>
                  <option :value="true">Sí</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn-cancelar" @click="cerrarModal">Cancelar</button>
            <button class="btn-guardar" @click="guardarAbogado">{{ modoEdicion ? 'Guardar cambios' : 'Guardar abogado' }}</button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'GestionAbogadosView',
  data() {
    return {
      busqueda: '',
      filtroEspecialidad: '',
      modalAbierto: false,
      modoEdicion: false,
      abogadoForm: {
        id: null,
        nombre: '',
        especialidad: '',
        telefono: '',
        whatsapp: '',
        correo: '',
        direccion: '',
        disponible: true,
        verificado: false
      },
      abogados: []
    }
  },
  computed: {
    abogadosFiltrados() {
      return this.abogados.filter(a => {
        const texto = `${a.nombre} ${a.especialidad} ${a.correo}`.toLowerCase();
        const matchBusqueda = texto.includes(this.busqueda.toLowerCase());
        const matchEspecialidad = !this.filtroEspecialidad || a.especialidad === this.filtroEspecialidad;
        return matchBusqueda && matchEspecialidad;
      });
    }
  },
  mounted() {
    this.fetchAbogados();
  },
  methods: {
    mapAbogado(data) {
      return {
        id: data.id,
        nombre: data.nombre,
        especialidad: data.especialidad || '',
        telefono: data.telefono || '',
        whatsapp: data.whatsapp || '',
        correo: data.email || data.correo || '',
        direccion: data.direccion || '',
        disponible: Boolean(data.disponible),
        verificado: Boolean(data.verificado),
        estado: data.estado || (data.disponible ? 'Activo' : 'Inactivo')
      };
    },
    async fetchAbogados() {
      try {
        const response = await axios.get('/abogados/list');
        this.abogados = response.data.map(this.mapAbogado);
      } catch (error) {
        console.error('Error cargando abogados:', error);
      }
    },
    abrirModal(abogado = null) {
      if (abogado) {
        this.modoEdicion = true;
        this.abogadoForm = {
          id: abogado.id,
          nombre: abogado.nombre,
          especialidad: abogado.especialidad,
          telefono: abogado.telefono,
          whatsapp: abogado.whatsapp,
          correo: abogado.correo,
          direccion: abogado.direccion,
          disponible: abogado.disponible,
          verificado: abogado.verificado
        };
      } else {
        this.modoEdicion = false;
        this.abogadoForm = {
          id: null,
          nombre: '',
          especialidad: '',
          telefono: '',
          whatsapp: '',
          correo: '',
          direccion: '',
          disponible: true,
          verificado: false
        };
      }
      this.modalAbierto = true;
    },
    cerrarModal() {
      this.modalAbierto = false;
      this.modoEdicion = false;
      this.abogadoForm = {
        id: null,
        nombre: '',
        especialidad: '',
        telefono: '',
        whatsapp: '',
        correo: '',
        direccion: '',
        disponible: true,
        verificado: false
      };
    },
    async guardarAbogado() {
      try {
        const payload = {
          nombre: this.abogadoForm.nombre,
          especialidad: this.abogadoForm.especialidad,
          telefono: this.abogadoForm.telefono,
          whatsapp: this.abogadoForm.whatsapp,
          correo: this.abogadoForm.correo,
          direccion: this.abogadoForm.direccion,
          disponible: this.abogadoForm.disponible ? 1 : 0,
          verificado: this.abogadoForm.verificado ? 1 : 0,
        };

        let response;
        if (this.modoEdicion && this.abogadoForm.id) {
          response = await axios.put(`/abogados/${this.abogadoForm.id}`, payload);
          const index = this.abogados.findIndex(a => a.id === this.abogadoForm.id);
          if (index !== -1) {
            this.$set(this.abogados, index, this.mapAbogado(response.data));
          }
        } else {
          response = await axios.post('/abogados', payload);
          this.abogados.unshift(this.mapAbogado(response.data));
        }

        this.cerrarModal();
      } catch (error) {
        console.error('Error guardando abogado:', error);
        alert(error.response?.data?.message || 'No se pudo guardar el abogado.');
      }
    },
    editarAbogado(abogado) {
      this.abrirModal(abogado);
    },
    async eliminarAbogado(abogado) {
      if (!confirm(`¿Eliminar al abogado ${abogado.nombre}?`)) {
        return;
      }

      try {
        await axios.delete(`/abogados/${abogado.id}`);
        this.abogados = this.abogados.filter(a => a.id !== abogado.id);
      } catch (error) {
        console.error('Error eliminando abogado:', error);
        alert('No se pudo eliminar el abogado.');
      }
    },
    async handleLogout() {
      const confirmed = confirm('¿Estás seguro que quieres cerrar sesión?')
      
      if (!confirmed) {
        return
      }

      try {
        await axios.post('/logout', {
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        });
        window.location.href = '/login';
      } catch (error) {
        console.error('Error al cerrar sesión:', error);
        window.location.href = '/login';
      }
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

* { box-sizing: border-box; margin: 0; padding: 0; }

.admin-layout {
  display: flex; min-height: 100vh;
  font-family: 'Sora', sans-serif; background: #f3f4f6;
}

.sidebar {
  width: 210px; min-height: 100vh; background: #0f172a;
  display: flex; flex-direction: column;
  position: fixed; left: 0; top: 0; bottom: 0; z-index: 100;
}
.sidebar-brand {
  display: flex; align-items: center; gap: 10px;
  padding: 22px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.07);
}
.brand-icon {
  width: 36px; height: 36px; background: #7c6ff7; border-radius: 8px;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.brand-name { font-size: 15px; font-weight: 700; color: #fff; line-height: 1.2; }
.brand-sub  { font-size: 11px; color: rgba(255,255,255,0.4); font-weight: 300; }
.sidebar-nav { display: flex; flex-direction: column; padding: 16px 12px; gap: 2px; flex: 1; }
.nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px; border-radius: 8px;
  font-size: 13px; font-weight: 400; color: rgba(255,255,255,0.55);
  text-decoration: none; transition: background 0.15s, color 0.15s; cursor: pointer;
}
.nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
.nav-item.active { background: #7c6ff7; color: #fff; font-weight: 500; }
.sidebar-logout { padding: 12px; border-top: 1px solid rgba(255,255,255,0.07); }
.logout-item { color: rgba(255,100,100,0.7); }

.main-content { margin-left: 210px; flex: 1; padding: 36px 32px; min-height: 100vh; }

.page-header {
  display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px;
}
.page-title  { font-size: 26px; font-weight: 700; color: #111827; letter-spacing: -0.02em; }
.page-subtitle { font-size: 13px; color: #6b7280; margin-top: 4px; font-weight: 300; }

.btn-nuevo {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 18px; background: #7c6ff7; color: #fff;
  border: none; border-radius: 8px; font-size: 13px; font-weight: 600;
  font-family: 'Sora', sans-serif; cursor: pointer; transition: background 0.2s;
  white-space: nowrap;
}
.btn-nuevo:hover { background: #6358e8; }

.filters-bar { display: flex; gap: 12px; margin-bottom: 20px; }
.search-wrap {
  flex: 1; display: flex; align-items: center; gap: 10px;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0 14px;
}
.search-input {
  flex: 1; border: none; outline: none; font-size: 13px;
  font-family: 'Sora', sans-serif; color: #111827; padding: 11px 0;
  background: transparent;
}
.select-filter {
  padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px;
  font-size: 13px; font-family: 'Sora', sans-serif; color: #374151;
  background: #fff; outline: none; cursor: pointer;
}

.stats-row { display: flex; gap: 14px; margin-bottom: 20px; }
.stat-pill {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
  padding: 14px 18px; display: flex; align-items: center; gap: 12px; flex: 1;
}
.stat-icon-sm {
  width: 36px; height: 36px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.stat-icon-sm.blue   { background: #eff6ff; color: #2563eb; }
.stat-icon-sm.green  { background: #f0fdf4; color: #16a34a; }
.stat-icon-sm.amber  { background: #fffbeb; color: #d97706; }
.stat-label { font-size: 11px; color: #6b7280; }
.stat-val   { font-size: 22px; font-weight: 700; color: #111827; line-height: 1.2; }

.table-card {
  background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;
}
.data-table { width: 100%; border-collapse: collapse; }
.data-table thead tr { background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
.data-table th {
  padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 600;
  color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;
}
.data-table td { padding: 14px 16px; font-size: 13px; color: #374151; border-bottom: 1px solid #f3f4f6;}

.cell-id { font-weight: 600; color: #6b7280; }
.cell-nombre { font-weight: 500; color: #111827; }
.cell-correo { color: #6b7280; }

.badge-estado {
  display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;
}
.badge-estado.activo   { background: #f0fdf4; color: #16a34a; }
.badge-estado.inactivo { background: #f3f4f6; color: #6b7280; }
.badge-estado.pendiente{ background: #fffbeb; color: #d97706; }

.acciones { display: flex; gap: 6px; align-items: center; }
.btn-accion {
  width: 30px; height: 30px; border: none; border-radius: 6px; cursor: pointer;
  display: flex; align-items: center; justify-content: center; transition: background 0.15s;
}
.btn-accion.ver     { background: #eff6ff; color: #2563eb; }
.btn-accion.editar  { background: #f3f0ff; color: #7c3aed; }
.btn-accion.eliminar{ background: #fef2f2; color: #dc2626; }

.modal-backdrop {
  position: fixed; inset: 0; background: rgba(0,0,0,0.45);
  display: flex; align-items: center; justify-content: center; z-index: 200;
}
.modal {
  background: #fff; border-radius: 14px; width: 560px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15); overflow: hidden;
}
.modal-header {
  display: flex; align-items: center; justify-content: space-between;
  padding: 20px 24px; border-bottom: 1px solid #e5e7eb;
}
.modal-title { font-size: 16px; font-weight: 600; color: #111827; }
.modal-close {
  background: none; border: none; cursor: pointer; color: #9ca3af; font-size: 24px;
}
.modal-body { padding: 24px; display: flex; flex-direction: column; gap: 16px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group label { font-size: 13px; font-weight: 500; color: #374151; }
.form-group input, .form-group select {
  padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px;
  font-size: 13px; font-family: 'Sora', sans-serif; color: #111827; outline: none;
}
.form-group input:focus, .form-group select:focus { border-color: #7c6ff7; }
.modal-footer {
  display: flex; justify-content: flex-end; gap: 10px;
  padding: 16px 24px; border-top: 1px solid #e5e7eb;
}
.btn-cancelar {
  padding: 9px 18px; border: 1px solid #e5e7eb; border-radius: 8px;
  background: #fff; font-size: 13px; font-weight: 500; font-family: 'Sora', sans-serif;
  color: #374151; cursor: pointer;
}
.btn-guardar {
  padding: 9px 18px; background: #7c6ff7; border: none; border-radius: 8px;
  font-size: 13px; font-weight: 600; font-family: 'Sora', sans-serif;
  color: #fff; cursor: pointer;
}
</style>