
<?php
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename= reporte.xls");	



	$ordendeprod=($_GET['ordenprod']);
	$itemaproducir=($_GET['itemaproducir']);

	include "conexion.php";
	$query1 = mysqli_query($conexion,"
		SELECT *
		FROM registroeficiencias
		WHERE ordendeprod='$ordendeprod' AND itemaproducir='$itemaproducir'" );
		include "conexion.php";
	mysqli_close($conexion);
	$result = mysqli_num_rows($query1);
	if($result>0){
		while ($data=mysqli_fetch_array($query1)) {
			$eficiencias[]=$data;	

		}
		$mod=$eficiencias[0]['modulo'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Grabar</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h2>Modulo: <?php echo $mod; ?></h2>
		<h2>Orden de Producción: <?php echo $ordendeprod; ?></h2>
		<h2>Item a producir: <?php echo $itemaproducir; ?></h2>
	 
		<table id="" class="table table-striped table-bordered">
			<tr>
				<th>Eficiencia Acumulada</th>
				<th>Hora</th>
			</tr>
			<tbody>
				<?php foreach($eficiencias as $eficiencia) { ?>
					<tr>
					<td><?php echo $eficiencia ['eficiencia']; ?></td>
					<td><?php echo $eficiencia ['fechahora']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>