<?php
session_start();
//Variables de busqueda
$_SESSION["origen"]=$_POST["origen"];
$_SESSION["destino"]=$_POST["destino"];
$_SESSION["fecha_salida"]=date('Y-m-d', strtotime($_POST['fecha_salida'])); //$_POST["fecha_salida"];
$_SESSION["fecha_regreso"]=date('Y-m-d', strtotime($_POST['fecha_regreso'])); // $_POST["fecha_regreso"];
$_SESSION["clase"]=$_POST["clase"];
$_SESSION["adultos"]=$_POST["num_adultos"];
$_SESSION["niños"]=$_POST["num_niños"];
$tot2 = 0;

$servername = "localhost";
$username = "root";
$password = "travel123";

// Realizar la coneccion
$conn = new mysqli($servername, $username, $password);

// Verificar la coneccion
if ($conn->connect_error) {
	$message = die("Coneccion Fallida" . $conn->connect_error);
} 
$message = "Coneccion Exitosa";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Precios</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include('nav.php'); ?>
	
	<div class="container altodiv">
		<div class="col-lg-10">
			<div class="page-header">
				<h1>Precio: </h1>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-4">
					<img src="./images/pricing.png" class="img-pricing" alt="">
					<h1>Fecha de Salida: </h1>
					<?php echo $_SESSION["fecha_salida"]; ?>
					<?php if($_SESSION["fecha_regreso"]!="1970-01-01"): ?>
						<h1>Fecha de Regreso: </h1>
						<?php echo $_SESSION["fecha_regreso"]; ?>
					<?php endif ?>	
					<h1>Clase: </h1>
					<?php if($_SESSION["clase"]=="1"): ?>
						<?php echo "Economica"; ?>
					<?php endif ?>
					<?php if($_SESSION["clase"]=="2"): ?>
						<?php echo "Empresarial"; ?>
					<?php endif ?>
					<h1>Adultos: </h1>
					<?php echo $_SESSION["adultos"]; ?>
					<?php if($_SESSION["niños"]!="0"): ?>
						<h1>Niños: </h1>
						<?php echo $_SESSION["niños"]; ?>
					<?php endif ?>
				</div>
				<div class="col-lg-8">
					<?php
					$sql = "SELECT * FROM travel.vuelo v INNER JOIN travel.destino D INNER JOIN travel.origen O WHERE v.idDest = D.id AND v.idOrigen = O.id AND v.idOrigen = ".$_SESSION["origen"]." AND v.idDest =".$_SESSION["destino"]." LIMIT 1;";
					$result = $conn->query($sql);

					echo "<h1>Viaje de Ida:</h1>";
					if ($result->num_rows > 0) {
    				// output data of each row
						while($row = $result->fetch_assoc()) {
							$_SESSION["idVueloIda"] = $row["idV"];
							if($_SESSION["clase"]=="1")
								$total = $row["porcPrecio"]/100*500;
							else
								$total = $row["porcPrecio"]/100*700;
							$totalPer = $_SESSION["adultos"]+$_SESSION["niños"];
							echo "<strong>Nombre del Aeropuerto Origen: </strong>" . $row["nomAeroO"]."<br>";
							echo "<strong>Nombre de Ciudad Origen: </strong>" . $row["nomCiudO"]."<br>";
							echo "<strong>Hora de Salida: </strong>".$row["hraSalida"]." hrs.<br>";
							echo "<strong>Nombre del Aeropuerto Destino: </strong>".$row["nomAeroD"]."<br>";
							echo "<strong>Nombre de Ciudad Destino: </strong>" . $row["nomCiudD"]."<br>";
							echo "<strong>Hora de Salida: </strong>".$row["hraLlegada"]." hrs<br>";
							echo "<h4>Precio Neto: $".$total."</h4>";
							echo "<h4>Impuestos(16%): $".$total*$totalPer*0.16."</h4>";
							echo "<h1>Precio Total: $".$total*$totalPer*1.16."</h1>";
							$tot1 = $total*$totalPer*1.16;
						}
					} else {
						echo "No hay resultados";
					}
					if($_SESSION["fecha_regreso"]!="1970-01-01") {
						$sql = "SELECT * FROM travel.vuelo v INNER JOIN travel.destino D INNER JOIN travel.origen O WHERE v.idDest = D.id AND v.idOrigen = O.id AND v.idOrigen = ".$_SESSION["destino"]." AND v.idDest =".$_SESSION["origen"]." LIMIT 1;";
						$result = $conn->query($sql);

						echo "<div class='linea'></div>";

						echo "<h1>Viaje de Regreso:</h1>";
						if ($result->num_rows > 0) {
    					// output data of each row
							while($row = $result->fetch_assoc()) {
								$_SESSION["idVueloVuelta"] = $row["idV"];
								if($_SESSION["clase"]=="1")
									$total = $row["porcPrecio"]/100*500;
								else
									$total = $row["porcPrecio"]/100*700;
								$totalPer = $_SESSION["adultos"]+$_SESSION["niños"];
								echo "<strong>Nombre del Aeropuerto Origen: </strong>" . $row["nomAeroO"]."<br>";
								echo "<strong>Nombre de Ciudad Origen: </strong>" . $row["nomCiudO"]."<br>";
								echo "<strong>Hora de Salida: </strong>".$row["hraSalida"]." hrs.<br>";
								echo "<strong>Nombre del Aeropuerto Destino: </strong>".$row["nomAeroD"]."<br>";
								echo "<strong>Nombre de Ciudad Destino: </strong>" . $row["nomCiudD"]."<br>";
								echo "<strong>Hora de Salida: </strong>".$row["hraLlegada"]." hrs<br>";
								echo "<h4>Precio Neto: $".$total."</h4>";
								echo "<h4>Impuestos(16%): $".$total*$totalPer*0.16."</h4>";
								echo "<h1>Precio Total: $".$total*$totalPer*1.16."</h1>";
								$tot2 = $total*$totalPer*1.16;
							}
						} else {
							echo "No hay resultados";
						}
					}					
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-2" style="padding: 100px 0px;">
			<?php 
				$totViaje = $tot1 + $tot2;
				$_SESSION["precioT"] = $totViaje;
				echo "<h1>Total del Viaje: ".$totViaje."</h1>";
				echo "<br>";
			 ?>
			<form action="asientos.php">
				<input type="submit" value="Seleccionar Asientos" class="btn btn-info">
			</form>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>