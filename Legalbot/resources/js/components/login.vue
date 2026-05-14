<template>
  <div class="login-page">

    <div class="bg-overlay"></div>

    <div class="top-bar">
      <span>Iniciar Sesión</span>
    </div>

    <div class="left-section">
      <div class="brand">
        <div class="brand-icon">
          <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M12 3L3 8.5V15.5L12 21L21 15.5V8.5L12 3Z"/>
            <path d="M8 12H16M10 9L14 15M14 9L10 15"/>
          </svg>
        </div>
        <div>
          <h1 class="brand-name">LegalBot</h1>
          <p class="brand-tagline">Tu asistente legal comunitario</p>
        </div>
      </div>

      <div class="bottom-icons">
        <div class="icon-box">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <div class="icon-line"></div>
        </div>
        <div class="icon-box">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
            <path d="M13 6H5l-3 7h15l-3-7zM13 6l4 7"/>
          </svg>
          <div class="icon-line"></div>
        </div>
        <div class="icon-box">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <rect x="2" y="7" width="20" height="14" rx="2"/>
            <path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
          </svg>
          <div class="icon-line"></div>
        </div>
        <div class="icon-box">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <div class="icon-line"></div>
        </div>
      </div>
    </div>

    <div class="login-card-wrapper">
      <div class="login-card">
        <h2 class="card-title">Iniciar Sesión</h2>

        <div class="field-group">
          <label class="field-label">Usuario</label>
          <input
            v-model="form.usuario"
            type="text"
            class="field-input"
            placeholder="Ingresa tu usuario"
          />
        </div>

        <div class="field-group">
          <label class="field-label">Contraseña</label>
          <input
            v-model="form.contrasena"
            type="password"
            class="field-input"
            placeholder="Ingresa tu contraseña"
          />
        </div>

        <button class="btn-ingresar" @click="handleLogin">
          Ingresar
        </button>

        <p class="register-text">¿No tienes cuenta? ¡Regístrate!</p>

        <button class="btn-registrar">
          Regístrate aquí
        </button>
      </div>
    </div>

    <div class="right-deco">
      <div class="scales-icon">
        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="0.8">
          <path d="M12 3v1m0 0l-4 8h8l-4-8zM8 11H4l4 8m8-8h4l-4 8M12 4v16m-4 0h8"/>
        </svg>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'LoginView',
  data() {
    return {
      form: {
        usuario: '',
        contrasena: ''
      }
    }
  },
  methods: {
    handleLogin() {
      console.log('Login con:', this.form)
      // Aquí el backend conectará la autenticación
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.login-page {
  min-height: 100vh;
  width: 100%;
  background: linear-gradient(135deg, #0a1628 0%, #0d1f4a 40%, #0f2660 70%, #1a1060 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
  font-family: 'Sora', sans-serif;
}

.bg-overlay {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 60% 50% at 20% 50%, rgba(30, 60, 180, 0.25) 0%, transparent 70%),
    radial-gradient(ellipse 40% 60% at 80% 40%, rgba(100, 60, 200, 0.15) 0%, transparent 70%);
  pointer-events: none;
}

.top-bar {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  padding: 12px 20px;
  background: rgba(0,0,0,0.25);
  color: rgba(255,255,255,0.7);
  font-size: 13px;
  font-weight: 400;
  letter-spacing: 0.02em;
  z-index: 10;
}

.left-section {
  position: absolute;
  left: 48px;
  top: 0;
  bottom: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding-bottom: 60px;
  z-index: 5;
}

.brand {
  display: flex;
  align-items: center;
  gap: 14px;
}

.brand-icon {
  width: 54px;
  height: 54px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid rgba(255,255,255,0.2);
}

.brand-name {
  font-size: 28px;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: -0.01em;
  line-height: 1.1;
}

.brand-tagline {
  font-size: 13px;
  color: rgba(255,255,255,0.6);
  font-weight: 300;
  margin-top: 2px;
}

.bottom-icons {
  position: absolute;
  bottom: 60px;
  left: 0;
  display: flex;
  gap: 12px;
}

.icon-box {
  width: 64px;
  height: 64px;
  border: 1px solid rgba(255,255,255,0.25);
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: rgba(255,255,255,0.05);
  cursor: pointer;
  transition: background 0.2s;
}

.icon-box:hover {
  background: rgba(255,255,255,0.1);
}

.icon-line {
  width: 32px;
  height: 2px;
  background: rgba(255,255,255,0.35);
  border-radius: 2px;
}

.login-card-wrapper {
  position: relative;
  z-index: 10;
  margin-left: 120px;
}

.login-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 48px 44px;
  width: 380px;
  display: flex;
  flex-direction: column;
  gap: 0;
}

.card-title {
  font-size: 24px;
  font-weight: 700;
  color: #111827;
  text-align: center;
  margin-bottom: 32px;
  letter-spacing: -0.01em;
}

.field-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-bottom: 20px;
}

.field-label {
  font-size: 14px;
  font-weight: 500;
  color: #374151;
}

.field-input {
  padding: 12px 16px;
  border: 1.5px solid #d1d5db;
  border-radius: 8px;
  font-size: 14px;
  font-family: 'Sora', sans-serif;
  color: #111827;
  outline: none;
  transition: border-color 0.2s;
  background: #fff;
}

.field-input::placeholder {
  color: #9ca3af;
}

.field-input:focus {
  border-color: #7c6ff7;
}

.btn-ingresar {
  width: 100%;
  padding: 13px;
  background: #7c6ff7;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  font-family: 'Sora', sans-serif;
  cursor: pointer;
  margin-top: 8px;
  margin-bottom: 18px;
  transition: background 0.2s;
  letter-spacing: 0.01em;
}

.btn-ingresar:hover {
  background: #6358e8;
}

.register-text {
  text-align: center;
  font-size: 13px;
  color: #6b7280;
  margin-bottom: 12px;
}

.btn-registrar {
  width: 100%;
  padding: 13px;
  background: #8b7ff8;
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  font-family: 'Sora', sans-serif;
  cursor: pointer;
  transition: background 0.2s;
}

.btn-registrar:hover {
  background: #7c6ff7;
}

.right-deco {
  position: absolute;
  right: 60px;
  bottom: 60px;
  opacity: 0.4;
  pointer-events: none;
}
</style>