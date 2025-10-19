<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión Exitoso - Dream</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <!-- Tarjeta Principal -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden card-hover">
            <div class="md:flex">
                <!-- Panel Izquierdo - Mensaje de Bienvenida -->
                <div class="md:w-2/5 bg-gradient-to-br from-blue-600 to-purple-700 text-white p-8 flex flex-col justify-center">
                    <div class="text-center md:text-left">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto md:mx-0 mb-6 pulse-animation">
                            <i class="fas fa-check text-3xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold mb-4">¡Bienvenido de vuelta!</h1>
                        <p class="text-blue-100 mb-6">Tu sesión ha sido iniciada exitosamente. Disfruta de tu experiencia en Dream.</p>
                        <div class="flex items-center justify-center md:justify-start space-x-4">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-shield-alt text-green-300"></i>
                                <span class="text-sm">Sesión Segura</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-clock text-yellow-300"></i>
                                <span class="text-sm" id="currentTime"><?php echo e(now()->format('H:i:s')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Derecho - Información del Usuario -->
                <div class="md:w-3/5 p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                        Información de tu Cuenta
                    </h2>
                    
                    <!-- Estadísticas Rápidas -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4 text-center">
                            <i class="fas fa-moon text-blue-600 text-xl mb-2"></i>
                            <div class="text-2xl font-bold text-gray-800">12</div>
                            <div class="text-sm text-gray-600">Sesiones de Sueño</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <i class="fas fa-star text-green-600 text-xl mb-2"></i>
                            <div class="text-2xl font-bold text-gray-800">8.5</div>
                            <div class="text-sm text-gray-600">Calificación Promedio</div>
                        </div>
                    </div>

                    <!-- Tabla de Información -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(0)">
                                        <i class="fas fa-sort mr-1"></i>Campo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(1)">
                                        <i class="fas fa-sort mr-1"></i>Valor
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Los datos se cargarán dinámicamente -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <button onclick="startSleepMode()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                            <i class="fas fa-bed"></i>
                            Iniciar Modo Sueño
                        </button>
                        <button onclick="exploreSounds()" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                            <i class="fas fa-music"></i>
                            Explorar Sonidos
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notificación de Seguridad -->
        <div class="mt-6 bg-white bg-opacity-90 backdrop-blur-sm rounded-2xl p-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-lock text-green-500 text-xl"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Sesión protegida</p>
                        <p class="text-sm text-gray-600">Tu conexión es segura y encriptada</p>
                    </div>
                </div>
                <button onclick="logout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold transition flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar Sesión
                </button>
            </div>
        </div>
    </div>

    <script>
        // Datos del usuario (simulados - en un caso real vendrían del backend)
        const userData = [
            { campo: 'Nombre Completo', valor: 'Juan Pérez Rodríguez', icon: 'user' },
            { campo: 'Correo Electrónico', valor: 'juan.perez@dream.com', icon: 'envelope' },
            { campo: 'Tipo de Cuenta', valor: 'Premium', icon: 'crown', badge: 'premium' },
            { campo: 'Fecha de Registro', valor: '15 de Enero, 2024', icon: 'calendar' },
            { campo: 'Último Acceso', valor: 'Hace 2 minutos', icon: 'clock' },
            { campo: 'Sesiones Activas', valor: '1 dispositivo', icon: 'desktop' },
            { campo: 'Preferencias', valor: 'Sonidos Naturales', icon: 'heart' },
            { campo: 'Tiempo Total de Sueño', valor: '45 horas', icon: 'moon' }
        ];

        // Función para cargar la tabla
        function loadUserTable() {
            const tableBody = document.getElementById('userTableBody');
            tableBody.innerHTML = '';
            
            userData.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition';
                
                const badgeClass = item.badge === 'premium' 
                    ? 'bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium'
                    : '';
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <i class="fas fa-${item.icon} text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium text-gray-900">${item.campo}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-700 ${badgeClass}">${item.valor}</span>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Función para ordenar la tabla
        function sortTable(columnIndex) {
            const tableBody = document.getElementById('userTableBody');
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            
            const isAscending = !tableBody.getAttribute('data-sort-asc');
            tableBody.setAttribute('data-sort-asc', isAscending);
            
            rows.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim();
                const bText = b.children[columnIndex].textContent.trim();
                
                return isAscending 
                    ? aText.localeCompare(bText, 'es', { numeric: true })
                    : bText.localeCompare(aText, 'es', { numeric: true });
            });
            
            rows.forEach(row => tableBody.appendChild(row));
        }

        // Funciones de los botones
        function startSleepMode() {
            alert('🎵 Iniciando modo sueño... Prepárate para descansar.');
            // Aquí iría la lógica para iniciar el modo sueño
        }

        function exploreSounds() {
            alert('🔊 Redirigiendo a la biblioteca de sonidos...');
            // Aquí iría la navegación a la página de sonidos
        }

        function logout() {
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                alert('👋 Sesión cerrada. ¡Hasta pronto!');
                // Aquí iría la lógica de logout
            }
        }

        // Inicializar la página
        document.addEventListener('DOMContentLoaded', function() {
            loadUserTable();
            
            // Actualizar la hora cada minuto
            setInterval(() => {
                const timeElement = document.querySelector('.fa-clock').parentNode.nextElementSibling;
                if (timeElement) {
                    timeElement.textContent = new Date().toLocaleTimeString('es-ES');
                }
            }, 60000);
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sueñito\Dream\resources\views/inicio sesion/index.blade.php ENDPATH**/ ?>