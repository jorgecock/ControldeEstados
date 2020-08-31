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
		$query = mysqli_query($conexion,"UPDATE controldeestados SET estado='error' WHERE idmodulo=$mod");
		mysqli_close($conexion);
	}

  //determinar el estado del modulo en variable mod
	include "conexion.php";
	$query = mysqli_query($conexion,"SELECT estado FROM controldeestados WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$resultado=mysqli_fetch_array($query);
	$estado=$resultado[0];
	
	if ($estado=="entrandoorden"){
		header("location: index.php?mod=".$mod);
	} elseif ($estado=="validando"){
		header("location: validacion.php?mod=".$mod);
	} elseif ($estado=="contando"){
		header("location: conteo.php?mod=".$mod);
	} elseif ($estado=="enpausa"){
		header("location: pausa.php?mod=".$mod);
	} elseif ($estado=="error"){
		echo ("Estado 4 Modulo:".$mod);
	} elseif ($estado=="terminado"){
		header("location: reportefinal.php?mod=".$mod);
	} 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 4 error</title>
</head>
<body>
	<br>
	Error <br>
	<a href="conteo.php?mod=<?php echo $mod;echo("&ce=1&ea=4");?>">Continuar</a><br>
	<a href="reportefinal.php?mod=<?php echo $mod;echo("&ce=1&ea=4");?>">Terminar</a>
</body>
</html>