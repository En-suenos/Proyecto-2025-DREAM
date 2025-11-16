<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  nombre: '',
  email: '',
  password: '',
  password_confirmation: '',
  codigo: '',
});

const submit = () => {
  form.post(route('admin.register.store'));
};
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
      <h2 class="text-xl font-bold mb-4 text-center">Registrar Administrador</h2>

      <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="block text-sm font-medium">Nombre</label>
          <input v-model="form.nombre" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.nombre" class="text-red-600 text-sm mt-1">{{ form.errors.nombre }}</div>
        </div>

        <div class="mb-3">
          <label class="block text-sm font-medium">Email</label>
          <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <div class="mb-3">
          <label class="block text-sm font-medium">Código</label>
          <input v-model="form.codigo" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.codigo" class="text-red-600 text-sm mt-1">{{ form.errors.codigo }}</div>
        </div>

        <div class="mb-3">
          <label class="block text-sm font-medium">Contraseña</label>
          <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" required />
          <div v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</div>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium">Confirmar contraseña</label>
          <input v-model="form.password_confirmation" type="password" class="w-full border rounded px-3 py-2" required />
        </div>

        <button type="submit" :disabled="form.processing" class="w-full bg-blue-600 text-white py-2 rounded">
          {{ form.processing ? 'Guardando...' : 'Registrar' }}
        </button>
      </form>
    </div>
  </div>
</template>
