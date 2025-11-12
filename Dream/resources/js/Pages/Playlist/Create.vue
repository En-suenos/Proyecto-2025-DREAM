<script setup>
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

// Props
const props = defineProps({
    sonidosDisponibles: {
        type: Array,
        default: () => []
    }
});

// Estado reactivo
const showForm = ref(true);
const formulario = useForm({
    nombre: '',
    descripcion: '',
    sonidos: [],
});

// Datos de navegación
const navItems = ref([
    { id: 1, href: '/perfil', icon: 'fas fa-user', text: 'Perfil' },
    { id: 2, href: '/sonido', icon: 'fas fa-music', text: 'Sonidos' },
    { id: 3, href: '/playlists', icon: 'fas fa-list', text: 'Playlist' },
    { id: 4, href: '#', icon: 'fas fa-robot', text: 'Asistente' },
    { id: 5, href: '#', icon: 'fas fa-cog', text: 'Opciones' }
]);

// Verifica si un sonido ya ha sido seleccionado
const isSelected = (archivo) => {
    return formulario.sonidos.includes(archivo);
};

// Añade o quita un sonido
const toggleSoundSelection = (sound) => {
    const archivo = sound.archivo;

    if (isSelected(archivo)) {
        formulario.sonidos = formulario.sonidos.filter(a => a !== archivo);
    } else {
        formulario.sonidos.push(archivo);
    }
};

// Envío del Formulario
const createPlaylist = () => {
    const url = route('playlist.store');

    console.log("Enviando Playlist:", formulario.data());

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
    <Head title="Crear Playlist - DreamApp" />

    <LayoutLimplio>
        <div class="min-h-screen bg-gray-900 p-6">
            <!-- Contenido principal simplificado para testing -->
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-4">Crear Nueva Playlist</h1>
                    <p class="text-gray-300">Selecciona los sonidos para tu playlist</p>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Formulario -->
                    <div class="w-full md:w-1/3">
                        <div class="bg-gray-800 rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">Detalles de la Playlist</h2>

                            <form @submit.prevent="createPlaylist" class="space-y-4">
                                <div>
                                    <label class="block text-gray-300 mb-2">Nombre</label>
                                    <input
                                        v-model="formulario.nombre"
                                        type="text"
                                        class="w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white"
                                        placeholder="Mi playlist"
                                    >
                                </div>

                                <div>
                                    <label class="block text-gray-300 mb-2">Descripción</label>
                                    <textarea
                                        v-model="formulario.descripcion"
                                        class="w-full bg-gray-700 border border-gray-600 rounded px-3 py-2 text-white"
                                        rows="3"
                                        placeholder="Descripción de la playlist"
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                >
                                    Crear Playlist
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Lista de sonidos -->
                    <div class="w-full md:w-2/3">
                        <div class="bg-gray-800 rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-white mb-4">
                                Sonidos Disponibles ({{ formulario.sonidos.length }} seleccionados)
                            </h2>

                            <div class="space-y-2 max-h-96 overflow-y-auto">
                                <div
                                    v-for="sound in sonidosDisponibles"
                                    :key="sound.archivo"
                                    @click="toggleSoundSelection(sound)"
                                    class="flex items-center justify-between p-3 bg-gray-700 rounded cursor-pointer hover:bg-gray-600"
                                    :class="{ 'bg-blue-600': isSelected(sound.archivo) }"
                                >
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-600 rounded flex items-center justify-center">
                                            <i class="fas fa-music text-white"></i>
                                        </div>
                                        <span class="text-white">{{ sound.nombre }}</span>
                                    </div>

                                    <span class="text-sm px-2 py-1 rounded"
                                        :class="isSelected(sound.archivo) ? 'bg-green-500 text-white' : 'bg-gray-600 text-gray-300'"
                                    >
                                        {{ isSelected(sound.archivo) ? 'SELECCIONADO' : 'SELECCIONAR' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </LayoutLimplio>
</template>
