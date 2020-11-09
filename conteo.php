<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=3; //contando

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	include "conexion.php";
	$query2 = mysqli_query($conexion,"SELECT * FROM modulos WHERE idmodulo=$mod");
	$data=mysqli_fetch_array($query2);
	
	$tiempoacumuladoanterior=$data['tiempoacumulado'];
	$momentoinidespausa=$data['momentoinidespausa'];
	$tiempoactual=strtotime("now");
	$momentodepausa=$tiempoactual;
	$tiempocicloesperado=$data['tiempocicloesperado'];
	$productoshechos=$data['productoshechos'];
	$unidadesesperadas=$data['unidadesesperadas'];
	$porcentajecompletado=$productoshechos*100/$unidadesesperadas;
	$ordendeprod=$data['ordendeprod'];
	$itemaproducir=$data['itemaproducir'];
	$ultimotiempodeproduccion=$data['ultimotiempodeproduccion'];
	$prodhechosdespausaini=$data['prodhechosdespausaini'];
	$tiempopasadodesdeultimoreinicio=($tiempoactual-$momentoinidespausa);
	$nuevotiempoacumuladoanterior=$tiempopasadodesdeultimoreinicio+$tiempoacumuladoanterior;
	$tiempoacumtrabajo=$tiempopasadodesdeultimoreinicio+$tiempoacumuladoanterior;
	$eficiencia=$productoshechos*100/(($tiempoacumtrabajo/60)/$tiempocicloesperado);
	$pausashechas=$data['pausashechas'];
	$tiempopausado=$data['tiempopausado'];

	//Definicion de estado siguiente

	if (isset($_POST)){
		//Selecciona a la pagina del siguiente estado con la funcion de salida para iniciar el estado siguiente
		if (isset($_POST['pausa'])){
			
			$siguienteestado=4; //pasa a estado pausa
			$pausashechas=$pausashechas+1;

			$query1 = mysqli_query($conexion,"
				UPDATE modulos
				SET estado=$siguienteestado, tiempoacumulado=$nuevotiempoacumuladoanterior, momentodepausa=$momentodepausa, eficienciaacumulada=$eficiencia, pausashechas=$pausashechas
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: pausa.php");
		} 

		if (isset($_POST['terminar'])){
			
			$siguienteestado=6; //pasa a estado terminado
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos
				SET estado=$siguienteestado, tiempoacumulado=$nuevotiempoacumuladoanterior, momentodepausa=$momentodepausa, eficienciaacumulada=$eficiencia
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
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 3 Contando</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body onload="mueveReloj()">
	<div>
		<hr size="8px" color="black" />
		<form name="form_reloj">
			<input type="text" name="reloj" style="font-size : 14pt; text-align : left;" onfocus="window.document.form_reloj.reloj.blur()">
		</form>
		<h3 align='left'> Fecha: <?php echo date("d/m/Y"); ?></h3>
		<h1 align="center">MODULO <?php echo $mod; ?></h1>
		<hr size="3px" color="black" />
		<h1 style='background-color:#F7F561;'>Conteo de producción</h1>
		<hr size="3px" color="black" />
		<h3>Orden de producción: <?php echo $ordendeprod; ?><br>Item a producir: <?php echo $itemaproducir; ?></h3>
		<hr size="3px" color="black" />
		<h3>Unidades terminadas actualmente: <?php echo $productoshechos; ?><br>
		<h3>Unidades terminadas luego del inicio o de la última pausa: <?php echo $prodhechosdespausaini; ?><br>
		Unidades programadas: <?php echo $unidadesesperadas; ?><br>
		Porcentaje completado: <?php echo round($porcentajecompletado,2); ?> %</h3>
		<hr size="3px" color="black" />
		
		<h3>Ultimo tiempo de ciclo realizado: 
		<?php 
			if ($prodhechosdespausaini > 1){
				//primer producto despues de inicio o de pausa
				echo round($ultimotiempodeproduccion,2)." minutos, ".round($ultimotiempodeproduccion*60,2)." segundos"; 
				$eficienciaultimociclo=round($tiempocicloesperado*100/$ultimotiempodeproduccion,2)." %";
			}else{
				//segundo producto en adelante.
				echo ("No aplica para la primera unidad hecha despues del inicio de producción o luego de renudar por algún tipo de pausa.");
				$eficienciaultimociclo=" No aplica para la primera unidad hecha despues del inicio de producción o luego de renudar por algún tipo de pausa.";
			}
		?>
		<br>
		Tiempo de ciclo esperado: <?php echo $tiempocicloesperado; ?> minutos, <?php echo $tiempocicloesperado*60; ?> segundos.<br>
		Eficiencia del ultimo ciclo: <?php echo $eficienciaultimociclo; ?><br>
		</h3>
		<h3>Eficiencia Acumulada: <?php echo round($eficiencia,2); ?></h3> 
		<h3>Tiempo Acumulado trabajado total en minutos: <?php echo round($tiempoacumtrabajo/60,2); ?>, en segundos: <?php echo round($tiempoacumtrabajo,2); ?></h3>
		<h3>Tiempo transcurrido desde la ultima pausa en minutos: <?php echo round($tiempopasadodesdeultimoreinicio/60,2); ?>, en segundos: <?php echo round($tiempopasadodesdeultimoreinicio,2); ?></h3>
		<h3>Pausas hechas: <?php echo ($pausashechas); ?></h3> 
		<h3>Tiempo acumulado en pausas en minutos: <?php echo round($tiempopausado/60,2); ?>, en segundos: <?php echo ($tiempopausado); ?></h3>

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