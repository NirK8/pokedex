<?php 
function pokedex_styles() {
  // adding stylesheets
  wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '6.0.0');
  wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

  // Enqueue the style
  wp_enqueue_style('normalize');
  wp_enqueue_style('style');
}

// Adds stylesheets and JS files
function pokedex_scripts() {
  // Google fonts
  wp_enqueue_style('google_font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap', array(), '1.0.0');
  // wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
} 

add_action('wp_enqueue_scripts', 'pokedex_styles');
add_action('wp_enqueue_scripts', 'pokedex_scripts');

// Function. Receives a pokemon object and prints a card which displays all the pokemon data. 
function print_pokemon_card($pokemon) {
  // calls the 'card' template (card.php), passing the pokemon url as the only argument. 
  get_template_part('card', null, array($url = $pokemon->url));
}
// console log for php
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
// receives a 'stat' object as received from the API and coverts it to a more useable object. 
function format_stat($stat) {
  $formattedStat = new stdClass();
  $formattedStat->stat_key = $stat->stat->name; 
  $formattedStat->stat_value = $stat->base_stat; 
  return $formattedStat;
}
// receives an array of formatted stats (objects) and returns the array with an added item- the total value of all stats combined. 
function add_total_to_stats($formatted_stats_array) {
  // reducer function that sums stat values.
  function sum_stat_values($carry, $stat) {
    $carry += $stat->stat_value;
    return $carry;
  }
  $total_value = array_reduce($formatted_stats_array, "sum_stat_values", 0);
  $total = new stdClass();
  $total->stat_key = 'total';
  $total->stat_value = $total_value;
  $formatted_stats_array[] = $total;
  return $formatted_stats_array;  
}
// takes a pokemon type and prints the stat using the 'stat' template.
function print_pokemon_type($type) {
  $type = $type->type->name;
  get_template_part('type', null, array($type = $type));
}
// takes a pokemon 'specie url' and prints the pokemon description using the 'description' template.
function print_pokemon_description($specie_url) {
  $specie = json_decode(wp_remote_retrieve_body(wp_remote_get($specie_url)));
  $description = $specie->flavor_text_entries[0]->flavor_text;
  get_template_part('description', null, array($description = $description));
}
// receives an array of stats as returned from the api, and prints all the stats using the 'stats' template.
function print_pokemon_stats($stats_array) {
  // formatting every 'stat' in the array.
  $formatted_stats_array = array_map('format_stat', $stats_array);
  // adds the total value of all the stats.
  $formatted_stats_array = add_total_to_stats($formatted_stats_array);
  // call the 'stats' template.
  get_template_part('stats', null, $formatted_stats_array);
}
// takes a pokemon stat and prints it using the 'stat' template. 
function print_stat($stat) {
  get_template_part('stat', null, array($stat));
}
?>