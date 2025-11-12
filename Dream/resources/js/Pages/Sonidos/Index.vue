<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    archivos: {
        type: Array, 
        required: true,
        default: () => []
    }
});

// Array para estrellas dinámicas
const stars = ref([]);

// Función para obtener la URL del audio
const getAudioUrl = (filename) => {
    return `/audio/${filename}`;
};

// Generar estrellas aleatorias al montar el componente
onMounted(() => {
    const numStars = 80; // Número de estrellas (ajusta si quieres más o menos)
    for (let i = 0; i < numStars; i++) {
        stars.value.push({
            id: i,
            top: Math.random() * 100 + '%',
            left: Math.random() * 100 + '%',
            size: Math.random() * 3 + 1 + 'px', // Tamaño entre 1-4px
            delay: Math.random() * 3 + 's', // Delay aleatorio
            duration: (Math.random() * 2 + 2) + 's' // Duración entre 2-4s
        });
    }
});
</script>

<template>
    <Head title="VentanaCuenta" />

    <AuthenticatedLayout>
        <!-- Fondo nocturno con gradiente -->
        <div class="min-h-screen bg-gradient-to-b from-indigo-900 via-purple-900 to-black text-white relative overflow-hidden py-12">
            <!-- Elementos visuales calmantes: estrellas generadas dinámicamente -->
            <div class="absolute inset-0">
                <div 
                    v-for="star in stars" 
                    :key="star.id" 
                    class="star" 
                    :style="{ 
                        top: star.top, 
                        left: star.left, 
                        width: star.size, 
                        height: star.size, 
                        animationDelay: star.delay, 
                        animationDuration: star.duration 
                    }"
                ></div>
            </div>

            <!-- Contenido principal -->
            <div class="relative z-10 py-12">
                <!-- Título con animación -->
                <h1 class="text-4xl font-light text-indigo-200 p-4 mb-8 text-center animate-fade-in">
                    Sonidos
                </h1>
                
                <!-- Botón salir con estilo relajante -->
                <div class="flex items-center justify-center mb-8">
                    <Link :href="route('ConCuenta.index')" class="bg-indigo-600 hover:bg-indigo-800 text-white font-light py-3 px-6 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 focus:outline-none focus:shadow-outline">
                        Salir
                    </Link>
                </div>

                <!-- Lista de sonidos con animaciones -->
                <div class="space-y-6 max-w-4xl mx-auto px-4">
                    <div v-for="(archivo, index) in archivos"
                        :key="index" 
                        class="sound-item bg-indigo-900 bg-opacity-50 p-6 rounded-xl shadow-lg flex flex-col md:flex-row justify-between items-center gap-4 transition duration-300 hover:shadow-xl hover:bg-opacity-70 border border-indigo-700 animate-fade-in"
                        :style="{ animationDelay: `${index * 0.1}s` }">

                        <div class="sound-info flex items-center space-x-3 w-full md:w-1/3">
                            <!-- Icono SVG simple para el audio -->
                            <svg class="w-8 h-8 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v14M9 19h12M9 19c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2zm12-2c0 1.105-1.79 2-4 2s-4-.895-4-2 1.79-2 4-2 4 .895 4 2z"></path>
                            </svg>
                            <!-- Nombre del archivo -->
                            <span class="font-light text-xl text-indigo-100 truncate">{{ archivo }}</span>
                        </div>

                        <!-- Audio Player con controles estilizados -->
                        <audio 
                            controls
                            preload="metadata"
                            :src="getAudioUrl(archivo)"
                            class="w-full md:w-2/3 custom-audio"
                        >
                            Tu navegador no soporta el elemento de audio.
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Estilos personalizados para animaciones */
.star {
    position: absolute;
    background: white;
    border-radius: 50%;
    animation: twinkle infinite ease-in-out;
}

@keyframes twinkle {
    0%, 100% { 
        opacity: 0.2; 
        transform: scale(0.8); 
    }
    50% { 
        opacity: 1; 
        transform: scale(1.2); 
    }
}

.animate-fade-in {
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(30px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Estilos personalizados para el reproductor de audio */
.custom-audio {
    background-color: rgba(79, 70, 229, 0.1); /* Indigo semi-transparente */
    border-radius: 0.5rem;
    padding: 0.5rem;
}

.custom-audio::-webkit-media-controls-panel {
    background-color: rgba(79, 70, 229, 0.2);
    border-radius: 0.5rem;
}

.custom-audio::-webkit-media-controls-current-time-display,
.custom-audio::-webkit-media-controls-time-remaining-display {
    color: #e0e7ff; /* Indigo claro */
}

/* Mejoras de responsividad */
@media (max-width: 640px) {
    h1 {
        font-size: 2.5rem;
    }
    
    .sound-item {
        padding: 1rem;
    }
    
    .sound-info span {
        font-size: 1.2rem;
    }
}
</style>