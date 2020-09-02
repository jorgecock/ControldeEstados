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
				UPDATE controldeestados 
				SET idestado=$siguienteestado 
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: index.php");
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
	<title>Estado 6 Terminado</title>
</head>
<body>
	<div>
		<h1>Reporte final en el módulo controlado por IoT</h1>
		<hr size="8px" color="black" />
		
		<h2>Reporte final de producción e indicadores en el módulo <?php echo $mod; ?>.</h2>
		<br>

		<form method="post" action="">
			<input type="submit" name="Reiniciar" value="reiniciar"> 
		</form>	
		
		<hr size="8px" color="black" />
		Número de modulo a seguir.<br>
		<select id="mySelect" onchange="cambiodemodulo(this.value)">
			<?php
			//obtener numero de modulos configurados a hacer seguimiento para select 
			include "conexion.php";
			$query1 = mysqli_query($conexion,"SELECT * FROM controldeestados");
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