<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'; // Agregar useForm
import { ref } from 'vue';

import fondo2 from '@/img/fondo2.jpg'

defineProps({
    archivos: {
        type: Array,
        required: true,
        default: () => []
    }
})

// Datos de navegación
const navItems = [
    { id: 1, href: 'perfil', icon: 'fas fa-user', text: 'Perfil' },
    { id: 2, href: 'sonido', icon: 'fas fa-music', text: 'Sonidos' },
    { id: 3, href: 'playlists', icon: 'fas fa-list', text: 'Playlist' },
    { id: 4, href: '#', icon: 'fas fa-robot', text: 'Asistente' },
    { id: 5, href: '#', icon: 'fas fa-cog', text: 'Opciones' }
];

const getAudioUrl = (filename) => {
    return `/audio/${filename}`;
}

// Estado para controlar la expansión de la lista de audios
const isExpanded = ref(true);

// Estado para el modal de eliminación
const showDeleteModal = ref(false);
const audioToDelete = ref(null);

// Función para abrir modal de eliminación
const openDeleteModal = (archivo) => {
    audioToDelete.value = archivo;
    showDeleteModal.value = true;
};

// Función para cerrar modal
const closeDeleteModal = () => {
    showDeleteModal.value = false;
    audioToDelete.value = null;
};

// Función para eliminar archivo
const deleteAudio = () => {
    if (audioToDelete.value) {
        const form = useForm({});
        form.delete(route('adminSonidos.destroy', { archivo: audioToDelete.value }), {
            onSuccess: () => {
                closeDeleteModal();
                window.location.reload();
            }
        });
    }
};
</script>

