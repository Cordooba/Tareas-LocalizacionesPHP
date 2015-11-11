<?php

require_once(dirname(dirname(__FILE__)).'/app/info.php');

require_once(__ROOT__.'/db/connectdb.php'); 

try{

	//SET - ENUM
	//ON UPDATE CASCADE ON DELELTE SET NULL	
	//ENGINE=InnoDB => Integridad referencial

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sqlLocation = "CREATE TABLE location (
		idLocation	INT AUTO_INCREMENT PRIMARY KEY,
		location 	VARCHAR(50) NOT NULL,
		latitud		DECIMAL(10,8) NOT NULL,
		longitud	DECIMAL(11,8) NOT NULL,
		createdat	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		editat		TIMESTAMP NULL DEFAULT NULL
		) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB";

	$pdo -> exec($sqlLocation);

	$sqlTasks = "CREATE TABLE tasks (
		id 			INT AUTO_INCREMENT PRIMARY KEY,
		idLocal  	INT, 
		task 		VARCHAR(255) NOT NULL,
		level   	ENUM('1','2','3','4','5') NOT NULL DEFAULT '1',
		createdat	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		doneat 		TIMESTAMP NULL DEFAULT NULL,
		deletedat 	TIMESTAMP NULL DEFAULT NULL,

		FOREIGN KEY (idLocal) REFERENCES location (idLocation)
		 	ON UPDATE CASCADE
		 	ON DELETE SET NULL
	) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB";

	$pdo -> exec($sqlTasks);

}catch(PDOException $e){

		die("No se ha podido crear la tabla 'tasks':". $e->getMessage());

}

?>