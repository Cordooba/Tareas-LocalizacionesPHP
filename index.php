<?php 

require_once 'app/info.php';
require_once 'db/connectdb.php';

if ( isset($_GET['addtask']) ) {

	$tarea = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
	$nivel = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');
	$idLocation = htmlspecialchars($_POST['idLocation'], ENT_QUOTES, 'UTF-8');
	$errores = [];

	if ( $tarea == "" ) {
		$errores['texto'] = 'Debes indicar un texto para cada tarea.';
	}

	if( $nivel < 1 || $nivel > 5) {
		$errores['nivel'] = 'Debes indicar un nivel con cada tarea.';
	}

	if ( empty($errores) ) {
		try{
			$sql = "INSERT INTO tasks (idLocal, task, level) VALUES (:idLocation, :tarea, :nivel)";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idLocation', $idLocation);
			$ps->bindValue(':tarea', $tarea);
			$ps->bindValue(':nivel', $nivel);
			$ps->execute();
		}catch (PDOException $e){
			die("No se ha podido guardar la tarea en la base de datos:". $e->getMessage());
		}
		header("Location: .");
		exit();
	}
	
}

if ( isset($_GET['completetask']) ) {
	$idtask = $_POST['idtask'];

	if ( is_numeric($idtask) ) {
		try {
			$sql = "UPDATE tasks SET doneat = NOW() WHERE id = :idtask";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idtask', $idtask);
			$ps->execute();
		} catch (PDOException $e) {
			echo "Error";
			exit();
		}
	}
	
	header('Location: .');
	exit();
}

if ( isset($_GET['undotask']) ) {
	$idtask = $_POST['idtask'];
	if ( is_numeric($idtask) ) {
		try {
			$sql = "UPDATE tasks SET doneat = NULL WHERE id = :idtask";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idtask', $idtask);
			$ps->execute();
		} catch (PDOException $e) {
			echo "Error";
			exit();
		}
	}
	
	header('Location: .');
	exit();
}

if ( isset($_GET['deletetask']) )
{
	$idtask = $_POST['idtask'];

	if ( is_numeric($idtask) ) {
		try {
			$sql = "UPDATE tasks SET deletedat = NOW() WHERE id = :idtask";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(':idtask', $idtask);
			$ps->execute();
		} catch (PDOException $e) {
			echo "Error";
			exit();
		}
	}
	
	header('Location: .');
	exit();
}

if ( isset($_GET['tareaasc']) ) {
	$sql = 'SELECT id, task, level, location FROM tasks JOIN location ON tasks.idLocal = location.idLocation WHERE tasks.doneat IS NULL AND tasks.deletedat  IS NULL ORDER BY tasks.task ASC';
}elseif ( isset($_GET['tareadesc']) ) {
	$sql = 'SELECT id, task, level, location FROM tasks JOIN location ON tasks.idLocal = location.idLocation WHERE tasks.doneat IS NULL AND tasks.deletedat  IS NULL ORDER BY tasks.task DESC';
}elseif ( isset($_GET['nivelasc']) ) {
	$sql = 'SELECT id, task, level, location FROM tasks JOIN location ON tasks.idLocal = location.idLocation WHERE tasks.doneat IS NULL AND tasks.deletedat  IS NULL ORDER BY tasks.level ASC';
}elseif ( isset($_GET['niveldesc']) ) {
	$sql = 'SELECT id, task, level, location FROM tasks JOIN location ON tasks.idLocal = location.idLocation WHERE tasks.doneat IS NULL AND tasks.deletedat  IS NULL ORDER BY tasks.level DESC';
}else{
	$sql = 'SELECT * FROM tasks JOIN location ON tasks.idLocal = location.idLocation WHERE tasks.doneat IS NULL AND tasks.deletedat IS NULL ORDER BY tasks.level DESC, tasks.task ASC';
}

try{
	$ps = $pdo->prepare($sql);
	$ps->execute();
}catch(PDOException $e) {
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

while ($row = $ps->fetch(PDO::FETCH_ASSOC) ) {
	$datos[] = $row;
}

// localizaciones
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

// completadas
try{
	$sql = 'SELECT * FROM tasks WHERE doneat IS NOT NULL AND deletedat IS NULL ORDER BY doneat DESC LIMIT 5';
	$ps = $pdo->prepare($sql);
	$ps->execute();
}catch(PDOException $e) {
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

while ($row = $ps->fetch(PDO::FETCH_ASSOC) ) {
	$completadas[] = $row;
}

// eliminadas
try{
	$sql = 'SELECT * FROM tasks WHERE deletedat IS NOT NULL ORDER BY doneat DESC LIMIT 20';
	$ps = $pdo->prepare($sql);
	$ps->execute();
}catch(PDOException $e) {
	die("No se ha podido extraer información de la base de datos:". $e->getMessage());
}

while ($row = $ps->fetch(PDO::FETCH_ASSOC) ) {
	$eliminadas[] = $row;
}

require_once 'view.html.php';

?>