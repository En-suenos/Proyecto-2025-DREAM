<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import fondo2 from '@/img/fondo2.jpg'

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
        <div class="w-full min-h-screen bg-cover bg-center p-6 min-h-screen bg-gray-50 py-8"
            :style="{ backgroundImage: `url(${fondo2})` }">
            <div class="max-w-2xl mx-auto px-4">
                
                <!-- Encabezado -->
                <div class="mb-8">
                    <Link
                        :href="route('adminSonidos.index')"
                        class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 shadow-lg mb-4"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver a Sonidos
                    </Link>
                    <h1 class="text-4xl font-bold text-white mb-4 drop-shadow-lg">Añadir Nuevo Sonido</h1>
                    <p class="text-gray-300 mt-2 text-lg">Sube un archivo de audio para agregarlo a la biblioteca</p>
                </div>

                <!-- Formulario -->
                <div class="glass-panel rounded-2xl shadow-lg p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Campo Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-white mb-3">
                                Nombre del Sonido *
                            </label>
                            <input
                                type="text"
                                id="nombre"
                                v-model="form.nombre"
                                required
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-300 backdrop-blur-sm"
                                placeholder="Ej: Lluvia Relajante"
                            />
                            <p v-if="form.errors.nombre" class="text-red-400 text-sm mt-2">
                                {{ form.errors.nombre }}
                            </p>
                        </div>

                        <!-- Campo Categoría -->
                        <div>
                            <label for="categoria" class="block text-sm font-medium text-white mb-3">
                                Categoría
                            </label>
                            <select
                                id="categoria"
                                v-model="form.categoria"
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white backdrop-blur-sm"
                            >
                                <option value="" class="text-gray-800">Seleccionar categoría</option>
                                <option value="naturaleza" class="text-gray-800">Naturaleza</option>
                                <option value="meditacion" class="text-gray-800">Meditación</option>
                                <option value="ambiental" class="text-gray-800">Ambiental</option>
                                <option value="instrumental" class="text-gray-800">Instrumental</option>
                                <option value="blanco" class="text-gray-800">Ruido Blanco</option>
                            </select>
                        </div>

                        <!-- Campo Descripción -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-white mb-3">
                                Descripción
                            </label>
                            <textarea
                                id="descripcion"
                                v-model="form.descripcion"
                                rows="3"
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-gray-300 backdrop-blur-sm"
                                placeholder="Describe el sonido..."
                            ></textarea>
                        </div>

                        <!-- Campo Archivo -->
                        <div>
                            <label for="archivo" class="block text-sm font-medium text-white mb-3">
                                Archivo de Audio *
                            </label>
                            <input
                                type="file"
                                id="archivo"
                                @change="handleFileChange"
                                accept="audio/*"
                                required
                                class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700 backdrop-blur-sm"
                            />
                            <p class="text-sm text-gray-300 mt-2">
                                Formatos aceptados: MP3, WAV, OGG (Máx. 10MB)
                            </p>
                            <p v-if="form.errors.archivo" class="text-red-400 text-sm mt-2">
                                {{ form.errors.archivo }}
                            </p>
                        </div>

                        <!-- Vista previa del archivo seleccionado -->
                        <div v-if="form.archivo" class="bg-blue-500/20 border border-blue-400/30 rounded-xl p-4 backdrop-blur-sm">
                            <div class="flex items-center">
                                <i class="fas fa-music text-blue-400 mr-3 text-lg"></i>
                                <div>
                                    <p class="font-medium text-white">{{ form.archivo.name }}</p>
                                    <p class="text-sm text-blue-300">
                                        {{ (form.archivo.size / 1024 / 1024).toFixed(2) }} MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4 pt-6">
                            <button
                                type="button"
                                @click="$inertia.visit(route('adminSonidos.index'))"
                                class="flex-1 px-6 py-3 border border-white/20 text-white rounded-xl hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 backdrop-blur-sm"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg hover:shadow-xl"
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
                <div class="mt-8 glass-panel border border-blue-400/30 rounded-2xl p-6">
                    <h3 class="text-lg font-medium text-white mb-3">
                        <i class="fas fa-info-circle mr-2 text-blue-400"></i>
                        Información importante
                    </h3>
                    <ul class="text-gray-300 space-y-2 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-400 text-xs mt-1 mr-3"></i>
                            <span>Los archivos deben ser de alta calidad y sin distorsiones</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-400 text-xs mt-1 mr-3"></i>
                            <span>El nombre debe ser descriptivo y claro</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-400 text-xs mt-1 mr-3"></i>
                            <span>El tamaño máximo permitido es de 10MB por archivo</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-circle text-blue-400 text-xs mt-1 mr-3"></i>
                            <span>Los sonidos serán revisados antes de ser publicados</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </LayoutLimpio>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Panel de vidrio */
.glass-panel {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Estilos para los inputs */
input, select, textarea {
    backdrop-filter: blur(10px);
}

/* Placeholder color para inputs */
::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

/* Estilos para el file input */
input[type="file"]::file-selector-button {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border: none;
    padding: 12px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

input[type="file"]::file-selector-button:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
}

/* Efectos de transición */
.transition-all {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Sombras mejoradas */
.shadow-lg {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.shadow-xl {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

/* Text shadow para mejor legibilidad */
.drop-shadow-lg {
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.7);
}

/* Gradientes azules */
.from-blue-600 {
    --tw-gradient-from: #2563eb;
    --tw-gradient-to: rgba(37, 99, 235, 0);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-blue-700 {
    --tw-gradient-to: #1d4ed8;
}

.from-blue-700 {
    --tw-gradient-from: #1d4ed8;
    --tw-gradient-to: rgba(29, 78, 216, 0);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}

.to-blue-800 {
    --tw-gradient-to: #1e40af;
}
</style>