<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    usuarios:{
        Object
    }
})
</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        <Link
            :href="route('admin.inicio')"
            class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center space-x-2"
          >
            <i class="fas fa-arrow-left"></i>
            <span>Regresar</span>
          </Link>
        <div class="p-6">
            <table class="w-full text-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left">Id</th>
                        <th class="px-6 py-4 text-left">Nombre</th>
                        <th class="px-6 py-4 text-left">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(usuarios, index) in usuarios" :key="index" class="border-b">
                        <td class="px-6 py-4">{{ usuarios.id }}</td>
                        <td class="px-6 py-4">{{ usuarios.name }}</td>
                        <td class="px-6 py-4">{{ usuarios.email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </LayoutLimplio>
</template>