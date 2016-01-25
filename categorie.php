<?php
include('header.php');

if (isset($_GET['cat'])){$cat = $_GET['cat'];}

//total de lignes
$retour_total=mysqli_query($conn,"SELECT COUNT(*) AS total FROM VIDEOS WHERE CAT1 LIKE '%$cat%' or CAT2 LIKE '%$cat%'"); 
$donnees_total=mysqli_fetch_assoc($retour_total);
$total=$donnees_total['total'];
//on déclare le nombre de videos par page
$videoParPages = 20;
$nombreDePages=ceil($total/$videoParPages);
//on regarde si un nombre de page existe
if(isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nombreDePages)
{
    $pageActuelle=intval($_GET['page']);
 	if($pageActuelle>$nombreDePages){$pageActuelle=$nombreDePages;}
}
//sinon c'est la premiere page
else{$pageActuelle=1;}
//la ou on debute
$premiereEntree=($pageActuelle-1)*$videoParPages;
//requete sql
$sqlpage="SELECT * FROM VIDEOS WHERE CAT1 LIKE '%".$cat."%' or CAT2 LIKE '%".$cat."%' ORDER BY AJOUT DESC LIMIT $premiereEntree,$videoParPages";
//resultats des pages
$resultpage = mysqli_query($conn,$sqlpage);
while($row = mysqli_fetch_array($resultpage)){
  echo $row['ID'],'<br>';
}

echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo $i; 
     }	
     else //Sinon...
     {
          echo "<a href='categorie.php?cat=".$cat."&page=".$i."'>".$i."</a>";
     }
}
echo '</p>';

include('footer.php');
?>