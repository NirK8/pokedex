<?php get_header();

  // get the page number from the url param which is called 'page'
  $page = $_GET['page']
  // if there is no url param, page number fallbacks to 1      
  ?: 1;

  // offset will be 12 times the page number, minus 12. For example: if the page number is 2, the offset will be 12. 
  $offset = (intval($page)-1) * 12;
  // url for fetching multiple pokemons. limit will always be 12. offset depends on the page number.
  $url = 'https://pokeapi.co/api/v2/pokemon?limit=12&offset=' . $offset;
  // the body of the returned response.
  $response = json_decode(wp_remote_retrieve_body(wp_remote_get($url)));
  // the pokemons array
  $results = $response->results;
  // prints each pokemon in the array
  array_map('print_pokemon_card', $results);
  // prints a navigation bar at the bottom
  print_nav_bar($page);
?>
  
<?php get_footer(); ?>