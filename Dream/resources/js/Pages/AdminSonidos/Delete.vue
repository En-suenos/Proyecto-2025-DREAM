<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    sonido: {
        type: Object,
        required: true
    }
});

const form = useForm({});

const submit = () => {
    form.delete(route('sonidos.destroy', props.sonido.id_sonido));
};
</script>

<template>
    <Head title="Eliminar Sonido - DreamApp" />

    <LayoutLimpio>
        <div class="min-h-screen bg-gray-50 py-8">
            <div class="max-w-md mx-auto px-4">
                
                <!-- Encabezado -->
                <div class="mb-8">
                    <Link
                        :href="route('sonidos.index')"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver a Sonidos
                    </Link>
                    <h1 class="text-2xl font-bold text-gray-900">Eliminar Sonido</h1>
                    <p class="text-gray-600 mt-2">Confirmar eliminación del sonido</p>
                </div>

                <!-- Panel de confirmación -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <!-- Icono de advertencia -->
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">¿Estás seguro de eliminar este sonido?</h3>
                    </div>

                    <!-- Información del sonido -->
                    <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-music text-red-600 mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-medium text-red-800">{{ sonido.nombre }}</h4>
                                <p class="text-sm text-red-700 mt-1">
                                    <span class="font-medium">Categoría:</span> 
                                    {{ sonido.categoria || 'Sin categoría' }}
                                </p>
                                <p class="text-sm text-red-700">
                                    <span class="font-medium">Archivo:</span> {{ sonido.archivo_audio }}
                                </p>
                                <p class="text-sm text-red-700">
                                    <span class="font-medium">Duración:</span> 
                                    {{ Math.floor(sonido.duracion / 60) }}:{{ (sonido.duracion % 60).toString().padStart(2, '0') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Advertencia -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-3"></i>
                            <div>
                                <p class="text-sm text-yellow-800">
                                    <strong>Esta acción no se puede deshacer.</strong> El archivo de audio será 
                                    eliminado permanentemente del sistema.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de eliminación -->
                    <form @submit.prevent="submit" class="space-y-4">
                        <div class="flex gap-4">
                            <Link
                                :href="route('sonidos.index')"
                                class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors text-center"
                            >
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex-1 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            >
                                <span v-if="form.processing">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Eliminando...
                                </span>
                                <span v-else>
                                    <i class="fas fa-trash mr-2"></i>
                                    Eliminar Permanentemente
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </LayoutLimpio>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
</style>