<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link} from '@inertiajs/vue3';

</script>

<template>
    <Head title="Playlist" />

    <LayoutLimplio>
        <h2>
            Tus Playlist
        </h2>
        <div class="py-3">
            <div class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >
                <Link :href="route('playlist.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> 
                    Crea tu nueva playlist
                </Link>
            </div>
        </div>
        
    </LayoutLimplio>
</template>
