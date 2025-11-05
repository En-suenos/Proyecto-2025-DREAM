<template>
  <div id="app">
    <Navbar :hidden="navbarHidden" />
    
    <div class="container">
      <div class="logo">SleepWell</div>
      <p class="tagline">Tu compañero inteligente para un sueño reparador</p>
      
      <ActionButtons 
        @toggle-ai="toggleAIAssistant"
        @toggle-notifications="toggleNotifications"
        @navigate-login="navigateToLogin"
        :unread-notifications="unreadNotifications"
      />
      
      <!-- Sleep Mode Section -->
      <div class="text-center mb-4">
        <p class="tagline">"Mientras sueñas, tu cerebro combina recuerdos y emociones para crear nuevas ideas y fortalecer la memoria"</p>
      </div>

      <SleepModeButton 
        :active="sleepModeActive"
        @toggle="toggleSleepMode"
      />

      <!-- AI Assistant Section -->
      <transition name="fade">
        <AIAssistant 
          v-if="showAIAssistant"
          :messages="chatMessages"
          @send-message="sendAIMessage"
        />
      </transition>

      <!-- Notifications Section -->
      <transition name="fade">
        <Notifications 
          v-if="showNotifications"
          :notifications="notifications"
          @mark-read="markNotificationsAsRead"
        />
      </transition>
      
      <!-- Footer -->
      <footer>
        <p class="tagline">Mientras duermes, tu cerebro se limpia de toxinas acumuladas durante el día, como si se "reiniciara" para funcionar mejor al despertar.</p>
        <p>SleepWell &copy; 2023 - Mejora tu sueño, mejora tu vida</p>
        <small>Versión 1.0.0 | <a href="#" style="color: #4fc3f7;">Política de Privacidad</a></small>
      </footer>
    </div>
    
    <!-- Toast Container -->
    <ToastContainer 
      :toasts="toasts"
      @remove-toast="removeToast"
    />
  </div>
</template>

<script>
import { ref, onMounted, nextTick } from 'vue'
import Navbar from './components/Navbar.vue'
import SleepModeButton from './components/SleepModeButton.vue'
import AIAssistant from './components/AIAssistant.vue'
import Notifications from './components/Notifications.vue'
import ActionButtons from './components/ActionButtons.vue'
import ToastContainer from './components/ToastContainer.vue'

export default {
  name: 'App',
  components: {
    Navbar,
    SleepModeButton,
    AIAssistant,
    Notifications,
    ActionButtons,
    ToastContainer
  },
  setup() {
    // Estado reactivo
    const navbarHidden = ref(false)
    const sleepModeActive = ref(false)
    const currentAudio = ref(null)
    const showAIAssistant = ref(false)
    const showNotifications = ref(false)
    const chatMessages = ref([
      { id: 1, text: '¡Hola! ¿En qué puedo ayudarte hoy? Por ejemplo, puedo recomendar sonidos o responder preguntas.', isUser: false }
    ])
    const unreadNotifications = ref(3)
    const notifications = ref([
      { id: 1, text: 'Nueva actualización disponible.', icon: 'fas fa-info-circle' },
      { id: 2, text: 'Canción recomendada: "Relajación Total".', icon: 'fas fa-music' },
      { id: 3, text: 'Recuerda iniciar sesión para guardar tus preferencias.', icon: 'fas fa-user' }
    ])
    const toasts = ref([])

    // Métodos
    const toggleSleepMode = () => {
      if (sleepModeActive.value) {
        stopSleepMode()
      } else {
        startSleepMode()
      }
    }

    const startSleepMode = () => {
      const audio = new Audio()
      const soundFiles = [
        "/audio/Sonido-7.mp3",
        "/audio/Sonido-4.mp3",
        "/audio/Sonido-5.mp3",
        "/audio/Sonido-6.mp3"
      ]
      
      const randomSound = soundFiles[Math.floor(Math.random() * soundFiles.length)]
      audio.src = randomSound
      audio.loop = true
      audio.volume = 0.10
      
      audio.play().then(() => {
        currentAudio.value = audio
        sleepModeActive.value = true
        showToast('Modo sueño activado', 'Sonidos relajantes reproduciéndose...')
      }).catch(error => {
        console.error('Error al reproducir el sonido:', error)
        showToast('Error', 'No se pudo reproducir el sonido.')
      })
    }

    const stopSleepMode = () => {
      if (currentAudio.value) {
        currentAudio.value.pause()
        currentAudio.value.currentTime = 0
        currentAudio.value = null
      }
      sleepModeActive.value = false
      showToast('Modo sueño desactivado', 'Sonidos detenidos')
    }

    const toggleAIAssistant = () => {
      showAIAssistant.value = !showAIAssistant.value
    }

    const toggleNotifications = () => {
      showNotifications.value = !showNotifications.value
    }

    const sendAIMessage = (message) => {
      const userMessage = {
        id: Date.now(),
        text: message,
        isUser: true
      }
      chatMessages.value.push(userMessage)

      // Simular respuesta AI
      setTimeout(() => {
        const aiResponses = [
          "Gracias por tu mensaje. Recomiendo probar el sonido de lluvia para relajarte.",
          "Para mejorar tu sueño, intenta establecer una rutina regular a la hora de acostarte.",
          "¿Has probado la meditación antes de dormir? Puede ayudar a calmar tu mente.",
          "El sonido de olas del mar es excelente para inducir un estado de relajación profunda."
        ]
        
        const aiMessage = {
          id: Date.now() + 1,
          text: aiResponses[Math.floor(Math.random() * aiResponses.length)],
          isUser: false
        }
        chatMessages.value.push(aiMessage)
      }, 1000)
    }

    const markNotificationsAsRead = () => {
      unreadNotifications.value = 0
      showToast('Notificaciones marcadas como leídas')
    }

    const navigateToLogin = () => {
      showToast('Navegando a inicio de sesión')
      // Aquí iría la navegación real: this.$router.push('/login')
    }

    const showToast = (message) => {
      const toast = {
        id: Date.now(),
        message: message
      }
      toasts.value.push(toast)
      
      setTimeout(() => {
        removeToast(toast.id)
      }, 3000)
    }

    const removeToast = (id) => {
      toasts.value = toasts.value.filter(toast => toast.id !== id)
    }

    // Ciclo de vida
    onMounted(() => {
      let lastScrollTop = 0
      window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop
        
        if (scrollTop > lastScrollTop) {
          navbarHidden.value = true
        } else {
          navbarHidden.value = false
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop
      })
    })

    return {
      navbarHidden,
      sleepModeActive,
      showAIAssistant,
      showNotifications,
      chatMessages,
      unreadNotifications,
      notifications,
      toasts,
      toggleSleepMode,
      toggleAIAssistant,
      toggleNotifications,
      sendAIMessage,
      markNotificationsAsRead,
      navigateToLogin,
      removeToast
    }
  }
}
</script>

<style scoped>
/* Estilos específicos del componente App */
.container {
  max-width: 600px;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
  animation: fadeInUp 1s ease-out;
  padding-top: 90px;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.logo {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 10px;
  color: #4fc3f7;
  text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
  text-align: center;
  animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
  from {
    text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
  }
  to {
    text-shadow: 0 0 30px rgba(79, 195, 247, 1);
  }
}

.tagline {
  font-size: 1.1rem;
  opacity: 0.9;
  margin-bottom: 40px;
  text-align: center;
  max-width: 400px;
}

footer {
  margin-top: 60px;
  text-align: center;
  opacity: 0.8;
  font-size: 0.9rem;
  padding: 20px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .container {
    padding: 0 20px;
  }
}
</style>