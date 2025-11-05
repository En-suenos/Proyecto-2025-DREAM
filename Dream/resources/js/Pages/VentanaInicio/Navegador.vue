<template>
  <nav class="navbar" :class="{ 'hide': hidden }">
    <a class="navbar-brand" href="#">SleepWell</a>
    <div class="navbar-nav">
      <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
      <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  props: {
    hidden: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style scoped>
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  background: rgba(26, 42, 108, 0.9);
  backdrop-filter: blur(10px);
  padding: 15px 20px;
  z-index: 1000;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  transition: top 0.4s ease;
}

.navbar.hide {
  top: -160px;
}

.navbar-brand {
  color: #4fc3f7;
  font-weight: 700;
  font-size: 1.2rem;
  text-decoration: none;
}

.navbar-nav {
  display: flex;
  gap: 20px;
}

.nav-link {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

.nav-link:hover {
  color: #4fc3f7;
}

@media (max-width: 768px) {
  .navbar-nav {
    gap: 15px;
  }
}
</style>