//Article  post filter same resources
function category_ajax_post_filter_shortcodes_for_article() {
  ob_start();
  ?>
  <div class="join-div">
  <?php
    $categories = get_terms('category');
    ?>
    <span class="category-filter-post">Categories</span>
    <div class="button-group">
      <!-- Button for "All Categories" -->
      <button class="category-button active" data-category="">Tout afficher</button>

      <!-- Buttons for each category -->
      <?php foreach ($categories as $categoryi) { ?>
          <button class="category-button" data-category="<?php echo $categoryi->slug; ?>">
              <?php echo $categoryi->name; ?>
          </button>
      <?php } ?>
      
        <select id="category-filter">
            <option value="">Ville </option>
            <?php
            $categories = get_terms('city');
                foreach ($categories as $category) {
                  echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }	
            ?>
        </select>
      
    </div>
    

    
    
  </div>
<!-- <div id="pagination"></div> -->
  <input type="hidden" id="currentPage" value="1">
  <div id="post-container-article">

  <?php
     $args = array(
   'post_type' => 'post',
   'posts_per_page' => 9,
   'order' => 'DESC',
   'paged' => 1,
      );

  $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1; // Get the current page number
  $query = new WP_Query($args);
 if ($query->have_posts()) {
      echo '<div class="resource-post-type">';
      while ($query->have_posts()) {
          $query->the_post();
          echo '<div class="resource-post-type-item">';
                if (has_post_thumbnail()) {
                    echo '<div class="resource-post-type-thumbnail"><a href="' . get_permalink() . '">';
                    the_post_thumbnail();
                    echo '</a></div>';
                }
                echo'<div class="category-main">';
                  echo'<div class="category-city">';
                      global $post;
                      $categories = get_the_terms( $post->ID, 'category' );
                      //print_r($categories);
                      
                      if (!empty($categories)) {
                      foreach ($categories as $category) {
                      $category_name = esc_html($category->name); // Get the name of each category
                      echo'<h3 class="resource-post-type-resource_category"><a href="' . esc_url(get_category_link($category->term_id)) . '"><img class="dot-icon" src="/wp-content/uploads/2023/08/Ellipse-92.svg"><p>' . $category_name . '</p></a></h3>';
                      }
                      }
                      $categories = get_the_terms( $post->ID, 'city' );
                      //print_r($categories);
                      if (!empty($categories)) {
                      foreach ($categories as $category) {
                      $category_name = esc_html($category->name); // Get the name of each category
                      echo'<h3 class="resource-post-type-resource_city"><a href="' . esc_url(get_category_link($category->term_id)) . '"><img class="dot-icon" src="/wp-content/uploads/2023/08/Ellipse-92.svg"><p>' . $category_name . '</p></a></h3>';
                      }
                      }
                  echo'</div>';
                    echo'<div class="title-dec">';
                      echo '<div class="resource-post-type-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                      echo '<div class="resource-post-type-description"><a href="">' .custom_excerpt(get_the_excerpt(),4). '</a></div>';
                    echo'</div>';  
                echo'</div>';  
          echo '</div>';
      }
      echo '</div>';
  


  $total_pages = $query->max_num_pages;
  
  if ($total_pages > 1) {
    echo '<div class="pagination">';
    global $wp_query;
          $big = 999999999; // need an unlikely integer

          echo paginate_links( array(
          'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
         'current' => $paged,
     'prev_text'    => __('<img src="/wp-content/uploads/2023/08/Polygon-3.svg">'),
         'next_text'    => __('<img src="/wp-content/uploads/2023/08/Polygon-3.svg">'),
     'prev_next'   => TRUE,
         'total'   => $query->max_num_pages
          ) );
    
    // for ($i = 1; $i <= $total_pages; $i++) {
    // 	$active_class = ($i === $paged) ? ' active' : '';
    // 	echo '<a href="#" class="page-link' . $active_class . '" data-page="' . $i . '">' . $i . '</a>';
    // }
    echo '</div>';
    
  }
      wp_reset_postdata();
} else {
  echo '<p>No posts found.</p>';
}
?>
</div>
  <?php
  return ob_get_clean();
}
add_shortcode('category_ajax_post_filter_shortcodes_for_article', 'category_ajax_post_filter_shortcodes_for_article');


