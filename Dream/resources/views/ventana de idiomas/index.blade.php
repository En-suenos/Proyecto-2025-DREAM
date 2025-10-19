<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Idioma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icons/6.6.6/css/flag-icons.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 2rem;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        th:hover {
            background-color: #e9ecef;
        }
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
        }
        .radio-cell {
            text-align: center;
        }
        .flag-icon {
            margin-right: 10px;
            border-radius: 3px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .selected-row {
            background-color: #e3f2fd;
        }
        .back-link {
            color: #667eea;
            font-weight: 500;
        }
        .back-link:hover {
            color: #764ba2;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4 text-primary">Configuración de Idioma / Language Settings</h2>
                        <p class="text-center text-muted mb-4">Selecciona el idioma preferido para la aplicación</p>
                        
                        <div class="table-container">
                            <table id="idiomasTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th onclick="sortTable(0)">Idioma</th>
                                        <th onclick="sortTable(1)">Código</th>
                                        <th onclick="sortTable(2)">País</th>
                                        <th class="text-center">Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid mt-4">
                            <button id="guardarBtn" class="btn btn-primary">Guardar Configuración</button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('ventana-principal') }}" class="back-link">
                                ← Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const data = [
            { idioma: 'Español', codigo: 'es', pais: 'España', flag: 'es' },
            { idioma: 'English', codigo: 'en', pais: 'United States', flag: 'us' },
            { idioma: 'Français', codigo: 'fr', pais: 'France', flag: 'fr' },
            { idioma: 'Português', codigo: 'pt', pais: 'Portugal', flag: 'pt' },
            { idioma: 'Deutsch', codigo: 'de', pais: 'Germany', flag: 'de' },
            { idioma: 'Italiano', codigo: 'it', pais: 'Italy', flag: 'it' },
            { idioma: 'Русский', codigo: 'ru', pais: 'Russia', flag: 'ru' },
            { idioma: '中文', codigo: 'zh', pais: 'China', flag: 'cn' },
            { idioma: '日本語', codigo: 'ja', pais: 'Japan', flag: 'jp' },
            { idioma: 'العربية', codigo: 'ar', pais: 'Saudi Arabia', flag: 'sa' },
            { idioma: 'हिन्दी', codigo: 'hi', pais: 'India', flag: 'in' },
            { idioma: '한국어', codigo: 'ko', pais: 'South Korea', flag: 'kr' }
        ];

        let selectedRow = null;

        function loadTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            const savedLang = localStorage.getItem('selectedLanguage') || 'es';
            data.forEach((item) => {
                const row = document.createElement('tr');
                const isChecked = item.codigo === savedLang ? 'checked' : '';
                row.innerHTML = `
                    <td><span class="fi fi-${item.flag} flag-icon"></span>${item.idioma}</td>
                    <td>${item.codigo}</td>
                    <td>${item.pais}</td>
                    <td class="radio-cell">
                        <input class="form-check-input" type="radio" name="idioma" value="${item.codigo}" ${isChecked} onchange="seleccionarIdioma('${item.codigo}', this)">
                    </td>
                `;
                if (isChecked) {
                    row.classList.add('selected-row');
                    selectedRow = row;
                }
                tableBody.appendChild(row);
            });
        }

        function seleccionarIdioma(codigo, radio) {
            if (selectedRow) {
                selectedRow.classList.remove('selected-row');
            }
            const row = radio.closest('tr');
            row.classList.add('selected-row');
            selectedRow = row;
            console.log('Idioma seleccionado:', codigo);
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('idiomasTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            const isAscending = table.getAttribute('data-sort') !== 'asc' || table.getAttribute('data-column') !== columnIndex.toString();
            table.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
            table.setAttribute('data-column', columnIndex);
            
            rows.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim();
                const bText = b.children[columnIndex].textContent.trim();
                if (isAscending) {
                    return aText.localeCompare(bText, 'es', { numeric: true });
                } else {
                    return bText.localeCompare(aText, 'es', { numeric: true });
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
        }

        document.getElementById('guardarBtn').addEventListener('click', function() {
            const selected = document.querySelector('input[name="idioma"]:checked');
            if (selected) {
                localStorage.setItem('selectedLanguage', selected.value);
                const selectedItem = data.find(item => item.codigo === selected.value);
                document.getElementById('modalMessage').textContent = `Configuración guardada: ${selectedItem.idioma} (${selectedItem.pais})`;
                const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                modal.show();
            } else {
                document.getElementById('modalMessage').textContent = 'Por favor, selecciona un idioma.';
                const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                modal.show();
            }
        });

        window.onload = loadTable;
    </script>
</body>
</html>
