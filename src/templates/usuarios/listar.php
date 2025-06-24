<?php
require_once __DIR__ . '/../../models/usuario.php';
$usuarioModel = new Usuario();
$usuarios = $usuarioModel->obtenerTodos();
?>

<div class="content">
    <h2 style="color: #2c3e50;">Lista de Usuarios</h2>

    <!-- Botón para agregar nuevo usuario -->
    <a href="/db_esquema/public/usuarios.php?accion=crear" 
       style="display: inline-block; margin-bottom: 15px; background-color: #2ecc71; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px;">
       Agregar nuevo usuario
    </a>

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #2c3e50; color: white;">
            <tr>
                <th>ID</th>
                <th>Persona</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr style="background-color: white;">
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['persona_nombre'] . ' ' . $u['persona_apellido']) ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['rol_nombre'] ?></td>
                    <td>
                        <a href="/db_esquema/public/usuarios.php?accion=editar&id=<?= $u['id'] ?>" 
                           style="color: #2980b9; text-decoration: none; margin-right: 10px;">Editar</a>
                        <a href="/db_esquema/src/controllers/usuarioController.php?accion=eliminar&id=<?= $u['id'] ?>" 
                           onclick="return confirm('¿Estás segur@ de eliminar este usuario?')" 
                           style="color: #e74c3c; text-decoration: none;">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
