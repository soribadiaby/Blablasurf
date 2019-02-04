<?php session_start(); ?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>Trouver un trajet | Blablasurf</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php include('header.php'); ?>

		<?php include('menu.php'); ?>	
		<section class="wrapper">
		<center><h2>Trouver un trajet</h2></center>
		<div class="inner">
		<form id="SearchForm" action="annonces.php" method="post">
		<input class="text" id="depart" type="text" name="depart" value="" placeholder="Départ"/>
		<input class="text" id="arrivee" type="text" name="arrivee" value="" placeholder="Arrivée"/><br/>
		<p><label for="date">Date et heure</label><input id="date" type="datetime-local" name="date" value="<?php echo date('Y-m-d\TH:i:s'); ?>"/></p>
		<label for="planches">Nombre de planches transportées</label><select name="planches" style="width: 50px;"> 
		<option>1
		<option>2
		<option>3
		<option>4</select>
		<br/>
		<input type="hidden" name="search1" id="search1" />
		<center><input id="search" value="Rechercher" type="submit"></center>
		</form></div></section>
		<?php include('footer.php'); ?>		
	</body>
</html>