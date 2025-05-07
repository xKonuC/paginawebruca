<?php
session_start();
require 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Procesar el formulario de agregar/editar items
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $table = $_POST['menu_type'] === 'desayuno' ? 'menu_desayuno' : 'menu_comida_rapida';
        
        switch ($_POST['action']) {
            case 'add':
                $stmt = $pdo->prepare("INSERT INTO $table (nombre, descripcion, precio, categoria, subcategoria, opciones) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['precio'],
                    $_POST['categoria'],
                    $_POST['subcategoria'],
                    $_POST['opciones'] ?? null
                ]);
                break;
            
            case 'edit':
                $stmt = $pdo->prepare("UPDATE $table SET nombre = ?, descripcion = ?, precio = ?, categoria = ?, subcategoria = ?, opciones = ? WHERE id = ?");
                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['precio'],
                    $_POST['categoria'],
                    $_POST['subcategoria'],
                    $_POST['opciones'] ?? null,
                    $_POST['id']
                ]);
                break;
            
            case 'delete':
                $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
                $stmt->execute([$_POST['id']]);
                break;
        }
        header("Location: admin.php");
        exit;
    }
}

// Obtener todos los items del menú de desayuno
$stmt = $pdo->query("SELECT * FROM menu_desayuno ORDER BY categoria, nombre");
$menu_desayuno = $stmt->fetchAll();

// Obtener todos los items del menú de comida rápida
$stmt = $pdo->query("SELECT * FROM menu_comida_rapida ORDER BY categoria, nombre");
$menu_comida_rapida = $stmt->fetchAll();

// Agrupar items por categoría
$desayuno_por_categoria = [];
foreach ($menu_desayuno as $item) {
    $desayuno_por_categoria[$item['categoria']][] = $item;
}

