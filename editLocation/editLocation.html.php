<!DOCTYPE html>
</pre>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar...</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-9">
				<div class="row">
					<div class="col-lg-8">
						<h1><a href="<?=$base_url?>/location">Mis Localizaciones</a></h1>
						<h2>Editar Localizacion</h2>
						<hr>
						<form action="?updateLocal" method="post">
							<div>
								<input type="hidden" class="form-control col-lg-12" name="idLocation" value="<?php if ( isset($locality['idLocation']) ) echo $locality['idLocation'] ; ?>">
							</div>
							<div class="form-group col-xs-12 col-lg-12">
					    		<input type="text" class="form-control col-lg-12" name="location" placeholder="Introducir Localizacion" value="<?php if ( isset($locality['location']) ) echo $locality['location'] ; ?>">
							</div>
							<div class="form-group col-xs-12 col-lg-4">
					    		<input type="text" class="form-control col-lg-12" name="latitud" placeholder="Latitud" value="<?php if ( isset($locality['latitud']) ) echo $locality['latitud'] ; ?>">
							</div>
							<div class="form-group col-xs-12 col-lg-4">
					    		<input type="text" class="form-control col-lg-12" name="longitud" placeholder="Longitud" value="<?php if ( isset($locality['longitud']) ) echo $locality['longitud'] ; ?>">
							</div>
							<div class="form-group col-xs-12 col-lg-4">
								<button type="submit" class="btn btn-primary">Actualizar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	