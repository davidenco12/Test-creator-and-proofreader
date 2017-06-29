
<!DOCTYPE html>
<html>
<head>
	<title>APP EXAMENES</title>
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
session_start();

// Si en panel1.php el usuario ha introducido bien los datos,pasaremos a un formulario en el que nos mostrará tantos campos para escribir enunciados,como numero de preguntas haya introducido el usuario


$siguiente = $_POST['siguiente']; //capturo el clic 
$fecha = $_POST['fecha'];		  //capturo fecha
$asignatura = $_POST['asignatura']; //capturo asignatura
$numPreguntas = $_POST['numPreguntas']; //capturo preguntas



 if(isset($siguiente) && $fecha == "" || $asignatura=="" || $numPreguntas ==""){ //controlo el clic y que los campos no vengan vacíos


 	echo "<b>LOS CAMPOS NO PUEDEN ESTAR VACIOS</b>";
 	echo "<a href='index.php'>Volver atras</a>";


 }else{

 	$examen = array(); //creo un array,que va a contener los datos del examen(fecha,materia y preguntas)

 	// si todo esta correcto en la primera parte del formulario de creacion del examen,comienzo a guardar los datos(fecha y materia)
 	// $examen["fecha"] = $fecha; //guardo fecha
 	// $examen["asignatura"] = $asignatura; //guardo asignatura

	//a continuacion,los datos guardaddos hasta ahora del examen,los guardo en una cookie,y lo serializo,para utilizarlo más adelante 
 	// setcookie('examen', serialize($examen));
 	$_SESSION["fecha"] = $fecha;
 	$_SESSION["asignatura"] = $asignatura;
 ?>
 
<form action="finExamen.php" method="POST">
	<fieldset>
    		<legend>
    			<h3>Escriba los enunciados del examen</h3>
    		</legend>
    			<table border="1">
    			<tr>
    				<td colspan="2"><b>Enunciado</b></td>
    				<td><b>V/F</b></td>
    				<!-- <td>Argumentacion</td> -->
    			</tr>
<?php
				for ($i=1; $i <= $numPreguntas; $i++) { 
					echo "<tr>
							<td><label>".$i."</label></td>
							<td><input type = 'text' name = 'pregunta".$i."' placeholder='escriba el enunciado'></input></td>
							<td><input class ='vf' type = 'text' name = 'respuesta".$i."' maxlength = '1'></input></td>
						 </tr>";
				}


			
setcookie('numPreguntas', $numPreguntas); //guardo el numero de preguntas en una cookie para usarlo más adelante
 
} //fin de control del clic

?>
</table><br>
<input type='submit' value='Crear Examen'>
<a href="index.php">Volver atras</a>
</fieldset>
</form>

</body>
</html>