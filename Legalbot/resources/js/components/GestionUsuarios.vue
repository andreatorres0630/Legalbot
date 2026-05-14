<template>
  <div class="admin-layout">

    <!-- Sidebar -->
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
        <a href="#" class="nav-item">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
          </svg>
          Dashboard
        </a>
        <a href="#" class="nav-item active">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
          Gestión de Usuarios
        </a>
        <a href="#" class="nav-item">
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
        <a href="#" class="nav-item logout-item">
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
          <h1 class="page-title">Gestión de Usuarios</h1>
          <p class="page-subtitle">Administra los usuarios registrados en la plataforma</p>
        </div>
        <button class="btn-nuevo" @click="abrirModal">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Nuevo usuario
        </button>
      </div>

      <!-- Filters -->
      <div class="filters-bar">
        <div class="search-wrap">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input
            v-model="busqueda"
            type="text"
            class="search-input"
            placeholder="Buscar usuario..."
          />
        </div>
        <select v-model="filtroRol" class="select-filter">
          <option value="">Todos los roles</option>
          <option value="Admin">Admin</option>
          <option value="Usuario">Usuario</option>
          <option value="Abogado">Abogado</option>
        </select>
      </div>

      <!-- Stats -->
      <div class="stats-row">
        <div class="stat-pill">
          <div class="stat-icon-sm blue">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
          </div>
          <div>
            <p class="stat-label">Total Usuarios</p>
            <p class="stat-val">{{ usuarios.length }}</p>
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
            <p class="stat-val">{{ usuarios.filter(u => u.estado === 'Activo').length }}</p>
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
            <p class="stat-val">{{ usuarios.filter(u => u.estado === 'Pendiente').length }}</p>
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
              <th>Correo</th>
              <th>Rol</th>
              <th>Teléfono</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="usuario in usuariosFiltrados" :key="usuario.id">
              <td class="cell-id">{{ usuario.id }}</td>
              <td class="cell-nombre">{{ usuario.nombre }}</td>
              <td class="cell-correo">{{ usuario.correo }}</td>
              <td>
                <span :class="['badge-rol', usuario.rol.toLowerCase()]">{{ usuario.rol }}</span>
              </td>
              <td>{{ usuario.telefono }}</td>
              <td>
                <span :class="['badge-estado', usuario.estado.toLowerCase()]">{{ usuario.estado }}</span>
              </td>
              <td>
                <div class="acciones">
                  <button class="btn-accion ver" title="Ver">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                  </button>
                  <button class="btn-accion editar" title="Editar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                  </button>
                  <button class="btn-accion eliminar" title="Eliminar">
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

      <!-- Modal nuevo usuario -->
      <div v-if="modalAbierto" class="modal-backdrop" @click.self="cerrarModal">
        <div class="modal">
          <div class="modal-header">
            <h3 class="modal-title">Nuevo usuario</h3>
            <button class="modal-close" @click="cerrarModal">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group">
                <label>Nombre completo</label>
                <input v-model="nuevoUsuario.nombre" type="text" placeholder="Ej. Juan Pérez" />
              </div>
              <div class="form-group">
                <label>Correo electrónico</label>
                <input v-model="nuevoUsuario.correo" type="email" placeholder="correo@ejemplo.com" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Teléfono</label>
                <input v-model="nuevoUsuario.telefono" type="text" placeholder="2234-5678" />
              </div>
              <div class="form-group">
                <label>Rol</label>
                <select v-model="nuevoUsuario.rol">
                  <option value="">Seleccionar rol</option>
                  <option>Admin</option>
                  <option>Usuario</option>
                  <option>Abogado</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn-cancelar" @click="cerrarModal">Cancelar</button>
            <button class="btn-guardar" @click="guardarUsuario">Guardar usuario</button>
          </div>
        </div>
      </div>

    </main>
  </div>
</template>

