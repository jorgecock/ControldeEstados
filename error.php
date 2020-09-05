<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=5; //error

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	//Definicion de estado siguiente
	if (isset($_POST)){
		//Selecciona a la pagina del siguiente estado con la funcion de salida para iniciar el estado siguiente
		if (isset($_POST['reanudar'])){
				
			$siguienteestado=3; //estado continuar conteo
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos 
				SET estado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: conteo.php");
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
	<title>Estado 5 error</title>
</head>
<body>
	<div>
		<h1>Error</h1>
		<hr size="8px" color="black" />
		<h2>Producción en el módulo <?php echo $mod; ?> Detenida desde la linea.</h2>
		<br>

		<form method="post" action="">
			<input type="submit" name="reanudar" value="Reanudar Conteo"> 
			<input type="submit" name="terminar" value="terminar">
		</form>	
		
		<hr size="8px" color="black" />
		Numero de modulo a seguir.<br>
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
	  		url="error.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>
