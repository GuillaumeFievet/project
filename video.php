<?php
include('header.php');

if (isset($_GET['vd']) && is_numeric($_GET['vd'])){
	$idvideo = $_GET['vd'];

	//on récupère les infos de la video
	$retourvideo=mysqli_query($conn,"SELECT * FROM VIDEOS WHERE ID = $idvideo"); 
	while($row = mysqli_fetch_array($retourvideo)){
	  echo $row['ID'],'<br>';echo $cat = $row['CAT1'];echo $cat2 = $row['CAT2'];
	  echo '<video class="video-pornation" controls width="1078" height="550" autoplay="1" preload="metadata" style="width: 100%; height: 100%;" src="'.urldecode($row['URL']).'">
				<source type="video/mp4" src="'.urldecode($row['URL']).'">'.$row['TITLE'].'
			</video>';
	}

	

	//on pousse d'autres videos
	echo "<h2>Nos autres vidéos similaires</h2>";
	
	//on récupère les infos de la video
	$pushvid=mysqli_query($conn,"SELECT * FROM VIDEOS WHERE CAT1 LIKE '%$cat%' ORDER BY AJOUT DESC LIMIT 5"); 
	while($row = mysqli_fetch_array($pushvid)){
	  echo $row['ID'],'<br>';
	}
}else{
	echo "<h2>Vidéo introuvable</h2>";

	//on pousse des vidéos au hasard
	$pushhasard=mysqli_query($conn,"SELECT * FROM VIDEOS ORDER BY AJOUT DESC LIMIT 20"); 
	while($row = mysqli_fetch_array($pushhasard)){
	  echo $row['ID'],'<br>';
	}
}

include('footer.php');
?>