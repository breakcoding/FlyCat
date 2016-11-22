<?php 
session_start();
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
for ($i=0; $i < $_SESSION["adultos"]+$_SESSION["niños"] ; $i++) { 
	$sql = "INSERT INTO travel.asiento(numAsiento, clase, vuelo_id) VALUES ('{$_SESSION['asientos'][$i]}', '{$_SESSION['clase']}','{$_SESSION['idVueloIda']}');";
	$result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>	
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include('nav.php'); ?>
	<div class="container altodiv">
		<div class="page-header">
			<h1>Final de la Compra: </h1>
		</div>
		<h1>Felicidades! Completaste tu compra para tu viaje de: </h1>
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1>Origen: </h1>
				<div class="carousel slide" data-ride="carousel" >
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<?php
							$res=$conn->query("select * from travel.origen WHERE id = ".$_SESSION["origen"].";");		
							$row=$res->fetch_assoc();				
							print "<img src=".$row["imgUrlO"]." class='img-precio'>"
							?>
							<div class="carousel-caption">
								<?php 
								echo "<h1>".$row["nomCiudO"]."</h1>" ; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<h1>Destino: </h1>
				<div class="carousel slide" data-ride="carousel" >
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<?php
							$res=$conn->query("select * from travel.destino WHERE id = ".$_SESSION["destino"].";");
							$row=$res->fetch_assoc();				
							print "<img src=".$row["imgUrlD"]." class='img-precio'>" 
							?>
							<div class="carousel-caption">
								<?php 
								echo "<h1>".$row["nomCiudD"]."</h1>" ; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php include('footer.php'); ?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script type="text/javascript">
        var pdf = new jsPDF();
        pdf.text(30, 30, 'Hello world!');
        //pdf.save('hello_world.pdf');
    </script>
</body>
</html>