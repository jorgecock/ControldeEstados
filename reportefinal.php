<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	//ce es cambio de estado
	//ea es estado anterior
	$estadopagina=6; //terminado

	include "scripts.php";
	
	if (!isset($_SESSION['mod'])){
		$mod=1;	
		$_SESSION['mod']=1;
	} else {
		$mod=$_SESSION['mod'];
	}
	include "conexion.php";
	$query = mysqli_query($conexion,"SELECT * FROM controldeestados WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$result = mysqli_num_rows($query);
	if($result>0){
		$data=mysqli_fetch_array($query);
		$estado=$data['idestado'];
		$ea=$data['ea'];
		$ce=$data['ce'];
		if ($estado<>$estadopagina){
			if ($estado==1){
				header("location: index.php");
			} elseif ($estado==2){
				header("location: validacion.php");
			} elseif ($estado==3){
				header("location: conteo.php");
			} elseif ($estado==4){
				header("location: pausa.php");
			} elseif ($estado==5){
				header("location: error.php");
			} elseif ($estado==6){
				header("location: reportefinal.php");
			} 
		}

		//Inicializaciones
		if ($ce=1){
			$ce=0;
			include "conexion.php";
			$query1 = mysqli_query($conexion,"UPDATE controldeestados SET ce=0 WHERE idmodulo=$mod");
			mysqli_close($conexion);
			
			//Inicializaciones
			//Inicializaciones
		}
	} else {
		echo "numero de modulo invalido";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 6 Terminado</title>
</head>
<body>
	Reporte Final<br><br>
	<a href="index.php?ce=1">Iniciar Nuevamente</a>
	<br><br>
	
	Numero de modulo a seguir.<br>
	<select id="mySelect" onchange="myFunction()">
		<?php
		//obtener numero de modulos configurados a hacer seguimiento para select 
		include "conexion.php";
		$query1 = mysqli_query($conexion,"SELECT * FROM controldeestados");
		mysqli_close($conexion);
		$result1=mysqli_num_rows($query1);
		echo $result1;
		for($i=1;$i<=$result1;$i++){
		?>	
		<option value="<?php echo $i; ?>"><?php echo $i;?></option>
		<?php 
		}
		?>
	</select>
</body>
</html>