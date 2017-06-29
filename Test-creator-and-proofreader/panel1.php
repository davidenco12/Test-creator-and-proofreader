<!DOCTYPE html>
<html>
<head>
	<title>APP EXAMENES</title>
</head>
<body>
<!-- 
***************************
*****DAVID GOMEZ GOMEZ*****
*********29/03/17**********
*************************** 
-->

<!-- Comenzaré con una la pagina principal en html,que mostrará un primer formulario para el profesor -->
<header></header>
<section>
	<article>
		<form action="panel2.php" method="POST" novalidate>
		<fieldset>
    		<legend>
    			<h3>APP EXAMEN-1</h3>
    		</legend>
				<label>Fecha</label><input type="date" name="fecha" required><br>
				<label>Asignatura</label><input type="text" name="asignatura" required><br>
				<label>Nº preguntas</label><input type="number" name="numPreguntas" required><br>
				<input type="submit" name="siguiente" value="Siguiente">
			</fieldset>
		</form>
	</article>
</section>

<footer></footer>
</body>
</html>