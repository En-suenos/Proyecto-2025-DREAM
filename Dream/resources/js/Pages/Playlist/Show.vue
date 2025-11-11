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
    // Si ya está reproduciendo este sonido, pausarlo
    if (currentSound.value === soundFile && isPlaying.value) {
        audioPlayer.value.pause();
        isPlaying.value = false;
        return;
    }

    // Si es un sonido diferente, cambiar y reproducir
    currentSound.value = soundFile;
    
    // Crear o reutilizar el elemento de audio
    if (!audioPlayer.value) {
        audioPlayer.value = new Audio();
    }

    // Configurar la fuente de audio
    audioPlayer.value.src = `/audio/${soundFile}`;
    
    // Reproducir
    audioPlayer.value.play();
    isPlaying.value = true;

    // Evento cuando termina la reproducción
    audioPlayer.value.onended = () => {
        isPlaying.value = false;
        currentSound.value = null;
    };

    // Evento para manejar errores
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
        <div class="min-h-screen bg-gray-900 p-4 md:p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center items-center mb-4">
                    <svg class="w-8 h-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                    <h1 class="text-3xl font-bold text-white">
                        {{ playlist.nombre }}
                    </h1>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex justify-center space-x-4 py-3">
                    <Link 
                        :href="route('playlist.index')" 
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 inline-flex items-center"
                    > 
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </Link>
                    
                    <!-- Botón para detener toda la reproducción -->
                    <button 
                        v-if="currentSound"
                        @click="stopPlayback"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg transition-all duration-300 inline-flex items-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                        </svg>
                        Detener
                    </button>
                </div>

                <!-- Indicador de reproducción actual -->
                <div v-if="currentSound" class="mt-4 p-3 bg-green-500/20 rounded-lg border border-green-500/30">
                    <p class="text-green-300 text-sm flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Reproduciendo: {{ getSoundName(currentSound) }}
                    </p>
                </div>
            </div>

            <!-- Información de la playlist -->
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm rounded-xl p-8 border border-white/20 text-white mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-400">{{ playlist.sonidos ? playlist.sonidos.length : 0 }}</div>
                            <div class="text-gray-400 text-sm">Sonidos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-400">{{ playlist.created_at ? new Date(playlist.created_at).toLocaleDateString() : 'N/A' }}</div>
                            <div class="text-gray-400 text-sm">Creada</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-400">{{ playlist.updated_at ? new Date(playlist.updated_at).toLocaleDateString() : 'N/A' }}</div>
                            <div class="text-gray-400 text-sm">Actualizada</div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-300 mb-2">Descripción</h3>
                        <p v-if="playlist.descripcion" class="text-gray-200">
                            {{ playlist.descripcion }}
                        </p>
                        <p v-else class="text-gray-500 italic">
                            Sin descripción
                        </p>
                    </div>
                </div>

                <!-- Lista de sonidos -->
                <div class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <h3 class="text-xl font-semibold text-white mb-4">Sonidos en esta playlist</h3>
                    
                    <div v-if="playlist.sonidos && playlist.sonidos.length > 0" class="space-y-3">
                        <div 
                            v-for="(sonido, index) in playlist.sonidos" 
                            :key="index"
                            class="flex items-center justify-between p-4 bg-white/5 rounded-lg border border-white/10 hover:bg-white/10 transition duration-200 group"
                            :class="{
                                'border-green-500/50 bg-green-500/10': currentSound === getSoundFile(sonido) && isPlaying
                            }"
                        >
                            <div class="flex items-center space-x-3 flex-1">
                                <!-- Botón de reproducción -->
                                <button 
                                    @click="togglePlay(getSoundFile(sonido))"
                                    class="w-10 h-10 flex items-center justify-center bg-blue-500 hover:bg-blue-600 rounded-full transition duration-200 group-hover:scale-110"
                                    :class="{
                                        'bg-green-500 hover:bg-green-600': currentSound === getSoundFile(sonido) && isPlaying
                                    }"
                                >
                                    <svg 
                                        v-if="currentSound === getSoundFile(sonido) && isPlaying" 
                                        class="w-5 h-5 text-white" 
                                        fill="currentColor" 
                                        viewBox="0 0 20 20"
                                    >
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <svg 
                                        v-else 
                                        class="w-5 h-5 text-white" 
                                        fill="currentColor" 
                                        viewBox="0 0 20 20"
                                    >
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div class="flex-1">
                                    <span class="text-white font-medium block">
                                        {{ getSoundName(sonido) }}
                                    </span>
                                    <span class="text-gray-400 text-xs">
                                        {{ getSoundFile(sonido) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Indicador de reproducción -->
                            <div 
                                v-if="currentSound === getSoundFile(sonido) && isPlaying"
                                class="flex items-center space-x-2"
                            >
                                <div class="flex space-x-1">
                                    <div class="w-1 h-3 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                    <div class="w-1 h-4 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                    <div class="w-1 h-3 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                                </div>
                                <span class="text-green-400 text-xs font-medium">En reproducción</span>
                            </div>
                        </div>
                    </div>
                    
                    <div v-else class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                        <p class="text-gray-400 text-lg">No hay sonidos en esta playlist</p>
                        <p class="text-gray-500 mt-2">Agrega sonidos desde el editor de playlists</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>