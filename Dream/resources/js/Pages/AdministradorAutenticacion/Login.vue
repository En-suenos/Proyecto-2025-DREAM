<script setup>
import { useForm, Link, Head } from '@inertiajs/vue3';

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
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-800">
    <Head title="Login Administrador" />
    
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">
      <div class="text-center mb-6">
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-yellow-500 to-orange-500 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Acceso Administrador</h2>
        <p class="text-gray-600 mt-2">Ingresa tus credenciales</p>
        
        <!-- Mensaje informativo -->
        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
          <p class="text-xs text-yellow-800">
            ℹ️ Si tienes una sesión de usuario activa, se cerrará automáticamente
          </p>
        </div>
      </div>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <input 
            v-model="form.email" 
            type="email" 
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition" 
            placeholder="admin@ejemplo.com"
            required 
          />
          <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">
            {{ form.errors.email }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
          <input 
            v-model="form.password" 
            type="password" 
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition" 
            placeholder="••••••••"
            required 
          />
          <div v-if="form.errors.password" class="text-red-600 text-sm mt-1">
            {{ form.errors.password }}
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Código de Acceso</label>
          <input 
            v-model="form.codigo" 
            type="text"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition" 
            placeholder="Código único"
            required 
          />
          <div v-if="form.errors.codigo" class="text-red-600 text-sm mt-1">
            {{ form.errors.codigo }}
          </div>
        </div>

        <button 
          type="submit" 
          :disabled="form.processing" 
          class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-3 rounded-lg font-semibold hover:from-yellow-600 hover:to-orange-600 disabled:opacity-50 disabled:cursor-not-allowed transition shadow-lg hover:shadow-xl"
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

      <div class="mt-6 text-center">
        <Link 
          :href="route('admin.register')" 
          class="text-yellow-600 hover:text-yellow-700 text-sm font-medium"
        >
          ¿No tienes cuenta? Regístrate
        </Link>
      </div>

      <div class="mt-4 text-center">
        <Link 
          href="/" 
          class="text-gray-600 hover:text-gray-800 text-sm flex items-center justify-center gap-1"
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