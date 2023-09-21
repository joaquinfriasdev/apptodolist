<?php

$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$conexion;

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=aplicacion", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falla de conexión: " . $e->getMessage();
}



if(isset($_POST['agregar_tarea'])){
    
    $tarea=($_POST['tarea']);
    $sql='INSERT INTO tareas (tarea) VALUE(?)';
    $sentencia=$conexion->prepare($sql);
    $sentencia->execute([$tarea]);
}

if(isset($_GET['id'])){

    $id=$_GET['id'];
    $sql='DELETE FROM tareas WHERE id=?';
    $sentencia=$conexion->prepare($sql);
    $sentencia->execute([$id]);
}

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $completado=(isset($_POST['completado']))?1:0;
    $sql='UPDATE tareas SET completado=? WHERE id=?';
    $sentencia=$conexion->prepare($sql);
    $sentencia->execute([$completado,$id]);
}

$sql="SELECT * FROM tareas";
$registros=$conexion->query($sql);

?>