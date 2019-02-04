<?php session_start(); 
if(isset($_SESSION['login']))
{ 
 session_unset();
 header('Location: index.php'); exit();
}

?>

<!DOCTYPE HTML>
<?php
/* Indique le bon format des entêtes (par défaut apache risque de les envoyer au standard ISO-8859-1)*/
header('Content-type: text/html; charset=UTF-8');

/* Initialisation de la variable du message de réponse*/
$message = null;

/* Récupération des variables issues du formulaire par la méthode post*/
$mail = filter_input(INPUT_POST, 'mail');
$pass = filter_input(INPUT_POST, 'pass');

/* Si le formulaire est envoyé*/
if (isset($mail,$pass)) 
{
    
    /* Teste que les valeurs ne sont pas vides ou composées uniquement d'espaces */  
    $mail = trim($mail) != '' ? $mail : null;
    $pass = trim($pass) != '' ? $pass : null;
  
  
  /* Si $mail et $pass différents de null */
  if(isset($mail,$pass)) 
  {
    /* Connexion au serveur : dans cet exemple, en local sur le serveur d'évaluation
    A MODIFIER avec vos valeurs */
    $hostname = "localhost";
    $database = "blablasurf";
    $username = "root";
    $password = "";
    
    /* Configuration des options de connexion */
    
    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé) */
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
    
    /* Requête pour récupérer les enregistrements répondant à la clause : champ du pseudo et champ du mdp de la table = pseudo et mdp posté dans le formulaire */
    $requete = "SELECT * FROM membres WHERE mail = :nom AND pass = :password";  
    
    try
    {
      /* Préparation de la requête*/
      $req_prep = $connect->prepare($requete);
      
      /* Exécution de la requête en passant les marqueurs et leur variables associées dans un tableau*/
      $req_prep->execute(array(':nom'=>$mail,':password'=>$pass));
      
      /* Création du tableau du résultat avec fetchAll qui récupère tout le tableau en une seule fois*/
      $resultat = $req_prep->fetchAll(); 
      
      $nb_result = count($resultat);
      
      if ($nb_result == 1)
      {
        /* Démarre une session si aucune n'est déjà existante et enregistre le pseudo dans la variable de session $_SESSION['login'] qui donne au visiteur la possibilité de se connecter.  */
        if (!session_id()) session_start();
        $result = $resultat[0];
        $_SESSION['login'] = $result['pseudo'];
            
        /*$message = 'Bonjour '.htmlspecialchars($_SESSION['login']).', vous êtes connecté';
        /*ou redirection vers une page en cas de succès ex : menu.php*/
        header("Location: index.php");
        
        
        /* Si vous voulez récupérer les données elles se trouvent dans la première et unique ligne du tableau $resultat par exemple */
        /* $result = $resultat[0];
        echo $result['pseudo'];
        echo $result['date_enregistrement'];
        */
      }
      else if ($nb_result > 1)
      {
        /* Par sécurité si plusieurs réponses de la requête mais si la table est bien construite on ne devrait jamais rentrer dans cette condition */
        $message = 'Problème de d\'unicité dans la table';
      }
      else
      {   /* Le pseudo ou le mot de passe sont incorrect */
        $message = 'Le pseudo ou le mot de passe sont incorrect';
      }
    }
    catch (PDOException $e)
    {
      $message = 'Problème dans la requête de sélection';
    }	
  }
  else 
  {/*au moins un des deux champs "pseudo" ou "mot de passe" n'a pas été rempli*/
    $message = 'Les champs Pseudo et Mot de passe doivent être remplis.';
  }
}
?>

<html>
	<head>
		<title>Connexion | Blablasurf</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php include('header.php'); ?>

		<?php include('menu.php'); ?>	
		<section class="wrapper">
		<center><h2>Renseignez vos identifiants</h2></center>
		<div class="inner">
		<form id="ConnectForm" action="" method="post">
		<input class="text" id="mail" type="text" name="mail" value="" placeholder="E-mail"/>
		<input class="text" id="pass" type="password" name="pass" value="" placeholder="Mot de passe"/><br/>
		<input id="remember" type="checkbox" name="remember" /><label for="remember">Se souvenir de moi</label> <!--il faut utiliser les cookies-->
		<a href=""><legend>Mot de passe oublié ?</legend></a>
		
		<center><p><input type="submit" value="Envoyer" id = "valider" /> </p></center>
    <legend>Pas encore membre ? <a href="inscription.php">Inscrivez-vous</a></legend>
		</form>
	    <p id = "message"><?= $message?:'' ?></p>
	</div></section>	
	</body>
</html>