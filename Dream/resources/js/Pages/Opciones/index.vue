<template>
  <LayoutLimplio>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 p-6">
      <!-- Barra de navegación -->
      <nav class="nav-bar mb-8">
        <div class="nav-container">
          <div class="nav-item" v-for="item in navItems" :key="item.id">
            <Link :href="route(item.route)" class="nav-link">
              <i :class="item.icon" class="nav-icon"></i>
              <span class="nav-text">{{ item.text }}</span>
              <div class="nav-dot"></div>
            </Link>
          </div>
          
          <div class="nav-actions">
            <Link :href="route('usuarios.reporte.pdf')" class="nav-btn">
              <i class="fas fa-file-pdf mr-2"></i> PDF
            </Link>
            <Link :href="route('logout')" method="post" as="button" class="nav-btn logout-btn">
              <i class="fas fa-sign-out-alt mr-2"></i> Salir
            </Link>
          </div>
        </div>
      </nav>

      <!-- Contenido principal -->
      <div class="max-w-4xl mx-auto mt-16">
        <div class="text-center mb-12">
          <h1 class="text-4xl font-bold text-white mb-4">Configuración</h1>
          <p class="text-gray-300 text-lg">Personaliza tu experiencia en DreamApp</p>
        </div>

        <!-- Tarjetas de opciones con datos dinámicos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Sonido -->
          <div class="bg-white/10 backdrop-blur-lg border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-4">
              <i class="fas fa-volume-up text-blue-400 text-2xl mr-3"></i>
              <h3 class="text-xl font-semibold text-white">Sonido</h3>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Volumen: {{ configuraciones.sonido.volumen }}%</span>
                <input type="range" v-model="configuraciones.sonido.volumen" min="0" max="100" class="w-24">
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Efectos de sonido</span>
                <input type="checkbox" v-model="configuraciones.sonido.efectos" class="toggle">
              </div>
            </div>
          </div>

          <!-- Apariencia -->
          <div class="bg-white/10 backdrop-blur-lg border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-4">
              <i class="fas fa-palette text-purple-400 text-2xl mr-3"></i>
              <h3 class="text-xl font-semibold text-white">Apariencia</h3>
            </div>
            <div class="space-y-3">
              <div>
                <label class="text-gray-300 block mb-2">Tema</label>
                <select v-model="configuraciones.apariencia.tema" class="w-full bg-gray-700 text-white rounded px-3 py-2">
                  <option value="oscuro">Oscuro</option>
                  <option value="claro">Claro</option>
                  <option value="auto">Automático</option>
                </select>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Animaciones</span>
                <input type="checkbox" v-model="configuraciones.apariencia.animaciones" class="toggle">
              </div>
            </div>
          </div>

          <!-- Privacidad -->
          <div class="bg-white/10 backdrop-blur-lg border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-4">
              <i class="fas fa-shield-alt text-green-400 text-2xl mr-3"></i>
              <h3 class="text-xl font-semibold text-white">Privacidad</h3>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Compartir datos de uso</span>
                <input type="checkbox" v-model="configuraciones.privacidad.datos_uso" class="toggle">
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Estadísticas anónimas</span>
                <input type="checkbox" v-model="configuraciones.privacidad.compartir_estadisticas" class="toggle">
              </div>
            </div>
          </div>

          <!-- Notificaciones -->
          <div class="bg-white/10 backdrop-blur-lg border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-4">
              <i class="fas fa-bell text-yellow-400 text-2xl mr-3"></i>
              <h3 class="text-xl font-semibold text-white">Notificaciones</h3>
            </div>
            <div class="space-y-3">
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Notificaciones push</span>
                <input type="checkbox" v-model="configuraciones.sonido.notificaciones" class="toggle">
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-300">Recordatorios de sueño</span>
                <input type="checkbox" checked class="toggle">
              </div>
            </div>
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-center gap-4 mt-12">
          <button @click="guardarConfiguracion" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full transition-colors">
            <i class="fas fa-save mr-2"></i>Guardar Cambios
          </button>
          <Link :href="route('dashboard')" class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-full transition-colors inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Volver al Inicio
          </Link>
        </div>
      </div>
    </div>
  </LayoutLimplio>
</template>

<script setup>
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Link } from '@inertiajs/vue3';

// Recibir las props del controlador
const props = defineProps({
  configuraciones: Object
});
</script>

<script>
export default {
  data() {
    return {
      navItems: [
        { id: 1, route: 'profile.edit', icon: 'fas fa-user', text: 'Perfil' },
        { id: 2, route: 'sonido.index', icon: 'fas fa-music', text: 'Sonidos' },
        { id: 3, route: 'playlist.index', icon: 'fas fa-list', text: 'Playlist' },
        { id: 4, route: 'dashboard', icon: 'fas fa-robot', text: 'Asistente' },
        { id: 5, route: 'opciones.index', icon: 'fas fa-cog', text: 'Opciones' }
      ]
    }
  },
  methods: {
    guardarConfiguracion() {
      // Aquí puedes agregar la lógica para guardar en la base de datos
      alert('Configuración guardada correctamente');
    }
  }
}
</script>

<style scoped>
/* Tus estilos de nav-bar aquí */
.toggle {
  @apply relative inline-flex h-6 w-11 items-center rounded-full bg-gray-700;
}
.toggle:checked {
  @apply bg-blue-600;
}
</style>