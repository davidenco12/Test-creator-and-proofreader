<?php
session_start();
if(isset($_SESSION["fecha"])){
$preguntas = array(); //array que guardará las preguntas del examen
// $argumentos = array(); //array que guardará los argumentos de las respuestas
$respuestas = array(); //array que guardará las respuestas correctas del examen



// **********GUARDADO DE DATOS**********

//el límite del for,es el numero de preguntas introducidas por el usuario(cookie numPreguntas creada en panel2.php(linea 60)

for ($i=1; $i <= $_COOKIE['numPreguntas'] ; $i++) { 

	// CONTROLO QUE NO ESTAN VACIOS LOS CAMPOS QUE LLEGAN
	if ($_POST['pregunta'.$i] == "" || $_POST['respuesta'.$i] == "") { //si estan vacios
		
		echo "<b>LOS CAMPOS NO PUEDEN ESTAR VACIOS</b><a href='panel1.php'></b><br>"; //muestro mensaje
 		echo "<a href='panel2.php'>Volver atras</a>";								  //boton atras
	}else{
	
		$preguntas[$i] = $_POST['pregunta'.$i];   //guardo preguntas en su array
		$respuestas[$i] = $_POST['respuesta'.$i]; //guardo respuestas en su array

		$_SESSION["preguntas"] = $preguntas;
		$_SESSION["respuestasProfe"] = $respuestas;
		$_SESSION["fecha"];
		$_SESSION["asignatura"];

		header('Location: menu.php');
	}

}




}else{
	echo "NO HAY EXAMEN CREADO CHICO!!!";
}

















?>