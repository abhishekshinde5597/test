<?php
function our_team_shortcode($atts) {
    ob_start();
    $args = array(
        'post_type'      => $atts['post_type'],
        'posts_per_page' => -1,
        'order'          => $atts['order'],
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
        foreach($allPostData as $post){
            $class =  has_term('board-of-directors','team_category', $post->ID ) ? "board-of-directors" : '';
            ?>
            <div class="teammember-post-type-item">
                <?php if (has_post_thumbnail($post->ID) && !has_term('board-of-directors','team_category', $post->ID )) { ?>
                 
                    <figure class="teammember-post-type-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo $post->post_title; ?>">
                    </figure>
               
                <?php } ?>
                  
                <div class="teammember-content-wrapper <?php echo $class; ?>">
                    <div class="teammember-post-type-title"><?php echo $post->post_title; ?></div>
                    <div class="teammember-post-type-content"><?php echo $post->post_excerpt; ?></div>
                    <?php $designation = get_field('designation',$post->ID); ?>
                    <?php if(!empty($designation)){ ?>
                    <div class="teammember-post-type-designation"><?php echo $designation?></div>
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

?>