<?php
if($args) {
  ?>
    <a href="/pokedex/?page=<?php echo $args[0]?>" class="nav-item"><?php echo $args[0] ?></a> 
  <?php
}
?>