<?php

$mensaje=array("1");
if(!empty($_GET)) {
	if (isset($_GET['iddispositivoiot']) AND isset($_GET['idtipodispositivoiot'])){  
		$iddispositivoIoTrecibido=$_GET['iddispositivoiot'];
		$idtipodispositivoIoTrecibido=$_GET['idtipodispositivoiot'];
	
		if ( $_GET['iddispositivoiot']==1 AND isset($_GET['boton1']) AND isset($_GET['boton2']) ){ // Modulo Iot solo con botenes para conteo de prendas hechas al final de linea y paro por error
			
			if($_GET['boton1']==1 AND $_GET['boton2']==0){ 
				
				include "../conexion.php";
				$query1 = mysqli_query($conexion,"SELECT * FROM dispositivosiot WHERE iddispositivoIoT=$iddispositivoIoTrecibido");
				mysqli_close($conexion);
				$numeroresultados = mysqli_num_rows($query1);
				if ($numeroresultados>0){
					$result = mysqli_fetch_array($query1);
					$mod=$result['modulo']; 
					echo $mod;

					


					$mensaje = array("Estado"=>"Ok","Respuesta" =>"icrementar en caso de estar contando, pieza hecha", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot']);

					echo("hola");




				} else {
					$mensaje = array("Estado"=>"Error","Respuesta"=>"No encontro registro del dispositivo");
				}
	
			} 






			elseif($_GET['boton1']==0 AND $_GET['boton2']==1) { 

				$mensaje = array("Estado"=>"Ok","Respuesta" =>"aro por error  pieza en la linea","idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'], "iddispositivoIoT"=>$_GET['iddispositivoiot']);
			} else {
				$mensaje = array("Estado"=>"Error","Respuesta" =>"Faltan parametros");
			} 
		} else {
			$mensaje = array("Estado"=>"Error","Respuesta" =>"Tipo de dispositivo con parametros incompletos o incorrectos");
		}
	} else {
		$mensaje = array("Estado"=>"Error","Respuesta "=>"Faltan parametros");
	}
} else {
	$mensaje = array("Estado"=>"Error","Respuesta"=>"Sin parametros");
}
echo json_encode($mensaje);
?>