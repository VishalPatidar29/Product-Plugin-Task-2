<?php 


// This function for print the post 
function my_posts(){

    $args = array(
       'post_type' => 'product'
   );

 $query = new WP_Query($args);

if($query->have_posts()){
 ob_start();
echo  '<div class="product-container">';
   
   while ($query->have_posts()) {
       $query->the_post(); // Set up the post data

       $id = get_the_ID(); // Get the post ID after setting up the post data
       $price = get_post_meta($id, '_custom_product_price', true);
      
       ?>

      
       <!-- Repeat the following product divs to display more products -->
       <div class="product">
       <?php echo the_post_thumbnail(); ?> 
         <h5><?php echo get_the_title(); ?></h5>
         <p>₹<?php echo $price; ?></p>
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





?>