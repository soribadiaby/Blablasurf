<!DOCTYPE HTML>
<html>
	<head>
		<title>Proposer un trajet | Blablasurf</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php include('header.php'); ?>

		<?php include('menu.php'); ?>	
		<section class="wrapper">
		<center><h2>Publier une annonce</h2></center>
		<div class="inner">
		<form id="AddForm" action="publication.php" method="post">
		<br/>
		<input class="text" id="depart" type="text" name="depart" value="" placeholder="Départ"/>
		<br>
		<input class="text" id="arrivee" type="text" name="arrivee" value="" placeholder="Arrivée"/>
		<br/>
		<label for="date">Date et heure : </label><input id="date" type="datetime-local" name="date" value="<?php echo date('Y-m-d\TH:i:s'); ?>"/>
		<br/>
		<label for="price">Prix par passager : </label>
		<input class="text" id="price" type="float" name="price" value="0" size="3"/><span>€</span>
		<br/>
		<label for="places">Nombre de places proposées</label><select name="places" style="width: 50px;"> 
		<option>1
		<option>2
		<option>3
		<option>4</select>
		<br/>
		<label for="planches">Nombre de planches proposées</label><select name="planches" style="width: 50px;"> 
		<option>1
		<option>2
		<option>3
		<option>4</select>
		<br/>		
		<input value="Ajouter" type="submit">
		</form></div></section>
		<?php include('footer.php'); ?>		
	</body>
	
</html>