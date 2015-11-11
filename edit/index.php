<?php 

	require_once '.././app/info.php';
	require_once '.././db/connectdb.php';

	if ( isset($_POST['idtask']) ) {

		$id = htmlspecialchars($_POST['idtask'], ENT_QUOTES, 'UTF-8');

	try {
			$sql = "SELECT id, task, level FROM tasks WHERE id = :id";

			$ps = $pdo->prepare($sql);

			$ps->bindValue(':id', $id);

			$ps->execute();

	} catch (PDOException $e) {

			die("Error en la base de datos: ". $e->getMessage() );

	}

	//Solo obtendremos un solo resultado
	$tarea = $ps -> fetch(PDO::FETCH_ASSOC); 

	require_once 'edit.html.php';

	}else{

		header('Location:'.$base_url);

	}

	if ( isset($_GET['updatetask']) ) {

		$id = htmlspecialchars($_POST['idtask'], ENT_QUOTES, 'UTF-8');
		$task = htmlspecialchars($_POST['tarea'], ENT_QUOTES, 'UTF-8');
		$level = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');

		try {
			
			$sql = "UPDATE tasks SET task = :task, level = :level WHERE id = :id";

			$ps = $pdo->prepare($sql);

			$ps->bindValue(':id', $id);
			$ps->bindValue(':task', $task);
			$ps->bindValue(':level', $level);

			$ps->execute();

		} catch (Exception $e) {
			
			die("Error en la base de datos: ". $e->getMessage() );

		}

		header('Location:'.$base_url);

	}

 ?>