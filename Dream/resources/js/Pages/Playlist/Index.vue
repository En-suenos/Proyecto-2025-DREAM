<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link } from '@inertiajs/vue3';

// Define props SIN el validador estricto
defineProps({
    playlists: {
        type: Array,
        default: () => [],
    }
});

// Función segura para contar sonidos
const contarSonidos = (playlist) => {
    if (!playlist.sonidos) return 0;
    if (Array.isArray(playlist.sonidos)) return playlist.sonidos.length;
    return 0;
};
</script>

<template>
    <Head title="Mis Playlists - DreamApp" />

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

            <!-- Contenido principal -->
            <div class="w-full max-w-7xl relative z-10">
                <!-- Header -->
                <div class="text-center mb-12">
                    <div class="flex justify-center items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-2xl mr-4">
                            <i class="fas fa-music text-white text-2xl"></i>
                        </div>
                        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">
                            Tus <span class="text-blue-300">Playlists</span>
                        </h1>
                    </div>

                    <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">
                        Organiza y disfruta de tus sonidos favoritos para una experiencia de descanso perfecta
                    </p>

                    <!-- Botón crear playlist - SOLO se muestra cuando HAY playlists -->
                    <div v-if="playlists && playlists.length > 0" class="py-3">
                        <Link
                            :href="route('playlist.create')"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-2xl hover:shadow-3xl hover:scale-105 inline-flex items-center space-x-3"
                        >
                            <i class="fas fa-plus-circle text-lg"></i>
                            <span>Crear Nueva Playlist</span>
                        </Link>
                    </div>
                </div>

                <!-- Debug info temporal -->
                <div class="text-center mb-6">
                    <span class="bg-white/10 text-gray-300 text-sm px-4 py-2 rounded-full backdrop-blur-sm border border-white/10">
                        {{ playlists?.length || 0 }} playlists encontradas
                    </span>
                </div>

                <!-- Lista de playlists - SOLO se muestra cuando HAY playlists -->
                <div v-if="playlists && playlists.length > 0" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <div
                        v-for="playlist in playlists"
                        :key="playlist.id"
                        class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10 text-white hover:bg-white/10 transition-all duration-500 transform hover:-translate-y-2 hover:shadow-2xl group relative overflow-hidden"
                    >
                        <!-- Efecto de fondo gradiente sutil -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Header de la playlist -->
                        <div class="flex items-start justify-between mb-6 relative z-10">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-headphones text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white truncate max-w-[180px]">{{ playlist.nombre }}</h3>
                                    <span class="bg-blue-500/30 text-blue-200 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ contarSonidos(playlist) }} sonidos
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-6 relative z-10">
                            <p v-if="playlist.descripcion" class="text-gray-300 line-clamp-3 leading-relaxed">
                                {{ playlist.descripcion }}
                            </p>
                            <p v-else class="text-gray-500 text-sm italic">
                                Sin descripción
                            </p>
                        </div>

                        <!-- Información adicional -->
                        <div class="flex items-center justify-between text-sm text-gray-400 mb-6 relative z-10">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-clock text-blue-400"></i>
                                <span>{{ (contarSonidos(playlist) * 3) }} min aprox.</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-calendar text-purple-400"></i>
                                <span>Creada hoy</span>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex justify-between items-center pt-6 border-t border-white/10 relative z-10">
                            <Link
                                :href="route('playlist.show', playlist.id)"
                                class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl hover:scale-105"
                            >
                                <i class="fas fa-eye"></i>
                                <span>Ver Playlist</span>
                            </Link>

                            <button class="bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl hover:scale-105">
                                <i class="fas fa-play"></i>
                                <span>Reproducir</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mensaje cuando NO hay playlists - SOLO se muestra cuando NO HAY playlists -->
                <div v-else class="text-center mt-12">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-12 border border-white/10 max-w-2xl mx-auto shadow-2xl">
                        <div class="mb-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-white/10">
                                <i class="fas fa-music text-gray-400 text-4xl"></i>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4">Aún no tienes playlists creadas</h3>
                        <p class="text-gray-300 mb-8 text-lg leading-relaxed">
                            Crea tu primera playlist y organiza tus sonidos favoritos para una experiencia de descanso personalizada
                        </p>

                        <Link
                            :href="route('playlist.create')"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-12 rounded-xl transition-all duration-300 inline-flex items-center space-x-3 shadow-2xl hover:shadow-3xl hover:scale-105"
                        >
                            <i class="fas fa-plus-circle text-lg"></i>
                            <span class="text-lg">Crear Mi Primera Playlist</span>
                        </Link>

                        <div class="mt-8 text-gray-400 text-sm">
                            <p>✨ Organiza tus sonidos favoritos</p>
                            <p>🎵 Crea mixes personalizados</p>
                            <p>🌙 Mejora tu experiencia de descanso</p>
                        </div>
                    </div>
                </div>

                <!-- Botón de volver al inicio -->
                <div class="text-center mt-12">
                    <Link
                        :href="route('ConCuenta.index')"
                        class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 inline-flex items-center space-x-2"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Volver al Inicio</span>
                    </Link>
                </div>
            </div>

            <!-- Footer informativo -->
            <div class="text-center text-gray-400 text-sm relative z-10 mt-12">
                <p>© 2025 DreamApp - Organiza tu descanso con playlists personalizadas</p>
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

/* Utilidades de texto */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
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
    }
}
</script>
