<?php
add_shortcode('wooocommerce_feture', 'woocommerce_feature_shortcode');

function woocommerce_feature_shortcode() {
    ob_start();
    ?>
    <div class="fit-products-ctm">
        <ul>
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 6,
                'orderby'        => 'rand',
				'meta_query' => array(
					array(
						'key' => '_featured_post',
						'value' => 'on',
					),
				),
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    global $product;
                    ?>
                    <li class="fit-product-main">
                        <a href="<?php the_permalink(); ?>">
                            <div class="fit-pro-outer">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </a>
                        <div class="fit-details-inner">
                            <h2 class="fit-product-title"><?php the_title(); ?></h2>

                            <?php
                            if ($product->is_type('variable')) {
								echo "vaariableProduct";
                                echo '<form class="cart" method="post" enctype="multipart/form-data">';
                                echo '<label for="variation-dropdown-' . $product->get_id() . '">Choose a Variation:</label>';
                                echo '<select name="variation_id" id="' . $product->get_id() . '" class="variation-dropdown">';
                                $variations = $product->get_available_variations();

                                foreach ($variations as $variation) {
                                    $variation_attributes = wc_get_formatted_variation($variation['attributes']);
                                    echo '<option value="' . $variation['variation_id'] . '">' . $variation_attributes . '</option>';
                                }

                                echo '</select>';
                                echo '</form>';
                            }else{
								
							}
                            ?>

                            <?php if ($average = $product->get_average_rating()) : ?>
                                <?php echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . __('out of 5', 'woocommerce') . '</span></div>'; ?>
                            <?php endif; ?>

                            <span class="price">
                                <?php
                                $regular_price = $product->get_regular_price();
                                $sale_price = $product->get_price();

                                if ($product->is_type('variable')) {
                                    $variation_ids = $product->get_children(); 
                                    $prices = array();

                                    foreach ($variation_ids as $variation_id) {
                                        $variation = wc_get_product($variation_id);
                                        $variation_regular_price = $variation->get_regular_price();
                                        $variation_sale_price = $variation->get_price();

                                        if ($variation_sale_price) {
                                            $prices[] = $variation_sale_price;
                                        } elseif ($variation_regular_price) {
                                            $prices[] = $variation_regular_price;
                                        }
                                    }

                                    if (!empty($prices)) {
                                        $min_price = min($prices);
                                        $max_price = max($prices);

                                        if ($min_price === $max_price) {
                                            echo '<b>' . wc_price($min_price) . '</b>';
                                        } else {
                                            echo '<b>' . wc_price($min_price) . ' - ' . wc_price($max_price) . '</b>';
                                        }
                                    }
                                } else if ($product->is_type('simple')) {
                                    if ($sale_price === $regular_price) {
                                        echo '<b>' . wc_price($regular_price) . '</b>';
                                    } else {
                                        echo '<del class="fit-currency">' . wc_price($regular_price) . '</del> ' . wc_price($sale_price);
                                    }
                                } elseif ($regular_price) {
                                    echo '<b>' . wc_price($regular_price) . '</b>';
                                } elseif ($sale_price) {
                                    echo '<b>' . wc_price($sale_price) . '</b>';
                                }
                                ?>
                            </span>
                        </div>

                        <?php
                        $pid = $product->get_id();
                        ?>
                        <a href="#" class="fit-add-to-cart-ctm" data-productid="<?php echo $pid ?>">Add to cart</a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo 'No featured products found';
            endif;
            ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

function add_featured_meta_box()
{
    add_meta_box(
        'featured-meta-box',
        'Featured Post',
        'featured_meta_box_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_featured_meta_box');

function featured_meta_box_callback($post)
{
    $featured = get_post_meta($post->ID, '_featured_post', true);
?>
    <label for="featured-post">
        <input type="checkbox" name="featured-post" id="featured-post" <?php checked($featured, 'on'); ?> />
        Mark this post as featured
    </label>
<?php
}

function save_featured_post_meta($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if (isset($_POST['featured-post'])) {
        update_post_meta($post_id, '_featured_post', 'on');
    } else {
        delete_post_meta($post_id, '_featured_post');
    }
}
add_action('save_post', 'save_featured_post_meta');

// Add custom column to post listing
function add_featured_column($columns)
{
    $columns['featured_post'] = 'Featured Post';
    return $columns;
}
add_filter('manage_posts_columns', 'add_featured_column');

// Populate the custom column with the editable featured post status
function display_featured_column($column, $post_id)
{
    if ($column === 'featured_post') {
        $featured = get_post_meta($post_id, '_featured_post', true);
        $star_icon = ($featured === 'on') ? 'fas fa-star' : 'far fa-star';

        echo '<span class="featured-star ' . esc_attr($star_icon) . '" data-post-id="' . esc_attr($post_id) . '"></span>';
    }
}
add_action('manage_posts_custom_column', 'display_featured_column', 10, 2);

// Add JavaScript to handle the star icon click event and update post meta
function featured_column_js()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('.featured-star').on('click', function() {
                var post_id = jQuery(this).data('post-id');
                var featured = jQuery(this).hasClass('fas fa-star') ? 'off' : 'on';

				jQuery.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'update_featured_status',
                        post_id: post_id,
                        featured: featured,
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
<?php
}
add_action('admin_footer', 'featured_column_js');

// Ajax handler to update post meta when star icon is clicked
function update_featured_status()
{
    $post_id = $_POST['post_id'];
    $featured = $_POST['featured'];

    // For Multiple Featured Post  
   
            if ($featured === 'on') {
                update_post_meta($post_id, '_featured_post', 'on');
            } else {
                delete_post_meta($post_id, '_featured_post');
            }
   

    //For Single Featured Post 
    // if ($featured === 'on') {
    //     // Remove featured status from all posts
    //     $args = array(
    //         'post_type' => 'product',
    //         'meta_key' => '_featured_post',
    //     );

    //     $featured_posts = get_posts($args);

    //     foreach ($featured_posts as $post) {
    //         delete_post_meta($post->ID, '_featured_post');
    //     }

    //     // Set the selected post as featured
    //     update_post_meta($post_id, '_featured_post', 'on');
    // } else {
    //     // Remove featured status from the selected post
    //     delete_post_meta($post_id, '_featured_post');
    // }

    die();
}
add_action('wp_ajax_update_featured_status', 'update_featured_status');

function enqueue_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('admin_enqueue_scripts', 'enqueue_font_awesome');



function ajaxaddtocart()
{
?>
   <script type="text/javascript">
       jQuery('.fit-add-to-cart-ctm').click(function (e) {
		e.preventDefault();
		console.log("test");
           // var product_id = jQuery(this).data('product-id');
           //var product_id = jQuery(this).data('product-id');
           var variation_id =jQuery(this).prev().find('select.variation-dropdown').val();
		   var p_id =jQuery(this).prev().find('select.variation-dropdown').attr("id");
		   var s_id = jQuery(this).data('productid');
		   console.log(variation_id);
		   console.log(s_id);
        //    var variation_id = selectedOption.val();
          
          // var product_id =jQuery(this).attr('data');
         
			jQuery.ajax({
				    url: '<?=site_url()?>/wp-admin/admin-ajax.php',
                    type: 'POST',
                    data: {
						action: 'load_variation_data',
                        variation_id: variation_id,
						p_id: p_id,
						s_id :s_id,
					
                    },
                    success: function(response) {
                    window.location.href = '/newton/cart';
                    }
                });
        });
    </script>
<?php
}
add_action('wp_footer', 'ajaxaddtocart');

function load_variation_data() {
    if (isset($_POST['variation_id']) && isset($_POST['p_id'])) {
        WC()->cart->add_to_cart($_POST['p_id'], 1, $_POST['variation_id']);
        $cart_url = wc_get_cart_url();
        echo esc_url($cart_url);
    }else{
		
		WC()->cart->add_to_cart($_POST['s_id'], 1);
	}
    exit();
}
add_action('wp_ajax_load_variation_data', 'load_variation_data');
add_action('wp_ajax_nopriv_load_variation_data', 'load_variation_data');

?>