<?php
include("header.php");
include("functions.php");
?>

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
				<li class="menu-text">Site Title</li>
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
				<li><input type="search" placeholder="Recherche"></li>
				<li><button type="button" class="button fi-magnifying-glass"></button></li>
			</ul>
		</div>
	</div>
</nav>

<?php
include("footer.php");
?>