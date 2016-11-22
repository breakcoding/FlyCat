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

$_SESSION["asientos"] = array();

if(!empty($_POST['asientos'])) {
	foreach($_POST['asientos'] as $check) {
		array_push($_SESSION["asientos"], $check);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Informacion del Cliente</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include('nav.php'); ?>

	<div class="container altodiv">
		<div class="page-header">
			<h1>Informacion del Cliente: </h1>
		</div>
		<form action="pago.php" method="POST">
			<h4>Nombre(s): </h4>
			<br>
			<input type="text" class="input-formclien" placeholder="Nombre(s)" name="nombre">
			<h4>Apellido(s): </h4>
			<br>
			<input type="text" class="input-formclien" placeholder="Apellido(s)" name="apellidos">
			<h4>Telefono: </h4>
			<br>
			<input type="text" class="input-formclien" placeholder="+52(123)4567890" name="telefono" maxlength="15" pattern="[0-9]{10}" title="Ingresa un numero Telefonico">
			<h4>Email: </h4>
			<br>
			<input type="email" class="input-formclien" placeholder="Correo Electronico" name="email">
			<h4>Sexo: </h4>
			<br>
			<select name="sexo" id="sexo" class="input-selectclient">
				<option value="1">Hombre</option>
				<option value="2">Mujer</option>
			</select>
			<h4>Edad: </h4>
			<br>
			<input type="number" class="input-formclien" placeholder="Edad" name="edad" min="1" max="110">			
			<input type="submit" class="btn btn-sucess" value="Confirmar forma de pago">
		</form>
	</div>

	<?php include('footer.php'); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>