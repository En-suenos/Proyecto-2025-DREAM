<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    playlist: {
        type: Object,
        required: true
    }
});

// Estado para el reproductor
const audioPlayer = ref(null);
const currentSound = ref(null);
const isPlaying = ref(false);

// Función para reproducir/pausar sonido
const togglePlay = (soundFile) => {
    if (currentSound.value === soundFile && isPlaying.value) {
        audioPlayer.value.pause();
        isPlaying.value = false;
        return;
    }

    currentSound.value = soundFile;

    if (!audioPlayer.value) {
        audioPlayer.value = new Audio();
    }

    audioPlayer.value.src = `/audio/${soundFile}`;
    audioPlayer.value.play();
    isPlaying.value = true;

    audioPlayer.value.onended = () => {
        isPlaying.value = false;
        currentSound.value = null;
    };

    audioPlayer.value.onerror = () => {
        console.error('Error al cargar el audio:', soundFile);
        isPlaying.value = false;
        currentSound.value = null;
    };
};

// Función para detener la reproducción
const stopPlayback = () => {
    if (audioPlayer.value) {
        audioPlayer.value.pause();
        audioPlayer.value.currentTime = 0;
    }
    isPlaying.value = false;
    currentSound.value = null;
};

// Función para obtener el nombre del sonido
const getSoundName = (sound) => {
    if (typeof sound === 'string') return sound;
    return sound.nombre || sound.archivo || 'Sonido sin nombre';
};

// Función para obtener el archivo del sonido
const getSoundFile = (sound) => {
    if (typeof sound === 'string') return sound;
    return sound.archivo || sound;
};
</script>

<template>
    <Head :title="`Playlist: ${playlist.nombre}`" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-gradient-to-br from-gray-900 to-blue-900 p-4 md:p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center items-center mb-4">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-music text-white text-xl"></i>
                    </div>
                    <h1 class="text-4xl font-bold text-white">
                        {{ playlist.nombre }}
                    </h1>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-center space-x-4 py-3">
                    <Link
                        :href="route('playlist.index')"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 inline-flex items-center shadow-lg"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver a Playlists
                    </Link>

                    <button
                        v-if="currentSound"
                        @click="stopPlayback"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 inline-flex items-center shadow-lg"
                    >
                        <i class="fas fa-stop mr-2"></i>
                        Detener Reproducción
                    </button>
                </div>

                <!-- Indicador de reproducción actual -->
                <div v-if="currentSound" class="mt-4 p-4 bg-green-500/20 rounded-xl border border-green-500/30 backdrop-blur-sm">
                    <p class="text-green-300 text-lg flex items-center justify-center">
                        <i class="fas fa-play-circle mr-3 animate-pulse"></i>
                        Reproduciendo: {{ getSoundName(currentSound) }}
                    </p>
                </div>
            </div>

            <!-- Información de la playlist -->
            <div class="max-w-6xl mx-auto">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 text-white mb-8 shadow-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="text-center p-4 bg-white/5 rounded-xl">
                            <div class="text-3xl font-bold text-blue-400">{{ playlist.sonidos ? playlist.sonidos.length : 0 }}</div>
                            <div class="text-gray-300 text-sm mt-1">Total de Sonidos</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 rounded-xl">
                            <div class="text-2xl font-bold text-green-400">
                                {{ playlist.created_at ? new Date(playlist.created_at).toLocaleDateString('es-ES') : 'N/A' }}
                            </div>
                            <div class="text-gray-300 text-sm mt-1">Fecha de Creación</div>
                        </div>
                        <div class="text-center p-4 bg-white/5 rounded-xl">
                            <div class="text-2xl font-bold text-purple-400">
                                {{ playlist.updated_at ? new Date(playlist.updated_at).toLocaleDateString('es-ES') : 'N/A' }}
                            </div>
                            <div class="text-gray-300 text-sm mt-1">Última Actualización</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-300 mb-3 flex items-center">
                            <i class="fas fa-align-left mr-2 text-blue-400"></i>
                            Descripción
                        </h3>
                        <p v-if="playlist.descripcion" class="text-gray-200 text-lg bg-white/5 p-4 rounded-xl">
                            {{ playlist.descripcion }}
                        </p>
                        <p v-else class="text-gray-400 italic text-lg bg-white/5 p-4 rounded-xl">
                            <i class="fas fa-info-circle mr-2"></i>
                            Esta playlist no tiene descripción
                        </p>
                    </div>
                </div>

                <!-- Lista de sonidos -->
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 shadow-2xl">
                    <h3 class="text-2xl font-semibold text-white mb-6 flex items-center">
                        <i class="fas fa-list-music mr-3 text-purple-400"></i>
                        Sonidos en esta Playlist
                    </h3>

                    <div v-if="playlist.sonidos && playlist.sonidos.length > 0" class="space-y-4">
                        <div
                            v-for="(sonido, index) in playlist.sonidos"
                            :key="index"
                            class="flex items-center justify-between p-6 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-all duration-300 group"
                            :class="{
                                'border-green-500/50 bg-green-500/20 shadow-lg': currentSound === getSoundFile(sonido) && isPlaying
                            }"
                        >
                            <div class="flex items-center space-x-4 flex-1">
                                <!-- Número y botón de reproducción -->
                                <div class="flex items-center space-x-3">
                                    <span class="text-gray-400 font-mono text-lg w-8">{{ index + 1 }}.</span>
                                    <button
                                        @click="togglePlay(getSoundFile(sonido))"
                                        class="w-12 h-12 flex items-center justify-center bg-blue-500 hover:bg-blue-600 rounded-full transition-all duration-300 group-hover:scale-110 shadow-lg"
                                        :class="{
                                            'bg-green-500 hover:bg-green-600 animate-pulse': currentSound === getSoundFile(sonido) && isPlaying
                                        }"
                                    >
                                        <i
                                            v-if="currentSound === getSoundFile(sonido) && isPlaying"
                                            class="fas fa-pause text-white text-lg"
                                        ></i>
                                        <i
                                            v-else
                                            class="fas fa-play text-white text-lg"
                                        ></i>
                                    </button>
                                </div>

                                <div class="flex-1">
                                    <span class="text-white font-semibold text-lg block">
                                        {{ getSoundName(sonido) }}
                                    </span>
                                    <span class="text-gray-400 text-sm">
                                        <i class="fas fa-file-audio mr-1"></i>
                                        {{ getSoundFile(sonido) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Indicador de reproducción -->
                            <div
                                v-if="currentSound === getSoundFile(sonido) && isPlaying"
                                class="flex items-center space-x-3 bg-green-500/20 px-4 py-2 rounded-full"
                            >
                                <div class="flex space-x-1">
                                    <div class="w-1 h-3 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-1 h-4 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                    <div class="w-1 h-3 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                                </div>
                                <span class="text-green-400 text-sm font-medium">Reproduciendo</span>
                            </div>
                        </div>
                    </div>

                    <div v-else class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-music text-gray-400 text-3xl"></i>
                        </div>
                        <p class="text-gray-400 text-xl mb-2">No hay sonidos en esta playlist</p>
                        <p class="text-gray-500">Agrega sonidos desde el editor de playlists</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
</style>
