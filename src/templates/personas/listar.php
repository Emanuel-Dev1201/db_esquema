<?php
require_once __DIR__ . '/../../models/Persona.php';

$personaModel = new Persona();
$personas = $personaModel->obtenerTodos();
?>

<div class="content">
    <h2 style="color: #2c3e50; margin-bottom: 20px;">👥 Lista de Personas</h2>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <a href="/db_esquema/public/personas.php?accion=crear"
       style="background-color: #2ecc71; color: white; padding: 10px 18px; text-decoration: none; border-radius: 6px;">
       ➕ Agregar nueva persona
    </a>

    <a href="/db_esquema/public/reportes/reportesPersonas.php"
       style="background-color: #9b59b6; color: white; padding: 10px 18px; text-decoration: none; border-radius: 6px;">
       🧾 Generar PDF
    </a>
</div>


    <table style="width: 100%; border-collapse: collapse; box-shadow: 0 2px 6px rgba(0,0,0,0.1); background-color: white; border-radius: 8px; overflow: hidden;">
        <thead style="background-color: #34495e; color: white;">
            <tr>
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Nombre</th>
                <th style="padding: 12px;">Apellido</th>
                <th style="padding: 12px;">Teléfono</th>
                <th style="padding: 12px;">Email</th>
                <th style="padding: 12px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personas as $p): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;"><?= $p['id'] ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['nombre']) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['apellido']) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['telefono']) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($p['email']) ?></td>
                    <td style="padding: 10px;">
                        <a href="/db_esquema/public/personas.php?accion=editar&id=<?= $p['id'] ?>" 
                           style="background-color: #3498db; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; margin-right: 6px;">
                           ✏️ Editar
                        </a>
                        <a href="/db_esquema/src/controllers/personaController.php?accion=eliminar&id=<?= $p['id'] ?>" 
                           onclick="return confirm('¿Estás segur@ de eliminar esta persona?')" 
                           style="background-color: #e74c3c; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;">
                           🗑️ Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