<script>
export default {
  name: 'GestionUsuariosView',
  data() {
    return {
      busqueda: '',
      filtroRol: '',
      modalAbierto: false,
      nuevoUsuario: { nombre: '', correo: '', telefono: '', rol: '' },
      usuarios: [
        { id: '#001', nombre: 'Admin Sistema',    correo: 'admin@legalbot.sv',    rol: 'Admin',   telefono: '2200-0001', estado: 'Activo' },
        { id: '#002', nombre: 'María López',      correo: 'maria@legalbot.sv',    rol: 'Usuario', telefono: '2234-5678', estado: 'Activo' },
        { id: '#003', nombre: 'Carlos Rivas',     correo: 'carlos@legalbot.sv',   rol: 'Usuario', telefono: '2245-6789', estado: 'Pendiente' },
        { id: '#004', nombre: 'Ana Martínez',     correo: 'ana@legalbot.sv',      rol: 'Abogado', telefono: '2256-7890', estado: 'Activo' },
        { id: '#005', nombre: 'José Hernández',   correo: 'jose@legalbot.sv',     rol: 'Usuario', telefono: '2267-8901', estado: 'Inactivo' },
        { id: '#006', nombre: 'Laura Castillo',   correo: 'laura@legalbot.sv',    rol: 'Usuario', telefono: '2278-9012', estado: 'Activo' },
        { id: '#007', nombre: 'Pedro Morales',    correo: 'pedro@legalbot.sv',    rol: 'Abogado', telefono: '2289-0123', estado: 'Pendiente' },
        { id: '#008', nombre: 'Sofia Guzmán',     correo: 'sofia@legalbot.sv',    rol: 'Usuario', telefono: '2290-1234', estado: 'Activo' },
      ]
    }
  },
  computed: {
    usuariosFiltrados() {
      return this.usuarios.filter(u => {
        const matchBusqueda = u.nombre.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                              u.correo.toLowerCase().includes(this.busqueda.toLowerCase())
        const matchRol = !this.filtroRol || u.rol === this.filtroRol
        return matchBusqueda && matchRol
      })
    }
  },
  methods: {
    abrirModal() { this.modalAbierto = true },
    cerrarModal() {
      this.modalAbierto = false
      this.nuevoUsuario = { nombre: '', correo: '', telefono: '', rol: '' }
    },
    guardarUsuario() {
      console.log('Guardar usuario:', this.nuevoUsuario)
      // Aquí el backend conectará el POST
      this.cerrarModal()
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

/* ── SIDEBAR (igual que Dashboard) ── */
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
.logout-item:hover { background: rgba(255,80,80,0.1); color: rgba(255,120,120,0.9); }

/* ── MAIN ── */
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

/* Filters */
.filters-bar {
  display: flex; gap: 12px; margin-bottom: 20px;
}
.search-wrap {
  flex: 1; display: flex; align-items: center; gap: 10px;
  background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 0 14px;
}
.search-input {
  flex: 1; border: none; outline: none; font-size: 13px;
  font-family: 'Sora', sans-serif; color: #111827; padding: 11px 0;
  background: transparent;
}
.search-input::placeholder { color: #9ca3af; }
.select-filter {
  padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 8px;
  font-size: 13px; font-family: 'Sora', sans-serif; color: #374151;
  background: #fff; outline: none; cursor: pointer;
}

/* Stats row */
.stats-row { display: flex; gap: 14px; margin-bottom: 20px; }
.stat-pill {
  background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
  padding: 14px 18px; display: flex; align-items: center; gap: 12px;
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

/* Table */
.table-card {
  background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;
}
.data-table { width: 100%; border-collapse: collapse; }
.data-table thead tr { background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
.data-table th {
  padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 600;
  color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;
}
.data-table tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.1s; }
.data-table tbody tr:last-child { border-bottom: none; }
.data-table tbody tr:hover { background: #fafafa; }
.data-table td { padding: 14px 16px; font-size: 13px; color: #374151; }

.cell-id { font-weight: 600; color: #6b7280; }
.cell-nombre { font-weight: 500; color: #111827; }
.cell-correo { color: #6b7280; }

.badge-estado, .badge-rol {
  display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;
}
.badge-estado.activo   { background: #f0fdf4; color: #16a34a; }
.badge-estado.inactivo { background: #f3f4f6; color: #6b7280; }
.badge-estado.pendiente{ background: #fffbeb; color: #d97706; }
.badge-rol.admin   { background: #f3f0ff; color: #7c3aed; }
.badge-rol.usuario { background: #eff6ff; color: #2563eb; }
.badge-rol.abogado { background: #f0fdf4; color: #16a34a; }

.acciones { display: flex; gap: 6px; align-items: center; }
.btn-accion {
  width: 30px; height: 30px; border: none; border-radius: 6px; cursor: pointer;
  display: flex; align-items: center; justify-content: center; transition: background 0.15s;
}
.btn-accion.ver     { background: #eff6ff; color: #2563eb; }
.btn-accion.editar  { background: #f3f0ff; color: #7c3aed; }
.btn-accion.eliminar{ background: #fef2f2; color: #dc2626; }
.btn-accion:hover   { opacity: 0.8; }

/* Modal */
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
  background: none; border: none; cursor: pointer; color: #9ca3af;
  display: flex; align-items: center; padding: 4px; border-radius: 6px;
}
.modal-close:hover { background: #f3f4f6; color: #374151; }
.modal-body { padding: 24px; display: flex; flex-direction: column; gap: 16px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group label { font-size: 13px; font-weight: 500; color: #374151; }
.form-group input, .form-group select {
  padding: 10px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px;
  font-size: 13px; font-family: 'Sora', sans-serif; color: #111827; outline: none;
  transition: border-color 0.2s;
}
.form-group input:focus, .form-group select:focus { border-color: #7c6ff7; }
.form-group input::placeholder { color: #9ca3af; }
.modal-footer {
  display: flex; justify-content: flex-end; gap: 10px;
  padding: 16px 24px; border-top: 1px solid #e5e7eb;
}
.btn-cancelar {
  padding: 9px 18px; border: 1px solid #e5e7eb; border-radius: 8px;
  background: #fff; font-size: 13px; font-weight: 500; font-family: 'Sora', sans-serif;
  color: #374151; cursor: pointer; transition: background 0.15s;
}
.btn-cancelar:hover { background: #f9fafb; }
.btn-guardar {
  padding: 9px 18px; background: #7c6ff7; border: none; border-radius: 8px;
  font-size: 13px; font-weight: 600; font-family: 'Sora', sans-serif;
  color: #fff; cursor: pointer; transition: background 0.2s;
}
.btn-guardar:hover { background: #6358e8; }
</style>