<?php
console_log($args[0]);
if($args[0]) {
  $pokemon = json_decode(wp_remote_retrieve_body(wp_remote_get($args[0])));
  ?>
    <div><?php echo $pokemon->id ?></div>
    <img class="poke-img" src="<?php echo $pokemon->sprites->front_default ?>"/>
    <h1>
      <?php echo $pokemon->name; ?>
    </h1>
  <?php
}
?>