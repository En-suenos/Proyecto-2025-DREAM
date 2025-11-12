<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    usuarios: {
        type: Object,
        default: () => ({})
    }
});
</script>

<template>
    <Head title="Inicio" />

    <AuthenticatedLayout>
        <!-- Fondo nocturno con gradiente y estrellas -->
        <div class="min-h-screen bg-gradient-to-b from-indigo-900 via-purple-900 to-black text-white relative overflow-hidden py-12">
            <!-- Elementos visuales calmantes: estrellas simuladas -->
            <div class="absolute inset-0">
                <div class="star" style="top: 15%; left: 25%;"></div>
                <div class="star" style="top: 40%; left: 60%;"></div>
                <div class="star" style="top: 70%; left: 10%;"></div>
                <!-- Agrega más si quieres -->
            </div>

            <!-- Botón Agregar cuenta con animación -->
            <div class="flex items-center justify-center mb-8">
                <Link :href="route('registro.create')" 
                class="bg-indigo-600 hover:bg-indigo-800 text-white font-light py-3 px-6 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 animate-pulse-slow focus:outline-none focus:shadow-outline">
                Agregar cuenta</Link>
            </div>

            <!-- Tabla con estilo relajante -->
            <div class="py-12 max-w-4xl mx-auto">
                <table class="min-w-full border-collapse border border-indigo-700 rounded-lg overflow-hidden shadow-lg animate-fade-in">
                    <thead class="bg-indigo-800">
                      <tr>
                        <th class="px-6 py-4 text-left text-indigo-200 font-light">Cuentas creadas</th>
                        <th class="px-6 py-4 text-left text-indigo-200 font-light">Usar cuenta</th>
                      </tr>
                    </thead>
                    <tbody class="bg-indigo-900 bg-opacity-50">
                      <tr v-for="(usuario, index) in usuarios" :key="index" class="animate-fade-in-row" :style="{ animationDelay: `${index * 0.2}s` }">
                        <td class="px-6 py-4 border-b border-indigo-700 text-indigo-100">{{ usuario.nombre_cuenta }}</td>
                        <td class="px-6 py-4 border-b border-indigo-700">
                            <Link :href="route('ConCuenta.index')" class="bg-indigo-600 hover:bg-indigo-800 text-white font-light py-2 px-4 rounded-full transition-all duration-300 ease-in-out transform hover:scale-105">
                                Ingresar
                            </Link>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Estilos personalizados para animaciones */
.star {
    position: absolute;
    width: 2px;
    height: 2px;
    background: white;
    border-radius: 50%;
    animation: twinkle 2s infinite ease-in-out;
}

@keyframes twinkle {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

.animate-fade-in {
    animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in-row {
    animation: fadeInRow 0.8s ease-in-out forwards;
    opacity: 0;
}

@keyframes fadeInRow {
    to { opacity: 1; transform: translateY(0); }
}

.animate-pulse-slow {
    animation: pulse 3s infinite;
}
</style>