<?php get_header();


  $response = json_decode(wp_remote_retrieve_body(wp_remote_get('https://pokeapi.co/api/v2/pokemon?limit=12&offset=0')));
  $results = $response->results;
  $pokeId = $_GET['pokeId'];
  array_map('print_pokemon_card', $results);
?>
  
<?php get_footer(); ?>