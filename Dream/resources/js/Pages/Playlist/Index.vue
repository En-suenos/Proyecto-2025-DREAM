<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
    <Head title="Mis Playlists" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-900 p-4 md:p-8">
            <!-- Debug info temporal -->
            <div class="text-xs text-gray-400 mb-4 p-2 bg-gray-800 rounded">
                Debug: {{ playlists?.length || 0 }} playlists cargadas
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center items-center mb-4">
                    <svg class="w-8 h-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h1 class="text-3xl font-bold text-white">
                        Tus listas de reproducción
                    </h1>
                </div>
                
                <!-- Botón crear playlist - SOLO se muestra cuando HAY playlists -->
                <div v-if="playlists && playlists.length > 0" class="py-3">
                    <Link 
                        :href="route('playlist.create')" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-blue-500/25"
                    > 
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear nueva lista de reproducción
                    </Link>
                </div>
            </div>

            <!-- Lista de playlists - SOLO se muestra cuando HAY playlists -->
            <div v-if="playlists && playlists.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
                <div 
                    v-for="playlist in playlists" 
                    :key="playlist.id" 
                    class="bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/20 text-white hover:bg-white/15 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl"
                >
                    <div class="flex items-start justify-between mb-4">
                        <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                        
                        <span class="bg-blue-500/30 text-blue-200 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ contarSonidos(playlist) }} sonidos
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-semibold mb-2 truncate">{{ playlist.nombre }}</h3>
                    
                    <p v-if="playlist.descripcion" class="text-gray-300 mb-4 line-clamp-2">
                        {{ playlist.descripcion }}
                    </p>
                    
                    <p v-else class="text-gray-500 text-sm italic mb-4">
                        Sin descripción
                    </p>
                    
                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">
                        <Link 
                            :href="route('playlist.show', playlist.id)" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-all duration-300 flex items-center"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Ver
                        </Link>
                        
                        <!-- Temporalmente comentado hasta que tengas la ruta reproducir -->
                        <!-- <Link 
                            :href="route('playlists.reproducir', playlist.id)" 
                            class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm transition-all duration-300 flex items-center"
                        >
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Reproducir
                        </Link> -->
                    </div>
                </div>
            </div>

            <!-- Mensaje cuando NO hay playlists - SOLO se muestra cuando NO HAY playlists -->
            <div v-else class="text-center mt-12">
                <div class="bg-gradient-to-br from-white/5 to-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 max-w-md mx-auto shadow-xl">
                    <div class="mb-6">
                        <svg class="w-16 h-16 text-gray-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-white mb-2">Aún no tienes listas de reproducción creadas</h3>
                    <p class="text-gray-400 mb-6">¡Comienza creando tu primera playlist!</p>
                    
                    <Link 
                        :href="route('playlist.create')" 
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-blue-500/25"
                    > 
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear primera lista de reproducción
                    </Link>
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>