<script setup>
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

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
        <div class="p-6">
            <!-- Botón de regresar -->
            <Link
                :href="route('admin.inicio')"
                class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition mb-6"
            >
                <i class="fas fa-arrow-left"></i>
                <span>Regresar</span>
            </Link>

            <!-- Título y contador -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-2">Usuarios Registrados</h1>
                <p class="text-gray-600">
                    Total de usuarios: <span class="font-semibold">{{ totalUsuarios }}</span>
                    <span v-if="searchEmail"> | Resultados: <span class="font-semibold">{{ usuariosFiltrados }}</span></span>
                </p>
            </div>

            <!-- Buscador -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Buscar por email:</label>
                <input 
                    v-model="searchEmail"
                    type="text"
                    placeholder="Ingrese el email del usuario..."
                    class="w-full max-w-md border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <!-- Tabla de usuarios -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 border-b">Id</th>
                            <th class="px-6 py-3 border-b">Nombre</th>
                            <th class="px-6 py-3 border-b">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(usuario, index) in filteredUsuarios" :key="index" class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3">{{ usuario.id }}</td>
                            <td class="px-6 py-3">{{ usuario.name }}</td>
                            <td class="px-6 py-3">{{ usuario.email }}</td>
                        </tr>
                        <tr v-if="filteredUsuarios.length === 0">
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                No se encontraron usuarios
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </LayoutLimplio>
</template>