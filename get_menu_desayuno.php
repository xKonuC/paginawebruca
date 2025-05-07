<?php
require 'conexion.php';

// Obtener todos los items del menú de desayuno
$stmt = $pdo->query("SELECT * FROM menu_desayuno ORDER BY categoria, nombre");
$menu_items = $stmt->fetchAll();

// Agrupar items por categoría
$items_por_categoria = [];
foreach ($menu_items as $item) {
    $items_por_categoria[$item['categoria']][] = $item;
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($items_por_categoria);
?> 