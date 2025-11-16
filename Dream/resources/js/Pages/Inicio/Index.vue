<script setup>
import { Head, Link } from '@inertiajs/vue3';

import fondoLuna1 from '@/img/fondoLuna1.jpg'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    
    <div class="w-full h-screen bg-cover bg-center flex items-center justify-center"
            :style="{ backgroundImage: `url(${fondoLuna1})` }">
        
        <!-- Elementos de fondo mejorados -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2220%22 height=%2220%22 viewBox=%220 0 20 20%22%3E%3Ccircle cx=%2210%22 cy=%2210%22 r=%221%22 fill=%22rgba(255,255,255,0.2)%22/%3E%3C/svg%3E')] bg-repeat opacity-20 animate-twinkle"></div>
        
        <!-- Nuevos elementos decorativos -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        
        <!-- Contenido principal -->
        <div class="text-center z-10 w-full max-w-lg px-4">
            <div class="bg-gradient-to-br from-indigo-900/30 to-indigo-800/20 backdrop-blur-2xl p-10 rounded-3xl shadow-2xl border border-indigo-300/20 transition-all duration-700 hover:shadow-[0_0_35px_rgba(129,140,248,0.4)] hover:bg-indigo-900/40 relative overflow-hidden">
                
                <!-- Efecto de brillo interior -->
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl opacity-20 blur-lg group-hover:opacity-30 transition duration-1000 group-hover:duration-200"></div>
                
                <div class="relative z-10">
                    <header>
                        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end mb-10">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="px-6 py-3 text-base font-medium text-indigo-100 bg-gradient-to-r from-indigo-700/70 to-purple-700/70 rounded-full hover:from-indigo-600/80 hover:to-purple-600/80 transition-all duration-300 shadow-lg hover:shadow-indigo-500/25 hover:scale-105 flex items-center gap-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Dashboard
                            </Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="px-6 py-3 mx-2 text-base font-medium text-indigo-100 bg-gradient-to-r from-indigo-700/60 to-purple-700/60 rounded-full hover:from-indigo-600/70 hover:to-purple-600/70 transition-all duration-300 shadow-lg hover:shadow-indigo-500/25 hover:scale-105 flex items-center gap-2"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Log in
                                </Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="px-6 py-3 mx-2 text-base font-medium text-indigo-100 bg-gradient-to-r from-indigo-700/60 to-purple-700/60 rounded-full hover:from-indigo-600/70 hover:to-purple-600/70 transition-all duration-300 shadow-lg hover:shadow-indigo-500/25 hover:scale-105 flex items-center gap-2"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                    </svg>
                                    Register
                                </Link>

                                
                            </template>
                        </nav>
                    </header>
                    
                    <!-- Contenido principal mejorado -->
                    <div class="mb-8">
                        <!-- Logo/icono decorativo -->
                        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-indigo-500/30 to-purple-500/30 flex items-center justify-center border border-indigo-300/30 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </div>
                        
                        <h2 class="text-4xl font-bold text-white drop-shadow-lg mb-4 tracking-wide bg-gradient-to-r from-indigo-200 to-purple-200 bg-clip-text text-transparent">
                            Welcome to DreamApp
                        </h2>
                        
                        <div class="relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg blur opacity-20 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                            <div class="relative bg-indigo-900/30 p-6 rounded-lg border border-indigo-300/20">
                                <p class="text-indigo-100 text-lg italic font-light leading-relaxed">
                                    "Reposa. Lo que está destinado a ser tuyo seguirá allí al despertar."
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información adicional decorativa -->
                    <div class="flex justify-center space-x-6 text-sm text-indigo-300/70 mt-8">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            Dream Journal
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                            </svg>
                            Sleep Analysis
                        </div>
                    </div>

                    <!-- Seccion de administrador -->
                    <br>
                    <div class="mt-8">
                        <Link 
                            :href="route('admin.login.admin')" 
                            class="inline-flex items-center gap-2 px-6 py-3 text-base font-medium text-yellow-100 bg-gradient-to-r from-yellow-600/70 to-orange-600/70 rounded-full hover:from-yellow-500/80 hover:to-orange-500/80 transition-all duration-300 shadow-lg hover:shadow-yellow-500/25 hover:scale-105"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                            </svg>
                            Acceso Administrador
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* Animación para el efecto de estrellas parpadeantes */
@keyframes twinkle {
    0%, 100% { opacity: 0.2; }
    50% { opacity: 0.5; }
}

@keyframes pulse-slow {
    0%, 100% { opacity: 0.1; transform: scale(1); }
    50% { opacity: 0.15; transform: scale(1.05); }
}

.animate-twinkle {
    animation: twinkle 4s infinite ease-in-out;
}

.animate-pulse-slow {
    animation: pulse-slow 8s infinite ease-in-out;
}

/* Mejoras de transición para todos los elementos interactivos */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>