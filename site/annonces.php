<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
<title>Annonces | Blablasurf</title>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
<?php include('header.php'); ?>
<section class="wrapper">
	<div class="inner">
<?php
echo "<table id=\"Trajets\">";
echo"  <tr><th onclick=\"sortTable(0)\">Lieu de départs</th>
	   <th onclick=\"sortTable(1)\">Lieu d'arrivée</th>
	   <th onclick=\"sortTable(2)\">Heure départs</th>
	   <th onclick=\"sortTable(3)\">Places disponibles</th>
	   <th onclick=\"sortTable(4)\">Nombre de planches</th>
	   <th onclick=\"sortTable(5)\">Prix</th>
	   <th onclick=\"sortTable(6)\">Conducteur</th>
     <th>Voir</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

include_once('connexionpdo.php');
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   if(isset($_POST['search1']))
   {
	   $depart=$_POST["depart"];
	   $arrivee=$_POST["arrivee"];
	   $date=$_POST["date"];
	   $planches=$_POST["planches"];
	   $stmt = $conn->prepare("SELECT Lieu_Depart , Lieu_Arrivee, Heure_Depart,Nombre_de_places, Nombre_de_planches, Prix, User_Pseudo FROM `trajets` WHERE `Lieu_Depart` = '".$depart."' AND `Lieu_Arrivee` = '".$arrivee."' AND `Heure_Depart` >= '".$date."' AND `Nombre_de_places` >= '".$planches."'");
      $stmt->execute();
   $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
   $r=$stmt->fetchAll();

}
   else 
   {
    $stmt = $conn->prepare("SELECT Lieu_Depart , Lieu_Arrivee, Heure_Depart,Nombre_de_places, Nombre_de_planches, Prix, User_Pseudo, ID FROM `trajets`");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $r=$stmt->fetchAll();

   }
  foreach($r as &$value)
    {
      $ID=$value['ID'];
      /*$value['ID']='<form method="post" action="annonce.php"><input type="hidden" name="ID" value="'.$ID.'" style="length: 0px;"><input style="length: 10px;" type="submit" name="More" value="Voir plus" /></form>';*/
      $value['ID']='<a href="annonce.php&'.$ID.'"><img height="15" width="15" src="images/More.jpg" alt=""/></a>';}
   foreach(new TableRows(new RecursiveArrayIterator($r)) as $k=>$v) 
    {

      echo $v;
    }
    $conn = null;
    echo "</table>";
?>
</div></section>
<script>

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("Trajets");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<?php include('footer.php'); ?>
</body>
</html>
