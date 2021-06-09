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

  <!-- < ?php 
  $results = json_decode(wp_remote_retrieve_body(wp_remote_get('https://pokeapi.co/api/v2/pokemon/1')));
?>
  <h1>< ?php echo $results->name ?></h1>
  <img class="poke-img" src="< ?php echo $results->sprites->front_default ?>"  />
  <h1>Hello from front-page.php</h1> -->

<?php get_footer(); ?> 