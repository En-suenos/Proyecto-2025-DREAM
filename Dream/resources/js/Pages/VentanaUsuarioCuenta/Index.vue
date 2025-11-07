<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="VentanaCuenta" />

    <AuthenticatedLayout>
        <h1>
            Welcome to Dream
        </h1>
        <!-- Para el menu -->
        <br>
        <div >
            <a href="perfil">Mi perfil</a>
            <br>
            <a href="#">Sonidos</a>
            <a href="#">PlayList</a>
            <a href="#"></a>
        </div>

        <!-- Boton iniciar sueño -->
        <div>
            <h2>
                Iniciar Sueño 
            </h2>
        </div>
    </AuthenticatedLayout>
</template>