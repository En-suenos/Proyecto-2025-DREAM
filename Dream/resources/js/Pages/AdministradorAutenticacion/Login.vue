<script setup>
import { useForm, Link, Head } from '@inertiajs/vue3';

import fondo2 from '@/img/fondoAmarril2.jpg'

const form = useForm({
  email: '',
  password: '',
  codigo: '',
});

const submit = () => {
  form.post(route('admin.login.store'), {
    onError: (errors) => {
      console.log('Errores:', errors);
    },
    onFinish: () => {
      form.reset('password');
    }
  });
};
</script>

<template>
  <div class="h-screen bg-cover bg-center flex items-center justify-center p-4 overflow-hidden fixed inset-0"
            :style="{ backgroundImage: `url(${fondo2})` }">
    <Head title="Login Administrador" />
    
    <div class="bg-white/15 backdrop-blur-2xl p-8 rounded-3xl shadow-2xl border border-white/30 relative overflow-hidden w-full max-w-md">
      <!-- Efecto de brillo amarillo -->
      <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/10 to-orange-500/5 rounded-3xl pointer-events-none"></div>
      
      <div class="relative z-10 text-center mb-6">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-yellow-500/80 to-orange-500/80 backdrop-blur-sm flex items-center justify-center border border-yellow-300/50">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-white">Acceso Administrador</h2>
        <p class="text-white/80 mt-2">Ingresa tus credenciales</p>
        
        <!-- Mensaje informativo -->
        <div class="mt-4 p-3 bg-yellow-500/20 backdrop-blur-sm border border-yellow-400/30 rounded-lg">
          <p class="text-xs text-yellow-100">
            ℹ️ Si tienes una sesión de usuario activa, se cerrará automáticamente
          </p>
        </div>
      </div>

      <form @submit.prevent="submit" class="space-y-4 relative z-10">
        <div>
          <label class="block text-sm font-medium text-white mb-2">Email</label>
          <input 
            v-model="form.email" 
            type="email" 
            class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-3 text-white placeholder-white/70 focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition backdrop-blur-sm" 
            placeholder="admin@ejemplo.com"
            required 
          />
          <div v-if="form.errors.email" class="text-yellow-200 text-sm mt-1">
            {{ form.errors.email }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-white mb-2">Contraseña</label>
          <input 
            v-model="form.password" 
            type="password" 
            class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-3 text-white placeholder-white/70 focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition backdrop-blur-sm" 
            placeholder="••••••••"
            required 
          />
          <div v-if="form.errors.password" class="text-yellow-200 text-sm mt-1">
            {{ form.errors.password }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-white mb-2">Código de Acceso</label>
          <input 
            v-model="form.codigo" 
            type="text"
            class="w-full bg-white/20 border border-white/30 rounded-lg px-4 py-3 text-white placeholder-white/70 focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition backdrop-blur-sm" 
            placeholder="Código único"
            required 
          />
          <div v-if="form.errors.codigo" class="text-yellow-200 text-sm mt-1">
            {{ form.errors.codigo }}
          </div>
        </div>

        <button 
          type="submit" 
          :disabled="form.processing" 
          class="w-full bg-gradient-to-r from-yellow-500/90 to-orange-500/90 backdrop-blur-sm text-white py-3 rounded-lg font-semibold hover:from-yellow-600/90 hover:to-orange-600/90 disabled:opacity-50 disabled:cursor-not-allowed transition shadow-lg hover:shadow-xl border border-yellow-400/30"
        >
          <span v-if="!form.processing">Ingresar</span>
          <span v-else class="flex items-center justify-center gap-2">
            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Ingresando...
          </span>
        </button>
      </form>

      <div class="mt-6 text-center relative z-10">
        <Link 
          :href="route('admin.register')" 
          class="text-yellow-300 hover:text-yellow-200 text-sm font-medium transition duration-200"
        >
          ¿No tienes cuenta? Regístrate
        </Link>
      </div>

      <div class="mt-4 text-center relative z-10">
        <Link 
          href="/" 
          class="text-white/80 hover:text-white text-sm flex items-center justify-center gap-1 transition duration-200"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Volver al inicio
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Estilos para deshabilitar el scroll en toda la página */
body, html {
  overflow: hidden !important;
  height: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
}

/* Estilos adicionales para mejorar el efecto brumoso */
.container {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  box-shadow: 
    0 8px 32px 0 rgba(31, 38, 135, 0.37),
    inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
}

/* Mejora la apariencia de los inputs */
::placeholder {
  color: rgba(255, 255, 255, 0.7) !important;
}

/* Efecto de vidrio mejorado */
.glass-effect {
  background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.1),
    rgba(255, 255, 255, 0.05)
  );
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 
    0 8px 32px 0 rgba(0, 0, 0, 0.36),
    inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
}
</style>