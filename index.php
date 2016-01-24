<?php
include("header.php");
?>
<div class="top-bar">
  <div class="top-bar-title">
    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
      <span class="menu-icon dark" data-toggle></span>
    </span>
  </div>
  <div id="responsive-menu">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li><a href="#">home</a></li>
        <li>
          <a href="#">Catégories</a>
          <ul class="menu vertical">
            <?php 
            $sqlimportcat = "(SELECT CAT1 as categories FROM VIDEOS) UNION (SELECT CAT2 FROM VIDEOS where CAT2 != '' AND CAT2 NOT IN (SELECT CAT1 FROM VIDEOS)) ORDER BY categories ASC";
            $resultimportcat = mysqli_query($conn,$sqlimportcat);
            while($row = mysqli_fetch_array($resultimportcat)) {
              echo "<li><a href='categories?".$row['categories']."'>".$row['categories']."</a></li>";
            }
            ?>
          </ul>
        </li>
      </ul>
    </div>
    <div class="top-bar-right">
      <ul class="menu">
        <li><input type="search" placeholder="Recherche"></li>
        <li><button type="button" class="button step fi-magnifying-glass size-60"></button></li>
      </ul>
    </div>
  </div>
</div>

<?php
include("footer.php");
?>