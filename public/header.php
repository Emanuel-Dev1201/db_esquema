<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /db_esquema/public/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestion Empresarial</title>
    <link rel="stylesheet" href="/db_esquema/src/templates/style.css"> <!-- Usa tu CSS -->
</head>
<body>
<div class="container">

    <!-- Menú lateral -->
    <div class="sidebar">
        <h2>Gestion Empresarial</h2>
        <a href="/db_esquema/public/personas.php">👤 Personas</a>
        <a href="/db_esquema/public/proveedores.php">🏢 Proveedores</a>
        <a href="/db_esquema/public/usuarios.php">🔐 Usuarios</a>
        <a href="/db_esquema/public/categorias.php">📂 Categorías</a>

        <div style="margin-top: 20px;">
            <form method="POST" action="/db_esquema/public/logout.php" style="padding: 10px;">
                <button type="submit">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content"> 
        <div class="header">
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['nombre'] ?? 'Usuario') ?></strong></span>
        </div>
