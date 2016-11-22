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
	<div class="container">
		<?php 
		$sql = "SELECT * FROM travel.asiento WHERE vuelo_id = ".$_SESSION["idVueloIda"].";";
		$asientos = array();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($asientos, $row["numAsiento"]);
			}
		} else {
			"No hay resultados";
		}
		?>
		<div class="page-header">
			<h1>Seleccion de Asientos</h1>
		</div>
		<div class="col-lg-12">
			<?php 
			echo "<h3>Cantidad de asientos a seleccionar: </h3>";
			echo $_SESSION["adultos"]+$_SESSION["niños"];
			?>
		</div>
		<form action="cliente.php" method="POST">
			<table border="1" width="100%" onchange="check()" id="seleccion">
				<tr>
					<td colspan="2">Premium</td>	
					<td colspan="28">Economica</td>		
				</tr>
				<?php 
				for ($i=1; $i <= 3; $i++) { 
					echo "<tr>";
					for ($j=1; $j <= 30; $j++) { 
						echo "<td><input type='checkbox' name='asientos[]' value='$i$j'><a data-toggle='tooltip' title='Fila: $i Columna: $j'><img src='./images/disponible.png'></a></td>";
					}
					echo "</tr>";
				}
				?>					
				<tr>
					<td colspan="30">Pasillo</td>			
				</tr>
				<?php 
				for ($i=4; $i <= 6; $i++) { 
					echo "<tr>";
					for ($j=1; $j <= 30; $j++) { 

						echo "<td><input type='checkbox' name='asientos[]' value='$i$j'><a href='#' data-toggle='tooltip' title='Fila: $i Columna: $j'><img src='./images/disponible.png'></a></td>";
					}
					echo "</tr>";
				}
				?>					
				<tr>
					<td colspan="2">Premium</td>	
					<td colspan="28">Economica</td>		
				</tr>
			</table>
			<div class="col-lg-6">
				<input type="button" onclick="reset()" value="Volver a Intentar">
			</div>
			<div class="col-lg-6">
				<input type="submit" value="Siguiente" class="btn btn-success" id="sub" disabled="true">
			</div>
		</form>
	</div>

	<?php include('footer.php'); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		function check() {
		<?php echo 'var numAdult = ' . json_encode($_SESSION["adultos"]) . ';'; ?>	
		<?php echo 'var numNiños = ' . json_encode($_SESSION["niños"]) . ';'; ?>
		<?php echo 'var ocupados = '.json_encode($asientos).';'; ?>
		var total = document.querySelectorAll('input[type="checkbox"]:checked').length - ocupados.length;		
		if (total == parseInt(numAdult)+parseInt(numNiños)) {				
			var inputs=document.getElementById("seleccion").getElementsByTagName('input');
			for(var i=0; i<inputs.length; ++i)
				if(inputs[i].checked != true){
					inputs[i].disabled=true;
					document.getElementById("sub").disabled = false;
				}					
			}
		else{
			var inputs=document.getElementById("seleccion").getElementsByTagName('input');
			for(var i=0; i<inputs.length; ++i)
				if(inputs[i].checked != true){
					inputs[i].disabled=false;
					document.getElementById("sub").disabled = true;
				}
			}
		}
		function reset() {
			var inputs=document.getElementById("seleccion").getElementsByTagName('input');
			for(var i=0; i<inputs.length; ++i){
				inputs[i].disabled=false;
				inputs[i].checked=false;
			}
		}

		function cant() {
			<?php echo 'var ocupados = '.json_encode($asientos).';'; ?>
			var inputs=document.getElementById("seleccion").getElementsByTagName('input');
			for(var i=0; i<inputs.length; ++i){
				for (var j = 0; j < ocupados.length; j++) {
					if(inputs[i].value==ocupados[j]){
						inputs[i].disabled = true;
						inputs[i].checked = true;
						document.getElementsByTagName('img')[i].src = './images/ocupado.png';
					}
				}
			}
		}

		function clase() {
			<?php echo 'var clase = '.json_encode($_SESSION["clase"]).';'; ?>
			var inputs=document.getElementById("seleccion").getElementsByTagName('input');
			if(clase == 2){
				for (var i = 1; i <= 6; i++) {
					for (var j = 3; j <= 30; j++) {
						for (var n = 0; n < inputs.length; n++)
							if(inputs[n].value == parseInt(i+""+j) )
								inputs[n].disabled = true;
						}
					}
				}
			if(clase == 1){
				for (var i = 1; i <= 6; i++) {
					for (var j = 1; j <= 2; j++) {
						for (var n = 0; n < inputs.length; n++)
							if(inputs[n].value == parseInt(i+""+j) )
								inputs[n].disabled = true;
						}
					}
				}
			}
		window.addEventListener('load',reset);
		window.addEventListener('load',cant);
		window.addEventListener('load',clase);
		window.addEventListener('change',clase);		
	</script>	
	</body>
	</html>