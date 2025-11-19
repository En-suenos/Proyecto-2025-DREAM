<script setup>
import LayoutLimpio from '@/Layouts/LayoutLimpio.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    opciones: {
        type: Object,
        default: () => ({
            fondo: 'estrellado',
            idioma: 'es',
            notificaciones: true,
        })
    }
});

const form = useForm({
    fondo: props.opciones.fondo,
    idioma: props.opciones.idioma,
    notificaciones: props.opciones.notificaciones,
});

const submit = () => {
    form.post(route('obsiones.update'), {  // ⚠️ Nombre de ruta con "b"
        preserveScroll: true,
        onSuccess: () => {
            // Aplica idioma en tiempo real
            document.documentElement.setAttribute('lang', form.idioma);
            // Opcional: dispara evento global para cambiar fondo
            window.dispatchEvent(new CustomEvent('fondo-cambiado', { detail: form.fondo }));
        }
    });
};

// 🎨 Fondos disponibles
const fondos = [
    { id: 'estrellado', name: 'Cielo Estrellado', bg: 'from-gray-900 to-indigo-950' },
    { id: 'luna', name: 'Luna Brillante', bg: 'from-slate-900 to-amber-900/10' },
    { id: 'oscuro', name: 'Modo Oscuro', bg: 'bg-gray-900' },
    { id: 'claro', name: 'Modo Claro', bg: 'bg-gray-100 text-gray-900' },
];

// 🌍 Idiomas
const idiomas = [
    { code: 'es', name: 'Español' },
    { code: 'en', name: 'English' },
];

// 🌐 Traducciones básicas
const traducciones = {
    es: {
        title: 'Opciones',
        fondo: 'Fondo',
        idioma: 'Idioma',
        notif: 'Notificaciones',
        activar: 'Activar notificaciones',
        guardar: 'Guardar Cambios',
        exito: '✅ ¡Opciones actualizadas!',
    },
    en: {
        title: 'Settings',
        fondo: 'Background',
        idioma: 'Language',
        notif: 'Notifications',
        activar: 'Enable notifications',
        guardar: 'Save Changes',
        exito: '✅ Settings updated!',
    }
};

const t = ref(traducciones[form.idioma]);

watch(() => form.idioma, (nuevo) => {
    t.value = traducciones[nuevo];
});
</script>

<template>
    <Head :title="t.title" />

    <LayoutLimpio>
        <div class="min-h-screen bg-gradient-to-b from-slate-900 to-indigo-950 text-white p-4 md:p-8">
            <div class="max-w-3xl mx-auto">
                <!-- Encabezado -->
                <div class="text-center mb-10 mt-6">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 flex items-center justify-center">
                        <i class="fas fa-sliders-h mr-3 text-blue-400"></i>
                        {{ t.title }}
                    </h1>
                    <p class="text-gray-300 max-w-2xl mx-auto">
                        Personaliza tu experiencia: elige fondo, idioma y ajusta tus notificaciones.
                    </p>
                </div>

                <!-- Formulario -->
                <form @submit.prevent="submit" class="space-y-8">
                    <!-- 🎨 Selección de fondo -->
                    <div class="glass-panel p-6 rounded-2xl">
                        <h2 class="text-xl font-bold mb-5 flex items-center">
                            <i class="fas fa-paint-brush mr-2 text-purple-400"></i>
                            {{ t.fondo }}
                        </h2>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <label
                                v-for="f in fondos"
                                :key="f.id"
                                class="group relative rounded-xl overflow-hidden cursor-pointer transition-transform hover:scale-105 border-2"
                                :class="form.fondo === f.id 
                                    ? 'border-blue-500 shadow-lg ring-2 ring-blue-500/30' 
                                    : 'border-transparent hover:border-white/20'"
                            >
                                <input
                                    type="radio"
                                    :value="f.id"
                                    v-model="form.fondo"
                                    class="sr-only"
                                />
                                <div 
                                    class="w-full h-24 flex items-center justify-center text-xs font-medium text-white/80 transition-colors"
                                    :class="f.id === 'claro' 
                                        ? 'bg-gray-100 text-gray-900' 
                                        : `bg-gradient-to-b ${f.bg}`"
                                >
                                    {{ f.name }}
                                </div>
                                <div 
                                    v-if="form.fondo === f.id"
                                    class="absolute inset-0 flex items-center justify-center"
                                >
                                    <i class="fas fa-check-circle text-blue-400 text-xl"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- 🌍 Idioma -->
                    <div class="glass-panel p-6 rounded-2xl">
                        <h2 class="text-xl font-bold mb-5 flex items-center">
                            <i class="fas fa-language mr-2 text-green-400"></i>
                            {{ t.idioma }}
                        </h2>
                        <div class="space-y-3">
                            <label
                                v-for="lang in idiomas"
                                :key="lang.code"
                                class="flex items-center p-4 rounded-xl bg-white/5 hover:bg-white/10 cursor-pointer transition group"
                            >
                                <div class="relative w-5 h-5 mr-4">
                                    <input
                                        type="radio"
                                        :value="lang.code"
                                        v-model="form.idioma"
                                        class="sr-only"
                                    />
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-400 flex items-center justify-center">
                                        <div 
                                            v-if="form.idioma === lang.code"
                                            class="w-3 h-3 rounded-full bg-blue-500 transition-all"
                                        ></div>
                                    </div>
                                </div>
                                <span class="text-lg">{{ lang.name }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- 🔔 Notificaciones -->
                    <div class="glass-panel p-6 rounded-2xl">
                        <h2 class="text-xl font-bold mb-5 flex items-center">
                            <i class="fas fa-bell mr-2 text-amber-400"></i>
                            {{ t.notif }}
                        </h2>
                        <label class="flex items-center justify-between p-4 bg-white/5 rounded-xl cursor-pointer">
                            <span>{{ t.activar }}</span>
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    v-model="form.notificaciones"
                                    class="sr-only"
                                />
                                <div
                                    :class="[
                                        'w-12 h-6 rounded-full transition-colors duration-300',
                                        form.notificaciones ? 'bg-blue-500' : 'bg-gray-600'
                                    ]"
                                ></div>
                                <div
                                    :class="[
                                        'absolute top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300',
                                        form.notificaciones ? 'left-7' : 'left-1'
                                    ]"
                                ></div>
                            </div>
                        </label>
                    </div>

                    <!-- ✅ Botón guardar -->
                    <div class="text-center pt-6">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all disabled:opacity-75 disabled:cursor-not-allowed flex items-center mx-auto"
                        >
                            <i class="fas fa-save mr-2"></i>
                            {{ t.guardar }}
                        </button>

                        <div 
                            v-if="form.recentlySuccessful"
                            class="mt-4 text-green-400 font-medium flex items-center justify-center animate-pulse"
                        >
                            <i class="fas fa-check-circle mr-2"></i> {{ t.exito }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </LayoutLimpio>
</template>

<style scoped>
.glass-panel {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.35);
}
</style>