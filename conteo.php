<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=3; //contando

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	//Definicion de estado siguiente
	if (isset($_POST)){
		//Selecciona a la pagina del siguiente estado con la funcion de salida para iniciar el estado siguiente
		if (isset($_POST['pausa'])){
				
			$siguienteestado=4; //estado pausa
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos
				SET estado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: pausa.php");
		} 

		if (isset($_POST['terminar'])){
			
			$siguienteestado=6; //estado terminado
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos
				SET estado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: reportefinal.php");
		}
	}

	include "validacionestadoactual.php";

	include "conexion.php";
	$query2 = mysqli_query($conexion,"SELECT * FROM modulos WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$data=mysqli_fetch_array($query2);
	$productoshechos=$data['productoshechos'];
	$unidadesesperadas=$data['unidadesesperadas'];
	$porcentajecompletado=$productoshechos*100/$unidadesesperadas;
	$ordendeprod=$data['ordendeprod'];
	$itemaproducir=$data['itemaproducir'];
	$ultimotiempodeproduccion=$data['ultimotiempodeproduccion'];
	$tiempocicloesperado=$data['tiempocicloesperado'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 3 Contando</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body >
	<div>
		<hr size="8px" color="black" />
		<h1 align="center">MODULO <?php echo $mod; ?></h1>
		<hr size="3px" color="black" />
		<h1 style='background-color:#F7F561;'>Conteo de producción</h1>
		<hr size="3px" color="black" />
		<h3>Orden de producción: <?php echo $ordendeprod; ?><br>Item a producir: <?php echo $itemaproducir; ?></h3>
		<hr size="3px" color="black" />
		<h3>Unidades terminadas actualmente: <?php echo $productoshechos; ?><br>
		Unidades programadas: <?php echo $unidadesesperadas; ?><br>
		Porcentaje completado: <?php echo $porcentajecompletado; ?> %</h3>
		<hr size="3px" color="black" />
		<h3>Ultimo tiempo de ciclo realizado: 

		<?php 
			if ($productoshechos > 1){
				//primer productdo
				echo round($ultimotiempodeproduccion,2)." minutos"; 
				$eficienciaultimociclo=($tiempocicloesperado*100/$ultimotiempodeproduccion)." %";
			}else{
				//segundo producto en adelante.
				echo ("No aplica para la primera unidad hecha.");
				$eficienciaultimociclo=" No aplica para la primera unidad hecha.";
			}
		?>

		<br>
		Tiempo de ciclo esperado: <?php echo $tiempocicloesperado; ?> minutos.<br>
		Eficiencia del ultimo ciclo: <?php echo $eficienciaultimociclo; ?><br>


		</h3>
		<hr size="3px" color="black" />
		<form method="post" action="">
			
			<input type="submit" name="pausa" value="pausa"> 
			<input type="submit" name="terminar" value="terminar">
		</form>	
		<hr size="8px" color="black" />
		Numero de módulo a seguir.<br>

		<select align='center' id="mySelect" name="selectmod" onchange="cambiodemodulo(this.value)">
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
	  		url="conteo.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>	
</body>
</html>