<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import fondo2 from '@/img/fondo2.jpg'
</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        <div 
            class="w-full h-screen bg-cover bg-center"
            :style="{ backgroundImage: `url(${fondo2})` }"
        >
            <div class="container mx-auto px-4 py-8">
                <!-- Botón cerrar sesión -->
                <div class="text-right mb-6">
                    <Link
                        :href="route('admin.logout')"
                        method="post"
                        as="button"
                        class="bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold transition duration-300 shadow-lg"
                    >
                        <i class="fas fa-sign-out-alt mr-2"></i>Cerrar sesión
                    </Link>
                </div>

                <!-- Encabezado -->
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-white mb-4">
                        Bienvenido
                    </h1>
                    <p class="text-xl text-white/80">Panel de Administración</p>
                </div>

                <!-- Contenedor principal -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl w-full max-w-4xl mx-auto flex overflow-hidden shadow-2xl">
                    
                    <!-- Sidebar con efecto de vidrio desenfocado -->
                    <aside class="bg-white/15 backdrop-blur-lg border-r border-white/20 w-64 p-6">
                        <h2 class="text-2xl font-semibold text-white mb-6 border-b border-white/30 pb-2">Menú</h2>
                        <nav class="space-y-2">
                            <Link 
                                :href="route('usuario.index')" 
                                class="block text-white hover:bg-white/20 px-4 py-3 rounded-lg transition duration-300"
                            >
                                <i class="fas fa-user mr-3"></i>Ver usuarios
                            </Link>
                            <Link 
                                :href="route('adminSonidos.index')" 
                                class="block text-white hover:bg-white/20 px-4 py-3 rounded-lg transition duration-300"
                            >
                                <i class="fas fa-music mr-3"></i>Ver sonidos
                            </Link>
                            <div class="nav-actions mt-8">
                                <a 
                                    href="/usuarios/reporte/pdf" 
                                    class="block bg-cyan-500/80 hover:bg-cyan-600 text-white px-4 py-3 rounded-lg font-semibold transition duration-300 text-center"
                                >
                                    <i class="fas fa-file-pdf mr-2"></i> PDF
                                </a>
                            </div>
                        </nav>
                    </aside>

                    <!-- Contenido principal -->
                    <main class="flex-1 p-8">
                        <div class="text-center text-white/70 py-16">
                            <i class="fas fa-tachometer-alt text-5xl mb-4 opacity-50"></i>
                            <p class="text-xl">Selecciona una opción del menú para comenzar</p>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </LayoutLimplio>
</template>

<style scoped>
/* Estilos adicionales para mejorar el efecto de vidrio */
.glass-sidebar {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
}

.nav-link {
    display: block;
    padding: 12px 20px;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin-bottom: 8px;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateX(5px);
}
</style>