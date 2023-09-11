<?php 

get_header();
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


	<div class="w3-container" style="padding:60px 16px" id="about">

  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>


    <div class="entry-content">

<div class="w3-container" style="padding:5px 16px">
  <div class="leftcolumn">
    <div class="card">
   
    <h5><?php echo get_the_date(); ?></h5>
      <h2 ><?php  the_post_thumbnail(array(600,1000)); ?></h2>
     
      
    </div>
    </div>
    </div>



	<div class="product-gallery">
          <?php
             // Display gallery images
             global $post;

            $gallery_images = array();
            $gallery_images = get_post_meta( $post->ID, 'gallery_data', true );
            $price = get_post_meta($post->ID, '_custom_product_price', true);
            $Description = get_post_meta($post->ID, '_product_description', true);
                        
                      
                      

                if ($gallery_images) {
                          $i = 0;
                foreach ($gallery_images as $image) {
                foreach($image as $data){
                                // die($data);
                  echo '<img src="' . esc_url($data).'">';
                              $i++;
                              // die();      
                                 }   
                            }
                        }
                        ?>
                    </div>

                    <div class="product-price">
                        <?php
                        // Display product price
                        echo $price;
                        ?>
                    </div>

                    <div class="product-description">
                        <?php
                        echo $Description;
                        ?>
                    </div>
        </div>
	</main><!-- #main -->
	</div><!-- #primary -->
<?php
do_action( 'storefront_sidebar' );
get_footer();
?>





<?php
/*
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'storefront_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'storefront_single_post_after' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->



*/