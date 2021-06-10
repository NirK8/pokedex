<?php 
function lapizzeria_styles() {
  // adding stylesheets
  wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '6.0.0');
  wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

  // Enqueue the style
  wp_enqueue_style('normalize');
  wp_enqueue_style('style');
}

// Adds stylesheets and JS files
function lapizzeria_scripts() {
  // Google fonts
  wp_enqueue_style('google_font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap', array(), '1.0.0');
  wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
  // wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js' );
} 

add_action('wp_enqueue_scripts', 'lapizzeria_styles');
add_action('wp_enqueue_scripts', 'lapizzeria_scripts');

function print_pokemon_card($pokemon) {
  get_template_part('card', null, array($url = $pokemon->url));
}
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
function format_stat($stat) {
  $formattedStat = new stdClass();
  $formattedStat->stat_key = $stat->stat->name; 
  $formattedStat->stat_value = $stat->base_stat; 
  return $formattedStat;
}
function add_total_to_stats($formatted_stats_array) {
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
function print_pokemon_type($type) {
  $type = $type->type->name;
  get_template_part('type', null, array($type = $type));
}
function print_pokemon_description($specie_url) {
  $specie = json_decode(wp_remote_retrieve_body(wp_remote_get($specie_url)));
  $description = $specie->flavor_text_entries[0]->flavor_text;
  // $args = array($description = $description);
  get_template_part('description', null, array($description = $description));
}
function print_pokemon_stats($stats_array) {
  $formatted_stats_array = array_map('format_stat', $stats_array);
  $formatted_stats_array = add_total_to_stats($formatted_stats_array);
  get_template_part('stats', null, $formatted_stats_array);
}
function print_stat($stat) {
  $args = array($stat);
  get_template_part('stat', null, $args);
}

?>