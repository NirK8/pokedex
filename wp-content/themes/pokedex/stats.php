<?php
if($args) {
  ?>
    <h4 class="h4">Stats</h4>
    <div class="stats-container">
      <div>
        <?php 
          array_map('print_stat', $args);
        ?>
      </div>
    </div>
  <?php
}
?>