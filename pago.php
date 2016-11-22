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

if($_POST["sexo"]==1)
	$genero = "Masculino";
else
	$genero = "Femenino";

$sql = "INSERT INTO travel.cliente(Nombre, Apellidos, Telefono, Email, Sexo, Edad) VALUES ('{$_POST['nombre']}', '{$_POST['apellidos']}','{$_POST['telefono']}', '{$_POST['email']}', '{$genero}', '{$_POST['edad']}');";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pago</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php include('nav.php'); ?>
	<div class="container altodiv">
		<div class="page-header">
			<h1>Forma de pago: </h1>
		</div>
		<form action="final.php" method="POST">
			<div class="form-group">
				<h3>Nombre:</h3>
				<br>
				<input type="text" name="nombre" autofocus="true" class="input-formclien" placeholder="Nombre(s)" required="true">		
			</div>
			<div class="form-group">
				<h3>Apellido(s): </h3>
				<br>
				<input type="text" class="input-formclien" placeholder="Apellido(s)" name="apellidos" required="true">
			</div>
			<div class="form-group">
				<h4>Email: </h4>
				<br>
				<input type="email" class="input-formclien" placeholder="Correo Electronico" name="email" required="true">
			</div>
			<div class="form-group">
				<h3>Numero de la tarjeta:</h3>
				<br>
				<input type="text" name="number" class="input-formclien" placeholder="Numero de tarjeta de credito(XXXXXXXXXXXXXXXX)" pattern="^5[1-5][0-9]{14}$|^4[0-9]{12}(?:[0-9]{3})?$|^3[47][0-9]{13}$" title="Formato incorrecto">
			</div>
			<div class="form-group">
				<h3>Fecha de expiracion:</h3>
				<div class="col-xs-6 col-sm-4 col-lg-6 inline-block">
					<select name="mes" id="mes" class="input-selectclient">
						<?php for ($i=1; $i <= 12; $i++) { 
							echo "<option value='$i'>$i</option>";
						} ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-4 col-lg-6 inline-block">
					<select name="año" id="año" class="input-selectclient">
						<?php for ($i=2015; $i <= 2050; $i++) { 
							echo "<option value='$i'>$i</option>";
						} ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<h3>CVV:</h3>
				<br>
				<input type="text" name="cvv" class="input-formclien" placeholder="Ej. 1234" width="120px;" required="true" pattern="[0-9]{3|4}" title="Formato Incorrecto">
			</div>
			<p>*Los datos no son almacenados</p>
			<input type="submit" value="Confirmar Viaje" class="btn btn-sucess">
		</form>
	</div>
	<?php include('footer.php'); ?>
</body>
</html>