<template>
    <Head title="Sonidos - DreamApp" />

    <LayoutLimpio>
        <div class="w-full min-h-screen bg-cover bg-center p-6"
            :style="{ backgroundImage: `url(${fondo2})` }">
            <!-- Contenido principal -->
            <div class="min-h-screen relative z-10 text-white p-6">
                <div class="max-w-7xl mx-auto">

                    <!-- Botón de volver -->
                    <div class="flex justify-end mb-8 gap-3">
                        <Link
                            :href="route('admin.index')"
                            class="inline-flex items-center space-x-2 bg-blue-500/80 backdrop-blur-sm hover:bg-blue-600/80 text-white font-semibold py-3 px-6 rounded-xl transition mb-4 border border-blue-400/50 shadow-lg"
                        >
                            <i class="fas fa-home mr-2"></i>
                            Volver al Inicio
                        </Link>
                    
                        <Link
                            :href="route('adminSonidos.create')"
                            class="inline-flex items-center space-x-2 bg-blue-500/80 backdrop-blur-sm hover:bg-blue-600/80 text-white font-semibold py-3 px-6 rounded-xl transition mb-4 border border-blue-400/50 shadow-lg"
                        >
                            <i class="fas fa-plus mr-2"></i>
                            Agregar sonido
                        </Link>
                    </div>

                    <!-- Header Centrado igual a playlists -->
                    <div class="text-center mb-12">
                        <h1 class="text-5xl font-bold text-blue-400 mb-4 drop-shadow-lg">Lista de Sonidos Relajantes</h1>
                        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                            Colección de sonidos para mejorar el descanso y la meditación
                        </p>
                    </div>

                    <!-- Contador y botón desplegable -->
                    <div class="glass-panel p-6 rounded-2xl mb-8 flex justify-between items-center">
                        <div class="text-white">
                            <span class="text-white-400">sonidos disponibles</span>
                        </div>

                        <button
                            @click="isExpanded = !isExpanded"
                            class="btn btn-blue"
                        >
                            <span>{{ isExpanded ? 'Ocultar' : 'Mostrar' }} Audios</span>
                            <i
                                class="fas fa-chevron-down transform transition-transform duration-300 ml-3"
                                :class="{ 'rotate-180': isExpanded }"
                            ></i>
                        </button>
                    </div>

                    <!-- Grid de sonidos igual al diseño de playlists -->
                    <div
                        v-if="isExpanded"
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-h-[800px] overflow-y-auto pr-2 custom-scrollbar"
                    >
                        <!-- Tarjeta de sonido estilo playlist -->
                        <div
                            v-for="(archivo, index) in archivos"
                            :key="index"
                            class="glass-panel p-6 rounded-2xl hover-lift transition-all duration-300 group relative"
                        >
                            <!-- Botón eliminar agregado -->
                            <!-- <button
                                @click="openDeleteModal(archivo)"
                                class="absolute top-3 right-3 w-8 h-8 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all duration-200 opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 z-10"
                                title="Eliminar sonido"
                            >
                                <i class="fas fa-trash text-xs text-white"></i>
                            </button> -->

                            <!-- Icono de sonido -->
                            <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-wave-square text-xl text-white"></i>
                            </div>

                            <!-- Información -->
                            <h2 class="text-xl font-bold text-white mb-2 line-clamp-1">
                                {{ archivo.replace('.mp3', '').replace(/_/g, ' ') }}
                            </h2>

                            <p class="text-gray-300 text-sm mb-4 line-clamp-2 min-h-[40px]">
                                Sonido relajante para meditación y descanso profundo
                            </p>

                            <!-- Duración simulada -->
                            <div class="text-gray-400 text-sm mb-4 flex items-center">
                                <i class="fas fa-clock mr-2 text-xs"></i>
                                {{ (index + 1) * 2 }} minutos
                            </div>

                            <!-- Footer de la card -->
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">
                                <!-- Reproductor minimalista -->
                                <div class="audio-wrapper flex-1 mr-4">
                                    <audio
                                        controls
                                        preload="metadata"
                                        :src="getAudioUrl(archivo)"
                                        class="minimal-audio w-full"
                                    >
                                        Tu navegador no soporta el elemento de audio.
                                    </audio>
                                </div>

                                <!-- Acciones -->
                                <div class="flex gap-2">
                                    <button class="action-btn favorite">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-btn download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensaje cuando está colapsado -->
                    <div v-else class="glass-panel p-10 rounded-2xl text-center transition-all duration-500">
                        <div class="empty-state">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                                <i class="fas fa-music text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Lista de audios oculta</h3>
                            <p class="text-gray-300 mb-6">Haz clic en "Mostrar Audios" para ver los sonidos disponibles</p>
                            <button
                                @click="isExpanded = true"
                                class="btn btn-blue"
                            >
                                <i class="fas fa-eye mr-2"></i>
                                Mostrar Sonidos
                            </button>
                        </div>
                    </div>

                    <!-- Mensaje si no hay sonidos -->
                    <div v-if="archivos.length === 0 && isExpanded" class="text-center py-20">
                        <div class="glass-panel p-8 rounded-2xl max-w-md mx-auto">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                                <i class="fas fa-music text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No hay sonidos disponibles</h3>
                            <p class="text-gray-300 mb-6">Próximamente agregaremos más contenido</p>
                            <Link
                                :href="route('adminSonidos.create')"
                                class="btn btn-blue"
                            >
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Primer Sonido
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal de confirmación para eliminar -->
        <div v-if="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
            <!-- Fondo oscuro -->
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="closeDeleteModal"></div>
            
            <!-- Contenido del modal -->
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full">
                    <!-- Encabezado -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Eliminar Sonido</h3>
                                <p class="text-sm text-gray-500">Confirmar eliminación</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cuerpo -->
                    <div class="px-6 py-4">
                        <p class="text-gray-700 mb-4">
                            ¿Estás seguro de eliminar el sonido <strong>"{{ audioToDelete?.replace('.mp3', '').replace(/_/g, ' ') }}"</strong>?
                        </p>
                        
                        <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4">
                            <p class="text-sm text-red-700">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                Esta acción no se puede deshacer. El archivo será eliminado permanentemente.
                            </p>
                        </div>
                    </div>

                    <!-- Pie -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex gap-3">
                        <button
                            @click="closeDeleteModal"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            @click="deleteAudio"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        >
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </LayoutLimpio>
</template>

<!-- Los estilos se mantienen exactamente igual -->
<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Fondo de cielo estrellado igual a playlists */
.night-sky {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, #0c0c2e 0%, #1a1a3e 50%, #2d1b69 100%);
    overflow: hidden;
}

/* Luna */
.moon {
    position: absolute;
    top: 50px;
    right: 50px;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f9f3c5 0%, #e8d89e 100%);
    border-radius: 50%;
    box-shadow:
        0 0 60px rgba(249, 243, 197, 0.6),
        0 0 100px rgba(249, 243, 197, 0.4),
        inset -10px -10px 20px rgba(0, 0, 0, 0.2);
    animation: moonGlow 4s ease-in-out infinite alternate;
}

@keyframes moonGlow {
    0% {
        box-shadow:
            0 0 60px rgba(249, 243, 197, 0.6),
            0 0 100px rgba(249, 243, 197, 0.4);
    }
    100% {
        box-shadow:
            0 0 80px rgba(249, 243, 197, 0.8),
            0 0 120px rgba(249, 243, 197, 0.6);
    }
}

