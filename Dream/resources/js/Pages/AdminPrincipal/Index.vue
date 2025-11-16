<!-- <script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-900 to-purple-900 flex items-center justify-center">
    <Head title="Panel Administrador" />
    
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-md w-full">
      <h1 class="text-4xl font-bold text-green-600 mb-4 text-center">
        ✅ ¡FUNCIONA!
      </h1>
      <p class="text-gray-700 text-center mb-6">
        Estás en el panel de administración
      </p>
      
      <Link 
        :href="route('admin.logout')" 
        method="post" 
        as="button"
        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded font-semibold"
      >
        Cerrar Sesión
      </Link>
    </div>
  </div>
</template> -->

<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutLimplio from '@/Layouts/LayoutLimpio.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="VentanaCuenta" />

    <LayoutLimplio>
        
        
        <div >
            <div class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded font-semibold">
                <Link
                    :href="route('admin.logout')"
                    method="post"
                    as="button"
                >
                    Cerrar sesion
                </Link>
            </div>
            <!-- Encabezado -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-extrabold text-white mb-2 drop-shadow-lg">
                    Bienvenido
                </h1>
                
            </div>

            <!-- Contenedor principal -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl w-full max-w-4xl flex overflow-hidden shadow-2xl">
                
                <!-- Sidebar -->
                <aside class="bg-gradient-to-b from-blue-800 to-indigo-900 text-white w-1/3 p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold mb-6 border-b border-white/30 pb-2">Menú</h2>
                        <nav class="space-y-4">
                            <Link :href="route('usuario.index')" > <i class="fas fa-user mr-2"></i>Ver usuarios</Link>
                            <br>
                            <Link :href="route('adminSonidos.index')" > <i class="fas fa-music mr-2"></i>Ver sonidos</Link>
                            <br>
                            <div class="nav-actions">
                              <a 
                            href="/usuarios/reporte/pdf" 
                            class="nav-btn"
                          >
                            <i class="fas fa-file-pdf mr-2"></i> PDF
                          </a>
                            </div>
                            
                        </nav>
                    </div>
                </aside>

                <!-- Contenido principal -->
                <main class="flex-1 p-10 flex flex-col items-center justify-center">
                    
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

 