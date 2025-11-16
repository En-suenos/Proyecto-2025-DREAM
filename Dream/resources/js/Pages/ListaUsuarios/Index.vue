<script setup>
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

import fondo2 from '@/img/fondo2.jpg'

const props = defineProps({
    usuarios: {
        type: Object
    }
});

const searchEmail = ref('');

// Filtrar usuarios por email
const filteredUsuarios = computed(() => {
    if (!searchEmail.value) {
        return props.usuarios;
    }
    return props.usuarios.filter(usuario => 
        usuario.email.toLowerCase().includes(searchEmail.value.toLowerCase())
    );
});

// Contar usuarios
const totalUsuarios = computed(() => props.usuarios?.length || 0);
const usuariosFiltrados = computed(() => filteredUsuarios.value?.length || 0);
</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        <div class="w-full min-h-screen bg-cover bg-center p-6"
            :style="{ backgroundImage: `url(${fondo2})` }">
            
            <!-- Contenedor principal con efecto brumoso -->
            <div class="bg-white/15 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 p-8 max-w-7xl mx-auto">
                
                <!-- Sección unificada de funcionalidades con efecto brumoso -->
                <div class="mb-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    
                    <!-- Botón de regresar con diseño verdoso -->
                    <Link
                        :href="route('admin.index')"
                        class="inline-flex items-center space-x-2 bg-green-500/80 backdrop-blur-sm hover:bg-green-600/80 text-white font-semibold py-3 px-6 rounded-xl transition mb-4 border border-green-400/50 shadow-lg"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Regresar</span>
                    </Link>

                    <!-- Título y contador -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-white mb-3">Usuarios Registrados</h1>
                        <div class="flex flex-wrap items-center gap-4">
                            <p class="text-white/80 bg-white/10 px-4 py-2 rounded-lg border border-white/20">
                                Total de usuarios: <span class="font-semibold text-white">{{ totalUsuarios }}</span>
                            </p>
                            <p v-if="searchEmail" class="text-white/80 bg-white/10 px-4 py-2 rounded-lg border border-white/20">
                                Resultados: <span class="font-semibold text-white">{{ usuariosFiltrados }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Buscador -->
                    <div>
                        <label class="block text-white font-medium mb-3 text-lg">Buscar por email:</label>
                        <input 
                            v-model="searchEmail"
                            type="text"
                            placeholder="Ingrese el email del usuario..."
                            class="w-full max-w-md bg-white/20 border border-white/30 rounded-xl px-4 py-3 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-green-400/50 focus:border-transparent backdrop-blur-sm"
                        />
                    </div>
                </div>

                <!-- Tabla con diseño mejorado para visibilidad -->
                <div class="overflow-x-auto bg-white/5 backdrop-blur-sm rounded-2xl border border-white/20">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-green-500/30 to-emerald-500/30 backdrop-blur-sm">
                                <th class="px-6 py-4 border-b border-white/30 text-white font-bold text-lg">ID</th>
                                <th class="px-6 py-4 border-b border-white/30 text-white font-bold text-lg">Nombre</th>
                                <th class="px-6 py-4 border-b border-white/30 text-white font-bold text-lg">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr 
                                v-for="(usuario, index) in filteredUsuarios" 
                                :key="index" 
                                class="border-b border-white/10 hover:bg-white/10 transition duration-300"
                                :class="index % 2 === 0 ? 'bg-white/5' : 'bg-white/3'"
                            >
                                <td class="px-6 py-4 text-white font-semibold text-base">{{ usuario.id }}</td>
                                <td class="px-6 py-4 text-white text-base">{{ usuario.name }}</td>
                                <td class="px-6 py-4 text-white text-base">{{ usuario.email }}</td>
                            </tr>
                            <tr v-if="filteredUsuarios.length === 0">
                                <td colspan="3" class="px-6 py-8 text-center text-white/70 text-lg">
                                    <i class="fas fa-search mr-2"></i>
                                    No se encontraron usuarios
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información adicional -->
                <div class="mt-6 p-4 bg-white/10 backdrop-blur-sm rounded-xl border border-white/20">
                    <p class="text-white/70 text-sm text-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Mostrando {{ usuariosFiltrados }} de {{ totalUsuarios }} usuarios
                        <span v-if="searchEmail" class="ml-2 text-green-300">• Búsqueda activa</span>
                    </p>
                </div>
            </div>
        </div>
    </LayoutLimplio>
</template>

<style scoped>
/* Estilos adicionales para mejorar el efecto brumoso */
.glass-effect {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 
        0 8px 32px 0 rgba(31, 38, 135, 0.37),
        inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
}

/* Mejora la apariencia del placeholder */
::placeholder {
    color: rgba(255, 255, 255, 0.7) !important;
}

/* Efectos de transición suaves */
* {
    transition: all 0.3s ease;
}

/* Scroll personalizado para la tabla */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Mejora la visibilidad de las filas de la tabla */
tr:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>