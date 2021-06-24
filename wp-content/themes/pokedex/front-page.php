<?php get_header();

  $page = $_GET['page'];
  $offset = 0;
  if($page) {
    $offset = (intval($page)-1) * 12;
  }
  $url = 'https://pokeapi.co/api/v2/pokemon?limit=12&offset=' . $offset;
  $response = json_decode(wp_remote_retrieve_body(wp_remote_get($url)));
  $results = $response->results;
  array_map('print_pokemon_card', $results);
  print_nav_bar($page);
?>
  
<?php get_footer(); ?>