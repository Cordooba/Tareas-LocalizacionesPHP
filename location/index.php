<?php 

require_once '.././app/info.php';
require_once '.././db/connectdb.php';

if ( isset($_GET['addLocal']) ) 
{
	$location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');
	$latitud = htmlspecialchars($_POST['latitud'], ENT_QUOTES, 'UTF-8');
	$longitud = htmlspecialchars($_POST['longitud'], ENT_QUOTES, 'UTF-8');
	$errores = [];

	if ( $location == "" ) {
		$errores['location'] = 'Debes indicar un texto para cada localizacion.';
	}

	if( !is_numeric($latitud) ) {
		$errores['latitud'] = 'Debes indicar una latitud con cada localizacion.';
	}

	if( !is_numeric($longitud) ) {
		$errores['longitud'] = 'Debes indicar una latitud con cada localizacion.';
	}

	if ( empty($errores) ) {
		try{
			$sql = "INSERT INTO location (location, latitud, longitud) VALUES (:location, :latitud, :longitud)";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':location', $location);
			$ps->bindValue(':latitud', $latitud);
			$ps->bindValue(':longitud', $longitud);
			$ps->execute();
		}catch (PDOException $e){
			die("No se ha podido guardar la tarea en la base de datos:". $e->getMessage());
		}
		header("Location: .");
		exit();
	}
	
}

if ( isset($_GET['deleteLocation']) )
{
	$idLocation = $_POST['idLocation'];

	if ( is_numeric($idLocation) ) {
		try {
			$sql = "DELETE FROM location WHERE idLocation = :idLocation";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idLocation', $idLocation);
			$ps->execute();
		} catch (PDOException $e) {
			echo "Error";
			exit();
		}
	}
	
	header('Location: .');
	exit();
}

try{
	$sql = 'SELECT * FROM location ;';
	$ps = $pdo->prepare($sql);
	$ps->execute();
}catch(PDOException $e) {
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

while ($row = $ps->fetch(PDO::FETCH_ASSOC) ) {
	$locality[] = $row;
}

require_once 'location.html.php';

?>