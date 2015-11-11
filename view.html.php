<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mi lista de tareas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.css">
	<style>
		h1 a:hover {
			text-decoration: none;
		}
		.listicon {
			text-align: right;
			width: 20px;
		}
		.listiconbutton {
			margin: 0px;
			padding: 0px;
		}
		.orderbutton {
			display: inline-block;
		}
		.orderbutton button {
			margin: 0px;
			padding: 6px 10px;
		}
		.orderbuttons {
			margin-top: 25px;
		}

		.footer {
			text-align: right;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<div class="row">
					<div class="col-lg-8">
						<h1><a href="<?=$base_url?>">Mis Tareas</a></h1>
						<hr>
					</div>
					<?php if( !empty($datos) && count($datos)>1 ): ?>
					<div class="col-lg-4 orderbuttons">
						<div class="btn-group" role="group" aria-label="order">
							<form action="?tareaasc" method="post" class="orderbutton">
								<button type="submit" class="btn btn-default" title="Orden ascendente">
									<span class="glyphicon glyphicon-sort-by-alphabet"></span>
								</button>
							</form>
							<form action="?tareadesc" method="post" class="orderbutton" title="Orden descendente">
								<button type="submit" class="btn btn-default">
									<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
								</button>
							</form>
							<form action="?nivelasc" method="post" class="orderbutton" title="Nivel ascendente">
								<button type="submit" class="btn btn-default">
									<span class="glyphicon glyphicon-sort-by-order"></span>
								</button>
							</form>
							<form action="?niveldesc" method="post" class="orderbutton" title="Nivel descendente">
								<button type="submit" class="btn btn-default">
									<span class="glyphicon glyphicon-sort-by-order-alt"></span>
								</button>
							</form>
						</div>
					</div>
					<?php endif; ?>
				</div>
				
				<table class="table table-striped">
					<tbody>
						<?php if ( !empty($datos) ): ?>
							<?php foreach($datos as $dato):
								switch ($dato['level']) {
									case '1':
										$colorTarea = 'class="active"';
										break;
									case '2':
										$colorTarea = 'class="success"';
										break;
									case '3':
										$colorTarea = 'class="info"';
										break;
									case '4':
										$colorTarea = 'class="warning"';
										break;
									case '5':
										$colorTarea = 'class="danger"';
										break;
									default:
										$colorTarea = 'class=""';
										break;
								}
							?>
							<tr <?=$colorTarea?>>
								<th><?=$dato['task']?> - <?=$dato['location']?></th>
								<!-- <th><span class="glyphicon glyphicon-ok"></span></th> -->
								<th class="listicon">
									<form action="?completetask" method="post">
										<input type="hidden" name="idtask" value="<?=$dato['id']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-saved"></i></button>
									</form>
								</th>
								<th class="listicon">
									<form action="?deletetask" method="post">
										<input type="hidden" name="idtask" value="<?=$dato['id']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-trash"></i></button>
									</form>
								</th>
								<th class="listicon">
									<form action="<?=$base_url?>/edit/" method="post">
										<input type="hidden" name="idtask" value="<?=$dato['id']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-pencil"></i></button>
									</form>
								</th>
							</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<h2>No existen tareas</h2>
							<p>Introduce las que tengas pendientes</p>
						<?php endif; ?>
					</tbody>
				</table>
				<form action="?addtask" method="post">
					<div class="form-group col-xs-12 col-lg-12">
					    <input type="text" class="form-control col-lg-12" name="tarea" placeholder="Introducir Tarea" value="<?php if (isset($tarea)) echo $tarea; ?>">
					</div>

					<div class="form-group col-xs-12 col-lg-4">
					    <select class="form-control" name="nivel">
					      <option>Nivel</option>
						  <option value="1" <?php if ( isset($nivel) && $nivel == 1) echo 'selected'; ?>>1</option>
						  <option value="2" <?php if ( isset($nivel) && $nivel == 2) echo 'selected'; ?>>2</option>
						  <option value="3" <?php if ( isset($nivel) && $nivel == 3) echo 'selected'; ?>>3</option>
						  <option value="4" <?php if ( isset($nivel) && $nivel == 4) echo 'selected'; ?>>4</option>
						  <option value="5" <?php if ( isset($nivel) && $nivel == 5) echo 'selected'; ?>>5</option>
						</select>
					</div>
					<div class="form-group col-xs-12 col-lg-4">
					    <select class="form-control" name="nivel">
					      <option>Localización</option>
					      <?php if ( !empty($locality) ):?> 
						  	<?php foreach ($locality as $local): ?>
						  		<option name="idLocation" value="<?=$local['idLocation']?>" <?php if ( isset($local) ) ; ?>><?=$local['location']?></option>
						  	<?php endforeach; ?>
						  <?php endif; ?>	
						</select>
					</div>
					<div class="form-group col-xs-12 col-lg-4">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
			
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

			<div class="col-lg-offset-3 col-lg-6">
				<?php if ( !empty($completadas) ): ?>
				<div class="headComplete">
					<h1>Tareas Completadas</h1>
				</div>
				<hr>	
				<table class="table table-striped">
					<tbody>
							<?php foreach($completadas as $completada):
								switch ($completada['level']) {
									case '1':
										$colorTarea = 'class="active"';
										break;
									case '2':
										$colorTarea = 'class="success"';
										break;
									case '3':
										$colorTarea = 'class="info"';
										break;
									case '4':
										$colorTarea = 'class="warning"';
										break;
									case '5':
										$colorTarea = 'class="danger"';
										break;
									default:
										$colorTarea = 'class=""';
										break;
								}
							?>
							<tr <?=$colorTarea?>>
								<th><?=$completada['task']?></th>
								<!-- <th><span class="glyphicon glyphicon-ok"></span></th> -->
								<th class="listicon">
									<form action="?undotask" method="post">
										<input type="hidden" name="idtask" value="<?=$completada['id']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-open"></i></button>
									</form>
								</th>
								<th class="listicon">
									<form action="?deletetask" method="post">
										<input type="hidden" name="idtask" value="<?=$completada['id']?>">
										<button type="submit" class="btn btn-link btn-sm listiconbutton"><i class="glyphicon glyphicon-trash"></i></button>
									</form>
								</th>
							</tr>
							<?php endforeach; ?>
						
					</tbody>
				</table>
					
				<?php else: ?>
					<h2>No existen tareas completadas</h2>
				<?php endif; ?>
			</div>
			<div class="col-lg-offset-3 col-lg-6 footer">
				<?php if(isset($completadas) && count($completadas)>1): ?>
					<a class="btn btn-default" href="<?=$base_url?>/completes" role="button">Completadas</a>
				<?php endif; ?>
				<?php if(isset($eliminadas)): ?>
					<a class="btn btn-default" href="<?=$base_url?>/eliminadas" role="button">Eliminadas</a>
			</div>
				<?php endif; ?>
			</div>
	</div>
</body>
</html>