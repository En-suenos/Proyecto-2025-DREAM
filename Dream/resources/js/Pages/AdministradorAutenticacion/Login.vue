<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  codigo: '',
});

const submit = () => {
  form.post(route('admin.login.store'));
};
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
      <h2 class="text-xl font-bold mb-4 text-center">Login Administrador</h2>

      <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="block text-sm font-medium">Email</label>
          <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <div class="mb-3">
          <label class="block text-sm font-medium">Contraseña</label>
          <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</div>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Código</label>
          <input v-model="form.codigo" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.codigo" class="text-red-600 text-sm mt-1">{{ form.errors.codigo }}</div>
        </div>

        <button type="submit" :disabled="form.processing" class="w-full bg-green-600 text-white py-2 rounded">
          {{ form.processing ? 'Ingresando...' : 'Ingresar' }}
        </button>

        <div v-if="form.props && form.props.flash && form.props.flash.error" class="text-red-600 mt-2">
          {{ form.props.flash.error }}
        </div>

        
      </form>
      <div>
        <Link :href="route('admin.dashboard')">Registrate</Link>
      <a ></a>
    </div>
    </div>
  </div>
</template>