function category_filter_posts_ajax_handler_article() {
$category_slug = isset($_POST['category']) ? $_POST['category'] : '';
$categoryValue = isset($_POST['categoryValue']) ? $_POST['categoryValue'] : '';
$currentPage = isset($_POST['currentPage']) ? $_POST['currentPage'] : 1;

$args = array(
  'post_type' => 'post',
  'posts_per_page' => 9,
  'order' => 'DESC',
  'paged' => $currentPage,
);

if ($category_slug) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'city',
      'field' => 'slug',
      'terms' => $category_slug,
    ),
  );
}


if ($categoryValue) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'category',
      'field' => 'slug',
      'terms' => $categoryValue,
    ),
  );
}
$paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
  $query = new WP_Query($args);
  $max_pages = $query->max_num_pages;
  ob_start();
  if ($query->have_posts()) {
      echo '<div class="resource-post-type">';
      while ($query->have_posts()) {
          $query->the_post();
          echo '<div class="resource-post-type-item">';
                  if (has_post_thumbnail()) {
                      echo '<div class="resource-post-type-thumbnail"><a href="' . get_permalink() . '">';
                      the_post_thumbnail();
                      echo '</a></div>';
                  }
                  echo'<div class="category-main">';
                    echo'<div class="category-city">';
                    global $post;
                    $categories = get_the_terms( $post->ID, 'category' );
                    //print_r($categories);
                    if (!empty($categories)) {
                    foreach ($categories as $category) {
                    $category_name = esc_html($category->name); // Get the name of each category
                    echo'<h3 class="resource-post-type-resource_category"><a href="' . esc_url(get_category_link($category->term_id)) . '"><img class="dot-icon" src="/wp-content/uploads/2023/08/Ellipse-92.svg"><p>' . $category_name . '</p></a></h3>';
                    }
                    }
                    $categories = get_the_terms( $post->ID, 'city' );
                    //print_r($categories);
                    if (!empty($categories)) {
                    foreach ($categories as $category) {
                    $category_name = esc_html($category->name); // Get the name of each category
                    echo'<h3 class="resource-post-type-resource_city"><a href="' . esc_url(get_category_link($category->term_id)) . '"><img class="dot-icon" src="/wp-content/uploads/2023/08/Ellipse-92.svg"><p>' . $category_name . '</p></a></h3>';
                    }
                    }
                    echo'</div>';
                    echo'<div class="title-dec">';
                      echo '<div class="resource-post-type-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                      echo '<div class="resource-post-type-description"><a href="">' .custom_excerpt(get_the_excerpt(), 4). '</a></div>';
                    echo '</div>';
                  echo'</div>';   
          echo '</div>';
      }
      echo '</div>';
  $total_pages = $query->max_num_pages;
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  if ($total_pages > 1) {
    echo '<div class="pagination">';
    global $wp_query;
    $big = 999999999; // need an unlikely integer
         echo paginate_links( array(
        'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'current' => $currentPage,
      'prev_text'    => __('<img src="/wp-content/uploads/2023/08/Polygon-3.svg">'),
      'next_text'    => __('<img src="/wp-content/uploads/2023/08/Polygon-3.svg">'),
        'total'   => $query->max_num_pages,
    'prev_next'   => TRUE,
         ) );

        
     
    // for ($i = 1; $i <= $total_pages; $i++) {
    // 	$active_class = ($i === $paged) ? ' active' : '';
    // 	echo '<a href="#" class="page-link' . $active_class . '" data-page="' . $i . '">' . $i . '</a>';
    // }
    echo '</div>';
  }
      wp_reset_query();
} else {
  echo '<p>No posts found.</p>';
}
  $response = ob_get_clean();
  echo $response;
//print_R($response);
  wp_die();
}
add_action('wp_ajax_loadPosts_article', 'category_filter_posts_ajax_handler_article');
add_action('wp_ajax_nopriv_loadPosts_article', 'category_filter_posts_ajax_handler_article');
