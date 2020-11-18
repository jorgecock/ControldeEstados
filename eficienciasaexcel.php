<?php
	session_start();

	
	if(!isset($_POST["cargar_data"]) AND !isset($_POST["export_data"])) {
		$inicio=true;
	} else {
		$inicio=false;
	}


	$verdatosyexportar=false;
	if(isset($_POST["cargar_data"])) {
		if (empty($_POST['ordenprod']) AND empty($_POST['itemaproducir'])){
				echo "Debe seleccionar una orden de produccion y un tipo de prenda producida";
		} else {
			$verdatosyexportar=true;
			$ordendeprod=$_POST['ordenprod'];
			$itemaproducir=$_POST['itemaproducir'];

			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				SELECT *
				FROM registroeficiencias
				WHERE ordendeprod='$ordendeprod' AND itemaproducir='$itemaproducir'" );
			include "conexion.php";
			mysqli_close($conexion);
			$result = mysqli_num_rows($query1);
			if($result>0){
				while ($data=mysqli_fetch_array($query1)) {
					$eficiencias[]=$data;	

				}
				$mod=$eficiencias[0]['modulo'];
			} else {
				echo ("Datos no encontrados");
				$mod="";
				$verdatosyexportar=false;
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Eficiencias a Excel</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<div class="container">
			<h2>Eficiencias acumuladas al ejecutar una orden de producción de un producto específico</h2>
			<div class="well-sm col-sm-12">
				<div class="btn-group pull-right">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post">
						
						<label for="ordendeprod">Orden de producción: </label>
						<input type="text" name="ordenprod" value="<?php 
							if ($inicio==true){
								echo "";
							}else{
								echo $ordendeprod;
							}	
						?>"
						>
						<br><br>
						<label for="itemaproducir">Item a producir: </label>
						<input type="text" name="itemaproducir" value="<?php 
							if ($inicio==true){
								echo ""; 
							}else{
								echo $itemaproducir;
							}
						?>"
						>
						<br><br>
						
						<?php if ($verdatosyexportar==true){ ?>
							<br><br>
							<a href="excel.php?ordenprod=<?php echo $ordendeprod ?>&itemaproducir=<?php echo $itemaproducir ?>">Exportar a Excel</a>
						<?php } ?>
						

						<button type="submit" id="cargar_data" name='cargar_data' value="Buscar Eficiencias" class="btn btn-info">Buscar Eficiencias</button>

					</form>
				</div>
			</div>
		
			<?php if ($verdatosyexportar==true){ ?>
				<h2>Modulo: <?php echo $mod; ?></h2>
				<h2>Orden de Producción: <?php echo $ordendeprod; ?></h2>
				<h2>Item a producir: <?php echo $itemaproducir; ?></h2>
 
				<table id="" class="table table-striped table-bordered">
					<tr>
						<th>Eficiencia Acumulada</th>
						<th>Hora</th>
					</tr>
					<tbody>
						<?php foreach($eficiencias as $eficiencia) { ?>
							<tr>
								<td><?php echo $eficiencia ['eficiencia']; ?></td>
								<td><?php echo $eficiencia ['fechahora']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</body>
</html>



