<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=6; //terminado

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	//Definicion de estado siguiente
	if (isset($_POST)){
		//Selecciona a la pagina del siguiente estado con la funcion de salida para iniciar el estado siguiente
		if (isset($_POST['Reiniciar'])){
				
			$siguienteestado=1; //estado programar produccion
			

			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos 
				SET estado=$siguienteestado 
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: index.php");
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
	$prodhechosdespausaini=$data['prodhechosdespausaini'];
	$eficienciaacumulada=$data['eficienciaacumulada'];
	$pausashechas=$data['pausashechas'];
	$tiempopausado=$data['tiempopausado'];
	$tiempoacumulado=$data['tiempoacumulado'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 6 Terminado</title>
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
		<?php 
			if ($productoshechos < $unidadesesperadas){
					echo("<h1 style='background-color:#F05B64';>Reporte final de producción e indicadores<br>La producción fue terminada sin hacer todas las unidades esperadas</h1>");
				} else {
					echo("<h1 style='background-color:#9AE3B0;'>Reporte final de producción e indicadores<br>Producción terminada completa</h1>");
				}
		?>
		<hr size="3px" color="black" />
		<h3>Orden de producción: <?php echo $ordendeprod; ?><br>Item a producir: <?php echo $itemaproducir; ?></h3>
		<hr size="3px" color="black" />
		<h3>Unidades terminadas actualmente: <?php echo $productoshechos; ?><br>
		Unidades programadas: <?php echo $unidadesesperadas; ?><br>
		Porcentaje completado: <?php echo $porcentajecompletado; ?> %</h3>
		<hr size="3px" color="black" />
		<h3>Ultimo tiempo de ciclo realizado: 

		<?php 
			if ($prodhechosdespausaini > 1){
				//primer productdo
				echo round($ultimotiempodeproduccion,2)." minutos ".round($ultimotiempodeproduccion*60,2)." segundos"; 
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


		<h3>Eficiencia Acumulada: <?php echo round($eficienciaacumulada,2); ?></h3>
		<h3>Pausas hechas: <?php echo ($pausashechas); ?></h3> 
		
		<h3>Tiempo acumulado en pausas en minutos: <?php echo round($tiempopausado/60,2); ?>, en segundos: <?php echo ($tiempopausado); ?></h3>
		<h3>Tiempo acumulado en trabajo hecho en minutos: <?php echo round($tiempoacumulado/60,2); ?>, en segundos: <?php echo ($tiempoacumulado); ?></h3>
		<hr size="3px" color="black" />

		<form method="post" action="">
			<input type="submit" name="Reiniciar" value="reiniciar"> 
		</form>	
		
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
	  		url="reportefinal.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>