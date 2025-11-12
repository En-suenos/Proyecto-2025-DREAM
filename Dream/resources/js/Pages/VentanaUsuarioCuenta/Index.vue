<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
</script>

<template>
  <Head title="VentanaCuenta" />

  <LayoutLimplio>
    <div
      class="min-h-screen flex flex-col items-center justify-center p-6 pt-24 relative overflow-hidden"
    >
      <!-- Fondo de cielo nocturno mejorado -->
      <div class="night-sky">
        <div class="stars-layer stars-1"></div>
        <div class="stars-layer stars-2"></div>
        <div class="stars-layer stars-3"></div>
        <div class="constellation"></div>
      </div>
      
      <!-- Luna -->
      <div class="moon"></div>
      
      <!-- Colina natural -->
      <div class="hill"></div>

      <!-- Nubes sutiles -->
      <div class="cloud cloud-1"></div>
      <div class="cloud cloud-2"></div>
      <div class="cloud cloud-3"></div>

      <!-- Botón de cierre de sesión -->
      <div class="bg-blue-600/80 text-white py-2 px-4 rounded-full shadow-lg hover:shadow-xl mb-4 relative z-10 transition-all duration-300 hover:scale-105">
        <Link :href="route('logout')" method="post" as="button" class="flex items-center">
          <i class="fas fa-sign-out-alt mr-2"></i>
          Cerrar sesión
        </Link>
        
      </div>
      <div >
          <a 
          href="/usuarios/reporte/pdf" 
          class="bg-blue-600/80 text-white py-2 px-4 rounded-full shadow-lg hover:shadow-xl mb-4 relative z-10 transition-all duration-300 hover:scale-105">
          PDF
      </a>
      </div>
      
      
      <!-- Barra de navegación superior animada -->
      <nav class="nav-bar">
        <div class="nav-container">
          <div class="nav-item" v-for="item in navItems" :key="item.id">
            <a :href="item.href" class="nav-link">
              <i :class="item.icon" class="nav-icon"></i>
              <span class="nav-text">{{ item.text }}</span>
              <div class="nav-dot"></div>
            </a>
          </div>
        </div>
      </nav>

      <!-- Encabezado -->
      <div class="text-center mb-8 relative z-10 mt-16">
        <h1 class="text-5xl font-extrabold text-white mb-2 drop-shadow-lg">
          Bienvenido <span class="text-blue-300">Sueños</span>
        </h1>
        <p class="text-gray-200 text-lg">
          Tu espacio personal para controlar tus sonidos y sueños.
        </p>
      </div>

      <!-- Contenedor principal -->
      <div
        class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl w-full max-w-4xl flex flex-col overflow-hidden shadow-2xl relative z-10"
      >
        <!-- Contenido principal -->
        <main class="flex-1 p-10 flex flex-col items-center justify-center">
          <div class="text-center">
            <div
              class="avatar w-20 h-20 rounded-full bg-gradient-to-br from-blue-400/20 to-purple-500/20 border border-white/10 flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg"
            >
              <i class="fas fa-music text-blue-300"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Control de Sueño</h3>
            <p class="text-gray-200 mb-6">
              Explora tus playlists, configura tu perfil y disfruta de la música.
            </p>

            <!-- Tarjeta de sueño -->
            <div
              class="card-sueno bg-gradient-to-br from-blue-500/10 to-purple-600/10 backdrop-blur-sm border border-white/5 rounded-2xl p-8 mb-6 shadow-2xl max-w-md mx-auto transition-all duration-500 hover:translate-y-[-8px] hover:shadow-3xl"
            >
              <div class="card-body text-center">
                <i class="fas fa-moon fa-2x text-yellow-200 mb-4 drop-shadow-lg"></i>
                <p class="card-text text-white text-lg mb-6 leading-relaxed">
                  😴 "Dormir no es perder el tiempo, es regalarle al cuerpo la energía y la claridad
                  que necesita para seguir soñando despierto." 🌌
                </p>

                <!-- Botón principal -->
                <button
                  class="btn-sueno bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-10 rounded-full shadow-2xl transform transition-all duration-500 relative overflow-hidden group"
                >
                  <i class="fas fa-play-circle mr-3 group-hover:scale-110 transition-transform duration-300"></i> 
                  Iniciar Sueño
                  <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                </button>
              </div>
            </div>
          </div>
        </main>

        <!-- Footer con copyright -->
        <footer class="bg-gradient-to-b from-slate-800/50 to-slate-900/50 text-white p-4 text-center border-t border-white/5">
          <div class="text-sm opacity-80">© 2025 DreamApp - Donde los sueños cobran vida</div>
        </footer>
      </div>
    </div>
  </LayoutLimplio>
