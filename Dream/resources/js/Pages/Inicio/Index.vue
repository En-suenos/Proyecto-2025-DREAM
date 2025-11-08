<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    usuarios:{
        Object
    }
})
</script>

<template>
    <Head title="Inicio" />

    <AuthenticatedLayout>
        <div class="py-12">
            
            <div class="flex items-center justify-center">
                <Link :href="route('registro.create')" 
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Agregar cuenta</Link>
            </div>
            <!-- {{ usuarios }} -->
            <div class="py-12">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-blue-500">
                      <tr>
                        <th class="px-4 py-2 text-left text-white">Cuentas creadas</th>
                        <th class="px-4 py-2 text-left text-white">Usar cuenta</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(usuarios, index) in usuarios":key="index">
                        <td class="px-4 py-2 border border-gray-300">{{ usuarios.nombre_cuenta }}</td>
                        <td class="px-4 py-2 border border-gray-300">
                            <Link :href="route('ConCuenta.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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