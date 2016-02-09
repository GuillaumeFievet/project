<?php
//fonction d'affichage des catégorie
function categorie($bdd){
	$sqlimportcat = "(SELECT CAT1 as categories FROM VIDEOS) UNION (SELECT CAT2 FROM VIDEOS where CAT2 != '' AND CAT2 NOT IN (SELECT CAT1 FROM VIDEOS)) ORDER BY categories ASC";
	$resultimportcat = mysqli_query($bdd,$sqlimportcat);
	while($row = mysqli_fetch_array($resultimportcat)) {
		echo "<li><a href='categorie.php?cat=".$row['categories']."' title='".$row['categories']."'>".$row['categories']."</a></li>";
	}
}

function vues($bdd,$nbvues,$id){
	$sqlincrementvues = "UPDATE VIDEOS SET VUES = $nbvues + 1 WHERE id = $id";
	$resultincrementvues = mysqli_query($bdd,$sqlincrementvues);
}
?>