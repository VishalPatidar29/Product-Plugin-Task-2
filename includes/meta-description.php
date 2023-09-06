<?php

// Add custom meta box for product description
function add_product_description_meta_box() {
    add_meta_box(
        'product_description_meta_box',
        'Product Description',
        'display_product_description_meta_box',
        'product', 
        'normal',
        'high'
    );
}


// Callback function to display the meta box content
function display_product_description_meta_box($post) {
    // Get the current product description
    $product_description = get_post_meta($post->ID, '_product_description', true);

    // Output the HTML for the meta box
    ?>
    <textarea id="product_description" name="product_description" rows="5" style="width: 100%;"><?php echo esc_textarea($product_description); ?></textarea>
    <?php
}



// Save the meta box data when the post is saved
function save_product_description_meta_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['product_description'])) {
        $product_description = sanitize_text_field($_POST['product_description']);
        update_post_meta($post_id, '_product_description', $product_description);
    }
}


?>