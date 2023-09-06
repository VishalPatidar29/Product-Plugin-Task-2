<?php

function custom_product_price_meta_box() {
    add_meta_box('custom_product_price', 'Product Price', 'custom_product_price_callback', 'product', 'normal', 'high');
}


// Callback function to display the 'price' field in the meta box
function custom_product_price_callback($post) {
   
    $price = get_post_meta($post->ID, '_custom_product_price', true);
     ?>
    <label for="custom_product_price">Price:</label>
     <input type="text" id="custom_product_price" name="custom_product_price" value="<?php echo esc_attr($price); ?>"> 
    <?php
  }


//  Save 'price' field data when saving/updating a product
  function custom_product_save_price($post_id) {
    if (isset($_POST['custom_product_price'])) {
        update_post_meta($post_id, '_custom_product_price', sanitize_text_field($_POST['custom_product_price']));
   }
 }

?>