<?php session_start(); ?> 
<!DOCTYPE HTML>
<html>
	<head>
		<title>S'inscrire sur Blablasurf | Blablasurf</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php include('header.php'); ?><br/>
		<?php
        if(isset($_SESSION['login']))
        {
        $User_ID=$_SESSION['login'];
        $Lieu_Depart = $_POST['depart'];
        $Lieu_Arrivee = $_POST['arrivee'];
        $Heure_Depart = $_POST['date'];
        $Nombre_de_places = $_POST['places'];
        $Nombre_de_planches=$_POST['planches'];
        $Prix = $_POST['price'];
        include_once('connexionpdo.php');
        try
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO `blablasurf`.`trajets` (`User_Pseudo`, `Lieu_Depart`, `Lieu_Arrivee`, `Heure_Depart`, `Nombre_de_places`, `Nombre_de_planches`, `Prix`) VALUES ('$User_ID', '$Lieu_Depart', '$Lieu_Arrivee', '$Heure_Depart', '$Nombre_de_places', '$Nombre_de_planches', '$Prix');";
            if ($conn->query($sql) === TRUE)
            {
            }
        }    
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
        else {  header('Location: connexion.php'); exit();}
?>
		<center><h1>Félicitations, votre annonce a bien été publiée !</h1></center><br/>	
		<center><a href="annonces.php"><button>Voir la liste des annonces</button></a></center>
	</body>
</html>