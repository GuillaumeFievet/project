<?php 
include("connect.php");
include_once('paginate.php');
include("functions.php");
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pornation - la nation du porno</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/icons.css"
  </head>
  <body>

  <nav>
	<!-- navigation mobile -->
	<div class="title-bar" data-responsive-toggle="pornation-menu" data-hide-for="medium">
		<button class="menu-icon" type="button" data-toggle></button>
		<div class="title-bar-title">Menu</div>
	</div>
	<!-- navigation desktop -->
	<div class="top-bar" id="pornation-menu">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<li class="menu-text"><a href="http://www.pornation.fr" title="la nation du porno">LOGO</a></li>
				<li><a href="http://www.pornation.fr" title="la nation du porno">Home</a></li>
				<li>
					<a href="#">Catégories</a>
					<ul class="menu vertical">
						<?php echo categorie($conn); ?>
					</ul>
				</li>
			</ul>
		</div>
		<div class="top-bar-right">
			<ul class="menu">
				<form action="search.php" method="post">
					<li><input type="search" placeholder="Recherche" name="search"></li>
					<li><button type="submit" class="button fi-magnifying-glass"></button></li>
				</form>
			</ul>
		</div>
	</div>
</nav>
<div id="container">
	<div class="row">
