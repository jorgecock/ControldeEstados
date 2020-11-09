<?php

include "../functions.php";

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
				//// Modulo Iot solo con botenes para conteo de prendas hechas al final de linea y paro por error, y medicion de voltaje

				if ( $_GET['idtipodispositivoiot']==1 AND isset($_GET['boton1']) AND isset($_GET['boton2']) AND isset($_GET['voltage'])){ 
					
					//voltage
					$voltage=$_GET['voltage'];

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
							
							$prodhechosdespausaini = $result2['prodhechosdespausaini'];
							$nuevosprodhechosdespausini=$prodhechosdespausaini+1;
							$unidadesesperadas=$result2['unidadesesperadas'];
							$tiemporegistroanterior=$result2['tiemporegistro'];
							$tiemporegistro=strtotime("now");
							$ordendeprod=$result2['ordendeprod'];
							$itemaproducir=$result2['itemaproducir'];


							//validar si no es el primer producto luego de inicio o pausa para descartar los valores en el promedio por ser un tiempo mas largo
							if ($nuevosprodhechosdespausini <= 1){
								//primer producto luego de inicio o de una pausa para no tomar en cuenta en los promedios.
								$ultimotiempodeproduccion=0;

							}else{
								//segundo producto en adelante.
								$ultimotiempodeproduccion=($tiemporegistro-$tiemporegistroanterior)/60;
							}


							//validar si termino
							if ($nuevosproductoshechos >= $unidadesesperadas){
								$siguenteestado=6;
							} else {
								$siguenteestado=3;
							}

							$query3 = mysqli_query($conexion,"
								UPDATE modulos 
								SET productoshechos=$nuevosproductoshechos, estado=$siguenteestado, tiemporegistro=$tiemporegistro,   tiemporegistroanterior=$tiemporegistroanterior, ultimotiempodeproduccion = $ultimotiempodeproduccion, voltage = $voltage, prodhechosdespausaini=$nuevosprodhechosdespausini
								WHERE idmodulo=$mod");

							//registro del momento de cada elemento a producir en una orden de produccion
							$query4 = mysqli_query($conexion,"
								INSERT INTO registrotiempos (ordendeprod, itemaproducir) 
								VALUES ('$ordendeprod', '$itemaproducir')");
							

							
							if ($query3 AND $query4){
								
								$mensaje = array("Estado"=>"Ok","Respuesta" =>"pieza hecha +1", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod, "Unidades esperadas"=>$unidadesesperadas, "Productos Hechos"=>$nuevosproductoshechos,"Estado Actual"=>$estadoactual,"Voltage"=>$voltage);
							} else{

								$mensaje = array("Estado"=>"Error","Respuesta" =>"No pudo incrementar en base de datos", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod,"Estado Actual"=>$estadoactual,"Voltage"=>$voltage);
							}
						}else{
							$mensaje = array("Estado"=>"Error","Respuesta" =>"Modulo no esta en estado de conteo", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod,"Modulo"=>$mod,"Estado Actual"=>$estadoactual,"Voltage"=>$voltage);
						}
						mysqli_close($conexion);

					}	
					
					//Boton de paro de modulo presionado
					elseif($_GET['boton1']==0 AND $_GET['boton2']==1) { 
						//Botón de paro de modulo presionado


						//Boton de fin de producto presionado
						$mod=$data['modulo']; 
						
						//incrementar contador parte hecha
						include "../conexion.php";
						$query2 = mysqli_query($conexion,"
							SELECT * FROM modulos WHERE idmodulo=$mod");
						
						$result2=mysqli_fetch_array($query2);
						$estadoactual=$result2['estado'];
						$pausashechas=$result2['pausashechas'];


						if($estadoactual==3){

							$siguenteestado=5;
							$pausashechas=$pausashechas+1;
							$tiempoacumuladoanterior=$result2['tiempoacumulado'];
							$momentoinidespausa=$result2['momentoinidespausa'];
							$tiempoactual=strtotime("now");
							$momentodepausa=$tiempoactual;
							$tiempocicloesperado=$result2['tiempocicloesperado'];
							$productoshechos=$result2['productoshechos'];
							$unidadesesperadas=$result2['unidadesesperadas'];
							$porcentajecompletado=$productoshechos*100/$unidadesesperadas;
							$ordendeprod=$result2['ordendeprod'];
							$itemaproducir=$result2['itemaproducir'];
							$ultimotiempodeproduccion=$result2['ultimotiempodeproduccion'];
							$prodhechosdespausaini=$result2['prodhechosdespausaini'];
							$tiempopasadodesdeultimoreinicio=($tiempoactual-$momentoinidespausa);
							$nuevotiempoacumuladoanterior=$tiempopasadodesdeultimoreinicio+$tiempoacumuladoanterior;
							$tiempoacumtrabajo=$tiempopasadodesdeultimoreinicio+$tiempoacumuladoanterior;
							$eficiencia=$productoshechos*100/(($tiempoacumtrabajo/60)/$tiempocicloesperado);
							


							$query3 = mysqli_query($conexion,"
								UPDATE modulos 
								SET estado=$siguenteestado, voltage = $voltage, pausashechas=$pausashechas, tiempoacumulado=$nuevotiempoacumuladoanterior, momentodepausa=$momentodepausa, eficienciaacumulada=$eficiencia
								WHERE idmodulo=$mod");

							$mensaje = array("Estado"=>"Ok","Respuesta" =>"Paro por error  pieza en la linea","idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'], "iddispositivoIoT"=>$_GET['iddispositivoiot'], "Voltage"=>$voltage);

						}else{
							$mensaje = array("Estado"=>"Error","Respuesta" =>"Modulo no esta en estado de conteo", "iddispositivoIoT"=>$_GET['iddispositivoiot'],"idtipodispositivoIoT"=>$_GET['idtipodispositivoiot'],"Modulo"=>$mod,"Modulo"=>$mod,"Estado Actual"=>$estadoactual, "Voltage"=>$voltage);
						}
						mysqli_close($conexion);

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