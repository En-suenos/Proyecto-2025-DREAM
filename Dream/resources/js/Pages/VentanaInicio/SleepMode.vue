<template>
  <button class="btn btn-primary w-200 mb-3 sleep-mode-btn" @click="$emit('toggle')">
    <i :class="active ? 'fas fa-pause-circle' : 'fas fa-moon'" class="me-2"></i>
    {{ active ? 'Detener Sueño' : 'Iniciar Sueño' }}
  </button>
</template>

<script>
export default {
  name: 'SleepModeButton',
  props: {
    active: {
      type: Boolean,
      default: false
    }
  },
  emits: ['toggle']
}
</script>

<style scoped>
.sleep-mode-btn {
  width: 200px;
  background: linear-gradient(45deg, #667eea, #764ba2);
  border: none;
  padding: 15px 30px;
  font-size: 1.1rem;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.sleep-mode-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
</style>