<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	//ce es cambio de estado
	//ea es estado anterior
	$estadopagina=3; //contando

	include "scripts.php";
	include "functions.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 3 Contando</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body>
	Contando <br><br>
	<a href="pausa.php?ce=1">Pausar</a><br>
	<a href="reportefinal.php?ce=1">Terminar</a>
	<br><br>
	
	Numero de modulo a seguir.<br>
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
  		url="conteo.php?mod="+val;
  		location.replace(url);
		}
	</script>
</body>
</html>