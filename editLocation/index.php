<?php 

require_once '.././app/info.php';
require_once '.././db/connectdb.php';

if ( isset($_POST['idLocation']) ) 
{

	$idLocation = htmlspecialchars($_POST['idLocation'], ENT_QUOTES, 'UTF-8');

	try {
			$sql = "SELECT * FROM location WHERE idLocation = :idLocation";

			$ps = $pdo->prepare($sql);

			$ps->bindValue(':idLocation', $idLocation);

			$ps->execute();

	} catch (PDOException $e) {

			die("Error en la base de datos: ". $e->getMessage() );

	}

	$locality = $ps -> fetch(PDO::FETCH_ASSOC); 

	require_once 'editLocation.html.php';

}else{

	header('Location:'.$base_url);

}

if ( isset($_GET['updateLocal']) ) 
{

	$idLocation = htmlspecialchars($_POST['idLocation'], ENT_QUOTES, 'UTF-8');
	$location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');
	$latitud = htmlspecialchars($_POST['latitud'], ENT_QUOTES, 'UTF-8');
	$longitud = htmlspecialchars($_POST['longitud'], ENT_QUOTES, 'UTF-8');

	try {
			
		$sql = "UPDATE location SET location = :location, latitud = :latitud, longitud = :longitud WHERE idLocation = :idLocation";

		$ps = $pdo->prepare($sql);

		$ps->bindValue(':location', $location);
		$ps->bindValue(':latitud', $latitud);
		$ps->bindValue(':longitud', $longitud);
		$ps->bindValue(':idLocation', $idLocation);

		$ps->execute();

		} catch (Exception $e) {
			
			die("Error en la base de datos: ". $e->getMessage() );

		}

		//header('Location:'.$base_url.'/location');

}
	
?>