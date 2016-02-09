<?php
include('header.php');

echo "<div class='page-video'>";
if (isset($_GET['vd']) && is_numeric($_GET['vd'])){
	$idvideo = $_GET['vd'];
	//on récupère les infos de la video
	$retourvideo=mysqli_query($conn,"SELECT * FROM VIDEOS WHERE ID = $idvideo"); 
	while($row = mysqli_fetch_array($retourvideo)){
		//on incremente les vues
		$vues = $row['VUES'];$votes = $row['VOTES'];$rating = $row['RATING'];
		if($votes != 0){$avg = ceil($rating/$votes);}
		echo vues($conn,$vues,$idvideo);
		//on recupere la categorie
		$cat = $row['CAT1'];
		//colonne de gauche
		echo '
		<div class="small-12 columns title"><h1>'.utf8_encode($row['TITLE']).'</h1></div>
		<div class="small-12 medium-9 columns">
			<video class="video-pornation" controls width="1000" height="500" autoplay="1" preload="metadata" style="width: 100%; height: 100%;" src="'.urldecode($row['URL']).'">
				<source type="video/mp4" src="'.urldecode($row['URL']).'">'.$row['TITLE'].'
			</video>
		</div>';

		//colonne de droite
		echo'
		<div class="small-12 medium-3 columns infos">
			<div class="small-6 columns vues text-center">
				<div class="small-6 columns fi-eye"></div>
				<div class="small-6 columns">'.$row['VUES'].'</div>
			</div>
			<div class="small-6 columns votes text-center">
				<div class="small-6 columns fi-heart"></div>
				<div class="small-6 columns positive">'.$avg.'%</div>
			</div>
			<span class="txtinfos">notez cette vidéo</span>
			<div class="small-6 columns action like text-center">
				<div class="small-12 columns fi-like"></div>
			</div>
			<div class="small-6 columns action dislike text-center">
				<div class="small-12 columns fi-dislike"></div>
			</div>
		</div>
		<div class="small-12 medium-9 columns resume">
			'.utf8_encode($row['RESUME']).'
		</div>';
	}	


	//on pousse d'autres videos
	echo "<div class='small-12 columns'>
	<h2>Nos autres vidéos similaires</h2>";
	
	//on récupère les infos de la video
	$pushvid=mysqli_query($conn,"SELECT * FROM VIDEOS WHERE CAT1 LIKE '%$cat%' ORDER BY AJOUT DESC LIMIT 5"); 
	while($row = mysqli_fetch_array($pushvid)){
	  echo $row['ID'],'<br>';
	}
	echo "</br>";
}else{
	echo "<h2>Vidéo introuvable</h2>";

	//on pousse des vidéos au hasard
	$pushhasard=mysqli_query($conn,"SELECT * FROM VIDEOS ORDER BY AJOUT DESC LIMIT 20"); 
	while($row = mysqli_fetch_array($pushhasard)){
	  echo $row['ID'],'<br>';
	}
}
echo "</div>";

include('footer.php');
?>

<script type="text/javascript">
	var id = <?php echo $idvideo ?>;
	var rating = <?php echo $rating ?>;
	var votes = <?php echo $votes ?>;
	$('.infos').on('click','.action',function(){
		if ($(this).hasClass('like')){var like = 100}else{var like = 0};
		console.log('oui');
		console.log(like);
		$.ajax({
			method: "POST",
			url: "like.php",
			data: {'id' : id , 'votes' : votes, 'rating' : rating , 'statut' : like}
		});
	});
	
</script>