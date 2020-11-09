<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=1; //entrandoorden

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	//Definicion de estado siguiente
	$alert="";
	if (!empty($_POST)){
		if (empty($_POST['unidadesesperadas']) AND empty($_POST['tiempocicloesperado'])  AND empty($_POST['minutosprogramados']) AND empty($_POST['ordendeprod']) AND empty($_POST['itemaproducir']) ){
			$alert="Se deben llenar todos los campos";
		} else {
			$siguienteestado=2; //estado validacion
			$unidadesesperadas=$_POST['unidadesesperadas'];
			$tiempocicloesperado=$_POST['tiempocicloesperado'];
			$minutosprogramados=$_POST['minutosprogramados'];
			$ordendeprod=$_POST['ordendeprod'];
			$itemaproducir=$_POST['itemaproducir'];


			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos 
				SET estado=$siguienteestado, unidadesesperadas=$unidadesesperadas, tiempocicloesperado=$tiempocicloesperado, minutosprogramados=$minutosprogramados, ordendeprod='$ordendeprod', itemaproducir='$itemaproducir', productoshechos=0, momentodeinicio=0, tiempopausado=0, tiempoacumulado=0, tiemporegistro=0, tiemporegistroanterior=0, ultimotiempodeproduccion=0
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			

			header("location: validacion.php");
			
		}		
	} 

	include "validacionestadoactual.php";

	//Traer datos y desiciones.
	//include "conexion.php";
	//$query1 = mysqli_query($conexion,"
	//			SELECT xxxxxxxxx 
	//			WHERE idmodulo=$mod");
	//mysqli_close($conexion);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Estado 1 Ingreso de Datos de orden de producción</title>
</head>
<body onload="mueveReloj()">	
	<div>
		<hr size="8px" color="black" />
		<form name="form_reloj">
			<input type="text" name="reloj" style="font-size : 14pt; text-align : left;" onfocus="window.document.form_reloj.reloj.blur()">
		</form>
		<h3 align='left'> Fecha: <?php echo date("d/m/Y"); ?></h3>
		<h1 align='center'>MODULO <?php echo $mod; ?></h1>
		<hr size="3px" color="black" />
		<h1>Datos de orden de producción para el día</h1>
		<hr size="3px" color="black" />
		<h2>Inserte los datos de la orden de producción a programar en el módulo <?php echo $mod; ?></h2>
		<form align='left' method="post" action="">
			<label for="ordendeprod">Orden de producción:  </label>
			<input type="text" name="ordendeprod">
			<br><br>
			<label for="itemaproducir">Item a producir:  </label>
			<input type="text" name="itemaproducir">
			<br><br>
			<label for="unidadesesperadas">Unidades requeridas en la jornada a programar:  </label>
			<input type="number" name="unidadesesperadas">
			<br><br>
			<label for="tiempocicloesperado">Tiempo de ciclo en minutos: (Tiempo de ritmo esperado entre prendas entregadas en el punto final)  </label>
			<input type="number" step="any" name="tiempocicloesperado">
			<br><br>
			<label for="minutosprogramados">Minutos de jornada programados para producir la referencia:  </label>
			<input type="number" step="any" name="minutosprogramados">
			<br><br>
			<input type="submit" name="ProgProd" value="Programar Producción">
			<h4><?php echo $alert; ?></h4>
		</form>

	  	<hr size="8px" color="black" />
		Número de módulo a seguir.<br>
		
		<select id="mySelect" name="selectmod" onchange="cambiodemodulo(this.value)">
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
	  		url="index.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>