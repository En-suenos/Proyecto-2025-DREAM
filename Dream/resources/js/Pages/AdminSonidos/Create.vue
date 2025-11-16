<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Formulario para subir sonidos
const form = useForm({
    nombre: '',
    archivo: null,
    categoria: '',
    descripcion: ''
});

// Función para subir el archivo
const submit = () => {
    form.post(route('adminSonidos.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
};

// Manejar selección de archivo
const handleFileChange = (event) => {
    form.archivo = event.target.files[0];
};
</script>

<template>
    <Head title="Añadir Sonido - DreamApp" />

    <LayoutLimpio>
        <div class="min-h-screen bg-gray-50 py-8">
            <div class="max-w-2xl mx-auto px-4">
                
                <!-- Encabezado -->
                <div class="mb-8">
                    <Link
                        :href="route('adminSonidos.index')"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver a Sonidos
                    </Link>
                    <h1 class="text-3xl font-bold text-gray-900">Añadir Nuevo Sonido</h1>
                    <p class="text-gray-600 mt-2">Sube un archivo de audio para agregarlo a la biblioteca</p>
                </div>

                <!-- Formulario -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Campo Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Sonido *
                            </label>
                            <input
                                type="text"
                                id="nombre"
                                v-model="form.nombre"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ej: Lluvia Relajante"
                            />
                            <p v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">
                                {{ form.errors.nombre }}
                            </p>
                        </div>

                        <!-- Campo Categoría -->
                        <div>
                            <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">
                                Categoría
                            </label>
                            <select
                                id="categoria"
                                v-model="form.categoria"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Seleccionar categoría</option>
                                <option value="naturaleza">Naturaleza</option>
                                <option value="meditacion">Meditación</option>
                                <option value="ambiental">Ambiental</option>
                                <option value="instrumental">Instrumental</option>
                                <option value="blanco">Ruido Blanco</option>
                            </select>
                        </div>

                        <!-- Campo Descripción -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                                Descripción
                            </label>
                            <textarea
                                id="descripcion"
                                v-model="form.descripcion"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Describe el sonido..."
                            ></textarea>
                        </div>

                        <!-- Campo Archivo -->
                        <div>
                            <label for="archivo" class="block text-sm font-medium text-gray-700 mb-2">
                                Archivo de Audio *
                            </label>
                            <input
                                type="file"
                                id="archivo"
                                @change="handleFileChange"
                                accept="audio/*"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            />
                            <p class="text-sm text-gray-500 mt-1">
                                Formatos aceptados: MP3, WAV, OGG (Máx. 10MB)
                            </p>
                            <p v-if="form.errors.archivo" class="text-red-500 text-sm mt-1">
                                {{ form.errors.archivo }}
                            </p>
                        </div>

                        <!-- Vista previa del archivo seleccionado -->
                        <div v-if="form.archivo" class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <div class="flex items-center">
                                <i class="fas fa-music text-blue-600 mr-3"></i>
                                <div>
                                    <p class="font-medium text-blue-800">{{ form.archivo.name }}</p>
                                    <p class="text-sm text-blue-600">
                                        {{ (form.archivo.size / 1024 / 1024).toFixed(2) }} MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4 pt-4">
                            <button
                                type="button"
                                @click="$inertia.visit(route('sonidos.index'))"
                                class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            >
                                <span v-if="form.processing">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    Subiendo...
                                </span>
                                <span v-else>
                                    <i class="fas fa-upload mr-2"></i>
                                    Subir Sonido
                                </span>
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Información adicional -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        Información importante
                    </h3>
                    <ul class="text-blue-700 space-y-2 text-sm">
                        <li>• Los archivos deben ser de alta calidad y sin distorsiones</li>
                        <li>• El nombre debe ser descriptivo y claro</li>
                        <li>• El tamaño máximo permitido es de 10MB por archivo</li>
                        <li>• Los sonidos serán revisados antes de ser publicados</li>
                    </ul>
                </div>

            </div>
        </div>
    </LayoutLimpio>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
</style>