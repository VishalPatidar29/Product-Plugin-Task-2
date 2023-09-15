<?php

// ajax for get all the post
function load_posts() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Retrieve all posts
    );

    $query = new WP_Query($args);

    if ($query->have_posts()):
        echo '<div class="product-container">';

        while ($query->have_posts()) {
            $query->the_post(); // Set up the post data

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
                    <?php echo $price; ?>
                </p>
                <a href="<?php the_permalink($id); ?>"><button type="button" class="">Read More</button></a>


            </div>

            <?php

        }
        echo '</div>';


        // wp_reset_postdata();
    else:
        echo 'No products found';
    endif;

    die();
}




// for short code print all the product 

function my_posts()
{

    $args = array(
        'post_type' => 'product'
    );

    $query = new WP_Query($args);
   

    if ($query->have_posts()) {
        ob_start();
      
        echo '<div class="product-container">';

        while ($query->have_posts()) {
            $query->the_post(); // Set up the post data

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
                    <?php echo $price; ?>
                </p>
                <a href="<?php the_permalink($id); ?>"><button type="button" class="">Read More</button></a>


            </div>

            <?php

        }
        echo '</div>';


    }
    wp_reset_postdata();

    $html = ob_get_clean();

    return $html;
}










// the load post


function load_posts() {

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6, // Retrieve all posts -1
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()){
        
        echo '<div class="product-container">';

        while ($query->have_posts()) {
            $query->the_post(); // Set up the post data

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
                    <?php echo $price; ?>
                </p>
                <a href="<?php the_permalink($id); ?>"><button type="button" class="">Read More</button></a>


            </div>

            <?php

        }
        echo '</div>';
       
 

    if ( $query->max_num_pages > 1 ) {
        echo '<div class="pagination">';
        echo paginate_links( array(
          'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
          'format'  => '?paged=%#%',
          'current' => max( 1, $paged ),
          'total'   => $query->max_num_pages,
        ) );
        echo '</div>';
      }
    }
    else {
     echo 'No products found';
 }
 
    wp_reset_postdata();
    die();
}





   // Example: $args['meta_query'] = array(array('key' => 'price', 'value' => $priceRange, 'compare' => '<='));
   $post_categories = wp_get_post_categories(get_the_ID());
   $post_in_selected_category = empty($selectedCategories) || array_intersect($post_categories, $selectedCategories);

   if ($post_in_selected_category) {