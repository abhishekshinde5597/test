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
add_action('wp_ajax_custom_csv_upload', 'custom_csv_upload_handler');v