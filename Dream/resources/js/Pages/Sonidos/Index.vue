<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    archivos: {
        type: Array, 
        required: true,
        default: () => []
    }
})
const getAudioUrl = (filename) => {
    // La ruta pública es simplemente /audio/{nombre_del_archivo}
    return `/audio/${filename}`;
}
</script>

<template>
    <Head title="VentanaCuenta" />

    <AuthenticatedLayout>
        <h1 class="text-4xl font-extrabold text-blue-500 p-4 mb-4">
            Sonidos
        </h1>
        
        <div class="center">
            <Link :href="route('ConCuenta.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Salir
            </Link>
        </div>

        <div class="space-y-4">
            <!-- V-FOR: Itera sobre el array 'archivos' -->
             <div v-for="(archivo, index) in archivos"
                    :key="index" 
                    class="sound-item bg-white p-4 rounded-xl shadow-lg flex flex-col md:flex-row justify-between items-center gap-4 transition duration-200 hover:shadow-xl hover:bg-gray-50 border border-gray-200">

                    <div class="sound-info flex items-center space-x-3 w-full md:w-1/3">
                        <!-- Icono SVG simple para el audio -->
                        <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v14M9 19h12M9 19c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2zm12-2c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2z"></path>
                        </svg>
                        <!-- Nombre del archivo -->
                        <span class="font-semibold text-lg text-gray-800 truncate">{{ archivo }}</span>
                    </div>

                    <!-- Audio Player con controles -->
                    <audio 
                        controls
                        preload="metadata"
                        :src="getAudioUrl(archivo)"
                        class="w-full md:w-2/3"
                    >
                        Tu navegador no soporta el elemento de audio.
                    </audio>
             </div>
            
        </div>
    </AuthenticatedLayout>
</template>
