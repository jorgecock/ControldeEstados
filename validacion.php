<?php
	session_start();
	//if($_SESSION['rol']!=1){
	//	header("location: ./");
	//}
	
	$estadopagina=2; //validando

	include "scripts.php";
	include "functions.php";
	include "definicionmodulo.php";


	//Definicion de estado siguiente
	if (isset($_POST)){
		//Selecciona a la pagina del siguiente estado con la funcion de salida para iniciar el estado siguiente
		if (isset($_POST['IniCont'])){
				
			$siguienteestado=3; //estado validacion
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE controldeestados 
				SET idestado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: conteo.php");
		} 

		if (isset($_POST['Regresar'])){
			
			$siguienteestado=1; //estado entrandoorden
			
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE controldeestados 
				SET idestado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: index.php");
		}
	}
	
	include "validacionestadoactual.php";

	//Traer datos y desiciones.
	include "conexion.php";
	$query1 = mysqli_query($conexion,"
				SELECT unidadesesperadas, tiempocicloesperado , minutosprogramados
				FROM controldeestados
				WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$data=mysqli_fetch_array($query1);
	$unidadesesperadas=$data['unidadesesperadas']; 
	$tiempocicloesperado=$data['tiempocicloesperado']; 
	$minutosprogramados=$data['minutosprogramados']; 
	$takt=$minutosprogramados/$unidadesesperadas;
	$aceptable=0;

	$mensaje1="<h3 align='center'>En la jornada programada de $minutosprogramados minutos se espera producir $unidadesesperadas unidades.<br>El tiempo de ciclo estimado es de $tiempocicloesperado minutos. <br>Se requiere un Takt Time de $takt minutos.</h3>"; 
	if($tiempocicloesperado<=$takt){
		$mensaje2="<h3 align='center'>El tiempo de ciclo es adecuado para cumplir con la demanda.<br><br>Si está de acuerdo, dar click en Iniciar Conteo para continuar</h3>";
		$aceptable=1;
	} else {
		$mensaje2="<h3 align='center'>El tiempo de ciclo esperado es mayor que el Takt time requerido por tanto no se puede cumplir con las unidades deseadas.<br>De click en Regresar para reajustar los valores.</h3>";
		$aceptable=0;
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 2 Validación</title>
</head>
<body align='center'>
	<div>
		<h1>Validación</h1>
		<hr size="8px" color="black" />
		<h2>Validación de los datos de la orden de producción a programar en el módulo <?php echo $mod; ?>.</h2>
		<?php echo($mensaje1.$mensaje2) ?>
		<br>
		<form method="post" action="">			
			<?php if($aceptable==1){echo('<input type="submit" name="IniCont" value="Iniciar conteo">');} ?>
			<input type="submit" name="Regresar" value="Regresar">
		</form>	
	
		<hr size="8px" color="black" />
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
	</div>
</body>
</html>