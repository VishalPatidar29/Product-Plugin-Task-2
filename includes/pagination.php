
<?php

function load_posts() {

$page = $_POST['page'];

$args = array(
    'post_type' => 'product',
    'posts_per_page' => 6, // Retrieve all posts -1
    'paged' => $page,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    
    echo '<div class="product-container">';

    while ($query->have_posts()) : $query->the_post(); // Set up the post data

        $id = get_the_ID(); // Get the post ID after setting up the post data
        $price = get_post_meta($id, '_custom_product_price', true);

        ?>
        <!-- Repeat the following product divs to display more products -->
        <div class="product">
            <?php echo the_post_thumbnail(); ?>
            <h5>
                <?php echo get_the_title(); ?>
            </h5>
            
            <p>₹
                    <?php echo $price; ?></p>
                    <h5>
   <?php
                    $terms = get_the_terms(get_the_ID(), 'category');
       foreach($terms as $term) {

         $product_cat = $term->name;
            echo 'Category - '.$product_cat;
              break;
          }?>
                </h5>
            <a href="<?php the_permalink($id); ?>"><button type="button" class="read-button">Read More</button></a>


        </div>

        <?php

    endwhile;
    echo '</div>';
   


if ( $query->max_num_pages > 1 ) {

    echo '<div class="pagination">';
    echo paginate_links( array(
    
      'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
      'format'  => '?page=%#%',
      'current' => max( 1, $page ),
      'total'   => $query->max_num_pages,
    ) );
    echo '</div>';
     } ?>    
<?php else :?>
<h3><?php _e('404 Error&#58; Not Found herer', ''); ?></h3>
<?php endif; ?>
<?php wp_reset_postdata();
wp_die();
}


?>


