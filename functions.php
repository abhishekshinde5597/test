<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category' ),
				'description' => __( 'A collection of full page layouts.' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );


add_shortcode('audio','audio');
function audio(){
	ob_start();
	?>
	<div> 
	<?php
    $track = get_field('audio');
	?>
	
<span class="audio-player">
<a class="audio-trigger tertiary-btn media-btn" href="javascript:;">test</a>
<audio class="audio-src" preload="auto">
<source src="<?php echo $track; ?>" type="audio/mpeg">
</audio>
</span>
    </div>
	<?php
	return ob_get_clean();
}


// function remove_yoast_schema_from_specific_page( $bool, $context ) {
//     // Check if the current page is the specific page where you want to remove schema.org markup
//     if ( is_page( 'sample-page' ) ) {
//         return false; // Return false to remove schema.org markup
//     }

//     // For other pages, maintain the original behavior
//     return $bool;
// }

// // // Add the filter
// add_filter( 'wpseo_json_ld_output', 'remove_yoast_schema_from_specific_page', 10, 2 );


// Remove Yoast SEO schema on single product page

add_filter('wpseo_schema_graph', 'change_image_urls_to_cdn', 10, 2);


function change_image_urls_to_cdn($data, $context) {
    foreach ($data as $key => $value) {
        if ($value['@type'] === 'Product') {
            // Check if 'contentUrl' key exists before attempting to replace
            if (isset($value['contentUrl'])) {
                $data[$key]['contentUrl'] = str_replace(
                    'http://localhost/job/product/test/',
                    'https://cdn.domain.tld/',
                    $value['contentUrl']
                );
            }
        }
    }

    return $data;
}



// function enqueue_custom_script() {
//     wp_enqueue_script('test', get_template_directory_uri() . '/js/scipt.js', array('jquery'), '1.0', true);
//     $acf_data = array();
//     $page_id = 2; 
//     $repeater_field = get_field('map', $page_id); 
//     //print_r($repeater_field);
//     if ($repeater_field) {
//         foreach ($repeater_field as $row) {
//             $acf_data[] = array(
//                 'name'   => $row['name'],
//                 'number' => $row['number'],
//             );
//         }
//     }



	
//     wp_localize_script('test', 'acf_data', $acf_data); // Corrected script handle
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_script');



