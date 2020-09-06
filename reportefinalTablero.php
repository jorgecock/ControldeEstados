<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=6; //terminado

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	include "validacionestadoactualTablero.php";

	include "conexion.php";
	$query2 = mysqli_query($conexion,"SELECT * FROM modulos WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$data=mysqli_fetch_array($query2);
	$productoshechos=$data['productoshechos'];
	$unidadesesperadas=$data['unidadesesperadas'];
	$porcentajecompletado=$productoshechos*100/$unidadesesperadas;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 6 Terminado</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body>
	<div>
		<h1>Reporte final en el módulo controlado por IoT</h1>
		<hr size="8px" color="black" />
		
		<h2>Reporte final de producción e indicadores en el módulo <?php echo $mod; ?>.</h2>
		<br>

		<p>Unidades terminadas: <?php echo $productoshechos ?></p>
		<p>Unidades programadas: <?php echo $unidadesesperadas; ?></p>
		<p>Porcentaje completado: <?php echo $porcentajecompletado; ?> %</p>
		
		
		<hr size="8px" color="black" />
		Número de modulo a seguir.<br>
		<select id="mySelect" onchange="cambiodemodulo(this.value)">
			<?php
			//obtener numero de modulos configurados a hacer seguimiento para select 
			include "conexion.php";
			$query1 = mysqli_query($conexion,"SELECT * FROM modulos");
			mysqli_close($conexion);
			$result1=mysqli_num_rows($query1);
			echo $result1;
			for($i=1;$i<=$result1;$i++){
			?>	
			<option value="<?php echo $i; ?>" <?php echo ($i==$mod)? "selected":"";?>><?php echo $i;?></option>
			<?php 
			}
			?>
		</select>

		<script>
			function cambiodemodulo(val) {
	  		url="reportefinalTablero.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>