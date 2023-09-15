jQuery(document).ready(function() {


    var  max_value = jQuery('#maxprice').val();
    var  min_value = jQuery('#minprice').val();
    

    jQuery( "#slider-range" ).slider({
       
        range: true,
         min: 0,
        max: max_value,
        values: [ min_value, max_value ],
        slide: function( event, ui ) {
          jQuery( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
        }
      });
      jQuery( "#amount" ).val( "$" + jQuery( "#slider-range" ).slider( "values", 0 ) +
        " - $" + jQuery( "#slider-range" ).slider( "values", 1 ) );



        jQuery(document).on('click', '.paginationsearch a', function(e) {
            e.preventDefault();
            var page = jQuery(this).attr('href').split('=').pop(); 
            search_item(page);
        
        });

 function search_item(page){

    var searchQuery = jQuery('#search-input').val();
    var pricerange = jQuery('#amount').val();

   
    var selectedCategories = [];

    // Get selected category values
    jQuery('.category-filter:checked').each(function() {
        selectedCategories.push(jQuery(this).val());
    });
    

    // AJAX request to search for products by title
    jQuery.ajax({
        url: custom_sidebar_ajax.ajax_url,
        type: 'POST',
        data: {
            action: 'custom_sidebar_search', // AJAX action
            search_query: searchQuery,
            categories: selectedCategories,
            price_range: pricerange,
            page: page
        },
        success: function(response) {
           
            // Display the search results in the custom-sidebar-results div
            jQuery('#custom-sidebar-results').html(response);
        }
    });


 }
    // Search button click event
    jQuery('#search-button').on('click', function() {
        search_item(1);
    });




});


window.onload = function() {
    load_item(1);


 function load_item(page)
{
    jQuery.ajax({
        url: custom_sidebar_ajax.ajax_url,
        type: 'POST',
        data: { 
            action: 'load_posts',
             page: page,
     },
        success: function(response) {
            jQuery('#custom-sidebar-results').html(response); 
        }
    });
}

jQuery(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var page = jQuery(this).attr('href').split('=').pop(); 
    load_item(page);

});




};
