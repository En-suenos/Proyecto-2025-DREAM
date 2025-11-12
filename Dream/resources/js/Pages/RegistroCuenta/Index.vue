<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const formulario = useForm({
    nombre: '',
    correo: '',
    contraseña: '',
});

// Array para estrellas dinámicas
const stars = ref([]);

const createUsuario = () => {
    const url = route('registro.store');
    formulario.post(url, {
        onSuccess: (response) => {
            // Manejo de éxito si es necesario
        }
    });
};

// Generar estrellas aleatorias al montar el componente
onMounted(() => {
    const numStars = 80; // Número de estrellas
    for (let i = 0; i < numStars; i++) {
        stars.value.push({
            id: i,
            top: Math.random() * 100 + '%',
            left: Math.random() * 100 + '%',
            size: Math.random() * 3 + 1 + 'px',
            delay: Math.random() * 3 + 's',
            duration: (Math.random() * 2 + 2) + 's'
        });
    }
});
</script>

<template>
    <Head title="Registro Cuenta" />

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
            <div class="relative z-10 py-12 max-w-md mx-auto px-4">
                <form @submit.prevent="createUsuario" class="bg-indigo-900 bg-opacity-50 p-8 rounded-xl shadow-lg animate-fade-in">
                    <div class="mb-6">
                        <label class="block text-indigo-200 text-sm font-light mb-2" for="username">
                          Nombre
                        </label>
                        <input v-model="formulario.nombre" class="shadow appearance-none border border-indigo-600 rounded w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-400 bg-indigo-100" id="username" type="text" placeholder="Nombre de usuario" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-indigo-200 text-sm font-light mb-2" for="username">
                          Correo
                        </label>
                        <input v-model="formulario.correo" class="shadow appearance-none border border-indigo-600 rounded w-full py-3 px-4 text-gray-800 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-400 bg-indigo-100" id="username" type="email" placeholder="Correo electrónico" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-indigo-200 text-sm font-light mb-2" for="password">
                          Contraseña
                        </label>
                        <input v-model="formulario.contraseña" class="shadow appearance-none border border-red-500 rounded w-full py-3 px-4 text-gray-800 mb-3 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-400 bg-indigo-100" id="password" type="password" placeholder="******************" required>
                        <p class="text-red-400 text-xs italic">Por favor, elige una contraseña más segura.</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-indigo-600 hover:bg-indigo-800 text-white font-light py-3 px-6 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 focus:outline-none focus:shadow-outline" type="submit">
                          Guardar
                        </button>
                    </div>
                </form>
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
</style>