$comida_rapida_por_categoria = [];
foreach ($menu_comida_rapida as $item) {
    $comida_rapida_por_categoria[$item['categoria']][] = $item;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - La Ruca de los Monos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #000;
            color: white;
        }

        .admin-header {
            background: linear-gradient(145deg, #1a1a1a, #2a2a2a);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .logo {
            height: 60px;
        }

        .admin-title {
            color: #f0a500;
            margin: 0;
        }

        .logout-btn {
            background: #f0a500;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #ff8c00;
        }

        .admin-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .admin-section {
            background: linear-gradient(145deg, #1a1a1a, #2a2a2a);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            color: #f0a500;
            margin-bottom: 20px;
        }

        .menu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .menu-table th,
        .menu-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        .menu-table th {
            background: #333;
            color: #f0a500;
        }

        .action-btn {
            background: none;
            border: none;
            color: #f0a500;
            cursor: pointer;
            margin: 0 5px;
            font-size: 1.1em;
            transition: color 0.3s;
        }

        .action-btn:hover {
            color: #ff8c00;
        }

        .add-form {
            display: grid;
            gap: 15px;
            margin-top: 20px;
        }

        .form-group {
            display: grid;
            gap: 5px;
        }

        .form-group label {
            color: #f0a500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 8px;
            border: 1px solid #333;
            border-radius: 5px;
            background: #1a1a1a;
            color: white;
        }

        .submit-btn {
            background: #f0a500;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #ff8c00;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
        }

        .close-modal {
            float: right;
            cursor: pointer;
            color: #f0a500;
            font-size: 1.5em;
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .menu-table {
                display: block;
                overflow-x: auto;
            }
        }

        /* Agregar estilos para las opciones de jugos */
        .opciones-container {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }
        
        .opcion-tag {
            background: #f0a500;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.9em;
        }

        .categoria-section {
            margin-bottom: 20px;
            border: 1px solid #333;
            border-radius: 10px;
            overflow: hidden;
        }

        .categoria-header {
            background: linear-gradient(145deg, #1a1a1a, #2a2a2a);
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s;
        }

        .categoria-header:hover {
            background: linear-gradient(145deg, #2a2a2a, #3a3a3a);
        }

        .categoria-title {
            color: #f0a500;
            margin: 0;
            font-size: 1.2em;
        }

        .categoria-content {
            padding: 20px;
            background: #1a1a1a;
            display: none;
        }

        .categoria-content.active {
            display: block;
        }

        .toggle-icon {
            color: #f0a500;
            transition: transform 0.3s;
        }

        .toggle-icon.active {
            transform: rotate(180deg);
        }

        .add-item-btn {
            background: #f0a500;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.3s;
        }

        .add-item-btn:hover {
            background: #ff8c00;
        }

        .categoria-header-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-count {
            background: #f0a500;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.9em;
        }

        .menu-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu-tab {
            background: #1a1a1a;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            transition: all 0.3s;
        }

        .menu-tab.active {
            background: #f0a500;
            color: white;
        }

        .menu-tab:hover {
            background: #ff8c00;
        }

        .menu-content {
            display: none;
        }

        .menu-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <img src="images/prueba.png" alt="La Ruca de los Monos" class="logo">
        <h1 class="admin-title">Panel de Administración</h1>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </header>

    <div class="admin-container">
        <div class="menu-tabs">
            <button class="menu-tab active" onclick="showMenu('desayuno')">Menú de Desayuno</button>
            <button class="menu-tab" onclick="showMenu('comida-rapida')">Menú de Comida Rápida</button>
        </div>

        <!-- Menú de Desayuno -->
        <section id="desayuno" class="admin-section menu-content active">
            <h2 class="section-title">Gestionar Menú de Desayuno</h2>
            
            <?php foreach ($desayuno_por_categoria as $categoria => $items): ?>
            <div class="categoria-section">
                <div class="categoria-header" onclick="toggleCategoria(this)">
                    <div class="categoria-header-content">
                        <h3 class="categoria-title"><?php echo htmlspecialchars($categoria); ?></h3>
                        <span class="item-count"><?php echo count($items); ?></span>
                    </div>
                    <div class="categoria-actions">
                        <button class="add-item-btn" onclick="showAddModal('<?php echo htmlspecialchars($categoria); ?>', 'desayuno')">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                </div>
                <div class="categoria-content">
                    <table class="menu-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Subcategoría</th>
                                <th>Opciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($item['descripcion']); ?></td>
                                <td>$<?php echo number_format($item['precio'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['subcategoria']); ?></td>
                                <td>
                                    <?php if ($item['opciones']): ?>
                                        <span class="opcion-tag"><?php echo htmlspecialchars($item['opciones']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="action-btn" onclick="showEditModal(<?php echo htmlspecialchars(json_encode($item)); ?>, 'desayuno')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" onclick="confirmDelete(<?php echo $item['id']; ?>, 'desayuno')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Menú de Comida Rápida -->
        <section id="comida-rapida" class="admin-section menu-content">
            <h2 class="section-title">Gestionar Menú de Comida Rápida</h2>
            
            <?php foreach ($comida_rapida_por_categoria as $categoria => $items): ?>
            <div class="categoria-section">
                <div class="categoria-header" onclick="toggleCategoria(this)">
                    <div class="categoria-header-content">
                        <h3 class="categoria-title"><?php echo htmlspecialchars($categoria); ?></h3>
                        <span class="item-count"><?php echo count($items); ?></span>
                    </div>
                    <div class="categoria-actions">
                        <button class="add-item-btn" onclick="showAddModal('<?php echo htmlspecialchars($categoria); ?>', 'comida-rapida')">
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                </div>
                <div class="categoria-content">
                    <table class="menu-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Subcategoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($item['descripcion']); ?></td>
                                <td>$<?php echo number_format($item['precio'], 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['subcategoria']); ?></td>
                                <td>
                                    <button class="action-btn" onclick="showEditModal(<?php echo htmlspecialchars(json_encode($item)); ?>, 'comida-rapida')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn" onclick="confirmDelete(<?php echo $item['id']; ?>, 'comida-rapida')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>

    <!-- Modal para agregar/editar items -->
    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 class="section-title" id="modalTitle">Agregar Nuevo Item</h2>
            <form id="itemForm" class="add-form" method="POST">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="itemId">
                <input type="hidden" name="menu_type" id="menuType">
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" required>
                </div>
                
                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria" required onchange="updateSubcategoria()">
                        <!-- Las opciones se llenarán dinámicamente según el tipo de menú -->
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="subcategoria">Subcategoría</label>
                    <select id="subcategoria" name="subcategoria" required>
                        <!-- Las opciones se llenarán dinámicamente según la categoría -->
                    </select>
                </div>
                
                <div class="form-group" id="opcionesGroup" style="display: none;">
                    <label for="opciones">Opciones</label>
                    <select id="opciones" name="opciones">
                        <option value="">Seleccione una opción</option>
                        <option value="Agua">Agua</option>
                        <option value="Leche">Leche</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">Guardar</button>
            </form>
        </div>
    </div>

    <script>
        const categoriasDesayuno = {
            'Pailas': ['Pailas'],
            'Empanadas': ['Empanadas'],
            'Jugos': ['Jugos'],
            'Sandwich': ['Sandwich'],
            'Bebestibles': ['Bebestibles']
        };

        const categoriasComidaRapida = {
            'Papas': ['Papas'],
            'Tablas': ['Tablas'],
            'Tabla Mixta': ['Tabla Mixta'],
            'Champi Pollo': ['Champi Pollo'],
            'Champi Carne': ['Champi Carne'],
            'Sandwichs': ['Sandwichs']
        };

        function showMenu(menuType) {
            // Actualizar tabs
            document.querySelectorAll('.menu-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Actualizar contenido
            document.querySelectorAll('.menu-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(menuType).classList.add('active');
        }

        function toggleCategoria(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('.toggle-icon');
            
            content.classList.toggle('active');
            icon.classList.toggle('active');
        }

        function showAddModal(categoria, menuType) {
            document.getElementById('modalTitle').textContent = 'Agregar Nuevo Item';
            document.getElementById('formAction').value = 'add';
            document.getElementById('menuType').value = menuType;
            document.getElementById('itemForm').reset();
            
            // Llenar las opciones de categoría según el tipo de menú
            const categorias = menuType === 'desayuno' ? categoriasDesayuno : categoriasComidaRapida;
            const categoriaSelect = document.getElementById('categoria');
            categoriaSelect.innerHTML = '';
            
            for (const cat in categorias) {
                const option = document.createElement('option');
                option.value = cat;
                option.textContent = cat;
                if (cat === categoria) option.selected = true;
                categoriaSelect.appendChild(option);
            }
            
            // Actualizar subcategorías
            updateSubcategoria();
            
            document.getElementById('itemModal').style.display = 'flex';
        }

        function showEditModal(item, menuType) {
            document.getElementById('modalTitle').textContent = 'Editar Item';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('menuType').value = menuType;
            document.getElementById('itemId').value = item.id;
            document.getElementById('nombre').value = item.nombre;
            document.getElementById('descripcion').value = item.descripcion;
            document.getElementById('precio').value = item.precio;
            
            // Llenar las opciones de categoría según el tipo de menú
            const categorias = menuType === 'desayuno' ? categoriasDesayuno : categoriasComidaRapida;
            const categoriaSelect = document.getElementById('categoria');
            categoriaSelect.innerHTML = '';
            
            for (const cat in categorias) {
                const option = document.createElement('option');
                option.value = cat;
                option.textContent = cat;
                if (cat === item.categoria) option.selected = true;
                categoriaSelect.appendChild(option);
            }
            
            document.getElementById('categoria').value = item.categoria;
            document.getElementById('subcategoria').value = item.subcategoria;
            document.getElementById('opciones').value = item.opciones;
            
            document.getElementById('itemModal').style.display = 'flex';
            updateSubcategoria();
        }

        function updateSubcategoria() {
            const categoria = document.getElementById('categoria').value;
            const menuType = document.getElementById('menuType').value;
            const categorias = menuType === 'desayuno' ? categoriasDesayuno : categoriasComidaRapida;
            const subcategoriaSelect = document.getElementById('subcategoria');
            const opcionesGroup = document.getElementById('opcionesGroup');
            
            // Actualizar subcategorías
            subcategoriaSelect.innerHTML = '';
            if (categorias[categoria]) {
                categorias[categoria].forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat;
                    option.textContent = subcat;
                    subcategoriaSelect.appendChild(option);
                });
            }
            
            // Mostrar/ocultar opciones para jugos
            if (menuType === 'desayuno' && categoria === 'Jugos') {
                opcionesGroup.style.display = 'block';
            } else {
                opcionesGroup.style.display = 'none';
            }
        }

        function closeModal() {
            document.getElementById('itemModal').style.display = 'none';
        }

        function confirmDelete(id, menuType) {
            if (confirm('¿Estás seguro de que deseas eliminar este item?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="${id}">
                    <input type="hidden" name="menu_type" value="${menuType}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            const modal = document.getElementById('itemModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Abrir la primera categoría por defecto
        document.addEventListener('DOMContentLoaded', function() {
            const firstCategoria = document.querySelector('.categoria-header');
            if (firstCategoria) {
                toggleCategoria(firstCategoria);
            }
        });
    </script>
</body>
</html> 