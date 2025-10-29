<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SleepAssistant - Tu Compañero para un Buen Descanso</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ======== ESTILO GENERAL ======== */
:root {
    --azul-suave: #a2d2ff;
    --azul-oscuro: #2b3a55;
    --violeta: #6b73ff;
    --fondo-gradiente: linear-gradient(135deg, #1e2a47, #3a506b, #5bc0be);
    --texto-claro: #f8f9fa;
    --sombra-suave: 0 8px 25px rgba(0, 0, 0, 0.1);
}

body {
    background: var(--fondo-gradiente);
    color: var(--texto-claro);
    font-family: "Poppins", "Segoe UI", sans-serif;
    min-height: 100vh;
    padding-top: 90px;
    overflow-x: hidden;
}

/* ======== NAVBAR ======== */
.navbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    background: rgba(43, 58, 85, 0.8);
    backdrop-filter: blur(10px);
    padding: 12px 30px;
    z-index: 1000;
    box-shadow: var(--sombra-suave);
}

.navbar-brand {
    color: var(--azul-suave);
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: 0.5px;
}

.nav-link {
    color: #e0e0e0;
    font-weight: 500;
    transition: color 0.3s;
}

.nav-link:hover {
    color: var(--azul-suave);
}

/* ======== CONTENEDOR PRINCIPAL ======== */
.main-content {
    max-width: 950px;
    margin: auto;
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* ======== CABECERA ======== */
.header {
    text-align: center;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 25px;
    padding: 40px 25px;
    box-shadow: var(--sombra-suave);
}

.header h1 {
    font-weight: 600;
    color: var(--azul-suave);
}

.header p {
    color: #cfd8dc;
    font-size: 1rem;
}

/* ======== TARJETAS ======== */
.info-box, .sound-card, .tip-card {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 20px;
    padding: 20px;
    color: #f1f1f1;
    transition: all 0.3s ease;
    box-shadow: var(--sombra-suave);
}

.info-box:hover, .sound-card:hover, .tip-card:hover {
    transform: translateY(-3px);
    background: rgba(255, 255, 255, 0.1);
}

/* ======== PANEL DE SONIDOS ======== */
.sounds-panel {
    margin-top: 40px;
    padding: 25px;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(8px);
}

.sound-card.active {
    border: 1.5px solid var(--azul-suave);
    background: rgba(162, 210, 255, 0.1);
}

.sound-icon {
    color: var(--azul-suave);
    font-size: 1.7rem;
}

.timer-control {
    background: var(--azul-suave);
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 5px 15px;
    font-size: 0.8rem;
    transition: all 0.3s;
}

.timer-control:hover {
    background: #80caff;
    transform: scale(1.05);
}

/* ======== CHAT ======== */
.chat-container {
    margin-top: 35px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 20px;
    padding: 25px;
    height: 400px;
    overflow-y: auto;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.message-bubble {
    padding: 12px 18px;
    border-radius: 20px;
    max-width: 70%;
}

.user-message .message-bubble {
    background: var(--azul-suave);
    color: #1e2a47;
}

.ai-message .message-bubble {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
}

/* ======== INPUT ======== */
.input-group {
    margin-top: 20px;
}

.form-control {
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.form-control::placeholder {
    color: #ccc;
}

.btn-primary {
    background: var(--violeta);
    border: none;
    border-radius: 25px;
    transition: all 0.3s;
}

.btn-primary:hover {
    background: #8990ff;
    transform: scale(1.05);
}

/* ======== CONSEJOS ======== */
.sleep-tips {
    margin-top: 40px;
}

.tip-card h6 {
    color: var(--azul-suave);
    font-weight: 600;
}

.tip-card p {
    color: #e0e0e0;
    font-size: 0.9rem;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="#"><i class="fas fa-moon"></i> SleepAssistant</a>
  <div class="ms-auto">
      <a class="nav-link d-inline mx-2" href="#"><i class="fas fa-globe"></i> Idioma</a>
      <a class="nav-link d-inline mx-2" href="#"><i class="fas fa-cog"></i> Configuración</a>
  </div>
</nav>

<main class="container main-content">
  <div class="header mb-4">
      <h1><i class="fas fa-cloud-moon"></i> Tu asistente del buen descanso</h1>
      <p>Relájate, desconecta y duerme mejor con la ayuda de tu guía virtual para el sueño.</p>
  </div>

  <div class="info-box mb-4">
      <h4><i class="fas fa-info-circle"></i> Bienvenido</h4>
      <p>Te acompañaré con técnicas, sonidos y consejos basados en bienestar y relajación para ayudarte a dormir profundamente.</p>
  </div>

  <div class="sounds-panel">
      <h4><i class="fas fa-music"></i> Sonidos Relajantes</h4>
      <p>Selecciona un sonido para crear el ambiente ideal para dormir:</p>

      <div class="sound-card d-flex justify-content-between align-items-center mt-3">
          <div><i class="fas fa-cloud-rain sound-icon me-2"></i> Lluvia Suave</div>
          <button class="timer-control">Reproducir</button>
      </div>

      <div class="sound-card d-flex justify-content-between align-items-center mt-3">
          <div><i class="fas fa-water sound-icon me-2"></i> Olas del Mar</div>
          <button class="timer-control">Reproducir</button>
      </div>

      <div class="sound-card d-flex justify-content-between align-items-center mt-3">
          <div><i class="fas fa-tree sound-icon me-2"></i> Bosque Nocturno</div>
          <button class="timer-control">Reproducir</button>
      </div>
  </div>

  <div class="chat-container mt-4">
      <div class="message ai-message">
          <div class="message-bubble">
              <p>🌙 ¡Hola! Soy tu asistente de sueño. Cuéntame, ¿qué te impide dormir bien esta noche?</p>
          </div>
      </div>
  </div>

  <div class="input-group">
      <input type="text" class="form-control" placeholder="Escribe tu consulta sobre el sueño...">
      <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
  </div>

  <div class="sleep-tips mt-5">
      <h5><i class="fas fa-lightbulb"></i> Consejos Rápidos</h5>
      <div class="row mt-3">
          <div class="col-md-6">
              <div class="tip-card mb-3">
                  <h6><i class="fas fa-bed"></i> Rutina de Sueño</h6>
                  <p>Establece una hora fija para acostarte y despertarte todos los días.</p>
              </div>
          </div>
          <div class="col-md-6">
              <div class="tip-card mb-3">
                  <h6><i class="fas fa-wind"></i> Aire y Luz</h6>
                  <p>Mantén tu habitación ventilada y con poca luz antes de dormir.</p>
              </div>
          </div>
      </div>
  </div>
</main>
</body>
</html>
<?php /**PATH C:\laragon\www\carpeta principal\Proyecto-2025-DREAM\Dream\resources\views/ventana asistente AI/index.blade.php ENDPATH**/ ?>