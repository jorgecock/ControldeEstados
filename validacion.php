<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	//ce es cambio de estado
	//ea es estado anterior
	$estadopagina=2; //validando

	include "scripts.php";
	include "functions.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 2 Validación</title>
</head>
<body>
	Validación <br><br>
	<a href="index.php?ce=1">Regresar</a><br>
	<a href="conteo.php?ce=1">Iniciar conteo</a>
	<br><br>
	
	Número de módulo a seguir.<br>
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
  		url="validacion.php?mod="+val;
  		location.replace(url);
		}
	</script>
</body>
</html>