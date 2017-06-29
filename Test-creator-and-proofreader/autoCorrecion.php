<?php
session_start();
	if(isset($_SESSION["fecha"]) && isset($_SESSION["asignatura"]) && isset($_SESSION["preguntas"]) && isset($_SESSION["respuestasProfe"])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>AUTOCORRECION</title>

	<style type="text/css">
		.nota{
			background-color: black;
			color: white;
		}
	</style>
</head>
<body>



<?php 


 //En este archivo,lo que haremos será,deserializar plantillaCorrecion y la respuesta del alumno

$alumno = $_POST['alumno'];

$examen = array();
$examen['fecha'] = $_SESSION["fecha"];
$examen['asignatura'] = $_SESSION["asignatura"];
$examen['preguntas'] = $_SESSION["preguntas"];

 
$examenAlumno = array(); //array donde guardo el examen hecho por el alumno
$examenAlumno['fecha'] = $_SESSION["fecha"];
$examenAlumno['asignatura'] = $_SESSION["asignatura"];
$examenAlumno['alumno'] = $alumno;

$plantillaCorrecion = array();
$plantillaCorrecion['fecha'] = $_SESSION["fecha"];
$plantillaCorrecion['asignatura'] = $_SESSION["asignatura"];
$plantillaCorrecion['respuestas'] = $_SESSION["respuestasProfe"];

 
$numPreguntasExamen = count($_SESSION["preguntas"]); //numero de preguntas que hay en el array examen

 
 $respuestasExamenAlumno = array();//array donde guardo las respuestas,que posteriormente guardare en $examenAlumno 
 $examenCorreguido = array(); //array donde guardo el examen hecho por el alumno y num aciertos,errores y no contestadas


 $numPreguntas = $_COOKIE['numPreguntas']; //numero de preguntas introducidas al crear el examen en panel1.php
 $alumno = $_POST['alumno']; // guardo el nombre del alumno


// GUARDO LAS RESPUESTAS DEL ALUMNO (SOLO LAS CONTESTADAS)


	 for ($i=1; $i <= $numPreguntas ; $i++) {//si no esta vacia la respuesta
	 		$respuestasExamenAlumno[$i] = $_POST['respuesta'.$i]; //guardo la respuesta
	 	
	 }

// Una vez finalizado el for,paso el array con las respuestas al $examenAlumno
	 $examenAlumno['respuestas'] = $respuestasExamenAlumno;

// comienzo la autoCorrecion recorriendo el numero de preguntas,y comparando las respuestas del alumno,con las de la plantilla de correcion

	 // creo los contadores de aciertos y errores

		$aciertos = 0;
		$errores = 0;
		$nc = 0;
	/* creo el de puntuacion
		acierto +1
		error -1
	*/
		 for ($i=1; $i <= $numPreguntasExamen ; $i++){ 
		 	 // NO CONTESTADA
		 	if ($examenAlumno['respuestas'][$i] == "") {
		 		$nc++;
		 	}
		 	// ACIERTO
		 	if ($examenAlumno['respuestas'][$i] == $plantillaCorrecion['respuestas'][$i]) { //acierto
		 	  	$aciertos++;
		 	} 
		 	// ERROR
		 	if ($examenAlumno['respuestas'][$i] != $plantillaCorrecion['respuestas'][$i]) { //acierto
		 	  	$errores++;
		 	}

		}
 // calculo la nota 
$nota = $aciertos - $errores;



// una vez corregido el examen 
//guardo toda la informacion en $examenCorregido

 $examenCorreguido['fecha'] = $examen['fecha']; //guardo fecha
 $examenCorreguido['asignatura'] = $examen['asignatura']; //guardo asignatura
 $examenCorreguido['alumno'] = $alumno; //guardo alumno
 $examenCorreguido['respuestas'] = $respuestasExamenAlumno; //guardo respuestas
 $examenCorreguido['aciertos'] = $aciertos; //guardo aciertos
 $examenCorreguido['errores'] = $errores; //guardo errores
 $examenCorreguido['nc'] = $aciertos; //guardo no contestadas
 $examenCorreguido['nota'] = $nota; //guardo nota final

 $puntuacion = 0; //control para mostrar la puntuacion de cada pregunta
 
 /* MUESTRO LOS DATOS DE LA AUTOCORRECION CON ESTA ESTRUCTURA
 	-FECHA
 	-ASIGNATURA
 	-ALUMNO
	-NUMERO PREGUNTA
	-ENUNCIADO
	-COMPRUEBO SI EXISTE CLAVE PARA SABER SI ESTA RESPONDIDA O NO
		SI NO EXISTE(muestro mensaje de no respondido)
		SI EXISTE(compruebo las respuestas,si esta BIEN,no mostrare la respuesta correcta(solo la del alumno),si esta mal,la mostraré)
	-MUESTRO PUNTUACION
	-MUESTRO UN RESUMEN CON EL RESULTADO DEL EXAMEN


 */
 echo "<b>Fecha: </b>" .$examenAlumno['fecha']."<br>";
 echo "<b>Asignatura: </b>" .$examenAlumno['asignatura']."<br>";
 echo "<b>Alumno: </b>" .$examenAlumno['alumno']."<br>";

echo "<fieldset>";
echo "<legend><b>RESULTADO AUTOCORRECION</b></legend>";
 for ($i=1; $i <= $numPreguntasExamen ; $i++) { 
 	echo "<b>Pregunta numero".$i."</b><br>";
 	echo "¿".$examen['preguntas'][$i]."?<br>";
 	if($examenAlumno['respuestas'][$i] == ""){
 		$puntuacion =0;
 		echo "NO LAS HAS RESPONDIDO<br>";
 		echo "Tu puntuacion es esta pregunta es de " .$puntuacion."<br>";
 	}else{
 		if($examenAlumno['respuestas'][$i] == $plantillaCorrecion['respuestas'][$i]){
 			$puntuacion = 1;
 			echo "Has respondido " .$examenAlumno['respuestas'][$i]."--<b><font color='green'>ACIERTO</font></b><br>";
 			echo "Tu puntuacion es esta pregunta es de " .$puntuacion."<br>";
 		}else{
 			$puntuacion = -1;
 			echo "Has respondido " .$examenAlumno['respuestas'][$i]."<br>";
 			echo "Y la respuesta correcta es " .$plantillaCorrecion['respuestas'][$i]."--<b><font color='red'>ERROR</font></b><br>";
 			echo "Tu puntuacion es esta pregunta es de " .$puntuacion."<br>";
 		}
 		
 	}
 }
echo "<hr>";

 echo "<table border = '1'>
 		  <tr>
 		  <td colspan='2'><b>RESUMEN CORRECION</b></td>
 		  </tr>
 		  <tr>
 			<td><b><font color='green'>ACIERTOS</font></b></td>
 			<td>".$aciertos."</td>
 		  </tr>
 		  <tr>
 			<td><b><font color='red'>ERRORES</font></b></td>
 			<td>".$errores."</td>
 		  </tr>
 		  <tr>
 			<td><b><font color='blue'>NO CONTESTADAS</font></b></td>
 			<td>".$nc."</td>
 		  </tr>
       </table>";
echo "</fieldset>";
?>
<a href="index.php">Volver al menu</a>
<?php  


echo "<b>***********EXAMEN**********</b>";
foreach ($examen as $key => $value) {
	if(is_array($value)){
		foreach ($value as $enunciado) {
			echo "<br>" .$enunciado;
		}
	}else{
		echo "<br><b>".$key."</b>: " .$value;
	}
}
echo "<br><b>***********RESPUESTAS DEL ALUMNO**********</b>";
foreach ($examenAlumno as $key => $value) {
	if(is_array($value)){
		foreach ($value as $enunciado) {
			echo "<br>" .$enunciado;
		}
	}else{
		echo "<br><b>".$key."</b>: " .$value;
	}
}

echo "<br><b>***********RESPUESTAS CORRECTAS**********</b>";
foreach ($plantillaCorrecion as $key => $value) {
	if(is_array($value)){
		foreach ($value as $enunciado) {
			echo "<br>" .$enunciado;
		}
	}else{
		echo "<br><b>".$key."</b>: " .$value;
	}
}

 ?>


</body>
</html>
<?php
}else{
	echo "EXAMEN NO CREADO";
}
?>