<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Inicio de Sesión para la Aplicación Reproductor de Música.">
    <title>Inicio de Sesión</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css  " rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css  " rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #2c3e50);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
            padding-top: 90px; /* Ajuste para navbar */
        }

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
        }

        .navbar-brand {
            color: #4fc3f7;
            font-weight: 700;
            font-size: 1.2rem;
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

        .main-content {
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 1s ease-out;
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

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            animation: gentleFloat 8s ease-in-out infinite;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .login-container h2 {
            color: #4fc3f7;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2.5rem;
            text-shadow: 0 0 20px rgba(79, 195, 247, 0.7);
        }

        .form-label {
            color: #fff;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #fff;
            padding: 15px;
            transition: all 0.4s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 0 0.3rem rgba(79, 195, 247, 0.25), inset 0 2px 4px rgba(0, 0, 0, 0.05);
            transform: scale(1.02);
        }

        .form-control::placeholder {
            color: #ccc;
            font-style: italic;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border: none;
            border-radius: 25px;
            padding: 15px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(79, 195, 247, 0.3);
            font-size: 1.2rem;
            width: 100%;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #78909c, #546e7a);
            border: none;
            border-radius: 25px;
            padding: 15px;
            font-weight: 600;
            color: #ffffff;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(120, 144, 156, 0.3);
            font-size: 1.2rem;
            width: 100%;
        }

        .btn-primary:hover, .btn-secondary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(79, 195, 247, 0.4);
        }

        .alert-custom {
            margin-top: 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 15px;
        }

        .text-center a {
            color: #4fc3f7;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Estilos para el campo de contraseña con ojito */
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s ease;
            z-index: 10;
            padding: 5px;
        }

        .toggle-password:hover {
            color: #4fc3f7;
        }

        .form-control.password-input {
            padding-right: 50px;
        }

        /* Modal para recuperación de contraseña */
        .modal-content {
            background: rgba(26, 42, 108, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #fff;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-close {
            filter: invert(1);
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            position: relative;
        }

        .steps-container::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
            flex: 1;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: #4fc3f7;
            box-shadow: 0 0 10px rgba(79, 195, 247, 0.7);
        }

        .step-label {
            font-size: 0.8rem;
            text-align: center;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .recovery-alert {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .recovery-alert.success {
            border-color: #28a745;
            background: rgba(40, 167, 69, 0.1);
        }

        .recovery-alert.error {
            border-color: #dc3545;
            background: rgba(220, 53, 69, 0.1);
        }

        @media (max-width: 768px) {
            .main-content {
                max-width: 100%;
                padding: 0 20px;
            }
            
            .login-container {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a class="navbar-brand" href="#">SleepWell</a>
        <div class="navbar-nav">
            <a class="nav-link" href="#"><i class="fas fa-globe me-1"></i>Idioma</a>
            <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i>Configuración</a>
        </div>
    </nav>

    <main class="container main-content">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="{{ route('inicio_sesion.login') }}" method="POST" id="formLogin">
                @csrf
                <div class="mb-3">
                    <label for="correoLogin" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correoLogin" name="correoLogin" placeholder="Correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasenaLogin" class="form-label">Contraseña</label>
                    <div class="password-container">
                        <input type="password" class="form-control password-input" id="contrasenaLogin" name="contrasenaLogin" placeholder="Contraseña" required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
            @if(session('error'))
                <div class="alert alert-danger alert-custom">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-custom">
                    {{ session('success') }}
                </div>
            @endif

            <p class="text-center mt-3">
                ¿No tienes cuenta? <a href="{{ route('ventana datos.index') }}">Regístrate aquí</a>
            </p>
            <p class="text-center">
                <a href="#" id="forgotPasswordLink">¿Olvidaste tu contraseña?</a>
            </p>
            <p class="text-center">
                <a href="{{ route('ventana-principal.index') }}">Volver a la aplicación</a>
            </p>
        </div>
    </main>

    <!-- Modal para recuperación de contraseña -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="recoveryMessage"></div>
                    
                    <div class="steps-container">
                        <div class="step active" id="step1">
                            <div class="step-circle">1</div>
                            <div class="step-label">Verificar</div>
                        </div>
                        <div class="step" id="step2">
                            <div class="step-circle">2</div>
                            <div class="step-label">Código</div>
                        </div>
                        <div class="step" id="step3">
                            <div class="step-circle">3</div>
                            <div class="step-label">Nueva Contraseña</div>
                        </div>
                    </div>

                    <form id="recoveryForm" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="step-content active" id="stepContent1">
                            <p>Ingresa tu correo electrónico para recuperar tu contraseña.</p>
                            <div class="mb-3">
                                <label for="recoveryEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="recoveryEmail" name="email" placeholder="Correo electrónico registrado" required>
                            </div>
                        </div>

                        <div class="step-content" id="stepContent2">
                            <p>Hemos enviado un código de verificación a tu correo electrónico. Ingresa el código a continuación.</p>
                            <div class="mb-3">
                                <label for="verificationCode" class="form-label">Código de Verificación</label>
                                <input type="text" class="form-control" id="verificationCode" name="token" placeholder="Código de 6 dígitos" required>
                            </div>
                            <p class="small">¿No recibiste el código? <a href="#" id="resendCode">Reenviar código</a></p>
                        </div>

                        <div class="step-content" id="stepContent3">
                            <p>Crea una nueva contraseña para tu cuenta.</p>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nueva Contraseña</label>
                                <div class="password-container">
                                    <input type="password" class="form-control password-input" id="newPassword" name="password" placeholder="Nueva contraseña" required>
                                    <button type="button" class="toggle-password" id="toggleNewPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                <div class="password-container">
                                    <input type="password" class="form-control password-input" id="confirmPassword" name="password_confirmation" placeholder="Confirmar contraseña" required>
                                    <button type="button" class="toggle-password" id="toggleConfirmPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="prevStep" style="display: none;">Anterior</button>
                    <button type="button" class="btn btn-primary" id="nextStep">Siguiente</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js  "></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Funcionalidad para mostrar/ocultar contraseña en el login
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('contrasenaLogin');
            const eyeIcon = togglePassword.querySelector('i');
            
            // Evento cuando se presiona el botón (mouse down)
            togglePassword.addEventListener('mousedown', function() {
                passwordInput.setAttribute('type', 'text');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            });
            
            // Evento cuando se suelta el botón (mouse up)
            togglePassword.addEventListener('mouseup', function() {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });
            
            // Evento cuando el mouse sale del botón (para casos donde se suelta fuera)
            togglePassword.addEventListener('mouseleave', function() {
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });
            
            // Para dispositivos táctiles
            togglePassword.addEventListener('touchstart', function(e) {
                e.preventDefault(); // Prevenir comportamiento por defecto
                passwordInput.setAttribute('type', 'text');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            });
            
            togglePassword.addEventListener('touchend', function(e) {
                e.preventDefault(); // Prevenir comportamiento por defecto
                passwordInput.setAttribute('type', 'password');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            });
            
            // Funcionalidad para recuperación de contraseña
            const forgotPasswordLink = document.getElementById('forgotPasswordLink');
            const forgotPasswordModal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));
            const recoveryForm = document.getElementById('recoveryForm');
            const recoveryMessage = document.getElementById('recoveryMessage');
            
            forgotPasswordLink.addEventListener('click', function(e) {
                e.preventDefault();
                resetRecoveryProcess();
                forgotPasswordModal.show();
            });
            
            // Variables para el proceso de recuperación
            let currentStep = 1;
            const totalSteps = 3;
            let recoveryToken = '';
            
            // Elementos del modal
            const prevStepBtn = document.getElementById('prevStep');
            const nextStepBtn = document.getElementById('nextStep');
            const resendCodeLink = document.getElementById('resendCode');
            
            // Funcionalidad para mostrar/ocultar contraseñas en el modal
            setupPasswordToggle('toggleNewPassword', 'newPassword');
            setupPasswordToggle('toggleConfirmPassword', 'confirmPassword');
            
            function setupPasswordToggle(toggleId, inputId) {
                const toggle = document.getElementById(toggleId);
                const input = document.getElementById(inputId);
                const icon = toggle.querySelector('i');
                
                toggle.addEventListener('mousedown', function() {
                    input.setAttribute('type', 'text');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                });
                
                toggle.addEventListener('mouseup', function() {
                    input.setAttribute('type', 'password');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                });
                
                toggle.addEventListener('mouseleave', function() {
                    input.setAttribute('type', 'password');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                });
            }
            
            // Navegación entre pasos
            prevStepBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    updateStepDisplay();
                }
            });
            
            nextStepBtn.addEventListener('click', function() {
                if (validateCurrentStep()) {
                    if (currentStep < totalSteps) {
                        if (currentStep === 1) {
                            // Paso 1: Enviar solicitud de recuperación
                            sendRecoveryRequest();
                        } else if (currentStep === 2) {
                            // Paso 2: Verificar código
                            verifyRecoveryCode();
                        } else {
                            currentStep++;
                            updateStepDisplay();
                        }
                    } else {
                        // Paso 3: Cambiar contraseña
                        changePassword();
                    }
                }
            });
            
            // Reenviar código
            resendCodeLink.addEventListener('click', function(e) {
                e.preventDefault();
                sendRecoveryRequest();
            });
            
            function updateStepDisplay() {
                // Actualizar pasos activos
                document.querySelectorAll('.step').forEach((step, index) => {
                    if (index + 1 <= currentStep) {
                        step.classList.add('active');
                    } else {
                        step.classList.remove('active');
                    }
                });
                
                // Mostrar/ocultar contenido de pasos
                document.querySelectorAll('.step-content').forEach((content, index) => {
                    if (index + 1 === currentStep) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
                
                // Actualizar botones
                prevStepBtn.style.display = currentStep > 1 ? 'block' : 'none';
                nextStepBtn.textContent = currentStep === totalSteps ? 'Cambiar Contraseña' : 'Siguiente';
            }
            
            function validateCurrentStep() {
                switch(currentStep) {
                    case 1:
                        const email = document.getElementById('recoveryEmail').value;
                        if (!email || !isValidEmail(email)) {
                            showRecoveryMessage('Por favor, ingresa un correo electrónico válido.', 'error');
                            return false;
                        }
                        return true;
                        
                    case 2:
                        const code = document.getElementById('verificationCode').value;
                        if (!code || code.length !== 6 || !/^\d+$/.test(code)) {
                            showRecoveryMessage('Por favor, ingresa un código de verificación válido de 6 dígitos.', 'error');
                            return false;
                        }
                        return true;
                        
                    case 3:
                        const newPassword = document.getElementById('newPassword').value;
                        const confirmPassword = document.getElementById('confirmPassword').value;
                        
                        if (!newPassword || newPassword.length < 6) {
                            showRecoveryMessage('La contraseña debe tener al menos 6 caracteres.', 'error');
                            return false;
                        }
                        
                        if (newPassword !== confirmPassword) {
                            showRecoveryMessage('Las contraseñas no coinciden.', 'error');
                            return false;
                        }
                        
                        return true;
                }
                return false;
            }
            
            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            function showRecoveryMessage(message, type = 'info') {
                recoveryMessage.innerHTML = `
                    <div class="recovery-alert ${type}">
                        ${message}
                    </div>
                `;
            }
            
            function clearRecoveryMessage() {
                recoveryMessage.innerHTML = '';
            }
            
            function sendRecoveryRequest() {
                const email = document.getElementById('recoveryEmail').value;
                
                // Simular envío de solicitud (en producción esto haría una petición AJAX)
                showRecoveryMessage('Enviando solicitud de recuperación...', 'info');
                
                setTimeout(() => {
                    // Simular respuesta del servidor
                    recoveryToken = Math.random().toString().substr(2, 6);
                    showRecoveryMessage(`Se ha enviado un código de verificación a <strong>${email}</strong>. 
                                        <br><br><strong>Código de prueba:</strong> ${recoveryToken}`, 'success');
                    
                    // Avanzar al siguiente paso
                    currentStep++;
                    updateStepDisplay();
                }, 1500);
            }
            
            function verifyRecoveryCode() {
                const code = document.getElementById('verificationCode').value;
                
                showRecoveryMessage('Verificando código...', 'info');
                
                setTimeout(() => {
                    if (code === recoveryToken) {
                        showRecoveryMessage('Código verificado correctamente.', 'success');
                        currentStep++;
                        updateStepDisplay();
                    } else {
                        showRecoveryMessage('Código incorrecto. Por favor, intenta nuevamente.', 'error');
                    }
                }, 1000);
            }
            
            function changePassword() {
                const email = document.getElementById('recoveryEmail').value;
                const newPassword = document.getElementById('newPassword').value;
                
                showRecoveryMessage('Cambiando contraseña...', 'info');
                
                // Simular petición al servidor
                setTimeout(() => {
                    // Aquí iría la lógica real para cambiar la contraseña
                    const formData = new FormData(recoveryForm);
                    
                    fetch(recoveryForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showRecoveryMessage('¡Tu contraseña ha sido cambiada exitosamente! Ahora puedes iniciar sesión con tu nueva contraseña.', 'success');
                            setTimeout(() => {
                                forgotPasswordModal.hide();
                                resetRecoveryProcess();
                                // Redirigir al login
                                window.location.href = "{{ route('inicio_sesion.index') }}";
                            }, 2000);
                        } else {
                            showRecoveryMessage(data.message || 'Error al cambiar la contraseña.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showRecoveryMessage('Error de conexión. Por favor, intenta nuevamente.', 'error');
                    });
                    
                }, 1500);
            }
            
            function resetRecoveryProcess() {
                currentStep = 1;
                recoveryToken = '';
                document.getElementById('recoveryEmail').value = '';
                document.getElementById('verificationCode').value = '';
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
                clearRecoveryMessage();
                updateStepDisplay();
            }
        });
    </script>
</body>
</html>