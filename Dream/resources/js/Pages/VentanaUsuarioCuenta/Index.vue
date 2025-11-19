<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link } from '@inertiajs/vue3';

// Datos de navegación
const navItems = [
    { id: 1, href: 'perfil', icon: 'fas fa-user', text: 'Perfil' },
    { id: 2, href: 'sonido', icon: 'fas fa-music', text: 'Sonidos' },
    { id: 3, href: 'playlists', icon: 'fas fa-list', text: 'Playlist' },
    { id: 4, href: '#', icon: 'fas fa-robot', text: 'Asistente' },
    { id: 5, href: route('opciones.index'), icon: 'fas fa-cog', text: 'Opciones' }
];
</script>

<template>
    <Head title="Dashboard" />
    <LayoutLimpio>
    
      <!-- Fondo de cielo estrellado -->
      <div class="night-sky ">
          <!-- Luna -->
          <div class="moon"></div>

 <!-- Fondo de cielo estrellado -->
        <div class="night-sky">
            <!-- Luna -->
            <div class="moon"></div>

          <!-- Estrellas -->
          <div class="stars"></div>
          <div class="stars2"></div>
          <div class="stars3"></div>
          <!-- Barra de navegación superior animada -->
          <nav class="nav-bar">
            <div class="nav-container">
              <!-- Ítems del menú -->
              <div class="nav-item" v-for="item in navItems" :key="item.id">
                <a :href="item.href" class="nav-link">
                  <i :class="item.icon" class="nav-icon"></i>
                  <span class="nav-text">{{ item.text }}</span>
                  <div class="nav-dot"></div>
                </a>
            </div>
            <div class="nav-actions">
              <Link 
                :href="route('logout')" 
                method="post" 
                as="button" 
                class="nav-btn logout-btn"
              >
                <i class="fas fa-sign-out-alt mr-2"></i> Salir
              </Link>
              
              </div>
            </div>
            
          </nav>

             <!-- Encabezado -->
          <div class="text-center mb-8 relative z-10 mt-16 ">
            <h1 class="text-5xl font-extrabold text-white mb-2 drop-shadow-lg">
              Bienvenido <span class="text-blue-300">Sueños</span>
            </h1>
            <p class="text-gray-200 text-lg">
              Tu espacio personal para controlar tus sonidos y sueños.
            </p>
          </div>
              
          <!-- Contenedor principal -->
          <div
            class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl w-full max-w-4xl flex flex-col overflow-hidden shadow-2xl relative z-10 items-stretch mx-auto mb-16 glass-panel"
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
    
        <!-- Footer con copyright -->
        <footer class="bg-gradient-to-b from-slate-800/50 to-slate-900/50 text-white p-4 text-center border-t border-white/5">
          <div class="text-sm opacity-80">© 2025 DreamApp - Donde los sueños cobran vida</div>
        </footer>
      </div>
   

  </LayoutLimpio>
       
 
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Fondo de cielo estrellado */
.night-sky {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, #0c0c2e 0%, #1a1a3e 50%, #2d1b69 100%);
    overflow: hidden;
}

/* Luna */
.moon {
    position: absolute;
    top: 50px;
    right: 50px;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f9f3c5 0%, #e8d89e 100%);
    border-radius: 50%;
    box-shadow:
        0 0 60px rgba(249, 243, 197, 0.6),
        0 0 100px rgba(249, 243, 197, 0.4),
        inset -10px -10px 20px rgba(0, 0, 0, 0.2);
    animation: moonGlow 4s ease-in-out infinite alternate;
}

@keyframes moonGlow {
    0% {
        box-shadow:
            0 0 60px rgba(249, 243, 197, 0.6),
            0 0 100px rgba(249, 243, 197, 0.4);
    }
    100% {
        box-shadow:
            0 0 80px rgba(249, 243, 197, 0.8),
            0 0 120px rgba(249, 243, 197, 0.6);
    }
}

