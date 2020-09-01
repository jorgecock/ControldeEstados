<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	//ce es cambio de estado
	//ea es estado anterior
	$estadopagina=1; //entrandoorden

	include "scripts.php";
	include "functions.php";
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
	<form method="post" action="index.php?ce=2">
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
		<input type="submit" value="Programar Producción">
	</form>

  <hr size="8px" color="black" />
	
	Número de módulo a seguir.<br>
	<select id="mySelect" name="selectmod" onchange="cambiodemodulo(this.value)">
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
  		url="index.php?mod="+val;
  		location.replace(url);
		}
	</script>
	</div>
</body>
</html>