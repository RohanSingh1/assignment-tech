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
        <div class="project-info expanded">
            <p>Elevate develops new models for transforming school systems, deepening partnerships between EL and school districts and networks around the nation.</p>
            <em>See our progress on <strong>systems change</strong>.</em>
            <button class="cta-button">Shorter CTA Text</button>
            <button class="close-button"><?php read_more_icon(); ?></button>
        </div>

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
            <a href="<?php echo esc_url($download); ?>">Download our campaign deck to learn more 📥</a>
        </div>
    <?php endif; ?>
    </div>
</section>
