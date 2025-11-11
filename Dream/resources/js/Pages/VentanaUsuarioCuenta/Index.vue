<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        <h1 class="text-4xl font-extrabold text-blue-500 p-4 mb-4">
            Welcome to Dream
            
        </h1>
        <br>
        <div class="mt-3 space-y-1">
            <Link
                :href="route('logout')"
                method="post"
                as="button"
            >
                Log Out
            </Link>
        </div>
        <!-- Para el menu -->
        <br>
        
        <div >
            <a href="perfil">Mi perfil</a>
            <br>
            <a href="sonido">Sonidos</a>
            <br>
            <a href="playlist">PlayList</a>
            <br>
            <a href="#"></a>
        </div>

        <!-- Boton iniciar sueño -->
        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Iniciar Sueño 
            </button>
        </div>
    </LayoutLimplio>
</template>