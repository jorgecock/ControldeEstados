<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=1; //entrandoorden

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";

	include "validacionestadoactualTablero.php";

?>


<!DOCTYPE html>
<html>
<head>
	<title>Sin programar modulo visualizado en tablero</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="5">
</head>
<body align='center'>	
	<div>
		<hr size="8px" color="black" />
		<br>
		<h1>Módulo <?php echo $mod; ?> en espera a ser programado.</h2>
		<br>
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
	  		url="indexTablero.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>