<?php 

require_once (dirname(dirname(__FILE__))).'app/info.php';
require_once (__ROOT__.'db/connectdb.php');

try {

	
	
} catch (PDOException $e) {
	
	echo "".$e->getMessage();

}


require_once 'map.html.php';

 ?>