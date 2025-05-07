<?php
require 'conexion.php';

// Cambia estos valores para el nuevo usuario
$usuario = 'kevin';
$password_plano = 'kevin123';

// Hashear la contraseña
$hash = password_hash($password_plano, PASSWORD_DEFAULT);

// Insertar en la base de datos
$stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
if ($stmt->execute([$usuario, $hash])) {
    echo "Usuario creado correctamente.<br>";
    echo "Usuario: $usuario<br>";
    echo "Contraseña: $password_plano<br>";
} else {
    echo "Error al crear el usuario.";
}
?>