<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// --- 🌟 Estrellas normales ---
const stars = ref([]);
onMounted(() => {
    const totalStars = 100; // cantidad de estrellas
    stars.value = Array.from({ length: totalStars }).map(() => ({
        top: `${Math.random() * 100}%`,
        left: `${Math.random() * 100}%`,
        size: `${Math.random() * 3 + 1}px`,
        delay: `${Math.random() * 3}s`,
        duration: `${2 + Math.random() * 3}s`
    }));
});

// --- 💫 Estrellas fugaces ---
const shootingStars = ref([]);

function createShootingStar() {
    const id = Date.now();
    const startLeft = Math.random() * 100;
    shootingStars.value.push({
        id,
        top: `${Math.random() * 50}%`,
        left: `${startLeft}%`
    });

    // remover después de animar
    setTimeout(() => {
        shootingStars.value = shootingStars.value.filter(s => s.id !== id);
    }, 2000);
}

// generar estrellas fugaces aleatorias
onMounted(() => {
    setInterval(() => {
        if (Math.random() > 0.7) createShootingStar();
    }, 3000);
});

// --- 🌙 Botón "Iniciar sueño" ---
const isStartingSleep = ref(false);
const startSleep = () => {
    isStartingSleep.value = true;
    setTimeout(() => {
        alert('💤 ¡Dulces sueños! Tu viaje ha comenzado...');
        isStartingSleep.value = false;
    }, 3000);
};
</script>

<template>
    <Head title="Dream - Inicio" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-gradient-to-b from-indigo-900 via-purple-900 to-black text-white relative overflow-hidden animate-sky-move">

            <!-- 🌟 Estrellas normales -->
            <div class="absolute inset-0 overflow-hidden">
                <div
                    v-for="(star, index) in stars"
                    :key="index"
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

            <!-- 💫 Estrellas fugaces -->
            <div v-for="shooting in shootingStars" :key="shooting.id"
                class="shooting-star"
                :style="{ top: shooting.top, left: shooting.left }">
            </div>

            <!-- 🌙 Contenido principal -->
            <div class="relative z-10 flex flex-col items-center justify-center min-h-screen py-12 text-center">
                <h1 class="text-5xl font-light text-indigo-200 mb-8 animate-fade-in">
                    🌌 Bienvenido a Dream 🌌
                </h1>

                <div class="flex flex-col items-center space-y-6 mb-12">
                    <Link :href="route('perfil.index')" class="menu-link">Mi perfil</Link>
                    <Link :href="route('sonido.index')" class="menu-link">Sonidos</Link>
                    <a href="#" class="menu-link">PlayList</a>
                    <a href="#" class="menu-link">Configuraciones</a>
                </div>

                <div class="flex justify-center">
                    <button 
                        @click="startSleep"
                        :disabled="isStartingSleep"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-light py-4 px-12 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 animate-pulse-slow disabled:opacity-50 disabled:cursor-not-allowed text-lg"
                    >
                        {{ isStartingSleep ? 'Iniciando Sueño...' : 'Iniciar Sueño' }}
                    </button>
                </div>

                <div v-if="isStartingSleep" class="mt-8 animate-fade-in">
                    <p class="text-indigo-300 mb-4 text-lg">Reproduciendo sonidos relajantes...</p>
                    <div class="w-80 mx-auto bg-gray-800 rounded-full h-3">
                        <div class="bg-indigo-500 h-3 rounded-full animate-progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* 🌟 Estrellas */
.star {
    position: absolute;
    background: white;
    border-radius: 50%;
    opacity: 0.8;
    animation: twinkle infinite ease-in-out, float infinite ease-in-out;
}
@keyframes twinkle {
    0%, 100% { opacity: 0.3; transform: scale(0.8); }
    50% { opacity: 1; transform: scale(1.2); }
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

/* 💫 Estrellas fugaces */
.shooting-star {
    position: absolute;
    width: 120px;
    height: 2px;
    background: linear-gradient(90deg, white, transparent);
    border-radius: 50%;
    opacity: 0.9;
    transform: rotate(-45deg);
    animation: shoot 1.5s ease-in-out forwards;
}
@keyframes shoot {
    from { transform: translate(0, 0) rotate(-45deg); opacity: 1; }
    to { transform: translate(400px, 200px) rotate(-45deg); opacity: 0; }
}

/* 🌌 Movimiento del fondo */
.animate-sky-move {
    background-size: 400% 400%;
    animation: skyMove 30s linear infinite;
}
@keyframes skyMove {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

/* ✨ Efectos generales */
.animate-fade-in {
    animation: fadeIn 1.5s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-pulse-slow {
    animation: pulse 4s infinite;
}
@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7); }
    50% { box-shadow: 0 0 0 20px rgba(99, 102, 241, 0); }
}

.animate-progress {
    animation: progress 3s linear;
}
@keyframes progress {
    from { width: 0%; }
    to { width: 100%; }
}

/* Menú */
.menu-link {
    color: #c7d2fe;
    text-decoration: none;
    font-size: 1.3rem;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    transition: color 0.3s, transform 0.3s, background-color 0.3s;
}
.menu-link:hover {
    color: #e0e7ff;
    background-color: rgba(199, 210, 254, 0.1);
    transform: translateY(-3px);
}

/* 📱 Responsivo */
@media (max-width: 640px) {
    h1 { font-size: 2.5rem; }
    .menu-link { font-size: 1.1rem; }
}
</style>
