<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    sonidosDisponibles: {
        type: Array,
        default: () => []
    }
});

const formulario = useForm({
    nombre: '',
    descripcion: '',
    sonidos: [],
});

const isSelected = (archivo) => {
    return formulario.sonidos.includes(archivo);
};

const toggleSoundSelection = (sound) => {
    const archivo = sound.archivo;

    if (isSelected(archivo)) {
        formulario.sonidos = formulario.sonidos.filter(a => a !== archivo);
    } else {
        formulario.sonidos.push(archivo);
    }
};

const createPlaylist = () => {
    formulario.post(route('playlist.store'), {
        onSuccess: () => formulario.reset(),
    });
};
</script>

<template>
    <Head title="Crear Playlist" />

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
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-bold text-blue-400 mb-3 drop-shadow-lg">Crear Nueva Playlist</h1>
                        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                            Personaliza tu lista de reproducción con tus sonidos favoritos
                        </p>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-6">

                        <!-- Formulario -->
                        <div class="lg:w-1/3">
                            <div class="glass-panel p-6 rounded-2xl">
                                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                    <i class="fas fa-edit mr-3 text-blue-400"></i>
                                    Información de la Playlist
                                </h2>

                                <form @submit.prevent="createPlaylist" class="space-y-4">
                                    <div>
                                        <label class="text-gray-300 font-medium mb-2 block">Nombre de la Playlist</label>
                                        <input
                                            v-model="formulario.nombre"
                                            placeholder="Ej: Mis Sonidos Favoritos"
                                            class="w-full bg-white/10 border border-white/20 text-white p-3 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                        >
                                    </div>

                                    <div>
                                        <label class="text-gray-300 font-medium mb-2 block">Descripción</label>
                                        <textarea
                                            v-model="formulario.descripcion"
                                            rows="4"
                                            placeholder="Describe tu playlist..."
                                            class="w-full bg-white/10 border border-white/20 text-white p-3 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                        ></textarea>
                                    </div>

                                    <div class="pt-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary w-full"
                                            :disabled="formulario.processing"
                                        >
                                            <i class="fas fa-plus mr-2"></i>
                                            {{ formulario.processing ? 'Creando...' : 'Crear Playlist' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Sonidos Disponibles -->
                        <div class="lg:w-2/3">
                            <div class="glass-panel p-6 rounded-2xl h-full">
                                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                    <i class="fas fa-music mr-3 text-blue-400"></i>
                                    Sonidos Disponibles
                                    <span class="ml-auto text-lg font-normal text-gray-300">
                                        {{ formulario.sonidos.length }} seleccionados
                                    </span>
                                </h2>

                                <div class="max-h-96 overflow-y-auto space-y-3 custom-scrollbar">
                                    <div
                                        v-for="sound in sonidosDisponibles"
                                        :key="sound.archivo"
                                        @click="toggleSoundSelection(sound)"
                                        class="p-4 rounded-xl cursor-pointer transition-all duration-300 group border-2"
                                        :class="isSelected(sound.archivo)
                                            ? 'bg-blue-500/20 border-blue-400/50 shadow-lg'
                                            : 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-white/20'"
                                    >
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                                                    <i class="fas fa-music text-white"></i>
                                                </div>
                                                <div>
                                                    <h3 class="text-white font-semibold text-lg">{{ sound.nombre }}</h3>
                                                    <p class="text-gray-400 text-sm">{{ sound.archivo }}</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <span
                                                    class="px-3 py-1 text-sm rounded-full font-medium transition-all"
                                                    :class="isSelected(sound.archivo)
                                                        ? 'bg-green-500 text-white shadow-lg'
                                                        : 'bg-gray-600 text-gray-300'"
                                                >
                                                    {{ isSelected(sound.archivo) ? 'SELECCIONADO' : 'SELECCIONAR' }}
                                                </span>
                                                <i
                                                    class="fas text-lg transition-transform duration-300"
                                                    :class="isSelected(sound.archivo)
                                                        ? 'fa-check-circle text-green-400 group-hover:scale-110'
                                                        : 'fa-plus-circle text-gray-400 group-hover:scale-110'"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado vacío -->
                                <div
                                    v-if="sonidosDisponibles.length === 0"
                                    class="text-center py-12"
                                >
                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg mx-auto mb-4">
                                        <i class="fas fa-music text-2xl text-white"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-white mb-2">No hay sonidos disponibles</h3>
                                    <p class="text-gray-300">Agrega algunos sonidos primero para crear tu playlist</p>
                                </div>
                            </div>
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

.btn-primary {
    @apply bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:scale-105 border border-blue-500/30;
}

.btn-primary:disabled {
    @apply opacity-50 cursor-not-allowed transform-none;
}

/* Scrollbar personalizado */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

/* Utilidades de texto */
.drop-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
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

/* Color azul personalizado para el título */
.text-blue-400 {
    color: #60a5fa;
}

/* Gradiente azul */
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

/* Responsive */
@media (max-width: 1024px) {
    .flex-col {
        flex-direction: column;
    }

    .lg\:w-1\/3, .lg\:w-2\/3 {
        width: 100%;
    }
}
</style>
