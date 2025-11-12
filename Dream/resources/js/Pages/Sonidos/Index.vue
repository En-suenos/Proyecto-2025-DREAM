<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    archivos: {
        type: Array, 
        required: true,
        default: () => []
    }
})

const getAudioUrl = (filename) => {
    return `/audio/${filename}`;
}

// Estado para controlar la expansión de la lista de audios
const isExpanded = ref(true);
</script>

<template>
    <Head title="Sonidos - DreamApp" />

    <LayoutLimplio>
        <div class="min-h-screen flex flex-col items-center justify-start p-6 pt-24 relative overflow-hidden">
            <!-- Fondo de cielo nocturno mejorado -->
            <div class="night-sky">
                <div class="stars-layer stars-1"></div>
                <div class="stars-layer stars-2"></div>
                <div class="stars-layer stars-3"></div>
                <div class="constellation"></div>
            </div>
            
            <!-- Luna -->
            <div class="moon"></div>
            
            <!-- Colina natural -->
            <div class="hill"></div>

            <!-- Nubes sutiles -->
            <div class="cloud cloud-1"></div>
            <div class="cloud cloud-2"></div>
            <div class="cloud cloud-3"></div>

            <!-- Barra de navegación superior animada -->
            <nav class="nav-bar">
                <div class="nav-container">
                    <div class="nav-item" v-for="item in navItems" :key="item.id">
                        <a :href="item.href" class="nav-link">
                            <i :class="item.icon" class="nav-icon"></i>
                            <span class="nav-text">{{ item.text }}</span>
                            <div class="nav-dot"></div>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Header con título y botón -->
            <div class="text-center mb-8 relative z-10 mt-4">
                <h1 class="text-5xl font-extrabold text-white mb-4 drop-shadow-lg">
                    <span class="text-blue-300">Sonidos</span> Relajantes
                </h1>
                <p class="text-gray-200 text-lg mb-6">
                    Descubre nuestra colección de sonidos para mejorar tu descanso
                </p>
                
                <Link 
                    :href="route('ConCuenta.index')" 
                    class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2 mx-auto w-fit"
                >
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver al Inicio</span>
                </Link>
            </div>

            <!-- Contenedor principal de sonidos -->
            <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-2xl shadow-2xl w-full max-w-6xl p-8 relative z-10 mb-8">
                <!-- Encabezado desplegable -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-white">
                        <span class="text-gray-300">Mostrando</span>
                        <span class="text-blue-300 font-bold mx-1">{{ archivos.length }}</span>
                        <span class="text-gray-300">sonidos disponibles</span>
                    </div>
                    
                    <!-- Botón desplegable mejorado -->
                    <button 
                        @click="isExpanded = !isExpanded"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-3 group"
                    >
                        <span>{{ isExpanded ? 'Ocultar' : 'Mostrar' }} Audios</span>
                        <i 
                            class="fas fa-chevron-down transform transition-transform duration-300" 
                            :class="{ 'rotate-180': isExpanded }"
                        ></i>
                    </button>
                </div>

                <!-- Lista de sonidos desplegable -->
                <div 
                    v-if="isExpanded" 
                    class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar transition-all duration-500"
                >
                    <div 
                        v-for="(archivo, index) in archivos"
                        :key="index" 
                        class="sound-item bg-white/10 backdrop-blur-sm border border-white/10 rounded-xl p-6 flex flex-col lg:flex-row justify-between items-center gap-6 transition-all duration-300 hover:bg-white/20 hover:border-white/20 hover:scale-[1.02] group"
                    >
                        <!-- Información del sonido -->
                        <div class="sound-info flex items-center space-x-4 w-full lg:w-2/5">
                            <!-- Icono animado -->
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-music text-white text-lg"></i>
                                </div>
                                <!-- Efecto de onda sónica -->
                                <div class="absolute inset-0 rounded-xl border-2 border-blue-300 opacity-0 group-hover:opacity-100 animate-ping"></div>
                            </div>
                            
                            <!-- Nombre del archivo -->
                            <div class="flex-1 min-w-0">
                                <span class="font-semibold text-lg text-white truncate block">
                                    {{ archivo.replace('.mp3', '').replace(/_/g, ' ') }}
                                </span>
                                <span class="text-gray-300 text-sm">Audio relajante • {{ (index + 1) * 2 }} min</span>
                            </div>
                        </div>

                        <!-- Reproductor de audio -->
                        <div class="audio-player w-full lg:w-2/5">
                            <audio 
                                controls
                                preload="metadata"
                                :src="getAudioUrl(archivo)"
                                class="w-full audio-custom"
                                @play="onAudioPlay"
                                @pause="onAudioPause"
                            >
                                Tu navegador no soporta el elemento de audio.
                            </audio>
                        </div>

                        <!-- Acciones rápidas -->
                        <div class="flex space-x-2">
                            <button class="bg-white/10 hover:bg-green-500/20 text-white p-3 rounded-lg transition-all duration-300 border border-white/10 hover:border-green-400 group/fav">
                                <i class="fas fa-heart text-gray-300 group-hover/fav:text-red-400"></i>
                            </button>
                            <button class="bg-white/10 hover:bg-blue-500/20 text-white p-3 rounded-lg transition-all duration-300 border border-white/10 hover:border-blue-400 group/download">
                                <i class="fas fa-download text-gray-300 group-hover/download:text-blue-400"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mensaje cuando está colapsado -->
                <div v-else class="text-center py-12 transition-all duration-500">
                    <div class="bg-white/5 rounded-2xl p-8 border border-white/10">
                        <i class="fas fa-music text-gray-400 text-6xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-300 mb-2">Lista de audios oculta</h3>
                        <p class="text-gray-400 mb-4">Haz clic en "Mostrar Audios" para ver los sonidos disponibles</p>
                        <button 
                            @click="isExpanded = true"
                            class="bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300"
                        >
                            Mostrar Sonidos
                        </button>
                    </div>
                </div>

                <!-- Mensaje si no hay sonidos -->
                <div v-if="archivos.length === 0 && isExpanded" class="text-center py-12">
                    <i class="fas fa-music text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-300 mb-2">No hay sonidos disponibles</h3>
                    <p class="text-gray-400">Próximamente agregaremos más contenido</p>
                </div>
            </div>

            <!-- Footer informativo -->
            <div class="text-center text-gray-400 text-sm relative z-10 mt-8">
                <p>© 2025 DreamApp - Todos los sonidos están optimizados para relajación y meditación</p>
            </div>
        </div>
    </LayoutLimplio>
