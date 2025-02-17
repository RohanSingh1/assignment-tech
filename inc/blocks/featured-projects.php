<?php
$description = get_field('description'); // WYSIWYG Editor
$caption = get_field('caption'); // Text
$link = get_field('link');
?>
<!-- Featured Projects Block -->
<section class="featured-projects">
    <div class="container">
    <h2>Featured Projects</h2>
    <div class="featured-projects-grid">
        <?php
        // Get the number of posts from the ACF field
        $number_of_posts = get_field('number_of_posts'); // Assuming this is set globally or in the options page

        // Set up the query arguments
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 1, // Default to 1 posts if no number is set
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) :
            while ($query->have_posts()): $query->the_post();
                get_template_part('template-parts/content', 'project');
            endwhile; endif; wp_reset_postdata(); 
        ?>

        <!-- Expanded Project Info -->
        <?php
         // ACF Link Field (Array)

        if ($description || $caption || $link) : ?>
            <div class="project-info expanded">
                <?php if ($description) : ?>
                    <p><?php echo ($description); ?></p>
                <?php endif; ?>

                <?php if ($caption) : ?>
                    <em><?php echo esc_html($caption); ?></em>
                <?php endif; ?>

                <?php if ($link) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" 
                    class="cta-button"
                    target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                        <?php echo esc_html($link['title']); ?>
                    </a>
                <?php endif; ?>
                <button class="close-button"><?php read_more_icon(); ?></button>
            </div>
        <?php endif; ?>


        <?php
        // Get the number of posts from the ACF field
        $number_of_posts = get_field('number_of_posts'); // Assuming this is set globally or in the options page

        // Set up the query arguments
        $args = array(
            'post_type' => 'project',
            'posts_per_page' => 2,
            'offset' => 1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) :
            while ($query->have_posts()): $query->the_post();
                get_template_part('template-parts/content', 'project');
            endwhile; endif; wp_reset_postdata();
        ?>

      
    </div>
    
    <?php if ($download = get_field('download')): ?>
        <div class="campaign-download">
            <a href="<?php echo esc_url($download['url']); ?>">Download our campaign deck to learn more 📥</a>
        </div>
    <?php endif; ?>
    </div>
</section>
