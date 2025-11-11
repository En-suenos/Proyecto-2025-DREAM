<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

// const props = defineProps({
//     usuario:Object
    
// })


</script>

<template>
    <Head title="Perfil" />

    <LayoutLimplio>
        <h1>
            Mi Perfil
        </h1>
        
        <div>
            <h2>Nombre: {{ $page.props.auth.user.name }}</h2>
            <h2>Correo: {{ $page.props.auth.user.email }}</h2>
        </div>
        <div class="flex items-center justify-center">
            <Link :href="route('ConCuenta.index')"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Regresar
            </Link>
        </div>
    </LayoutLimplio>
</template>