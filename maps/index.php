<?php 

require_once '.././app/info.php';
require_once '.././db/connectdb.php';

try {
	
	$sql = 'SELECT task, level, idLocation, location, latitud, longitud FROM location JOIN tasks ON location.idLocation = tasks.idLocal;';
	$ps = $pdo->prepare($sql);
	$ps->execute();

} catch (PDOException $e) {

	die("No se ha podido extraer información de la base de datos:". $e->getMessage());

}
while ( $row = $ps->fetch(PDO::FETCH_ASSOC) ) {

	$locality[] = $row;

}

require_once 'map.html.php';

 ?>