/* Estrellas */
.stars, .stars2, .stars3 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.stars::before, .stars2::before, .stars3::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image:
        radial-gradient(2px 2px at 20px 30px, #eee, transparent),
        radial-gradient(2px 2px at 40px 70px, #fff, transparent),
        radial-gradient(1px 1px at 90px 40px, #ddd, transparent),
        radial-gradient(1px 1px at 130px 80px, #fff, transparent),
        radial-gradient(2px 2px at 160px 30px, #eee, transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: starsMove 50s linear infinite;
}

.stars2::before {
    background-image:
        radial-gradient(1px 1px at 50px 160px, #fff, transparent),
        radial-gradient(1px 1px at 90px 40px, #eee, transparent),
        radial-gradient(2px 2px at 130px 80px, #fff, transparent),
        radial-gradient(1px 1px at 160px 120px, #ddd, transparent);
    animation: starsMove 100s linear infinite;
    animation-delay: -50s;
}

.stars3::before {
    background-image:
        radial-gradient(1px 1px at 110px 80px, #fff, transparent),
        radial-gradient(1px 1px at 190px 20px, #eee, transparent),
        radial-gradient(1px 1px at 160px 60px, #ddd, transparent);
    animation: starsMove 150s linear infinite;
    animation-delay: -100s;
}

@keyframes starsMove {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-100px);
    }
}

/* Panel de vidrio */
.glass-panel {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Sistema de botones */
.btn {
    @apply px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center;
}

.btn-sm {
    @apply px-3 py-1.5 text-sm;
}

.btn-blue {
    @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500/30;
}

.btn-primary {
    @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500/30;
}

.btn-secondary {
    @apply bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-600/30;
}

/* Efectos de hover */
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}

/* Utilidades de texto */
.drop-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
}

.line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
}

.line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}

/* Transiciones suaves */
.transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Reproductor de audio minimalista */
.minimal-audio {
    height: 32px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.minimal-audio::-webkit-media-controls-panel {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.minimal-audio::-webkit-media-controls-play-button {
    background-color: rgba(59, 130, 246, 0.3);
    border-radius: 50%;
}

.minimal-audio::-webkit-media-controls-current-time-display,
.minimal-audio::-webkit-media-controls-time-remaining-display {
    color: #cbd5e1;
    font-size: 11px;
}

/* Botones de acción */
.action-btn {
    width: 32px;
    height: 32px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.action-btn:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 255, 255, 0.15);
    transform: scale(1.05);
}

.favorite:hover {
    color: #f87171;
}

.download:hover {
    color: #60a5fa;
}

/* Scrollbar personalizado */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.15);
}

/* 🎨 Barra de navegación */
.nav-bar {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 50px;
    padding: 10px 20px;
    z-index: 1000;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.nav-container {
    display: flex;
    gap: 6px;
    align-items: center;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
    color: #94a3b8;
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: white;
    background: rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.nav-icon {
    font-size: 1.1rem;
    margin-bottom: 4px;
    transition: all 0.3s ease;
}

.nav-link:hover .nav-icon {
    transform: scale(1.1);
    color: #93c5fd;
}

.nav-text {
    font-size: 0.7rem;
    font-weight: 500;
}

.nav-dot {
    width: 4px;
    height: 4px;
    background: #93c5fd;
    border-radius: 50%;
    position: absolute;
    bottom: 6px;
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
}

.nav-link:hover .nav-dot {
    opacity: 1;
    transform: scale(1);
    animation: dotPulse 1.5s infinite;
}

@keyframes dotPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.5);
        opacity: 0.7;
    }
}

/* Color azul personalizado para el título */
.text-blue-400 {
    color: #60a5fa;
}

/* Gradiente azul para los iconos */
.from-blue-500 {
    --tw-gradient-from: #3b82f6;
    --tw-gradient-to: rgba(59, 130, 246, 0);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-blue-600 {
    --tw-gradient-to: #2563eb;
}

.from-blue-600 {
    --tw-gradient-from: #2563eb;
    --tw-gradient-to: rgba(37, 99, 235, 0);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-blue-700 {
    --tw-gradient-to: #1d4ed8;
}

.from-blue-700 {
    --tw-gradient-from: #1d4ed8;
    --tw-gradient-to: rgba(29, 78, 216, 0);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-blue-800 {
    --tw-gradient-to: #1e40af;
}

/* Centrado mejorado */
.inline-flex {
    display: inline-flex;
}

.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

.text-center {
    text-align: center;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .btn {
        @apply w-full justify-center;
    }

    .nav-bar {
        padding: 8px 16px;
    }

    .nav-container {
        gap: 4px;
    }

    .nav-link {
        padding: 8px 12px;
    }

    .nav-text {
        font-size: 0.65rem;
    }
}

/* Rotación para el ícono del chevron */
.rotate-180 {
    transform: rotate(180deg);
}
</style>