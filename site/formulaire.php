<?php session_start(); ?> 
<!doctype html>
<html lang="fr">
<head>
   		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<?php include('header.php'); ?>
<form method="post" action="formulaire.php"">
        <legend>Formulaire</legend>
        <div class="controls">
            <br> 
            <label for="User_ID">Pseudo :</label>
            <input type="text" id="User_ID" name="User_ID" size="20" />
            <br>
            <label for="Lieu_Depart">Lieu de départ:</label>
            <input type="text" name="Lieu_Depart" size="15" />
            <br>
            <label for="Lieu_Arrivee">Lieu d'arrivée :</label>
            <input type="text" name="Lieu_Arrivee"/>
            <br>
            <label for="Heure_Depart">Date de départ :</label>
            <input type="datetime" name="Heure_Depart"/>
            <br>
            <label for="Nombre_de_places">Places disponibles:</label>
            <input type="int" name="Nombre_de_places"/>
            <br>
            <label for="Prix">Prix :</label>
            <input type="float" name="Prix" >
            <br>
            <input type="reset" value="Annuler" />
            <input type="submit" value="Envoyer" />
        </div>
</form>

<?php
    if(isset($_POST['Envoyer'])){
        $User_ID=$_GET['User_ID'];
        $Lieu_Depart = $_POST['Lieu_Depart'];
        $Lieu_Arrivee = $_POST['Lieu_Arrivee'];
        $Heure_Depart = $_POST['Heure_Depart'];
        $Nombre_de_places = $_POST['Nombre_de_places'];
        $Prix = $_POST['Prix'];
        include_once('connexion.php');
        try
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="Update `web287_main`.`annuaire_ate202` Set Nom='".$nom."', Prenom='".$prenom."', Age=".$age.", Sexe='".$sexe."', Categorie='".$categorie."' Where ID=".$ID."";
            if ($conn->query($sql) === TRUE)
            {
            }    
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
?>
<?php include('footer.php'); ?> 
</body> 
<form method="post" action="index.php?page=user">
        <div class="controls" style="float: left;" style="color: red;">
            <input type="submit" value="Retour" size="18" />
        </div>
</form>

</html>
	