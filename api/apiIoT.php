<?php

$mensaje=array("1");
if(!empty($_GET)) {
	if (isset($_GET['iddispositivoiot']) AND isset($_GET['idtipodispositivoiot'])){  
		//Datos GET recibidos
		$iddispositivoIoTrecibido=$_GET['iddispositivoiot'];
		$idtipodispositivoIoTrecibido=$_GET['idtipodispositivoiot'];
		include "../conexion.php";
		$query1 = mysqli_query($conexion,"
				SELECT * FROM dispositivosiot WHERE iddispositivoIoT=   $iddispositivoIoTrecibido");
		mysqli_close($conexion);
		$result=mysqli_num_rows($query1);
		
		//Verifica si Hay registros de dispositivo del iddispositivoIoT
		if ($result>0){
			$data=mysqli_fetch_array($query1);
			//Hay registros de dispositivo del iddispositivoIoT

			// verifica que el tipo dispositivo recibido desde el modulo iot corresponde con el registrado en la base de datos
			if($idtipodispositivoIoTrecibido==$data['tipodispositivoIoT']){
				//corresponden el tipo dispositivo recibido desde el modulo iot corresponde con el registrado en la base de datos

				//***************Dispositivo tipo 1*******
				if ( $_GET['idtipodispositivoiot']==1 AND isset($_GET['boton1']) AND isset($_GET['boton2']) ){ 
					//// Modulo Iot solo con botenes para conteo de prendas hechas al final de linea y paro por error

					//Boton tarea hecha
					if($_GET['boton1']==1 AND $_GET['boton2']==0){ 
						//Boton de fin de producto presionado
						$mod=$data['modulo']; 
						

						//incrementar contador parte hecha
						include "../conexion.php";
						$query2 = mysqli_query($conexion,"
							SELECT * FROM modulos WHERE idmodulo=$mod");
						$result2=mysqli_fetch_array($query2);
						$estadoactual=$result2['estado'];

						if($estadoactual==3){
							
							$productoshechos = $result2['productoshechos'];
							$nuevosproductoshechos=$productoshechos+1;
							$unidadesesperadas=$result2['unidadesesperadas'];


							//validar si termino
							if ($nuevosproductoshechos >= $unidadesesperadas){
								$siguenteestado=6;
							} else {
								$siguenteestado=3;
							}

							$query3 = mysqli_query($conexion,"
								UPDATE modulos SET productoshechos=$nuevosproductoshechos, estado=$siguenteestado WHERE idmodulo=$mod");
							mysqli_close($conexion);
							
							if ($query3){
								$mensaje = array("Estado"=>"Ok","Respuesta" =>"pieza hecha +1", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod, "Unidades esperadas"=>$unidadesesperadas, "Productos Hechos"=>$nuevosproductoshechos,"Estado Actual"=>$estadoactual);
							} else{
								$mensaje = array("Estado"=>"Error","Respuesta" =>"No pudo incrementar en base de datos", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod,"Estado Actual"=>$estadoactual);
							}
						}else{
							$mensaje = array("Estado"=>"Error","Respuesta" =>"Modulo no esta en estado de conteo", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod,"Modulo"=>$mod,"Estado Actual"=>$estadoactual);
						}

					}	
					
					//Boton de paro de modulo presionado
					elseif($_GET['boton1']==0 AND $_GET['boton2']==1) { 
						//Botón de paro de modulo presionado
						$mensaje = array("Estado"=>"Ok","Respuesta" =>"aro por error  pieza en la linea","idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'], "iddispositivoIoT"=>$_GET['iddispositivoiot']);
					} 

					//Sin info de botones acorde al tipo de modulo
					else {
						//Sin info de botones acorde al tipo de modulo
						$mensaje = array("Estado"=>"Error","Respuesta" =>"Parametros invalidos para el Dispositivo tipo 1");
					}
				} 

				//******dispositivo tipo 2
				else {
					//******dispositivo tipo 2 
					$mensaje = array("Estado"=>"Ok","Respuesta" =>"Dispositivo tipo 2");
				}

			} else {
				//el tipo de dispositivo enviado por el modulo iot no corresponde con el matriculado en la base de datos
				$mensaje = array("Estado"=>"Error","Respuesta"=>"El tipo de dispositivo recibido por el modulo no corresponde con el matriculado en la base de datos");
			}		
	
		} else {
			$mensaje = array("Estado"=>"Error","Respuesta"=>"No encontro registro del dispositivo $iddispositivoIoTrecibido ");
		} 
			
	} else {
		$mensaje = array("Estado"=>"Error","Respuesta "=>"Faltan parametros");
	}
} else {
	$mensaje = array("Estado"=>"Error","Respuesta"=>"Sin parametros");
}
echo json_encode($mensaje);

?>