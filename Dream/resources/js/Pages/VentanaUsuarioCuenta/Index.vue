<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        
        
        <div class="min-h-screen bg-gradient-to-br from-gray-900 to-blue-900 flex flex-col items-center justify-center p-6 pt-24">
            <div class="bg-blue-500 text-white py-2 px-4 rounded shadow-md hover:shadow-lg">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                >
                    Cerrar sesion
                </Link>
            </div>
            <!-- Encabezado -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-extrabold text-white mb-2 drop-shadow-lg">
                    Bienvenido a <span class="text-blue-400">Dream</span>
                </h1>
                <p class="text-gray-300 text-lg">Tu espacio personal para controlar tus sonidos y sueños.</p>
            </div>

            <!-- Contenedor principal -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl w-full max-w-4xl flex overflow-hidden shadow-2xl">
                
                <!-- Sidebar -->
                <aside class="bg-gradient-to-b from-blue-800 to-indigo-900 text-white w-1/3 p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold mb-6 border-b border-white/30 pb-2">Menú</h2>
                        <nav class="space-y-4">
                            <a href="perfil" class="flex items-center hover:bg-white/20 px-3 py-2 rounded transition duration-300">
                                <i class="fas fa-user mr-2"></i> Mi perfil
                            </a>
                            <a href="sonido" class="flex items-center hover:bg-white/20 px-3 py-2 rounded transition duration-300">
                                <i class="fas fa-music mr-2"></i> Sonidos
                            </a>
                            <a href="playlists" class="flex items-center hover:bg-white/20 px-3 py-2 rounded transition duration-300">
                                <i class="fas fa-list mr-2"></i> Playlist
                            </a>
                            <a href="#" class="flex items-center hover:bg-white/20 px-3 py-2 rounded transition duration-300">
                                <i class="fas fa-robot mr-2"></i> Asistente
                            </a>
                            <a href="#" class="flex items-center hover:bg-white/20 px-3 py-2 rounded transition duration-300">
                                <i class="fas fa-cog mr-2"></i> Opciones
                            </a>
                        </nav>
                    </div>
                    <div class="text-sm text-center opacity-75">
                        © 2025 DreamApp
                    </div>
                </aside>

                <!-- Contenido principal -->
                <main class="flex-1 p-10 flex flex-col items-center justify-center">
                    <div class="text-center">
                        <div class="avatar w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-lg">
                            <i class="fas fa-music"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Control de Sueño</h3>
                        <p class="text-gray-300 mb-6">Explora tus playlists, configura tu perfil y disfruta de la música.</p>
                        
                        <!-- Tarjeta de sueño -->
                        <div class="card-sueno bg-gradient-to-r from-purple-500/20 to-indigo-600/20 backdrop-blur-sm border border-white/10 rounded-xl p-6 mb-6 shadow-lg max-w-md mx-auto transition-all duration-300 hover:translate-y-[-5px]">
                            <div class="card-body text-center">
                                <i class="fas fa-moon fa-2x text-yellow-300 mb-3"></i>
                                <p class="card-text text-white text-lg mb-4">😴 "Dormir no es perder el tiempo, es regalarle al cuerpo la energía y la claridad que necesita para seguir soñando despierto." 🌌</p>
                                
                                <!-- Botón principal -->
                                <button
                                    class="btn-sueno bg-gradient-to-r from-purple-600 to-indigo-700 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition-all duration-500 relative overflow-hidden"
                                >
                                    <i class="fas fa-play-circle mr-2"></i> Iniciar Sueño
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </LayoutLimplio>
</template>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

.avatar {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.card-sueno {
    animation: gentleFloat 8s ease-in-out infinite;
}

@keyframes gentleFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

.btn-sueno {
    box-shadow: 0 5px 20px rgba(156, 39, 176, 0.4);
    transition: all 0.5s ease;
}

.btn-sueno:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 30px rgba(156, 39, 176, 0.6);
}

.btn-sueno::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: 0.5s;
}

.btn-sueno:hover::before {
    left: 100%;
}

.btn-sueno i {
    animation: twinkle 2s infinite;
}

@keyframes twinkle {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