function enqueue_custom_scripts() {
    wp_enqueue_script('test', get_template_directory_uri() . '/js/scipt.js', array('jquery'), '1.0', true);
    $acf_data = array();
    $page_id = 2; 
    $repeater_field = get_field('inner_location', $page_id); 
    print_r($repeater_field);
    if ($repeater_field) {
        foreach ($repeater_field as $row) {
            $acf_data[] = array(
                'Latitude'   => $row['latitude'],
                'longitude' => $row['longitude'],
				'Country name' => $row['country_name'],
				'city name' => $row['city_name'],
            );
        }
    }
    wp_localize_script('fintech-map', 'acf_data', $acf_data); // Corrected script handle
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function wpdocs_enqueue_custom_admin_style()
{
    // Ajax JS
    wp_enqueue_script('custom-ajax-js', get_template_directory_uri() . '/js/custom-ajax.js', array(), (string) time(), true);
    wp_enqueue_style( 'slick-css', get_template_directory_uri().'/css/slick.css', array(), (string) time(), '' );
	wp_enqueue_style( 'slick-theme-css', get_template_directory_uri().'/css/slick-theme.css', array(), (string) time(), '' );
	wp_enqueue_script( 'slick-js', get_template_directory_uri().'/js/slick.js?rand='.rand(1,100), array( 'jquery' ), false, true );
    wp_enqueue_style( 'customcss', get_template_directory_uri() . '/css/custom.css', array(), (string) time(), 'all' );
    wp_enqueue_style( 'custom2css', get_template_directory_uri() . '/css/custom2.css', array(), (string) time(), 'all' );
    wp_enqueue_style( 'circle-slider', get_template_directory_uri() . '/css/circle-slider.css', array(), (string) time(), 'all' );
    wp_enqueue_style( 'homecss', get_template_directory_uri() . '/css/home.css', array(), (string) time(), 'all' );
    wp_enqueue_style( 'recrutementcss', get_template_directory_uri() . '/css/recrutement.css', array(), (string) time(), 'all' );
    
   
	//wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/script.js', array(), (string) time(),'true' );  
    wp_localize_script('custom-ajax-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');

function enqueue_google_maps() {
    wp_register_script('googlemaps', 'https://maps.google.com/maps/api/js?key=AIzaSyBmCVKuABjI7DdLXsbgBEuawpENL1quaI8', array(), '', true);
    wp_enqueue_script('googlemaps');
}
add_action('wp_enqueue_scripts', 'enqueue_google_maps');


// Register Custom Post Type
function custom_post_type()
{
    $labels = array(
        'name'                  => _x('Promotional Products', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Promotional Product', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Promotional Products', 'text_domain'),
        'name_admin_bar'        => __('Promotional Product', 'text_domain'),
        'archives'              => __('Item Archives', 'text_domain'),
        'attributes'            => __('Item Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('All Items', 'text_domain'),
        'add_new_item'          => __('Add New Item', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Item', 'text_domain'),
        'edit_item'             => __('Edit Item', 'text_domain'),
        'update_item'           => __('Update Item', 'text_domain'),
        'view_item'             => __('View Item', 'text_domain'),
        'view_items'            => __('View Items', 'text_domain'),
        'search_items'          => __('Search Item', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list'            => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Promotional Product', 'text_domain'),
        'description'           => __('Promotional products description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'page-attributes'),
        'taxonomies'            => array('product_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-products',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('promotional_product', $args);

    // Register Custom Taxonomy for Category
    $taxonomy_labels = array(
        'name'                       => _x('Product Categories', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Product Category', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Product Categories', 'text_domain'),
        'all_items'                  => __('All Categories', 'text_domain'),
        'parent_item'                => __('Parent Category', 'text_domain'),
        'parent_item_colon'          => __('Parent Category:', 'text_domain'),
        'new_item_name'              => __('New Category Name', 'text_domain'),
        'add_new_item'               => __('Add New Category', 'text_domain'),
        'edit_item'                  => __('Edit Category', 'text_domain'),
        'update_item'                => __('Update Category', 'text_domain'),
        'view_item'                  => __('View Category', 'text_domain'),
        'separate_items_with_commas' => __('Separate categories with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove categories', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Categories', 'text_domain'),
        'search_items'               => __('Search Categories', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No categories', 'text_domain'),
        'items_list'                 => __('Categories list', 'text_domain'),
        'items_list_navigation'      => __('Categories list navigation', 'text_domain'),
    );
    $taxonomy_args = array(
        'labels'                     => $taxonomy_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('product_category', array('promotional_product'), $taxonomy_args);
}
add_action('init', 'custom_post_type', 0);







//**csv import */
// function add_custom_import_pages() {
//     add_menu_page(
//         'Custom CSV Import',
//         'CSV Import',
//         'manage_options',
//         'custom_csv_import',
//         'custom_import_page_callback'
//     );
// }

// add_action('admin_menu', 'add_custom_import_pages');
// function custom_import_page_callback() {
//     ?>
<!-- //     <div class="wrap">
//         <h2>Custom CSV Import</h2>
//         <form id="custom-csv-upload-form" enctype="multipart/form-data">
//             <input type="file" name="csv_file" accept=".csv" />
//             <input type="submit" value="Upload" class="button button-primary" />
//         </form>
//         <div id="upload-result"></div>
// 		<div class="spinner-loader" style="display:none; height:20px;">
//     <img src="<?php// echo site_url() . '/wp-content/uploads/2023/12/slick-loader.gif' ?>" width="20" height="20">
// </div>
// </div> -->
//     <script>
//         jQuery(document).ready(function ($) {
//             jQuery('#custom-csv-upload-form').submit(function (e) {
//                 e.preventDefault();
// 				jQuery(".spinner-loader").show();
//                 var formData = new FormData(this);
//                 formData.append('action', 'custom_csv_upload'); 

//                 jQuery.ajax({
//                     type: 'POST',
//                     url: ajaxurl, 
//                     data: formData,
//                     contentType: false,
//                     processData: false,
//                     success: function (response) {
//                         jQuery('#upload-result').html(response);
//                         jQuery(".spinner-loader").hide();
//                     },
//                     error: function (error) {
//                         console.log(error);
//                         jQuery('#upload-result').html('Error occurred during upload.');
//                     }
//                 });
//             });
//         });
//     </script>
//     <?php
// }

// function custom_csv_upload_handler() {
//     if (isset($_FILES['csv_file'])) {
//         $file = $_FILES['csv_file'];

//         // Check for valid CSV file
//         $file_info = wp_check_filetype_and_ext($file['tmp_name'], $file['name']);

//         // Check if file type is CSV
//         if ($file_info['ext'] === 'csv' && $file_info['type'] === 'text/csv') {
          
//             $upload_folder = WP_CONTENT_DIR . '/uploads/csv/';

//             // Check if the folder exists, and create it if not
//             if (!file_exists($upload_folder)) {
//                 mkdir($upload_folder, 0755, true);
//             }

//             $destination_path = $upload_folder . $file['name'];

//             // Move the uploaded file to the destination folder
//             move_uploaded_file($file['tmp_name'], $destination_path);
//             // Read CSV data
//             $csv_data = array_map('str_getcsv', file($destination_path));
//             // Define column name mappings
//             $column_mappings = array(
//                 'post_title'   => 1,
//             );

//             // Create a product for each row in the CSV
//             foreach ($csv_data as $row) {

//                 $existing_post = get_page_by_title($row[$column_mappings['post_title']], OBJECT, 'promotional_product');

//                 // echo"<pre>";
//                 // print_r($existing_post);
//                 // echo"</pre>";

//                 if ($existing_post) {
//                     // If the post exists, update its status to draft
//                     wp_update_post(array(
//                         'ID' => $existing_post->ID,
//                         'post_status' => 'draft',
//                     ));
//                 }
//             }

//             echo 'CSV file uploaded successfully to ' . $destination_path . '<br>';
//             echo 'Product data added to the database.';
//         } else {
//             echo 'Invalid file format. Please upload a valid CSV file.';
//         }
//     } else {
//         echo 'No file uploaded.';
//     }

//     wp_die();
// }
// add_action('wp_ajax_custom_csv_upload', 'custom_csv_upload_handler');


function add_custom_import_pages() {
    add_menu_page(
        'Custom CSV Import',
        'CSV Import',
        'manage_options',
        'custom_csv_import',
        'custom_import_page_callback'
    );
}

add_action('admin_menu', 'add_custom_import_pages');
function custom_import_page_callback() {
    ?>
    <div class="wrap">
        <h2>Custom CSV Import</h2>
        <form id="custom-csv-upload-form" enctype="multipart/form-data">
            <input type="file" name="csv_file" accept=".csv" />
            <input type="submit" value="Upload" class="button button-primary" />
        </form>
        <div id="upload-result"></div>
		<div class="spinner-loader" style="display:none; height:20px;">
    <img src="<?php//echo site_url() . '/wp-content/uploads/2023/12/slick-loader.gif' ?>" width="20" height="20">
</div>
</div>
     <script>
        jQuery(document).ready(function ($) {
            jQuery('#custom-csv-upload-form').submit(function (e) {
                e.preventDefault();
				jQuery(".spinner-loader").show();
                var formData = new FormData(this);
                formData.append('action', 'custom_csv_upload'); 

                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl, 
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        jQuery('#upload-result').html(response);
                        jQuery(".spinner-loader").hide();
                    },
                    error: function (error) {
                        console.log(error);
                        jQuery('#upload-result').html('Error occurred during upload.');
                    }
                });
            });
        });
    </script>
    <?php
}

function custom_csv_upload_handler() {
    if (isset($_FILES['csv_file'])) {
        $file = $_FILES['csv_file'];

        // Check for valid CSV file
        $file_info = wp_check_filetype_and_ext($file['tmp_name'], $file['name']);

        // Check if file type is CSV
        if ($file_info['ext'] === 'csv' && $file_info['type'] === 'text/csv') {
          
            $upload_folder = WP_CONTENT_DIR . '/uploads/csv/';

            // Check if the folder exists, and create it if not
            if (!file_exists($upload_folder)) {
                mkdir($upload_folder, 0755, true);
            }

            $destination_path = $upload_folder . $file['name'];

            // Move the uploaded file to the destination folder
            move_uploaded_file($file['tmp_name'], $destination_path);
            // Read CSV data
            $csv_data = array_map('str_getcsv', file($destination_path));
            // Define column name mappings
            $column_mappings = array(
                'post_title'   => 1,
                'post_content' => "",
                'title'        => 2,
                'description'  => 3,
                'image'        => 4,
                'link'         => 5,
                'content'      => 6,
                'innercontent' => 7,
                'post_image'   => 8,
				'color'        => 9,
				'color picker' => 10,
				
            );

            // Create a product for each row in the CSV
            foreach ($csv_data as $row) {
                $product_data = array(
                    'post_title'   => $row[$column_mappings['post_title']], 
                    'post_content' => $row[$column_mappings['post_content']],
                    'post_status'  => 'publish',
                    'post_type'    => 'promotional_product',
                );
               
                $product_id = wp_insert_post($product_data);

                if ($product_id) {
                    // Update regular fields like text description ,link,title etc
                    foreach (array('title', 'description', 'link', 'content') as $field) {
                        update_post_meta($product_id, $field, $row[$column_mappings[$field]]);
                    }
					require_once(ABSPATH . 'wp-admin/includes/media.php');
					require_once(ABSPATH . 'wp-admin/includes/file.php');
					require_once(ABSPATH . 'wp-admin/includes/image.php');

                    // Update ACF single image field
					$image_url = $row[$column_mappings['image']];
					if (!empty($image_url)) {
						// Get the image data as a string
						$image_data = file_get_contents($image_url);
						if ($image_data !== false) {
							$upload = wp_upload_bits(basename($image_url), null, $image_data);
							if (!$upload['error']) {
								$file_path = $upload['file'];
								$file_name = basename($file_path);
								
								$attachment = array(
									'post_mime_type' => wp_check_filetype($file_name)['type'],
									'post_title'     => preg_replace('/\.[^.]+$/', '', $file_name),
									'post_content'   => '',
									'post_status'    => 'inherit'
								);
								$attachment_id = wp_insert_attachment($attachment, $file_path, $product_id);
								require_once(ABSPATH . 'wp-admin/includes/image.php');
								$attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
								wp_update_attachment_metadata($attachment_id, $attachment_data);
								
								// Update the ACF image field with the attachment ID
								update_field('postimage', $attachment_id, $product_id);
							} else {
								// Handle error uploading image to the media library
								//echo 'Error uploading image to media library: ' . $upload['error'];
							}
						} else {
							// Handle error fetching the image data
							//echo 'Error fetching image data from URL: ' . $image_url;
						}
					}
                     

		
						//**  Update repeater field for images*/
						if (!empty($row[$column_mappings['post_image']])) {
							$repeater_image = $row[$column_mappings['post_image']];
						
							// Check if the repeater field exists and is not empty
							if ($repeater_image) {
								$repeater_images = array();
								$image_urls = explode(',', $repeater_image);
								
								foreach ($image_urls as $image_url) {
									$image_data = file_get_contents($image_url);
						
									if ($image_data !== false) {
										$upload = wp_upload_bits(basename($image_url), null, $image_data);
						
										if (!$upload['error']) {
											$file_path = $upload['file'];
											$file_name = basename($file_path);
						
											$attachment = array(
												'post_mime_type' => wp_check_filetype($file_name)['type'],
												'post_title'     => preg_replace('/\.[^.]+$/', '', $file_name),
												'post_content'   => '',
												'post_status'    => 'inherit'
											);
						
											$attachment_id = wp_insert_attachment($attachment, $file_path, $product_id);
						
											if (!is_wp_error($attachment_id)) {
												require_once(ABSPATH . 'wp-admin/includes/image.php');
												$attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
												wp_update_attachment_metadata($attachment_id, $attachment_data);
						
												// Add the attachment ID to the repeater array
												$repeater_images[] = $attachment_id;
											} else {
												// Handle error inserting attachment
												echo 'Error inserting attachment: ' . $attachment_id->get_error_message();
											}
										} else {
											// Handle error uploading image to the media library
											echo 'Error uploading image to media library: ' . $upload['error'];
										}
									}
								}
						
								// Update ACF repeater field with the accumulated attachment IDs
								$repeater_data = array();
								foreach ($repeater_images as $img) {
									$repeater_item = array(
										'post_image11' => $img,
									);
									$repeater_data[] = $repeater_item;
								}
								// Update ACF repeater field
								update_field('image', $repeater_data, $product_id);
							} else {
								// Repeater field is empty, update ACF repeater field with blank value
								update_field('image', array(), $product_id);
							}
						}


						
                    /*Update repeater field for content*/
                    if (!empty($row[$column_mappings['innercontent']])) {
                        $repeater_data = array();
                        $repeater_rows = explode(',', $row[$column_mappings['innercontent']]);
                        foreach ($repeater_rows as $repeater_row) {
                            $repeater_item = array(
                                'innercontent' => $repeater_row,
                            );
                            $repeater_data[] = $repeater_item;
                        }
                        update_field('repeter_content', $repeater_data, $product_id);
                    }
                    
                   //**Update checkbox field */
					if (!empty($row[$column_mappings['color']])) {
						$checkbox_values = explode(',', $row[$column_mappings['color']]);
					   update_field('color', $checkbox_values, $product_id);
					}
                    
					//update color picker field
					if (!empty($row[$column_mappings['color picker']])) {
						$color_picker_values = explode(',', $row[$column_mappings['color picker']]);
					   update_field('color_picker', $color_picker_values, $product_id);
					}
                    
                }
            }

            echo 'CSV file uploaded successfully to ' . $destination_path . '<br>';
            echo 'Product data added to the database.';
        } else {
            echo 'Invalid file format. Please upload a valid CSV file.';
        }
    } else {
        echo 'No file uploaded.';
    }

    wp_die();
}
add_action('wp_ajax_custom_csv_upload', 'custom_csv_upload_handler');


function count_immebules()
{
    ob_start();
    $args = array(
        'post_type' => 'country',
        'posts_per_page' => -1,
    );
    $immebules = new WP_Query($args);
    $total_repeater_fields_count = 0;
    if ($immebules->have_posts()) {
        while ($immebules->have_posts()) {
            $immebules->the_post();
            $repeater_field = get_field('repeter_content');
            $count = $repeater_field ? count($repeater_field) : 0;

            // Increment total count
            $total_repeater_fields_count += $count;
        }
        echo '<p>' . $total_repeater_fields_count . 'IMMEUBLES</p>';
        wp_reset_postdata();
    } else {
        echo 'No Villes found.';
    }
    return ob_get_clean();
}
add_shortcode('count_immebules', 'count_immebules');



function custom_our_team_post_type() {
    $labels = array(
        'name'               => _x( 'Our Team', 'Post Type General Name', 'text_domain' ),
        'singular_name'      => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'          => __( 'Our Team', 'text_domain' ),
        'all_items'          => __( 'All Team Members', 'text_domain' ),
        'view_item'          => __( 'View Team Member', 'text_domain' ),
        'add_new_item'       => __( 'Add New Team Member', 'text_domain' ),
        'add_new'            => __( 'Add New', 'text_domain' ),
        'edit_item'          => __( 'Edit Team Member', 'text_domain' ),
        'update_item'        => __( 'Update Team Member', 'text_domain' ),
        'search_items'       => __( 'Search Team Members', 'text_domain' ),
        'not_found'          => __( 'Not Found', 'text_domain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
    );

    $args = array(
        'label'               => __( 'our_team', 'text_domain' ),
        'description'         => __( 'Our Team Members', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields','excerpt' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true, // Enable Gutenberg editor support
    );

    register_post_type( 'our_team', $args );
    
    $labels = array(
        'name'                       => _x( 'Team Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Team Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Team Categories', 'text_domain' ),
        'all_items'                  => __( 'All Categories', 'text_domain' ),
        'parent_item'                => __( 'Parent Category', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
        'new_item_name'              => __( 'New Category Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Category', 'text_domain' ),
        'edit_item'                  => __( 'Edit Category', 'text_domain' ),
        'update_item'                => __( 'Update Category', 'text_domain' ),
        'view_item'                  => __( 'View Category', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Categories', 'text_domain' ),
        'search_items'               => __( 'Search Categories', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No categories', 'text_domain' ),
        'items_list'                 => __( 'Categories list', 'text_domain' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    register_taxonomy( 'team_category', array( 'our_team' ), $args );
}

add_action( 'init', 'custom_our_team_post_type', 0 );


function our_team_shortcode($atts) {
    ob_start();

    $args = array(
        'post_type'      => isset($atts['post_type']) ? $atts['post_type'] : 'team_member',
        'posts_per_page' => -1,
        'order'          => isset($atts['order']) ? $atts['order'] : 'ASC',
        'tax_query'      => array(),
    );

    // Check if a category is specified
    if (!empty($atts['category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'team_category',
            'field'    => 'slug',
            'terms'    => $atts['category'],
        );
    }

    $teammembers = new WP_Query($args);

    if ($teammembers->have_posts()) {
        $allPostData = $teammembers->posts;
        echo '<div class="teammember-post-main">';
        foreach ($allPostData as $post) {
            $class = has_term('board-of-directors', 'team_category', $post->ID) ? "board-of-directors" : '';
            ?>
            <div class="teammember-post-type-item">
                <?php if (has_post_thumbnail($post->ID) && !has_term('board-of-directors', 'team_category', $post->ID)) { ?>
                    <figure class="teammember-post-type-thumbnail">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($post->ID)); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                    </figure>
                <?php } ?>

                <div class="teammember-content-wrapper <?php echo esc_attr($class); ?>">
                    <div class="teammember-post-type-title"><?php echo esc_html($post->post_title); ?></div>
                    <div class="teammember-post-type-content"><?php echo esc_html($post->post_excerpt); ?></div>
                    <?php $designation = get_field('designation', $post->ID); ?>
                    <?php if (!empty($designation)) { ?>
                        <div class="teammember-post-type-designation"><?php echo esc_html($designation); ?></div>
                    <?php } ?>

                    <?php $link_array = get_field('url', $post->ID); ?>
                    <?php //print_r($link_array); ?>
                    <?php if (!empty($link_array) && is_array($link_array)) { ?>
                        <a href="<?php echo ($link_array['url']); ?>" target="<?php echo esc_attr($link_array['target']); ?>"><?php echo esc_html($link_array['title']); ?></a>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('our_team', 'our_team_shortcode');


function custom_multi_marker_google_map_shortcode() {
    ob_start(); ?>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmCVKuABjI7DdLXsbgBEuawpENL1quaI8&loading=async&callback=initMap"></script>
    <div id="custom-map" style="height: 400px;"></div>
    <script>
        function initMap() {
            var locations = [
                <?php
                $args = array(
                    'post_type' => 'dealer', // Change to your custom post type
                    'posts_per_page' => -1,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $address_values = get_post_meta(get_the_ID(), '_address', true);
                        $latitude_values = get_post_meta(get_the_ID(), '_latitude', true);
                        $longitude_values = get_post_meta(get_the_ID(), '_longitude', true);

                        if (!empty($address_values) && is_array($address_values) && count($address_values) > 0) {
                            for ($i = 0; $i < count($address_values); $i++) {
                                $address = esc_js($address_values[$i]);
                                $latitude = esc_js($latitude_values[$i]);
                                $longitude = esc_js($longitude_values[$i]);

                                echo "['{$address}', {$latitude}, {$longitude}],";
                            }
                        }
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            ];

            var map = new google.maps.Map(document.getElementById('custom-map'), {
                zoom: 4,
                center: new google.maps.LatLng(37.0902, -95.7129), // Adjust the center of the map as needed
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    title: locations[i][0]
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('map', 'custom_multi_marker_google_map_shortcode');

add_shortcode('dynamic_data', 'dynamicdata');

function dynamicdata() {
    ob_start();
    ?>
    <input type="hidden" id="custId" name="custId" value="">
    <p class="title-value"><?php echo isset($_GET['title']) ? esc_html($_GET['title']) : ''; ?></p>
    <p class="category-value"><?php echo isset($_GET['category']) ? esc_html($_GET['category']) : ''; ?></p>
    <p class="description-value"><?php echo isset($_GET['address']) ? esc_html($_GET['address']) : ''; ?></p>
    <?php
    return ob_get_clean();
}


/**featured product dynamic */
add_shortcode('wooocommerce_feture', 'woocommerce_feature_shortcode');
function woocommerce_feature_shortcode(){
    ob_start();
    ?>
    <div class="fit-products-ctm">
        <ul>
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
				'orderby'        =>   'rand',
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
                    $product_type_class = 'fit-product-' . sanitize_html_class($product->get_type());
                    ?>
                    <li class="fit-product-main <?php echo esc_attr($product_type_class); ?>">
                        <a href="<?php the_permalink(); ?>">
                            <div class="fit-pro-outer">
                                <?php the_post_thumbnail(); ?>
                            </div>
						</a>
                            <div class="fit-details-inner">
                                <h2 class="fit-product-title"><?php the_title(); ?></h2>
								<?php

								if ($product->is_type('variable')) {
								$variations = $product->get_available_variations();
                                //print_r($variations);
								// Check if there are variations
								if (!empty($variations)) {
									echo '<form class="cart fit-cart" method="post" enctype="multipart/form-data">';
									echo '<label for="variation-dropdown-' . $product->get_id() . '"> Choose a Size:</label>';
									echo '<select name="variation_id" id="' . $product->get_id() . '" class="variation-dropdown">';
									foreach ($variations as $variation) {
										echo '<option value="' . $variation['variation_id'] . '">' . $variation['attributes']['attribute_size'] . '</option>';
									}
									echo '</select>';

                                    // echo '<label for="variation-dropdown-' . $product->get_id() . '"> Choose a color:</label>';
									// echo '<select name="variation_id" id="' . $product->get_id() . '" class="variation-dropdown">';
									// foreach ($variations as $variation) {
									// 	echo '<option value="' . $variation['variation_id'] . '">' . $variation['attributes']['attribute_color'] . '</option>';
									// }
									// echo '</select>';
									echo '</form>';
								} else {
									// Display a message or alternative content if there are no variations
									echo '<p class="no-vari">No variations available for this product.</p>';
								}
							}
                            ?>
								<?php if ($average = $product->get_average_rating()) : ?>
                               <?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>'; ?>
                               <?php endif; ?>
							   <?php
							   $p_price = get_post_meta( get_the_ID(), '_price', true );
							   $regularprice =  get_post_meta( get_the_ID(), '_regular_price', true);

							   ?>
								<span class="price">
										<?php
										
										$regular_price = $product->get_regular_price();
											$sale_price = $product->get_price();

											if ($product->is_type('variable')) {
                                    $variation_ids = $product->get_children(); // Get variation IDs
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
													echo '<b>' . $regular_price . '</b>';
												} else {
													echo '<del class="fit-currency" >' . wc_price($regular_price) . '</del> ' . wc_price($sale_price);
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
		   console.log(p_id);
        //    var variation_id = selectedOption.val();
          
          // var product_id =jQuery(this).attr('data');
         
			jQuery.ajax({
				    url: 'http://localhost/job/wp-admin/admin-ajax.php',
                    type: 'POST',
                    data: {
						action: 'load_variation_data',
                        variation_id: variation_id,
						p_id: p_id,
						s_id: s_id
					
                    },
                    success: function(response) {
                    window.location.href = '/cart';
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




add_action('init', 'extract_and_save_names_init');
function extract_and_save_names_init() {
    if (is_admin() && isset($_GET['post'])) {
        $post_id = $_GET['post'];
         $post = get_post($post_id);

        // Check if the post type is your desired post type
        if ('promotional_product' === $post->post_type) {
            // Get the post title
            $title = $post->post_title;

            // Split the title into parts based on the delimiter '/'
            $names = explode('/', $title);

            // Trim whitespace from each part
            $names = array_map('trim', $names);

            // Update custom fields with the extracted names
            if (!empty($names[0])) {
                update_post_meta($post_id, 'chinese_name', $names[0]);
            }

            if (!empty($names[1])) {
                update_post_meta($post_id, 'english_name', $names[1]);
            }
        }
    }
}

