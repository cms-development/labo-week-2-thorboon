<?php 
// Header
get_header();
if(have_posts()) :
  while(have_posts()) :
    the_post();
    the_title();
    the_content();
  endwhile;
endif;
$args = array(
        'posts_per_page' => 2,
        'order' => 'desc',
        'orderby' => 'date',
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'algemeen',
            'include_children' => false
          ),
        )
    );
$posts = new WP_Query($args);
if( $posts->have_posts() ):
  while( $posts->have_posts() ) :
    $posts->the_post(); 
    the_title();
    the_content();
  endwhile;
endif; 
$args2 = array(
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'date',
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'weetje',
            'include_children' => false
          ),
        )
);
$posts2 = new WP_Query($args2);
if($posts2->have_posts()):
  while($posts2->have_posts()) :
    $posts2->the_post();
    the_title();
    the_content();
  endwhile;
endif;
wp_reset_postdata();
// Sidebar
get_sidebar('primary-sidebar');
// Footer
get_footer();
?>