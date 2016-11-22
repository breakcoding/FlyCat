<?php 
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
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gatos en el Aire</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include('nav.php'); ?>

	<div class="row">
		<div class="col-sm-6 col-lg-4 area">
			<form action="precios.php" method="post" name="registro">
				<h3>Buscar vuelo:</h3>
				<label for="">Origen:</label>
				<br>
				<select name="origen" id="origen" class="input-select">
					<?php 
					$res=$conn->query("select * from travel.origen;");
					while($row=$res->fetch_assoc())
						echo"<option value=".$row['id'].">".$row['nomCiudO']."</option>";
					?>
				</select>					
				<label for="">Destino:</label>
				<br>
				<select name="destino" id="destino" class="input-select">
					<?php 
					$res=$conn->query("select * from travel.destino;");
					while($row=$res->fetch_assoc())
						echo"<option value=".$row['id'].">".$row['nomCiudD']."</option>";
					?>
				</select>				
				<label for="">Salida:</label>
				<br>
				<input type="date" name="fecha_salida" class="input-date" placeholder="Fecha de Salida" required="true">
				<br>
				<label for="">Regreso:</label>
				<br>
				<input type="date" name="fecha_regreso" class="input-date" placeholder="Fecha de Regreso">
				<br>
				<label for="">Clase:</label>
				<br>
				<select name="clase" id="country" class="input-select" placeholder="Selecciona tu clase">
					<option value="1">Economica</option>
					<option value="2">Empresiaral</option> 
				</select>
				<br>
				<label for="">Adultos(+18 años):</label>
				<br>
				<select name="num_adultos" id="adultos" class="input-select" placeholder="Selecciona tu clase">
					<option value="1">1</option>
					<option value="2">2</option>         
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<br>
				<label for="">Niños(1-17 años):</label>
				<br>
				<select name="num_niños" id="niños" class="input-select" placeholder="Selecciona tu clase">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>         
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<br>
				<input type="submit" value="Buscar" class="input-button" onclick="cambiar()">
			</form>
		</div>
		<div class="col-sm-6 col-lg-8" style="padding: 0px;">
			<div class="carousel slide" data-ride="carousel" data-interval="3000">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="images/banner/1.jpg" class="img-responsive">
						<div class="carousel-caption">
							<h1>Los Angeles, California</h1>
						</div>
					</div>
					<div class="item">
						<img src="images/banner/2.jpg" class="img-responsive">
						<div class="carousel-caption">
							<h1>Toronto, Canada</h1>
						</div>
					</div>
					<div class="item">
						<img src="images/banner/3.jpg" class="img-responsive">
						<div class="carousel-caption">
							<h1>Sydney, Australia</h1>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 text-center">
			<h1 style="font-size: 54px;">"Planea de la mejor manera tu viaje con los mejores"</h1>
		</div>		
	</div>

	<div class="container" style="padding: 45px;">
		<div class="col-lg-4" align="center">
			<img src="images/price.png" alt="" width="100" height="100">
			<p>Tenemos los mejores precios, comparados con la competencia. Descuentos para alumnos o egresados del ITL.</p>
		</div>
		<div class="col-lg-4" align="center">
			<img src="images/maleta.png" alt="" width="100" height="100">
			<p>Ayudanos a crecer y ofrecer un mejor servicio, con tus recomendaciones, hablando sobre este servicio con tus amigos mas cercanos. Buscamos ser los mejores dentro de las aerolineas de Mexico. Y en un futuro interncionalmente.</p>
		</div>
		<div class="col-lg-4" align="center">
			<img src="images/place.png" alt="" width="100" height="100">
			<p>Te recomendaremos lugares que nuestros propios usuarios visitaron y por parte de nosotros, que tambien utilizamos nuestro servicio para conocer el mundo!</p>
		</div>
	</div>

	<?php include('footer.php'); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		function cambiar() {
			var origen=document.getElementById("origen");
			var ori = origen.options[origen.selectedIndex].value;
			var destino=document.getElementById("destino");
			var des = destino.options[destino.selectedIndex].value;
			if(ori == des)
				alert("Cambiar origen o destino ya que son el mismo");
		}
	</script>
</body>
</html>