</template>

<style scoped>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css");

/* 🎨 Fondo nocturno natural */
.min-h-screen {
    background: linear-gradient(135deg, #0c1445 0%, #1a1f3d 25%, #0f172a 50%, #0a0f1f 75%, #050816 100%);
}

/* ✨ Sistema de estrellas mejorado */
.night-sky {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.stars-layer {
    position: absolute;
    width: 100%;
    height: 100%;
    background-repeat: repeat;
    animation: starDrift 300s linear infinite;
}

.stars-1 {
    background-image: 
        radial-gradient(0.6px 0.6px at 5% 10%, rgba(255, 255, 255, 0.8) 0%, transparent 50%),
        radial-gradient(0.6px 0.6px at 15% 25%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
        radial-gradient(0.6px 0.6px at 25% 40%, rgba(255, 255, 255, 0.6) 0%, transparent 50%);
    animation-duration: 400s;
    opacity: 0.6;
}

.stars-2 {
    background-image: 
        radial-gradient(1px 1px at 8% 18%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
        radial-gradient(1px 1px at 22% 32%, rgba(255, 255, 255, 0.7) 0%, transparent 50%),
        radial-gradient(1px 1px at 38% 48%, rgba(255, 255, 255, 0.8) 0%, transparent 50%);
    animation-duration: 350s;
    opacity: 0.8;
}

.stars-3 {
    background-image: 
        radial-gradient(1.5px 1.5px at 12% 22%, rgba(255, 255, 255, 1) 0%, transparent 50%),
        radial-gradient(1.5px 1.5px at 32% 42%, rgba(255, 255, 255, 0.9) 0%, transparent 50%),
        radial-gradient(1.5px 1.5px at 58% 68%, rgba(255, 255, 255, 0.8) 0%, transparent 50%);
    animation-duration: 300s;
    opacity: 1;
}

.constellation {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20% 30%, rgba(173, 216, 230, 0.8) 0%, transparent 70%),
        radial-gradient(2px 2px at 70% 60%, rgba(255, 182, 193, 0.7) 0%, transparent 70%);
    animation: constellationTwinkle 8s ease-in-out infinite;
}

@keyframes starDrift {
    from { transform: translateX(0) translateY(0); }
    to { transform: translateX(-100px) translateY(-50px); }
}

@keyframes constellationTwinkle {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

/* 🌙 Luna natural */
.moon {
    position: absolute;
    top: 10%;
    right: 12%;
    width: 70px;
    height: 70px;
    background: radial-gradient(circle at 30% 30%, #f8fafc 0%, #e2e8f0 30%, #cbd5e1 60%, #94a3b8 100%);
    border-radius: 50%;
    box-shadow: 
        0 0 40px rgba(255, 255, 255, 0.4),
        0 0 80px rgba(255, 255, 255, 0.2);
    z-index: 2;
    animation: moonGlow 8s ease-in-out infinite;
}

@keyframes moonGlow {
    0%, 100% { opacity: 0.9; }
    50% { opacity: 1; }
}

/* 🌄 Colina natural */
.hill {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 180%;
    height: 45%;
    background: radial-gradient(ellipse at center top, #1e293b 0%, #0f172a 40%, #020617 100%);
    border-top-left-radius: 60% 30%;
    border-top-right-radius: 60% 30%;
    z-index: 3;
}

/* ☁️ Nubes sutiles */
.cloud {
    position: absolute;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
    filter: blur(8px);
    z-index: 1;
    animation: cloudFloat 40s ease-in-out infinite;
}

.cloud-1 { width: 120px; height: 40px; top: 25%; left: 15%; }
.cloud-2 { width: 80px; height: 25px; top: 35%; right: 20%; animation-duration: 35s; animation-direction: reverse; }
.cloud-3 { width: 100px; height: 30px; top: 45%; left: 25%; animation-duration: 45s; }

@keyframes cloudFloat {
    0%, 100% { transform: translateX(0) translateY(0); }
    50% { transform: translateX(20px) translateY(-5px); }
}

/* 🎨 Barra de navegación */
.nav-bar {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    padding: 12px 24px;
    z-index: 1000;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    animation: navSlideIn 0.8s ease-out;
}

.nav-container {
    display: flex;
    gap: 8px;
    align-items: center;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px 16px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: white;
    background: rgba(59, 130, 246, 0.15);
    transform: translateY(-2px);
}

.nav-icon {
    font-size: 1.25rem;
    margin-bottom: 4px;
    transition: all 0.3s ease;
}

.nav-link:hover .nav-icon {
    transform: scale(1.2) rotate(5deg);
    color: #93c5fd;
}

.nav-text {
    font-size: 0.75rem;
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

@keyframes navSlideIn {
    0% { opacity: 0; transform: translateX(-50%) translateY(-20px); }
    100% { opacity: 1; transform: translateX(-50%) translateY(0); }
}

@keyframes dotPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0.7; }
}

/* 🎵 Estilos personalizados para el reproductor de audio */
.audio-custom {
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.audio-custom::-webkit-media-controls-panel {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 12px;
}

.audio-custom::-webkit-media-controls-play-button {
    background-color: #4fc3f7;
    border-radius: 50%;
}

.audio-custom::-webkit-media-controls-current-time-display,
.audio-custom::-webkit-media-controls-time-remaining-display {
    color: white;
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
    background: rgba(79, 195, 247, 0.5);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(79, 195, 247, 0.7);
}
</style>

<script>
export default {
    data() {
        return {
            navItems: [
                { id: 1, href: 'perfil', icon: 'fas fa-user', text: 'Perfil' },
                { id: 2, href: 'sonido', icon: 'fas fa-music', text: 'Sonidos' },
                { id: 3, href: 'playlists', icon: 'fas fa-list', text: 'Playlist' },
                { id: 4, href: '#', icon: 'fas fa-robot', text: 'Asistente' },
                { id: 5, href: '#', icon: 'fas fa-cog', text: 'Opciones' }
            ]
        }
    },
    methods: {
        onAudioPlay(event) {
            console.log('Audio playing:', event.target.src);
        },
        onAudioPause(event) {
            console.log('Audio paused:', event.target.src);
        }
    }
}
</script>