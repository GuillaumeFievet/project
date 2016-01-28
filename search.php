<?php
include('header.php');

if (isset($_POST['search']) && ($_POST['search'])!=""){
	$search = $_POST['search'];
	$sqlsearch=mysqli_query($conn,"SELECT * FROM VIDEOS WHERE TITLE LIKE '%$search%' OR RESUME LIKE '%$search%' OR CAT1 LIKE '%$search%' OR CAT2 LIKE '%$search%'"); 
	if (mysqli_num_rows($sqlsearch)==0) {
	 echo "<div class='small-12 columns'><h1>Votre recherche $search n'a donné aucun résultat</h1></div>"; 
	}else{
		while($row = mysqli_fetch_array($sqlsearch)){
	  		echo $row['ID'],'<br>';
		}
	}
	
}

include('footer.php');
?>