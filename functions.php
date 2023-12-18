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



function enqueue_custom_script() {
    wp_enqueue_script('test', get_template_directory_uri() . '/js/scipt.js', array('jquery'), '1.0', true);
    $acf_data = array();
    $page_id = 2; 
    $repeater_field = get_field('map', $page_id); 
    print_r($repeater_field);
    if ($repeater_field) {
        foreach ($repeater_field as $row) {
            $acf_data[] = array(
                'name'   => $row['name'],
                'number' => $row['number'],
            );
        }
    }



	
    wp_localize_script('test', 'acf_data', $acf_data); // Corrected script handle
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');



// function enqueue_custom_script() {
//     wp_enqueue_script('test', get_template_directory_uri() . '/js/scipt.js', array('jquery'), '1.0', true);
//     $acf_data = array();
//     $page_id = 2; 
//     $repeater_field = get_field('inner_location', $page_id); 
//     print_r($repeater_field);
//     if ($repeater_field) {
//         foreach ($repeater_field as $row) {
//             $acf_data[] = array(
//                 'Latitude'   => $row['latitude'],
//                 'longitude' => $row['longitude'],
// 				'Country name' => $row['country_name'],
// 				'city name' => $row['city_name'],
//             );
//         }
//     }
//     wp_localize_script('fintech-map', 'acf_data', $acf_data); // Corrected script handle
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_script');

function wpdocs_enqueue_custom_admin_style()
{
    // Ajax JS
    wp_enqueue_script('custom-ajax-js', get_stylesheet_directory_uri() . '/js/custom-ajax.js', array(), (string) time(), true);
    wp_localize_script('custom-ajax-js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');

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





// Add a menu item in the WordPress admin for your custom import page
// function add_custom_import_page() {
//     add_menu_page(
//         'Custom CSV Import',
//         'CSV Import',
//         'manage_options',
//         'custom_csv_import',
//         'custom_import_page_callback'
//     );
// }

// add_action('admin_menu', 'add_custom_import_page');


//**csv import */
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
    <img src="<?php echo site_url() . '/wp-content/uploads/2023/12/slick-loader.gif' ?>" width="20" height="20">
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
                'post_title'   => 0,
                'post_content' => 1,
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


function jacgp_generate_pdf_on_thankyou_page($order_id) {
    // Get the order
    $order = wc_get_order($order_id);

    // Include FPDF library with absolute path
    $theme_dir_path = get_theme_file_path();
    require_once $theme_dir_path . '/fpdf186/fpdf.php';

    // Create PDF object
    $pdf = new FPDF('P', 'mm', 'A3', true, 'UTF-8', false);
    $pdf->AddPage();

    // Header
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetFillColor(150, 150, 255);
    $pdf->Cell(0, 10, 'Styled List', 0, 1, 'C', true);
    $pdf->SetFillColor(255, 255, 255);

    // Get user's first name
    $user_first_name = $order->get_billing_first_name();

    // List items with user's first name
    $listItems = [
        'Dear ' . $user_first_name . ',',
        'Thank you for choosing our store. If you have any questions, please contact us at support@example.com.'
    ];

    // Set font for the list items
    $pdf->SetFont('Arial', '', 12);

    foreach ($listItems as $item) {
        $pdf->Ln(10); // Add spacing
        $pdf->MultiCell(0, 10, utf8_decode($item), 0, 'L');
    }

    // Output the PDF content
    $pdf_content = $pdf->Output('S');

    // Output the PDF
    $pdf_filename = 'order_' . $order_id . '_receipt.pdf';
    $pdf->Output($pdf_filename, 'F'); // Save the PDF to a file

    // Send email to user
    $user_email = $order->get_billing_email();
    $subject = 'Your Order Receipt';
    $message = 'Thank you, ' . $user_first_name . ', for your order! Please find your receipt attached.';
    $headers = 'Content-Type: text/html; charset=UTF-8';

    $attachments = array(WP_CONTENT_DIR . '/uploads/csv' . $pdf_filename);

    // Attempt to send the email
    $email_sent_to_user = wp_mail($user_email, $subject, $message, $headers, $attachments);

    // Send email to admin
    $admin_email = get_option('admin_email');
    $email_sent_to_admin = wp_mail($admin_email, $subject, $message, $headers, $attachments);

    // Check if both emails were sent successfully
    if ($email_sent_to_user && $email_sent_to_admin) {
        // Emails were sent successfully
        error_log('Emails were sent successfully.');
    } else {
        // Emails failed to send
        error_log('Failed to send emails.');
    }
}
add_action('woocommerce_thankyou', 'jacgp_generate_pdf_on_thankyou_page', 10, 1);




add_shortcode('wooocommerce_feture', 'woocommerce_feature_shortcode');

function woocommerce_feature_shortcode(){
    ob_start(); // Start output buffering
    ?>
    <div class="fit-products-ctm">
        <ul>
            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 5,
                'post__in'       => wc_get_featured_product_ids(),
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
                            <div class="fit-details-inner">
                                <h2 class="fit-product-title"><?php the_title(); ?></h2>
                                <div class="star-rating" role="img" aria-label="Rated <?php echo esc_attr($product->get_average_rating()); ?> out of 5">
                                    <?php
                                    $rating = $product->get_average_rating();
                                    $max_rating = 5;
                                    for ($i = 1; $i <= $rating; $i++) {
                                        echo '<span class="dashicons dashicons-star-filled"></span>';
									}
                                    ?>
                                    
                                </div>
                                <span class="price">
                                    <?php
                                    echo '<span class="fit-Price-amount amount"><bdi><span class="fit-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>' . get_post_meta(get_the_ID(), '_price', true) . '</bdi></span>';
                                    ?>
                                </span>
                            </div>
                        </a>
						<?php
						global $product;
                        $pid = $product->get_id();
                        ?>
                        <a href="<?php echo do_shortcode( '[add_to_cart_url id=' . $pid . ']' ) ?>" class="fit-add-to-cart-ctm">Add to cart</a>
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
