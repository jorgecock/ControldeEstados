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
		$_GET['ce']=0;
		include "conexion.php";
		$query = mysqli_query($conexion,"UPDATE controldeestados SET estado='contando' WHERE idmodulo=$mod");
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
		echo ("Estado 2 Módulo:".$mod);
	} elseif ($estado=="enpausa"){
		header("location: pausa.php?mod=".$mod);
	} elseif ($estado=="error"){
		header("location: error.php?mod=".$mod);
	} elseif ($estado=="terminado"){
		header("location: reportefinal.php?mod=".$mod);
	} 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 2 Contando</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="1">
</head>
<body>
	<br>
	Contando <br>
	<a href="pausa.php?mod=<?php echo $mod;echo("&ce=1");?>">Pausar</a><br>
	<a href="reportefinal.php?mod=<?php echo $mod;echo("&ce=1&ea=2");?>">Terminar</a>
</body>
</html>