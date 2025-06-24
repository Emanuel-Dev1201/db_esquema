<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /db_esquema/public/login.php');
    exit;
}

require_once __DIR__ . '/../src/models/Categoria.php';
$categoriaModel = new Categoria();
$categorias = $categoriaModel->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="/db_esquema/src/templates/style.css">
</head>
<body>
    <!-- Menú lateral -->
    <div class="sidebar">
        <h2>db_esquema</h2>
        <a href="/db_esquema/public/personas.php">👤 Personas</a>
        <a href="/db_esquema/public/proveedores.php">🏢 Proveedores</a>
        <a href="/db_esquema/public/usuarios.php">🔐 Usuarios</a>
        <a href="/db_esquema/public/categorias.php">📂 Categorías</a>

    <!-- Botón cerrar sesión abajo -->
    <div style="position: absolute; bottom: 550px; width: 100%; text-align: left;">
        <form method="POST" action="/db_esquema/public/logout.php"style="padding: 10px;">
            <button type="submit">
                    Cerrar sesión
                </button>
        </form>
    </div>
</div>

    <!-- Contenido -->
    <div class="main-content">
        <div class="header">
            <span>Bienvenido, <?= htmlspecialchars($_SESSION['nombre'] ?? 'Usuario') ?></span>
                
            </form>
        </div>

        <h2 style="margin-top: 20px;">Lista de Categorías</h2>

        <!-- Formulario para añadir nueva categoría -->
        <form method="POST" action="/db_esquema/src/controllers/categoriaController.php?accion=guardar">
            <input type="text" name="nombre" placeholder="Nueva categoría" required>
            <button type="submit">Agregar</button>
        </form>

        <!-- Tabla de categorías -->
        <table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px; width: 100%;">
            <thead>
                <tr style="background-color: #2c3e50; color: white;">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                    <tr style="background-color: white;">
                        <td><?= $cat['id'] ?></td>
                        <td><?= htmlspecialchars($cat['nombre']) ?></td>
                        <td>
                            <a href="/db_esquema/src/controllers/categoriaController.php?accion=eliminar&id=<?= $cat['id'] ?>" 
                               onclick="return confirm('¿Eliminar esta categoría?')" 
                               style="color: #e74c3c; text-decoration: none;">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
</body>
</html>

