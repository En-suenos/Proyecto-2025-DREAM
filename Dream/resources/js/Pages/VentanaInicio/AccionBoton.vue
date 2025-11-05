<template>
  <div class="buttons-container">
    <a href="#" class="btn btn-login" @click="$emit('navigate-login')">
      <i class="fas fa-sign-in-alt btn-icon"></i>
      <span class="btn-text">Inicio de Sesión</span>
    </a>
    
    <a href="#" class="btn btn-assistant" @click="$emit('toggle-ai')">
      <i class="fas fa-robot btn-icon"></i>
      <span class="btn-text">Asistente de Sueño</span>
    </a>
    
    <a href="#" class="btn btn-playlist" @click="showComingSoon">
      <i class="fas fa-music btn-icon"></i>
      <span class="btn-text">Playlist Relajante</span>
    </a>
    
    <a href="#" class="btn btn-notification notification-badge" @click="$emit('toggle-notifications')">
      <i class="fas fa-bell btn-icon"></i>
      <span class="btn-text">Notificaciones</span>
      <span class="badge bg-danger" v-if="unreadNotifications > 0">{{ unreadNotifications }}</span>
    </a>
  </div>
</template>

<script>
export default {
  name: 'ActionButtons',
  props: {
    unreadNotifications: {
      type: Number,
      default: 0
    }
  },
  emits: ['toggle-ai', 'toggle-notifications', 'navigate-login'],
  methods: {
    showComingSoon() {
      this.$emit('toggle-ai')
      // Simular que el AI sugiere playlists
      setTimeout(() => {
        this.$emit('send-message', '¿Qué tipo de playlist relajante me recomiendas?')
      }, 500)
    }
  }
}
</script>

<style scoped>
.buttons-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  width: 100%;
}

.btn {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: white;
  padding: 20px;
  font-size: 1rem;
  border-radius: 15px;
  cursor: pointer;
  transition: all 0.4s ease;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  text-decoration: none;
  position: relative;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.btn:hover::before {
  left: 100%;
}

.btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
}

.btn-icon {
  font-size: 2rem;
  margin-bottom: 5px;
}

.btn-text {
  font-weight: 500;
  font-size: 0.9rem;
}

.btn-login {
  background: linear-gradient(45deg, #4fc3f7, #29b6f6);
  border: none;
}

.btn-assistant {
  background: linear-gradient(45deg, #7e57c2, #5e35b1);
  border: none;
}

.btn-playlist {
  background: linear-gradient(45deg, #66bb6a, #43a047);
  border: none;
}

.btn-notification {
  background: linear-gradient(45deg, #ffa726, #fb8c00);
  border: none;
}

.notification-badge {
  position: relative;
}

.notification-badge .badge {
  position: absolute;
  top: -5px;
  right: -5px;
}

@media (max-width: 768px) {
  .buttons-container {
    grid-template-columns: 1fr;
  }
  
  .btn {
    padding: 18px;
    font-size: 0.95rem;
  }
}

@media (max-width: 480px) {
  .btn {
    padding: 16px;
    font-size: 0.9rem;
  }
}
</style>