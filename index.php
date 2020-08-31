<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	//ce es cambio de estado
	//ea es estado anterior
	include "scripts.php";
	if (!isset($_GET['mod'])){
		$mod=1;		
	} else {
		$mod=$_GET['mod'];
	}

	if (isset($_GET['ce']) AND $_GET['ce']=1){
		include "conexion.php";
		$query = mysqli_query($conexion,"UPDATE controldeestados SET estado='entrandoorden' WHERE idmodulo=$mod");
		mysqli_close($conexion);
	}

  //determinar el estado del modulo en variable mod
	include "conexion.php";
	$query = mysqli_query($conexion,"SELECT estado FROM controldeestados WHERE idmodulo=$mod");
	mysqli_close($conexion);
	
	$result = mysqli_num_rows($query);
	if($result>0){
		$resultado=mysqli_fetch_array($query);
		$estado=$resultado[0];
		
		if ($estado=="entrandoorden"){
			echo ("Estado 0 Modulo:".$mod);
		} elseif ($estado=="validando"){
			header("location: validacion.php?mod=".$mod);
		} elseif ($estado=="contando"){
			header("location: conteo.php?mod=".$mod);
		} elseif ($estado=="enpausa"){
			header("location: pausa.php?mod=".$mod);
		} elseif ($estado=="error"){
			header("location: error.php?mod=".$mod);
		} elseif ($estado=="terminado"){
			header("location: reportefinal.php?mod=".$mod);
		} 
	}	else {
		echo ("Numero de módulo invalido");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 0 Ingreso de Datos de orden de producción</title>
</head>
<body>
	<br>
	Ingreso de Datos de orden de producción <br>
	<a href="validacion.php?mod=<?php echo $mod;echo("&ce=1");?>">Validar</a>

	<select id="mySelect" onchange="myFunction()">
  	<option value="1">1</option>
  	<option value="2">2</option>
	</select>




</body>
</html>