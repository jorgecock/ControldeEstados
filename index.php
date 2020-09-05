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
		if (empty($_POST['unidadesesperadas']) AND empty($_POST['tiempocicloesperado'])  AND empty($_POST['minutosprogramados']) ){
			$alert="Los campos de Unidades Requeridas, Tiempo de ciclo esperado y Minutos de jornada no pueden estar vacios";
		} else {
			$siguienteestado=2; //estado validacion
			$unidadesesperadas=$_POST['unidadesesperadas'];
			$tiempocicloesperado=$_POST['tiempocicloesperado'];
			$minutosprogramados=$_POST['minutosprogramados'];

			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos 
				SET estado=$siguienteestado, unidadesesperadas=$unidadesesperadas, tiempocicloesperado=$tiempocicloesperado, minutosprogramados=$minutosprogramados
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
<body align='center'>	
	<div>
		<h1>Datos de orden de producción para el día en el módulo controlado por IoT</h1>
		<hr size="8px" color="black" />

		<h2>Inserte los datos de la orden de producción a programar en el módulo <?php echo $mod; ?>.</h2>
		<br>
		<form method="post" action="">
			<label for="unidadesesperadas">Unidades requeridas en la jornada a programar:  </label>
			<input type="number" name="unidadesesperadas">
			<br>
			<br>
			<label for="tiempocicloesperado">Tiempo de ciclo en minutos: (Tiempo de ritmo esperado entre prendas entregadas en el punto final)  </label>
			<input type="number" name="tiempocicloesperado">
			<br>
			<br>
			<label for="minutosprogramados">Minutos de jornada programados para producir la referencia:  </label>
			<input type="number" name="minutosprogramados">
			<br>
			<br>
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