<?php 
function lapizzeria_styles() {
  // adding stylesheets
  wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '6.0.0');
  wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

  // Enqueue the style
  wp_enqueue_style('normalize');
  wp_enqueue_style('style');
}
function lapizzeria_menus() {
  // WordPress function
  register_nav_menus( array(
    'main-menu' => 'Main Menu'
  ));
}
// Adds stylesheets and JS files
function lapizzeria_scripts() {
  // Google fonts
  wp_enqueue_style('google_font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap', array(), '1.0.0');
  wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
  // wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js' );
} 

add_action('init', 'lapizzeria_menus');
add_action('wp_enqueue_scripts', 'lapizzeria_styles');
add_action('wp_enqueue_scripts', 'lapizzeria_scripts');

function print_pokemon_card($pokemon) {
  $args = array($url = $pokemon->url);
  get_template_part('card', null, $args);
}
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
?>