<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-900 to-purple-900 flex items-center justify-center">
    <Head title="Panel Administrador" />
    
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-md w-full">
      <h1 class="text-4xl font-bold text-green-600 mb-4 text-center">
        ✅ ¡FUNCIONA!
      </h1>
      <p class="text-gray-700 text-center mb-6">
        Estás en el panel de administración
      </p>
      
      <Link 
        :href="route('admin.logout')" 
        method="post" 
        as="button"
        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded font-semibold"
      >
        Cerrar Sesión
      </Link>
    </div>
  </div>
</template>

