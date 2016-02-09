<?php
include('connect.php');

$idvideo= $_POST['id'];
$votes = $_POST['votes'];
$rating = $_POST['rating'];
$like = $_POST['statut'];

$sql = "UPDATE VIDEOS SET VOTES = ($votes + 1), RATING = ($rating+$like) WHERE ID = $idvideo";
$result = mysqli_query($conn,$sql);
?>