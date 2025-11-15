<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    playlists: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <Head title="Mis Playlists" />

    <LayoutLimpio>
        <!-- Fondo de cielo estrellado -->
        <div class="night-sky">
            <!-- Luna -->
            <div class="moon"></div>

            <!-- Estrellas -->
            <div class="stars"></div>
            <div class="stars2"></div>
            <div class="stars3"></div>

            <!-- Contenido principal -->
            <div class="min-h-screen relative z-10 text-white p-6">
                <div class="max-w-7xl mx-auto">

                    <!-- Header Centrado -->
                    <div class="text-center mb-12">
                        <h1 class="text-5xl font-bold text-blue-400 mb-4 drop-shadow-lg">Mis Playlists</h1>
                        <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                            Gestiona y reproduce tus listas de sonidos favoritas
                        </p>

                        <!-- Botón crear centrado -->
                        <Link
                            :href="route('playlist.create')"
                            class="btn btn-primary inline-flex mx-auto"
                        >
                            <i class="fas fa-plus mr-3"></i>Crear Nueva Playlist
                        </Link>
                    </div>

                    <!-- Lista de Playlists -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                        <!-- Card de Playlist -->
                        <div
                            v-for="playlist in playlists"
                            :key="playlist.id"
                            class="glass-panel p-6 rounded-2xl hover-lift transition-all duration-300 group"
                        >
                            <!-- Icono de playlist -->
                            <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-music text-xl text-white"></i>
                            </div>

                            <!-- Información -->
                            <h2 class="text-xl font-bold text-white mb-2 line-clamp-1">
                                {{ playlist.nombre }}
                            </h2>

                            <p class="text-gray-300 text-sm mb-4 line-clamp-2 min-h-[40px]">
                                {{ playlist.descripcion || "Sin descripción" }}
                            </p>

                            <!-- Footer de la card -->
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">

                                <span class="text-gray-400 text-sm flex items-center">
                                    <i class="fas fa-music mr-1 text-xs"></i>
                                    {{ playlist.sonidos?.length || 0 }} sonidos
                                </span>

                                <Link
                                    :href="route('playlist.show', playlist.id)"
                                    class="btn btn-sm btn-primary"
                                >
                                    <i class="fas fa-play mr-1"></i>Ver
                                </Link>
                            </div>
                        </div>

                    </div>

                    <!-- Estado vacío -->
                    <div
                        v-if="playlists.length === 0"
                        class="text-center py-20"
                    >
                        <div class="glass-panel p-8 rounded-2xl max-w-md mx-auto">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                                <i class="fas fa-music text-2xl text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No tienes playlists todavía</h3>
                            <p class="text-gray-300 mb-6">Comienza creando tu primera playlist</p>
                            <Link
                                :href="route('playlist.create')"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-plus mr-2"></i>Crear Primera Playlist
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </LayoutLimpio>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Fondo de cielo estrellado */
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

.btn-primary {
    @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500/30;
}

.btn-secondary {
    @apply bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-600/30;
}

.btn-outline {
    @apply bg-transparent border border-gray-600 text-gray-300 hover:bg-white/10 hover:border-gray-500 hover:text-white shadow-lg hover:shadow-xl;
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

/* Efectos de backdrop */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
}

.backdrop-blur-lg {
    backdrop-filter: blur(16px);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .btn {
        @apply w-full justify-center;
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
</style>
