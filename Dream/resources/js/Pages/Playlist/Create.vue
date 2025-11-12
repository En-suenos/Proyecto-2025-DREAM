<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    sonidosDisponibles: {
        type: Array,
        default: () => []
    }
});

// Estado local para mostrar/ocultar el formulario de creación
const showForm = ref(true);

const formulario = useForm({
    nombre: '',
    descripcion: '',
    sonidos: [], 
});

// Verifica si un sonido ya ha sido seleccionado para la playlist.
const isSelected = (archivo) => {
    return formulario.sonidos.includes(archivo);
}; 

// Añade o quita un sonido del array 'formulario.sonidos'.
const toggleSoundSelection = (sound) => {
    const archivo = sound.archivo;
    
    if (isSelected(archivo)) {
        // Quitar
        formulario.sonidos = formulario.sonidos.filter(a => a !== archivo);
    } else {
        // Añadir
        formulario.sonidos.push(archivo);
    }
    
    // Debug: ver qué sonidos están seleccionados
    console.log('Sonidos seleccionados:', formulario.sonidos);
}; 

// Envío del Formulario
const createPlaylist = () => {
    const url = route('playlist.store');

    // Muestra los datos que se enviarán 
    console.log("Enviando Playlist:", {
        nombre: formulario.nombre,
        descripcion: formulario.descripcion,
        sonidos: formulario.sonidos,
        total_sonidos: formulario.sonidos.length
    });

    formulario.post(url, {
        onSuccess: (response) => {
            formulario.reset();
            console.log('¡Playlist creada exitosamente!');
            showForm.value = false;
        },
        onError: (errors) => {
            console.error("Errores:", errors);
            console.error('Error al crear la playlist. Revisa la consola.');
        }
    });
};
</script>

<template>
    <Head title="Create Playlist" />

    <LayoutLimplio>
        <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-indigo-700 mb-8">
                Crear Nueva Playlist
            </h1>

            <div class="flex flex-col md:flex-row gap-8">
                
                <!-- Columna de Formulario y Botón de Toggle -->
                <div class="w-full md:w-1/3 space-y-4">
                    <!-- Botón de Toggle -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-indigo-100">
                        <button 
                            @click="showForm = !showForm"
                            class="w-full text-lg font-bold py-3 px-4 rounded-lg transition duration-200"
                            :class="showForm ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-indigo-500 text-white hover:bg-indigo-600'"
                        >
                            {{ showForm ? 'Ocultar Formulario' : 'Crear nueva Playlist' }}
                        </button>
                    </div>

                    <!-- Formulario de Creación (se muestra condicionalmente) -->
                    <Transition name="fade">
                        <form v-if="showForm" @submit.prevent="createPlaylist" class="bg-white p-6 rounded-xl shadow-lg space-y-4 border border-indigo-100">
                            <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">Detalles</h3>
                            
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Playlist</label>
                                <input 
                                    id="nombre"
                                    type="text" 
                                    v-model="formulario.nombre" 
                                    required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': formulario.errors.nombre }"
                                >
                                <div v-if="formulario.errors.nombre" class="text-red-500 text-xs mt-1">{{ formulario.errors.nombre }}</div>
                            </div>
                            
                            <div>
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                <textarea 
                                    id="descripcion"
                                    v-model="formulario.descripcion"
                                    rows="3"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': formulario.errors.descripcion }"
                                ></textarea>
                                <div v-if="formulario.errors.descripcion" class="text-red-500 text-xs mt-1">{{ formulario.errors.descripcion }}</div>
                            </div>

                            <div class="pt-4">
                                <button 
                                    type="submit" 
                                    :disabled="formulario.processing"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-md"
                                >
                                    {{ formulario.processing ? 'Guardando...' : 'Crear Playlist' }}
                                </button>
                                <div v-if="formulario.errors.sonidos" class="text-red-500 text-xs mt-3 text-center">
                                    {{ formulario.errors.sonidos }}
                                </div>
                            </div>
                        </form>
                    </Transition>
                </div>

                <!-- Columna de Selección de Sonidos -->
                <div class="w-full md:w-2/3 bg-white p-6 rounded-xl shadow-lg border border-indigo-100">
                    <h3 class="text-2xl font-semibold text-gray-800 border-b pb-2 mb-4">
                        Seleccionar Sonidos ({{ formulario.sonidos.length }} Añadidos)
                    </h3>
                    
                    <div class="max-h-96 overflow-y-auto space-y-2 pr-2">
                        <div 
                            v-for="(sound, index) in props.sonidosDisponibles"
                            :key="`sound-${index}-${sound.archivo}`"
                            @click="toggleSoundSelection(sound)"
                            class="flex items-center justify-between p-3 rounded-lg cursor-pointer transition duration-150 border"
                            :class="[
                                isSelected(sound.archivo) 
                                    ? 'bg-indigo-50 border-indigo-500 shadow-sm' 
                                    : 'bg-white hover:bg-gray-50 border-gray-200'
                            ]"
                        >
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" :class="isSelected(sound.archivo) ? 'text-indigo-600' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v14M9 19h12M9 19c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2zm12-2c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2z"></path>
                                </svg>
                                <div class="text-left">
                                    <span class="font-medium block" :class="isSelected(sound.archivo) ? 'text-indigo-800' : 'text-gray-700'">
                                        {{ sound.nombre }}
                                    </span>
                                    <span class="text-xs text-gray-500">{{ sound.archivo }}</span>
                                </div>
                            </div>

                            <span class="p-1 rounded-full text-xs font-semibold"
                                :class="isSelected(sound.archivo) 
                                    ? 'bg-indigo-600 text-white' 
                                    : 'bg-gray-200 text-gray-700'"
                            >
                                {{ isSelected(sound.archivo) ? 'AÑADIDO' : 'AÑADIR' }}
                            </span>
                        </div>
                    </div>
                    
                    <div v-if="props.sonidosDisponibles.length === 0" class="text-center p-8 text-gray-500">
                        No se encontraron archivos de audio en la carpeta `public/audio`.
                    </div>
                </div>
            </div>
        </div>
    </LayoutLimplio>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>