<?php
require_once __DIR__ . '/../../models/Proveedor.php';
require_once __DIR__ . '/../../models/Persona.php';
require_once __DIR__ . '/../../models/Categoria.php';

$proveedorModel = new Proveedor();
$personaModel = new Persona();
$categoriaModel = new Categoria();

$personas = $personaModel->obtenerTodos();
$categorias = $categoriaModel->obtenerTodas();

$proveedores = [];

// FILTRADO: Buscar por nombre de empresa o contacto
if (!empty($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $proveedores = $proveedorModel->buscarPorNombre($busqueda);
} elseif (!empty($_GET['persona_id'])) {
    $persona_id = $_GET['persona_id'];
    $proveedores = $proveedorModel->obtenerPorPersona($persona_id);
} else {
    $proveedores = $proveedorModel->obtenerTodos();
}
?>

<div class="content">
    <h2 style="color: #2c3e50;">Lista de Proveedores</h2>

    <!-- BUSCAR POR NOMBRE -->
    <form method="GET" action="" style="margin-bottom: 10px;" id="form-busqueda">
        <input type="text" name="buscar" id="input-buscar" placeholder="Buscar proveedor por nombre"
               value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
        <button type="submit">Buscar</button>
    </form>

    <!-- LIMPIAR INPUT LUEGO DE BUSCAR -->
    <script>
        if (window.location.search.includes('buscar=')) {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('input-buscar').value = '';
            });
        }
    </script>

    <!-- FILTRAR POR PERSONA -->
    <form method="GET" action="" style="margin-bottom: 20px;">
        <select name="persona_id" onchange="this.form.submit()">
            <option value="">-- Selecciona una persona --</option>
            <?php foreach ($personas as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (isset($_GET['persona_id']) && $_GET['persona_id'] == $p['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- BOTÓN PARA CREAR -->
    <a href="/db_esquema/public/proveedores.php?accion=crear"
       style="display: inline-block; margin-bottom: 15px; background-color: #2ecc71; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px;">
        Agregar nuevo proveedor
    </a>

    <!-- Justo encima o debajo de tu tabla de proveedores -->
<a href="/db_esquema/public/estadisticasProveedores.php"
   style="display: inline-block; margin-bottom: 15px; background-color: #3498db; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px;">
   📊 Ver Estadísticas
</a>


    <!-- TABLA -->
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #2c3e50; color: white;">
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Categoría</th> <!-- NUEVA COLUMNA -->
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($proveedores)): ?>
                <?php foreach ($proveedores as $prov): ?>
                    <tr style="background-color: white;">
                        <td><?= $prov['id'] ?></td>
                        <td><?= htmlspecialchars($prov['nombre_empresa']) ?></td>
                        <td><?= htmlspecialchars(($prov['contacto_nombre'] ?? '') . ' ' . ($prov['contacto_apellido'] ?? '')) ?></td>
                        <td><?= htmlspecialchars($prov['categoria_nombre'] ?? 'Sin categoría') ?></td>
                        <td><?= htmlspecialchars($prov['telefono']) ?></td>
                        <td><?= htmlspecialchars($prov['email']) ?></td>
                        <td><?= htmlspecialchars($prov['direccion']) ?></td>
                        <td>
                            <a href="/db_esquema/public/proveedores.php?accion=editar&id=<?= $prov['id'] ?>" 
                               style="color: #2980b9; text-decoration: none; margin-right: 10px;">Editar</a>
                            <a href="/db_esquema/src/controllers/proveedorController.php?accion=eliminar&id=<?= $prov['id'] ?>" 
                               onclick="return confirm('¿Estás segur@ de eliminar este proveedor?')" 
                               style="color: #e74c3c; text-decoration: none;">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center;">No se encontraron proveedores</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

