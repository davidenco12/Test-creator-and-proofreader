<?php
session_start();
	if(isset($_SESSION["fecha"]) && isset($_SESSION["asignatura"]) && isset($_SESSION["preguntas"]) && isset($_SESSION["respuestasProfe"])){
?>
	





<!DOCTYPE html>
<html>
<head>
	<title>MENU USUARIO</title>
</head>
<body>
<form method="POST">
	<fieldset>
		<legend>¿Que desea hacer?</legend>

		<input type="submit" name="crearExamen" value="Crear examen">
		<input type="submit" name="hacerExamen" value="Hacer el examen">
	</fieldset>
</form>
<?php 

 $examen = unserialize($_COOKIE['examen']);
 setcookie('examen', serialize($examen));

@$crearExamen=$_POST['crearExamen'];	//pulsar crear examen
@$hacerExamen=$_POST['hacerExamen'];    //pulsa hacer examen

// si el usuario pulsa crear examen,lo redirecciono al primer fdormulario para crear este
if(isset($crearExamen)){ 
	header('Location: panel1.php');
}

if(isset($hacerExamen)){ 
	header('Location: hacerExamen.php');
}


 ?>
</body>
</html>
<?php
}else{
	echo "EXAMEN NO CREADO";
}
?>