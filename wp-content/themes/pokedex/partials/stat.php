<?php
if($args[0]) {
  ?>
    <span class="stat"><?php echo ucfirst($args[0]->stat_key) ?>: <?php echo $args[0]->stat_value ?></span>
  <?php
}
?>