<?php            
	if(isset($_SESSION['login']))		
	{
		echo "	<header id=\"header\">
				
				<a href=\"index.php\" class=\"logo\">Blablasurf</a>
				<nav class=\"right\">
				    <strong>Bonjour ".$_SESSION['login']."      </strong>
					<a href=\"connexion.php\" class=\"button alt\">Déconnexion</a>
				</nav>
				<nav class=\"left\">
					
					<a href=\"annonces.php\" class=\"button alt\">Annonces</a>
				
				</nav>
		
					
				
			</header>";
	}
	else
	{
		echo "	<header id=\"header\">
				
				<a href=\"index.php\" class=\"logo\">Blablasurf</a>
				<nav class=\"right\">
					
					<a href=\"inscription.php\" class=\"button alt\">Inscription</a>
					<a href=\"connexion.php\" class=\"button alt\">Connexion</a>
				
				</nav>
				<nav class=\"left\">
					
					<a href=\"annonces.php\" class=\"button alt\">Annonces</a>
				
				</nav>
		
					
				
			</header>";

	}

?>