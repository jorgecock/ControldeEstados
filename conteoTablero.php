<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=3; //contando

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
	<title>Estado 3 Contando, tablero</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body >
	<div>
		<h1>Contando</h1>
		<hr size="8px" color="black" />
		<h2>Conteo de producción en el módulo <?php echo $mod; ?>.</h2>
		<br>

		<p>Unidades terminadas actualmente: <?php echo $productoshechos; ?></p>
		<p>Unidades programadas: <?php echo $unidadesesperadas; ?></p>
		<p>Porcentaje completado: <?php echo $porcentajecompletado; ?> %</p>


		<hr size="8px" color="black" />
		Numero de módulo a seguir.<br>

		<select id="mySelect" name="selectmod" onchange="cambiodemodulo(this.value)">
			<?php
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
	  		url="conteoTablero.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>	
</body>
</html>