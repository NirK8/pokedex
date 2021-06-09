<?php get_header(); ?>
<!-- 
  <main class="container page section">
    < ?php while(have_posts() ): the_post(); ?>
    <h1 class="text-center text-primary">< ?php the_title(); ?></h1>

    <div class="text-center">
      < ?php the_content(); ?>
    </div>
    < ?php endwhile; ?>
  </main> -->

<?php 
  $id = $_GET['id'];
  $pokemon = json_decode(wp_remote_retrieve_body(wp_remote_get('https://pokeapi.co/api/v2/pokemon/' . $id)));
?>
  <!-- ID -->
  <h4><?php echo $pokemon->id ?></h4>
  <!-- Image -->
  <img class="poke-img" src="<?php echo $pokemon->sprites->front_default ?>"  />
  <!-- Name -->
  <h1><?php echo $pokemon->name ?></h1>
  <!-- Types -->
  <?php 
  array_map('print_pokemon_type', $pokemon->types);
  ?>
<?php get_footer(); ?> 