<!DOCTYPE HTML>
<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/
header('Content-type: text/html; charset=UTF-8');

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$pseudo = filter_input(INPUT_POST, 'pseudo');
$pass = filter_input(INPUT_POST, 'pass');
$mail = filter_input(INPUT_POST, 'mail');
$phone = filter_input(INPUT_POST, 'phone');
$conditions= filter_input(INPUT_POST, 'acceptTerms'); 

/* Si le formulaire est envoyé */
if (isset($pseudo,$pass,$mail,$phone,$conditions)) 
{   

    /* Teste que les valeurs ne sont pas vides ou composées uniquement d'espaces  */ 
    $pseudo = trim($pseudo) != '' ? $pseudo : null;
    $pass = trim($pass) != '' ? $pass : null;
    $mail =trim($mail) != '' ? $mail : null;
    $phone =trim($phone) != '' ? $phone : null;
   

    /* Si $pseudo et $pass différents de null */
    if(isset($pseudo,$pass,$mail,$phone)) 
    {
    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation
    A MODIFIER avec vos valeurs */
    $hostname = "localhost";
    $database = "blablasurf";
    $username = "root";
    $password = "";
    
    /* Configuration des options de connexion */
    
    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
    
    /* Active le mode exception */
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    /* Indique le charset */
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
    
    /* Connexion */
    try
    {
      $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
    }
    catch (PDOException $e)
    {
      exit('problème de connexion à la base');
    }
        
    
    /* Requête pour compter le nombre d'enregistrements répondant à la clause : champ du pseudo de la table = pseudo posté dans le formulaire */
    $requete = "SELECT count(*) FROM membres WHERE pseudo = ?";
    
    try
    {
      /* préparation de la requête*/
      $req_prep = $connect->prepare($requete);
      
      /* Exécution de la requête en passant la position du marqueur et sa variable associée dans un tableau*/
      $req_prep->execute(array(0=>$pseudo));
      
      /* Récupération du résultat */
      $resultat = $req_prep->fetchColumn();
      
      if ($resultat == 0)
      /* Résultat du comptage = 0 pour ce pseudo, on peut donc l'enregistrer */
      {
        /* Pour enregistrer la date actuelle (date/heure/minutes/secondes) on peut utiliser directement la fonction mysql : NOW()*/
        $insertion = "INSERT INTO membres(pseudo,pass,date_enregistrement,mail,phone) VALUES(:nom, :password, NOW(), :mail, :phone)";
        
        /* préparation de l'insertion */
        $insert_prep = $connect->prepare($insertion);
        
        /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
        $inser_exec = $insert_prep->execute(array(':nom'=>$pseudo,':password'=>$pass, ':mail'=>$mail, ':phone'=>$phone));
        
        /* Si l'insertion s'est faite correctement...*/
        if ($inser_exec === true) 
        {
          /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
          if (!session_id()) session_start();
          $_SESSION['login'] = $pseudo;
          
          /* A MODIFIER Remplacer le '#' par l'adresse de votre page de destination, sinon ce lien indique la page actuelle.*/
          
          /*ou redirection vers une page en cas de succès ex : menu.php*/
          header("Location: index.php");
            exit(); 
        }   
      }
      else
      {   /* Le pseudo est déjà utilisé */
        $message = 'Ce pseudo est déjà utilisé, changez-le.';
      }
    }
    catch (PDOException $e)
    {
      $message = 'Problème dans la requête d\'insertion';
    }	
  }
  else 
  {    /* Au moins un des deux champs "pseudo" ou "mot de passe" n'a pas été rempli*/
    $message = 'Les champs doivent être remplis.';
  }
}
?>
<!doctype html>

<html>
	<head>
		<title>S'inscrire sur Blablasurf | Blablasurf</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />

	</head>
	<body>
		<?php include('header.php'); ?>

		<?php include('menu.php'); ?>	
		<section class="wrapper">
		<center><h2>Je crée mon compte</h2></center>
		<div class="inner">
		<form id="RegisterUserForm" action="#" method="post">
		<label for="name">Pseudo : </label> <input class="text" id="pseudo" type="text" name="pseudo" value="" style="height: 30px;" />
		<label for="tel">Téléphone : </label> <input class="text" id="phone" type="tel" name="phone" value="" style="height: 30px;"/>
		<label for="email">E-mail : </label> <input class="text" id="mail" type="email" name="mail" value="" style="height: 30px;"/>
		<label for="pass">Mot de passe : </label> <input class="text" id="pass" type="password" name="pass" style="height: 30px;"/>
		<br>
		<p><input id="acceptTerms" type="checkbox" name="acceptTerms" required />
		 <label for="acceptTerms"> J'accepte les <a>Conditions générales</a> et la <a>Politique de confidentialité</a> </label></p>
		 
		<center><p><input type = "submit" value = "Envoyer" id = "valider" /></p></center>
		</form></div>
		<strong><p id = "message" style="color: red;"><?= $message?:'' ?></p></strong>	
	</section>
		
	</body>
</body>
</html>

