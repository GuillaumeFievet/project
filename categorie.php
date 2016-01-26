<?php
include('header.php');
include('functions.php');

if (isset($_GET['cat']) && strlen($_GET['cat']) < 30 && $_GET['cat'] != ""){
	$cat = $_GET['cat'];
	//total de lignes
	$retour_total=mysqli_query($conn,"SELECT COUNT(*) AS total FROM VIDEOS WHERE CAT1 LIKE '%$cat%' or CAT2 LIKE '%$cat%'"); 
	$donnees_total=mysqli_fetch_assoc($retour_total);
	$total=$donnees_total['total'];
	//on déclare le nombre de videos par page
	$videoParPages = 20;
	$nombreDePages=ceil($total/$videoParPages);
	//on regarde si un nombre de page existe
	if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nombreDePages)
	{
	    $pageActuelle=intval($_GET['p']);
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
	// la pagination
	echo paginate("/project/categorie.php?cat=$cat", '&p=', $nombreDePages, $pageActuelle);
}else{
	echo "<h2>nous n'avons pas trouvé votre catégorie :/ trouvez en une autre</h2>";
	echo categorie($conn);
}

include('footer.php');
?>