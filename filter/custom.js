
//category ajx jquery for resource post type and article 
jQuery(document).ready(function($) {
    var categorySlug = jQuery('#category-filter').val();
    var categoryValue = jQuery('.category-button.active').data('category');
    var lastKnownPage = 1;

    jQuery('#category-filter').on('change', function() {
        categorySlug = jQuery(this).val();
        categoryValue = ''; 
        loadPosts(categorySlug, 1, "");
        loadPosts_article(categorySlug, 1, ""); // Reset to page 1
        jQuery('.category-button').removeClass('active'); 
    });

    jQuery('.category-button').on('click', function() {
        jQuery('.category-button').removeClass('active');
        jQuery(this).addClass('active');
        categorySlug = ''; 
        categoryValue = jQuery(this).data('category');
        loadPosts("", 1, categoryValue);
        loadPosts_article("", 1, categoryValue); // Reset to page 1
    });

    jQuery(document).on('click', '.pagination .page-numbers', function(e) {
        e.preventDefault();
        var nextPageLink = jQuery(this).attr('href');

        if (jQuery(this).hasClass('next')) {
            lastKnownPage++;
        } else if (jQuery(this).hasClass('prev')) {
            lastKnownPage--;
        } else if (jQuery(this).hasClass('dots')) {
            lastKnownPage = lastKnownPage + 2; // Go to the next page when dots are clicked.
        } else {
            lastKnownPage = parseInt(jQuery(this).text());
        }

        jQuery('.page-numbers.current').removeClass('current'); 
        jQuery(this).addClass('current'); 
        
        if (categorySlug) {
            loadPosts(categorySlug, lastKnownPage, "");
            loadPosts_article(categorySlug, lastKnownPage, "");
        } else if (categoryValue) {
            loadPosts("", lastKnownPage, categoryValue);
            loadPosts_article("", lastKnownPage, categoryValue);
        } else {
            loadPosts("", lastKnownPage, "");
            loadPosts_article("", lastKnownPage, "");
        }
    });
    //load post for resoureces post type 
    function loadPosts(categorySlug, currentPage, categoryValue) {
        var data = {
            action: 'category_filter_posts',
            currentPage: currentPage,
        };

        if (categorySlug) {
            data.category = categorySlug;
        }
        if (categoryValue) {
            data.categoryValue = categoryValue;
        }

        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            dataType: 'html',
            success: function(response) {
                jQuery('#post-container').html(response);
                jQuery('#currentPage').val(lastKnownPage); // Update the hidden input value
                jQuery('.page-numbers.current').removeClass('current');
                jQuery('.page-numbers:contains(' + currentPage + ')').addClass('current'); 
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

   //loadPosts_article for article post type
    function loadPosts_article(categorySlug, currentPage, categoryValue) {
        var data = {
            action: 'loadPosts_article',
            currentPage: currentPage,
        };

        if (categorySlug) {
            data.category = categorySlug;
        }
        if (categoryValue) {
            data.categoryValue = categoryValue;
        }

        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            dataType: 'html',
            success: function(response) {
                jQuery('#post-container-article').html(response);
                jQuery('#currentPage').val(lastKnownPage); // Update the hidden input value
                jQuery('.page-numbers.current').removeClass('current');
                jQuery('.page-numbers:contains(' + currentPage + ')').addClass('current'); 
            },
            error: function(error) {
                console.log(error);
            }
        });
    }



});

setTimeout(function() { jQuery('#hs-form-iframe-0').contents().find("head"). append(jQuery('<style type="text/css"> #6f9f605e-ca74-40c5-800a-8cd573002c14 .hs-form-6f9f605e-ca74-40c5-800a-8cd573002c14_1dfe932b-52f6-4e44-9f2c-ec50752709f4 .hs-form-field label:not(.hs-error-msg) {font-family: Montserrat; font-size: 18px;}</style>'));},2000);

// jQuery('.moreless-button2').click(function() {
//     jQuery('.moretext2').slideToggle();
//     if (jQuery('.moreless-button2').text() == "Lire plus") {
//         jQuery(this).text("Lire moins")
//     } else {
//         jQuery(this).text("Lire plus")
//     }
//   });
jQuery(document).ready(function($) {
jQuery('.newton-main-popup').hide();
jQuery('.address-detail-map').hide();
jQuery('.map-add-details').hide();


// jQuery('.nw-inner-circle').click(function(){
//     jQuery(this).parent().prev().show();
// });

jQuery('.close-popup').click(function() {
    jQuery('.newton-main-popup').hide();
});


// jQuery('a.prev-newton').on('click', function(e) {
//     // Prevent the default behavior of the link
//     console.log('test');
//     e.preventDefault();
    
//     // Trigger the slick slider to go to the next slide
//     jQuery("img.prevarrow-icon-adress.slick-arrow").trigger("click");
// });

// jQuery('a.prev-newton').on('click', function(e) {
//     // Prevent the default behavior of the link
//     console.log('test');
//     e.preventDefault();
    
//     // Trigger the slick slider to go to the next slide
//     jQuery("img.prevarrow-icon-adress.slick-arrow").trigger("click");
// });

    });
  
    
  
   
        
    