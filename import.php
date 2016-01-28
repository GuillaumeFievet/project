<?php
include('header.php');
//variables
$nb = 0;
$newvideo = 0;
$datadate = date('Y-m-d');

//appel du flux
$doc = new DOMDocument();
$doc->load( 'http://www.eravage.com/export/getfluxvideos/xml_st/6682/1/cb302m90/0/utf8/all/640x480/none/12/60/0//0/0/0/0/1/null/all/1/0/0/120-0/' );
//on enregistre les données
$videos = $doc->getElementsByTagName( "video" );
foreach( $videos as $video )
{
	$id = $video->getElementsByTagName( "id" );
	$id = $id->item(0)->nodeValue;
	
	$title = $video->getElementsByTagName( "title" );
	$title = utf8_decode(addslashes($title->item(0)->nodeValue));
	
	$resume = $video->getElementsByTagName( "description" );
	$resume = utf8_decode(addslashes($resume->item(0)->nodeValue));
	
	$cat = $video->getElementsByTagName( "tags" );
	$cat =  explode("|",$cat->item(0)->nodeValue);
	$cat1 = utf8_decode(addslashes($cat[1]));
	$cat2 = utf8_decode(addslashes($cat[2]));
	
	$url = $video->getElementsByTagName( "clip_url" );
	$url = $url->item(0)->nodeValue;
	$flv = $video->getElementsByTagName( "flv" );
	$flv = $flv->item(0)->nodeValue;
	$url = urlencode($url.$flv);
	
	$thumb = $video->getElementsByTagName( "screen_url" );
	$thumb = urlencode($thumb->item(0)->nodeValue);
	
	$duree = $video->getElementsByTagName( "duration" );
	$duree = $duree->item(0)->nodeValue;
	
	$rating = 0;
	$votes = 0;
	$vues = 0;
	$ajout = date('Y-m-d H:i:s');

	//on calcule le nombre de video ajoutées
	$sqlajout = "SELECT COUNT(*) as nbajout FROM VIDEOS WHERE ID = '$id'"; 
	$resultajout = mysqli_query($conn,$sqlajout);
	while($row = mysqli_fetch_array($resultajout)) {
		$newvideo = $newvideo + $row['nbajout'];
	}
	//sql insertion
	$sql = "INSERT INTO VIDEOS (ID,TITLE,RESUME,CAT1,CAT2,URL,THUMB,DUREE,RATING,VOTES,VUES,AJOUT) VALUES ('$id','$title','$resume','$cat1','$cat2','$url','$thumb','$duree','$rating','$votes','$vues','$ajout')"; 
	$result = mysqli_query($conn,$sql);
	//nombre de videos au total
	$nb = $nb + 1;
}

// on ajoute les statistiques 
$sqlinsertstat = "INSERT INTO DATAVIDEO (DATE,NBVIDEO) VALUES ('$datadate','$nb')";
$sqlstat = "SELECT COUNT(DATE) as nbdate FROM DATAVIDEO WHERE DATE= '$datadate'"; 
$resultstat = mysqli_query($conn,$sqlstat);
	while($row = mysqli_fetch_array($resultstat)) {
		if($row['nbdate'] == 0){mysqli_query($conn,$sqlinsertstat);}
	}

//on calcule les mois 	
$sqlmonth = "SELECT DISTINCT CONCAT(MONTH(DATE),'-',YEAR(DATE)) FROM DATAVIDEO";
$resultmonth = mysqli_query($conn,$sqlmonth);
	while($row = mysqli_fetch_array($resultmonth)) {
		$month[] = $row[0];
			//on calcule les données
			$sqlavg = "SELECT ROUND(AVG(NBVIDEO)) FROM DATAVIDEO WHERE CONCAT(MONTH(DATE),'-',YEAR(DATE)) = '$row[0]'";
			$resultavg = mysqli_query($conn,$sqlavg);
			while($row2 = mysqli_fetch_array($resultavg)) {
				$avg[] = $row2[0];
			}
	}	
// on sort les tableau en json	
$label = json_encode($month);
$data = json_encode($avg);
include('footer.php');
?>
<script src="js/Chart.js"></script>
<div class="row">
	<div class="small-12 columns text-center">
		<?php 
			echo "nombre de vidéos ajoutées : ",$nb-$newvideo,"<br>";
			echo "nombre de vidéos au total : ",$nb;
		?>
	</div>
	<div class="small-12 columns">
		<canvas id="canvas" height="450" width="600"></canvas>
	</div>
</div>
<script>
	var lineChartData = {
		labels : <?php echo $label ?>,
		datasets : [
			{
				label: "Nombre de vidéos ajoutées",
				fillColor : "rgba(151,187,205,0.2)",
				strokeColor : "rgba(151,187,205,1)",
				pointColor : "rgba(151,187,205,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(151,187,205,1)",
				data : <?php echo $data ?>
			},
		]
	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true,
			scaleGridLineColor : "rgba(255,255,255,0.5)",
			scaleLineColor : "rgba(255,255,255,0.5)"
		});
	}
</script>