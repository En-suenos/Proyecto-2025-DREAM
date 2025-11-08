<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="VentanaCuenta" />

    <AuthenticatedLayout>
        <h1 class="text-4xl font-extrabold text-blue-500 p-4 mb-4">
            Welcome to Dream
        </h1>
        <!-- Para el menu -->
        <br>
        
        <div >
            <a href="perfil">Mi perfil</a>
            <br>
            <a href="sonido">Sonidos</a>
            <br>
            <a href="#">PlayList</a>
            <br>
            <a href="#"></a>
        </div>

        <!-- Boton iniciar sueño -->
        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Iniciar Sueño 
            </button>
        </div>
    </AuthenticatedLayout>
</template>