/* Estrellas */
.stars, .stars2, .stars3 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.stars::before, .stars2::before, .stars3::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image:
        radial-gradient(2px 2px at 20px 30px, #eee, transparent),
        radial-gradient(2px 2px at 40px 70px, #fff, transparent),
        radial-gradient(1px 1px at 90px 40px, #ddd, transparent),
        radial-gradient(1px 1px at 130px 80px, #fff, transparent),
        radial-gradient(2px 2px at 160px 30px, #eee, transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: starsMove 50s linear infinite;
}

.stars2::before {
    background-image:
        radial-gradient(1px 1px at 50px 160px, #fff, transparent),
        radial-gradient(1px 1px at 90px 40px, #eee, transparent),
        radial-gradient(2px 2px at 130px 80px, #fff, transparent),
        radial-gradient(1px 1px at 160px 120px, #ddd, transparent);
    animation: starsMove 100s linear infinite;
    animation-delay: -50s;
}

.stars3::before {
    background-image:
        radial-gradient(1px 1px at 110px 80px, #fff, transparent),
        radial-gradient(1px 1px at 190px 20px, #eee, transparent),
        radial-gradient(1px 1px at 160px 60px, #ddd, transparent);
    animation: starsMove 150s linear infinite;
    animation-delay: -100s;
}

@keyframes starsMove {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-100px);
    }
}

/* Panel de vidrio */
.glass-panel {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Sistema de botones */
.btn {
    @apply px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center;
}

.btn-primary {
    @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500/30;
}

.btn-secondary {
    @apply bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-600/30;
}

/* Efectos de hover */
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

/* Utilidades de texto */
.drop-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
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

/* Transiciones suaves */
.transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .nav-bar {
        padding: 8px 16px;
    }

    .nav-container {
        gap: 4px;
    }

    .nav-link {
        padding: 8px 12px;
    }

    .nav-text {
        font-size: 0.7rem;
    }
}

/* Color azul personalizado para el título */
.text-blue-400 {
    color: #60a5fa;
}

/* Gradientes */
.from-blue-500 {
    --tw-gradient-from: #3b82f6;
}

.to-blue-600 {
    --tw-gradient-to: #2563eb;
}

.from-purple-500 {
    --tw-gradient-from: #8b5cf6;
}

.to-purple-600 {
    --tw-gradient-to: #7c3aed;
}

.from-indigo-500 {
    --tw-gradient-from: #6366f1;
}

.to-indigo-600 {
    --tw-gradient-to: #4f46e5;
}

/* Asegurar que las tarjetas tengan la misma altura */
.h-full {
    height: 100%;
}

/* Centrado perfecto para las dos tarjetas */
.max-w-2xl {
    max-width: 42rem;
}
/* 🔹 Contenedor de botones adicionales (lado derecho del nav) */
.nav-actions {
  display: flex;
  gap: 12px;
  align-items: center;
  margin-left: 20px;
}

/* 🔹 Estilo general de botones */
.nav-btn {
  background: linear-gradient(90deg, rgba(37, 99, 235, 0.25), rgba(147, 51, 234, 0.25));
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #e2e8f0;
  font-size: 0.85rem;
  font-weight: 500;
  padding: 8px 14px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  transition: all 0.3s ease;
  text-decoration: none;
}

.nav-btn:hover {
  background: linear-gradient(90deg, rgba(59, 130, 246, 0.6), rgba(147, 51, 234, 0.6));
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

/* 🔹 Botón de cerrar sesión con tono rojo */
.logout-btn {
  background: linear-gradient(90deg, rgba(239, 68, 68, 0.3), rgba(220, 38, 38, 0.3));
  border: 1px solid rgba(239, 68, 68, 0.4);
}

.logout-btn:hover {
  background: linear-gradient(90deg, rgba(239, 68, 68, 0.8), rgba(220, 38, 38, 0.8));
  box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
}

</style>