</template>

<style scoped>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css");

/* 🎨 Fondo nocturno natural */
.min-h-screen {
  background: linear-gradient(135deg, #0c1445 0%, #1a1f3d 25%, #0f172a 50%, #0a0f1f 75%, #050816 100%);
}

/* ✨ Sistema de estrellas mejorado y natural */
.night-sky {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}

.stars-layer {
  position: absolute;
  width: 100%;
  height: 100%;
  background-repeat: repeat;
  animation: starDrift 300s linear infinite;
}

.stars-1 {
  background-image: 
    radial-gradient(0.6px 0.6px at 5% 10%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 15% 25%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 25% 40%, rgba(255, 255, 255, 0.6) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 35% 55%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 45% 70%, rgba(255, 255, 255, 0.5) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 55% 85%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 65% 30%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 75% 45%, rgba(255, 255, 255, 0.6) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 85% 60%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(0.6px 0.6px at 95% 75%, rgba(255, 255, 255, 0.7) 0%, transparent 50%);
  animation-duration: 400s;
  opacity: 0.6;
}

.stars-2 {
  background-image: 
    radial-gradient(1px 1px at 8% 18%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
    radial-gradient(1px 1px at 22% 32%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
    radial-gradient(1px 1px at 38% 48%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(1px 1px at 52% 62%, rgba(255, 255, 255, 0.6) 0%, transparent 50%),
    radial-gradient(1px 1px at 68% 78%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
    radial-gradient(1px 1px at 82% 28%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
    radial-gradient(1px 1px at 28% 82%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(1px 1px at 42% 22%, rgba(255, 255, 255, 0.6) 0%, transparent 50%);
  animation-duration: 350s;
  opacity: 0.8;
}

.stars-3 {
  background-image: 
    radial-gradient(1.5px 1.5px at 12% 22%, rgba(255, 255, 255, 1) 0%, transparent 50%),
    radial-gradient(1.5px 1.5px at 32% 42%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
    radial-gradient(1.5px 1.5px at 58% 68%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
    radial-gradient(1.5px 1.5px at 78% 88%, rgba(255, 255, 255, 1) 0%, transparent 50%),
    radial-gradient(1.5px 1.5px at 88% 38%, rgba(255, 255, 255, 0.9) 0%, transparent 50%);
  animation-duration: 300s;
  opacity: 1;
}

.constellation {
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: 
    radial-gradient(2px 2px at 20% 30%, rgba(173, 216, 230, 0.8) 0%, transparent 70%),
    radial-gradient(2px 2px at 25% 32%, rgba(173, 216, 230, 0.8) 0%, transparent 70%),
    radial-gradient(2px 2px at 30% 28%, rgba(173, 216, 230, 0.8) 0%, transparent 70%),
    radial-gradient(2px 2px at 70% 60%, rgba(255, 182, 193, 0.7) 0%, transparent 70%),
    radial-gradient(2px 2px at 75% 65%, rgba(255, 182, 193, 0.7) 0%, transparent 70%),
    radial-gradient(2px 2px at 80% 55%, rgba(255, 182, 193, 0.7) 0%, transparent 70%);
  animation: constellationTwinkle 8s ease-in-out infinite;
}

@keyframes starDrift {
  from { transform: translateX(0) translateY(0); }
  to { transform: translateX(-100px) translateY(-50px); }
}

@keyframes constellationTwinkle {
  0%, 100% { opacity: 0.3; }
  50% { opacity: 1; }
}

/* 🌙 Luna natural con gradientes suaves */
.moon {
  position: absolute;
  top: 10%;
  right: 12%;
  width: 70px;
  height: 70px;
  background: radial-gradient(circle at 30% 30%, #f8fafc 0%, #e2e8f0 30%, #cbd5e1 60%, #94a3b8 100%);
  border-radius: 50%;
  box-shadow: 
    0 0 40px rgba(255, 255, 255, 0.4),
    0 0 80px rgba(255, 255, 255, 0.2),
    inset -5px 5px 10px rgba(255, 255, 255, 0.3);
  z-index: 2;
  animation: moonGlow 8s ease-in-out infinite;
  filter: blur(0.3px);
}

@keyframes moonGlow {
  0%, 100% {
    opacity: 0.9;
    box-shadow: 
      0 0 40px rgba(255, 255, 255, 0.4),
      0 0 80px rgba(255, 255, 255, 0.2);
  }
  50% {
    opacity: 1;
    box-shadow: 
      0 0 50px rgba(255, 255, 255, 0.6),
      0 0 100px rgba(255, 255, 255, 0.3);
  }
}

/* 🌄 Colina natural con textura */
.hill {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 180%;
  height: 45%;
  background: 
    radial-gradient(ellipse at center top, #1e293b 0%, #0f172a 40%, #020617 100%);
  border-top-left-radius: 60% 30%;
  border-top-right-radius: 60% 30%;
  z-index: 3;
  box-shadow: 
    0 -10px 30px rgba(0, 0, 0, 0.5),
    inset 0 -10px 20px rgba(255, 255, 255, 0.05);
}

/* ☁️ Nubes sutiles */
.cloud {
  position: absolute;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 50%;
  filter: blur(8px);
  z-index: 1;
}

.cloud-1 {
  width: 120px;
  height: 40px;
  top: 25%;
  left: 15%;
  animation: cloudFloat 40s ease-in-out infinite;
}

.cloud-2 {
  width: 80px;
  height: 25px;
  top: 35%;
  right: 20%;
  animation: cloudFloat 35s ease-in-out infinite reverse;
}

.cloud-3 {
  width: 100px;
  height: 30px;
  top: 45%;
  left: 25%;
  animation: cloudFloat 45s ease-in-out infinite;
}

@keyframes cloudFloat {
  0%, 100% { transform: translateX(0) translateY(0); }
  50% { transform: translateX(20px) translateY(-5px); }
}

/* 🎨 Barra de navegación mejorada */
.nav-bar {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(15, 23, 42, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 50px;
  padding: 12px 24px;
  z-index: 1000;
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
  animation: navSlideIn 0.8s ease-out;
}

.nav-container {
  display: flex;
  gap: 8px;
  align-items: center;
}

.nav-item {
  position: relative;
}

.nav-link {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 12px 16px;
  color: #cbd5e1;
  text-decoration: none;
  border-radius: 25px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(96, 165, 250, 0.2), transparent);
  transition: left 0.5s ease;
}

.nav-link:hover::before {
  left: 100%;
}

.nav-link:hover {
  color: white;
  background: rgba(59, 130, 246, 0.15);
  transform: translateY(-2px);
  box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
}

.nav-icon {
  font-size: 1.25rem;
  margin-bottom: 4px;
  transition: all 0.3s ease;
}

.nav-link:hover .nav-icon {
  transform: scale(1.2) rotate(5deg);
  color: #93c5fd;
}

.nav-text {
  font-size: 0.75rem;
  font-weight: 500;
  transition: all 0.3s ease;
}

.nav-dot {
  width: 4px;
  height: 4px;
  background: #93c5fd;
  border-radius: 50%;
  position: absolute;
  bottom: 6px;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s ease;
}

.nav-link:hover .nav-dot {
  opacity: 1;
  transform: scale(1);
  animation: dotPulse 1.5s infinite;
}

@keyframes navSlideIn {
  0% {
    opacity: 0;
    transform: translateX(-50%) translateY(-20px);
  }
  100% {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }
}

@keyframes dotPulse {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.5);
    opacity: 0.7;
  }
}

/* 🌠 Botón de acción mejorado */
.btn-sueno {
  box-shadow: 
    0 8px 25px rgba(59, 130, 246, 0.3),
    0 2px 10px rgba(59, 130, 246, 0.2);
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-sueno:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 
    0 15px 35px rgba(59, 130, 246, 0.4),
    0 5px 15px rgba(59, 130, 246, 0.3);
}
</style>

<script>
export default {
  data() {
    return {
      navItems: [
        { id: 1, href: 'perfil', icon: 'fas fa-user', text: 'Perfil' },
        { id: 2, href: 'sonido', icon: 'fas fa-music', text: 'Sonidos' },
        { id: 3, href: 'playlists', icon: 'fas fa-list', text: 'Playlist' },
        { id: 4, href: '#', icon: 'fas fa-robot', text: 'Asistente' },
        { id: 5, href: '#', icon: 'fas fa-cog', text: 'Opciones' }
      ]
    }
  }
}
</script>