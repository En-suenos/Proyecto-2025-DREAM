<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    usuarios:{
        Object
    }
})
</script>

<template>
    <Head title="Perfil" />

    <AuthenticatedLayout>
        <h1>
            Mi Perfil
        </h1>
        {{ usuarios }}
        <div>
            <h2>Nombre: {{ usuarios.name }}</h2>
        </div>
    </AuthenticatedLayout>
</template>