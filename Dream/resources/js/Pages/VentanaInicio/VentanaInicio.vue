<template>
    <div id="app">
        <!-- Navbar Component -->
        <nav class="navbar" :class="{ 'hide': navbarHidden }">
            <a class="navbar-brand" href="#">SleepWell</a>
            <div class="navbar-nav">
                <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
                <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="main-container p-5 text-white">
                        <div class="text-center mb-4">
                            <h1 class="fw-bold mb-2">
                                <i class="fas fa-headphones me-2"></i>SoundScape
                            </h1>
                            <div class="badge bg-warning">
                                <i class="fas fa-user-clock me-1"></i> Sin iniciar sesión
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <p class="tagline">"Mientras sueñas, tu cerebro combina recuerdos y emociones para crear nuevas ideas y fortalecer la memoria"</p>
                        </div>

                        <button class="btn btn-primary w-100 mb-3" @click="toggleModoSueno">
                            <i :class="modoSuenoActivo ? 'fas fa-pause-circle' : 'fas fa-moon'" class="me-2"></i>
                            {{ modoSuenoActivo ? 'Detener sueño' : 'Iniciar sueño' }}
                        </button>

                        <a :href="loginRoute" class="btn btn-success w-100">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Content -->
        <div class="container">
            <div class="logo">SleepWell</div>
            <p class="tagline">Tu compañero inteligente para un sueño reparador</p>
            
            <div class="buttons-container">
                <a :href="loginRoute" class="btn btn-login" @click="handleButtonClick">
                    <i class="fas fa-sign-in-alt btn-icon"></i>
                    <span class="btn-text">Inicio de Sesión</span>
                </a>
                
                <a href="#" class="btn btn-notification" @click="showNotification">
                    <i class="fas fa-bell btn-icon"></i>
                    <span class="btn-text">Notificaciones</span>
                </a>
            </div>
            
            <footer>
                <p class="tagline">Mientras duermes, tu cerebro se limpia de toxinas acumuladas durante el día, como si se "reiniciara" para funcionar mejor al despertar.</p>
                <p>SleepWell &copy; 2023 - Mejora tu sueño, mejora tu vida</p>
                <small>Versión 1.0.0 | <a href="#" style="color: #4fc3f7;">Política de Privacidad</a></small>
            </footer>
        </div>

        <!-- Toast Container -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1050"></div>
    </div>
</template>

<script>
export default {
    name: 'App',
    data() {
        return {
            navbarHidden: false,
            lastScrollTop: 0,
            modoSuenoActivo: false,
            currentAudio: null,
            sonidos: [
                '/audio/Sonido-7.mp3',
                '/audio/Sonido-4.mp3',
                '/audio/Sonido-5.mp3',
                '/audio/Sonido-6.mp3'
            ],
            loginRoute: '/inicio-sesion' // Ajusta según tus rutas Laravel
        }
    },
    mounted() {
        this.setupScrollListener();
        this.setupButtonAnimations();
    },
    methods: {
        setupScrollListener() {
            window.addEventListener('scroll', this.handleScroll);
        },
        handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > this.lastScrollTop) {
                this.navbarHidden = true;
            } else {
                this.navbarHidden = false;
            }
            
            this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        },
        // ... (todos los demás métodos del archivo anterior)
        setupButtonAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.btn').forEach(btn => {
                btn.style.opacity = '0';
                btn.style.transform = 'translateY(20px)';
                btn.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(btn);
            });
        },
        toggleModoSueno() {
            if (this.modoSuenoActivo) {
                this.detenerModoSueno();
            } else {
                this.iniciarModoSueno();
            }
        },
        iniciarModoSueno() {
            const audio = new Audio();
            const sonidoAleatorio = this.sonidos[Math.floor(Math.random() * this.sonidos.length)];
            
            audio.src = sonidoAleatorio;
            audio.loop = true;
            audio.volume = 0.10;
            
            audio.play().then(() => {
                this.modoSuenoActivo = true;
                this.currentAudio = audio;
                this.mostrarNotificacion('Modo sueño activado', 'Sonidos relajantes reproduciéndose...');
            }).catch(error => {
                console.error('Error al reproducir el sonido:', error);
                this.mostrarToast('No se pudo reproducir el sonido. Verifica que los archivos de audio estén disponibles.');
            });
        },
        detenerModoSueno() {
            if (this.currentAudio) {
                this.currentAudio.pause();
                this.currentAudio.currentTime = 0;
                this.currentAudio = null;
            }
            this.modoSuenoActivo = false;
            this.mostrarNotificacion('Modo sueño desactivado', 'Sonidos detenidos');
        },
        handleButtonClick(event) {
            event.target.style.transform = 'scale(0.95)';
            setTimeout(() => {
                event.target.style.transform = '';
            }, 150);
        },
        showNotification(event) {
            event.preventDefault();
            this.mostrarToast('Funcionalidad de notificaciones próximamente disponible.');
        },
        mostrarNotificacion(titulo, mensaje) {
            const notificacion = document.createElement('div');
            notificacion.className = 'alert alert-info position-fixed';
            notificacion.style.cssText = `
                top: 100px;
                right: 20px;
                z-index: 1050;
                min-width: 300px;
                background: rgba(255, 255, 255, 0.9);
                color: #333;
                border: none;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            `;
            notificacion.innerHTML = `
                <strong>${titulo}</strong><br>
                ${mensaje}
            `;
            
            document.body.appendChild(notificacion);
            
            setTimeout(() => {
                notificacion.remove();
            }, 3000);
        },
        mostrarToast(message) {
            let toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                toastContainer.style.zIndex = '1050';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-primary border-0';
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
        if (this.currentAudio) {
            this.currentAudio.pause();
        }
    }
}
</script>

<style scoped>
/* Aquí puedes agregar estilos específicos del componente Vue */
#app {
    color: rgb(185, 174, 20);
}
</style>