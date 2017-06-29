<?php
session_start();
	if(isset($_SESSION["fecha"]) && isset($_SESSION["asignatura"]) && isset($_SESSION["preguntas"]) && isset($_SESSION["respuestasProfe"])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>HACER EXAMEN</title>

	<style type="text/css">
		.vf{
			width:22px;
		}
		table{
			text-align: center;
		}
	</style>
</head>
<body>
<?php 
$examen = unserialize($_COOKIE['examen']); //deserializo para usar el examen y mostrarlo en este archivo
$plantillaCorrecion = unserialize($_COOKIE['plantillaCorrecion']);
?>
<!-- 
	para mostrar el código mas limpio,voy a mostrar "a pelo" fecha ,asignatura,y creare un campo para el alumno
	y solo usaré el for para mostrar las preguntas y la opcion de respuesta
 -->
<form method="POST" action="autoCorrecion.php">


<table border="1">
<tr>
	<td colspan="2"><b>Pregunta<b></td>
	<td><b>V/F</b></td>
</tr>


<?php
$numPreguntas = count($_SESSION["preguntas"]);

// Muestro fecha,asignatura y campo de alumno
echo "<b>Fecha: </b>".$_SESSION["fecha"]."<br>";
echo "<b>Asignatura: </b>".$_SESSION["asignatura"]."<br>";
echo "<label><b>alumno</b></label><input type='text' name='alumno'></input><br><br>";

// MUESTRO LAS PREGUNTAS
for ($i=1; $i <= $numPreguntas ; $i++) {
	
	echo "<tr>
			<td>".$i."</td>
			<td><b>".$_SESSION["preguntas"][$i]."<b></td>
			<td><input class = 'vf' type = 'text' name = 'respuesta".$i."' maxlength = '1'></input></td>
		 </tr>";
}


?>

</table><br>
<input type="submit" name="correguir" value="AutoCorrecion">
<a href='menu.php'>Volver al menu</a>
</form>

<?php
// Mantengo las cookies
setcookie('examen', serialize($examen));
setcookie('plantillaCorrecion', serialize($plantillaCorrecion)); 

 ?>
</body>
</html>
<?php
}else{
	echo "EXAMEN NO CREADO";
}
?>