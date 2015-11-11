<?php 

require_once 'connectdb.php';

try{

	$sql = "INSERT INTO `todos`.`tareas` (`id`, `tarea`, `nivel`, `completada`, `fechahora`) VALUES (NULL, '$tarea', '5', '0', CURRENT_TIMESTAMP)";

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$pdo->exec($sql);

}catch(PDOException $e){

		die("No se ha podido crear la tabla 'tareas':". $e->getMessage());

}

?>