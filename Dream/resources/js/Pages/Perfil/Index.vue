<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { User, Mail, Phone, ArrowLeftCircle } from 'lucide-vue-next';

// Array para estrellas dinámicas
const stars = ref([]);

// Generar estrellas aleatorias al montar el componente
onMounted(() => {
    const numStars = 80; // Número de estrellas
    for (let i = 0; i < numStars; i++) {
        stars.value.push({
            id: i,
            top: Math.random() * 100 + '%',
            left: Math.random() * 100 + '%',
            size: Math.random() * 3 + 1 + 'px',
            delay: Math.random() * 3 + 's',
            duration: (Math.random() * 2 + 2) + 's'
        });
    }
});
</script>

<template>
  <Head title="Perfil" />

  <AuthenticatedLayout>
    <!-- Fondo nocturno con gradiente -->
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-indigo-900 via-purple-900 to-black p-6 relative overflow-hidden">
      <!-- Elementos visuales calmantes: estrellas generadas dinámicamente -->
      <div class="absolute inset-0">
        <div 
          v-for="star in stars" 
          :key="star.id" 
          class="star" 
          :style="{ 
            top: star.top, 
            left: star.left, 
            width: star.size, 
            height: star.size, 
            animationDelay: star.delay, 
            animationDuration: star.duration 
          }"
        ></div>
      </div>

      <!-- Tarjeta -->
      <div class="relative z-10 max-w-lg w-full bg-indigo-900 bg-opacity-50 text-white shadow-2xl rounded-2xl p-8 border border-indigo-700 animate-fade-in">
        <!-- Imagen de perfil -->
        <div class="flex flex-col items-center mb-6">
          <img
            src="https://i.pravatar.cc/150?img=68"
            alt="Foto de perfil"
            class="w-28 h-28 rounded-full border-4 border-indigo-400 shadow-lg mb-3"
          />
          <h1 class="text-3xl font-light text-indigo-200">Mi Perfil ✨</h1>
          <p class="text-indigo-300 text-sm">Bienvenido a tu espacio personal</p>
        </div>

        <!-- Datos -->
        <div class="space-y-5">
          <!-- Nombre -->
          <div class="flex items-center space-x-3 animate-fade-in-row" style="animation-delay: 0.2s;">
            <User class="text-indigo-400 w-6 h-6" />
            <p class="text-lg">
              <span class="font-light">Nombre:</span>
              {{ $page.props.auth.user.name }}
            </p>
          </div>

          <!-- Correo -->
          <div class="flex items-center space-x-3 animate-fade-in-row" style="animation-delay: 0.4s;">
            <Mail class="text-indigo-400 w-6 h-6" />
            <p class="text-lg">
              <span class="font-light">Correo:</span>
              {{ $page.props.auth.user.email }}
            </p>
          </div>

          <!-- Teléfono -->
          <div
            v-if="$page.props.auth.user.telefono"
            class="flex items-center space-x-3 animate-fade-in-row"
            style="animation-delay: 0.6s;"
          >
            <Phone class="text-indigo-400 w-6 h-6" />
            <p class="text-lg">
              <span class="font-light">Teléfono:</span>
              {{ $page.props.auth.user.telefono }}
            </p>
          </div>
        </div>

        <!-- Botón Regresar -->
        <div class="mt-10 flex justify-center">
          <Link
            :href="route('ConCuenta.index')"
            class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-800 text-white font-light py-3 px-6 rounded-full shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105"
          >
            <ArrowLeftCircle class="w-5 h-5" />
            Regresar
          </Link>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Estilos personalizados para animaciones */
.star {
  position: absolute;
  background: white;
  border-radius: 50%;
  animation: twinkle infinite ease-in-out;
}

@keyframes twinkle {
  0%, 100% { 
    opacity: 0.2; 
    transform: scale(0.8); 
  }
  50% { 
    opacity: 1; 
    transform: scale(1.2); 
  }
}

.animate-fade-in {
  animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
  from { 
    opacity: 0; 
    transform: translateY(30px); 
  }
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

.animate-fade-in-row {
  animation: fadeInRow 0.8s ease-in-out forwards;
  opacity: 0;
}

@keyframes fadeInRow {
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

/* Mejoras de responsividad */
@media (max-width: 640px) {
  .max-w-lg {
    max-width: 90%;
  }
  
  h1 {
    font-size: 2rem;
  }
  
  .space-y-5 > div p {
    font-size: 1rem;
  }
}
</style>