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
				
			$siguienteestado=3; //Pasa a estado conteo
			$productoshechos=0; //inicio del conteo 
			$prodhechosdespausaini=0; //productos hechos luego de inicio
			$momentodeinicio=strtotime("now");
			$momentoinidespausa=strtotime("now");
			$tiempoacumulado=0;
			$tiempopausado=0;
			$pausashechas=0;
			$tiempoacumtrabajo=0;

			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos
				SET estado=$siguienteestado, productoshechos=$productoshechos, momentodeinicio=$momentodeinicio, tiempoacumulado=0, tiempopausado=0, prodhechosdespausaini=$prodhechosdespausaini, momentoinidespausa= $momentoinidespausa, pausashechas=0, tiempoacumtrabajo=0
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: conteo.php");
		} 

		if (isset($_POST['Regresar'])){
			
			$siguienteestado=1; //pasa a estado entrandoorden
			include "conexion.php";
			$query1 = mysqli_query($conexion,"
				UPDATE modulos 
				SET estado=$siguienteestado
				WHERE idmodulo=$mod");
			mysqli_close($conexion);
			header("location: index.php");
		}
	}
	
	include "validacionestadoactual.php";

	//Traer datos y desiciones.
	include "conexion.php";
	$query1 = mysqli_query($conexion,"
				SELECT *
				FROM modulos
				WHERE idmodulo=$mod");
	mysqli_close($conexion);
	$data=mysqli_fetch_array($query1);
	

	$unidadesesperadas=$data['unidadesesperadas']; 
	$tiempocicloesperado=$data['tiempocicloesperado']; 
	$minutosprogramados=$data['minutosprogramados']; 
	$takt=$minutosprogramados/$unidadesesperadas;
	$ordendeprod=$data['ordendeprod'];
	$itemaproducir=$data['itemaproducir'];

	$aceptable=0;

	$mensaje1="Jornada programada: $minutosprogramados minutos <br> Cantidad a producir: $unidadesesperadas unidades.<br><hr size='3px' color='black' />El tiempo de ciclo estimado es de $tiempocicloesperado minutos y se requiere un 'Takt Time' de $takt minutos para poder cumplir con los tiempos requeridos."; 
	if($tiempocicloesperado<=$takt){
		$mensaje2="Como el tiempo de ciclo es menor o igual que el 'Takt Time' requerido, se puede cumplir con la demanda.<br><br>Cuando vayan a comenzar labores en la línea modulo $mod de producción dar click en Iniciar Conteo.";
		$aceptable=1;
	} else {
		$mensaje2="El tiempo de ciclo esperado es mayor que el 'Takt time' requerido por tanto no se puede cumplir con las unidades deseadas.<br>De click en Regresar para reajustar los valores.";
		$aceptable=0;
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estado 2 Validación</title>
</head>
<body onload="mueveReloj()">
	<div>
		<hr size="8px" color="black" />
		<form name="form_reloj">
			<input type="text" name="reloj" style="font-size : 14pt; text-align : left;" onfocus="window.document.form_reloj.reloj.blur()">
		</form>
		<h3 align='left'> Fecha: <?php echo date("d/m/Y"); ?></h3>
		<h1 align='center'>MODULO <?php echo $mod; ?></h1>
		<hr size="3px" color="black" />
		<h1>Validación de los datos de la orden de producción a programar en el módulo <?php echo $mod; ?></h1>
		<hr size="3px" color="black" />
		<h3>Orden de producción: <?php echo $ordendeprod; ?><br>Item a producir: <?php echo $itemaproducir; ?></h3>
		<hr size="3px" color="black" />
		<h3 align="left"><?php echo $mensaje1; ?></h3>
		<h3 align="left" <?php if($aceptable==0){echo('style="background-color:#F05B64";');} ?>><?php echo $mensaje2; ?></h3>
		<hr size="3px" color="black" />
		<form  method="post" action="">			
			<?php if($aceptable==1){echo('<input type="submit" name="IniCont" value="Iniciar conteo">');} ?>
			<input type="submit" name="Regresar" value="Regresar">
		</form>	
	
		<hr size="8px" color="black" />
		Número de módulo a seguir.<br>
		<select id="mySelect" onchange="cambiodemodulo(this.value)">
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
	  		url="validacion.php?mod="+val;
	  		location.replace(url);
			}
		</script>
	</div>
</body>
</html>