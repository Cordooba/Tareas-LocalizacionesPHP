<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Localizaciones</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css">
	</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<div class="row">
					<div class="col-lg-8">
						<h1><a href="<?=$base_url?>">Mis Tareas</a></h1>
						<h2>Localizaciones</h2>
						<hr>
					</div>
				</div>
				<table class="table table-striped">
					<tbody>
						<tr>
							<th>Localizacion</th>
							<th>Latitud</th>
							<th>Longitud</th>
							<th>Eliminar</th>
							<th>Editar</th>
						</tr>
						<?php if ( !empty($locality) ): ?>
							<?php foreach($locality as $dato): ?>
								<tr>
									<th><?=$dato['location']?></th>
									<th><?=$dato['latitud']?></th>
									<th><?=$dato['longitud']?></th>
									<th class="listicon">
									<form action="?deleteLocation" method="post">
										<input type="hidden" name="idLocation" value="<?=$dato['idLocation']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-trash"></i></button>
									</form>
									</th>
									<th class="listicon">
									<form action="<?=$base_url?>/editLocation/" method="post">
										<input type="hidden" name="idLocation" value="<?=$dato['idLocation']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-pencil"></i></button>
									</form>
								</th>
								</tr>
							<?php endforeach;?>
						<?php else: ?>
							<h2>No existen localizaciones</h2>
							<p>Introduce algunas localizaciones para emplearlas en las tareas</p>
						<?php endif; ?>	
					</tbody>
				</table>
				<form action="?addLocal" method="post">
					<div class="form-group col-xs-12 col-lg-14">
					    <input type="text" class="form-control col-lg-12" name="location" placeholder="Introducir Localizacion" value="<?php if ( isset($location) ) echo $location ; ?>">
					</div>
					<div class="form-group col-xs-12 col-lg-4">
					    <input type="text" class="form-control col-lg-12" name="latitud" placeholder="Latitud" value="<?php if ( isset($latitud) ) echo $latitud ; ?>">
					</div>
					<div class="form-group col-xs-12 col-lg-4">
					    <input type="text" class="form-control col-lg-12" name="longitud" placeholder="Longitud" value="<?php if ( isset($longitud) ) echo $longitud ; ?>">
					</div>
					<div class="form-group col-xs-12 col-lg-4">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
				<div class="row">
					<div class="col-lg-offset-3 col-lg-6">
						<?php if( isset($errores) ): ?>
							<div class="panel panel-danger">
								<div class="panel-heading">Error</div>
									<div class="panel-body">
										<?php foreach($errores as $error): ?>
											<?=$error?><br>
										<?php endforeach; ?>
									</div>
							</div>
						<?php endif; ?>
					</div>
				</div>	
			</div>		
		</div>
	</div>
</body>
</html>		