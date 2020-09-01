<?php 
	date_default_timezone_set('America/Bogota');
	//Definicion de modulo
	if (isset($_GET['mod'])){
		$_SESSION['mod']=$_GET['mod'];
	}
	if (!isset($_SESSION['mod'])){
		$mod=1;	
		$_SESSION['mod']=1;
	} else {
		$mod=$_SESSION['mod'];
	}

	//Definicion de estado siguiente
	if (isset($_GET['ce'])){
		$siguienteestado=$_GET['ce'];
		include "conexion.php";
		$query1 = mysqli_query($conexion,"UPDATE controldeestados SET idestado=$siguienteestado WHERE idmodulo=$mod");
		mysqli_close($conexion);
		
		//Selecciona a la pagina del siguiente estado segun ce )cambio de estado) Agregar la funcion de salida para iniciar el estado siguiente
		if ($siguienteestado==1){
			//funcion de inicio
			header("location: index.php");
		} elseif ($siguienteestado==2){
			//funcion de inicio
			header("location: validacion.php");
		} elseif ($siguienteestado==3){
			//funcion de inicio
			header("location: conteo.php");
		} elseif ($siguienteestado==4){
			//funcion de inicio	
			header("location: pausa.php");
		} elseif ($siguienteestado==5){
			//funcion de inicio	
			header("location: error.php");
		} elseif ($siguienteestado==6){
			//funcion de inicio	
			header("location: reportefinal.php");
		} 
	}

	//validacion de estado actual vs pagina cargada
	include "conexion.php";
	$query = mysqli_query($conexion,"SELECT * FROM controldeestados WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$result = mysqli_num_rows($query);
	if($result>0){
		$data=mysqli_fetch_array($query);
		$estado=$data['idestado'];
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
	} else {
		echo "numero de modulo invalido";
	} 
?>