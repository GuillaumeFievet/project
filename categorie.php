<?php
include('header.php');

if (isset($_GET['cat']) && strlen($_GET['cat']) < 30 && $_GET['cat'] != ""){
	$cat = $_GET['cat'];
	//total de lignes
	$retour_total=mysqli_query($conn,"SELECT COUNT(*) AS total FROM VIDEOS WHERE CAT1 LIKE '%".$cat."%' or CAT2 LIKE '%".$cat."%'"); 
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
	$sqlpage="SELECT * FROM VIDEOS WHERE CAT1 LIKE '%".$cat."%' OR CAT2 LIKE '%".$cat."%' ORDER BY AJOUT DESC LIMIT $premiereEntree,$videoParPages";
	//resultats des pages
	$resultpage = mysqli_query($conn,$sqlpage);
	echo "<div class='large-2 columns show-for-large'>";
	echo categorie($conn);
	echo "</div>";
	echo "<div class='small-12 large-10 columns categorie'>";
	while($row = mysqli_fetch_array($resultpage)){
		echo 
		'<div class="small-12 medium-6 large-3 columns">
			<a href="video.php?vd='.$row['ID'].'">
				<img src='.urldecode($row['THUMB']).'1.jpg width="270" height="150" alt='.utf8_encode($row['TITLE']).'/>
				',utf8_encode($row['TITLE']),
			'</a>
		</div>';
		}
	echo "</div>";
	// la pagination
	echo paginate("/project/categorie.php?cat=$cat", '&p=', $nombreDePages, $pageActuelle);
}else{
	echo "<h2>nous n'avons pas trouvé votre catégorie :/ trouvez en une autre</h2>";
	echo categorie($conn);
}

include('footer.php');
?>