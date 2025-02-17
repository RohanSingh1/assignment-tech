<?php
// AJAX: Load Projects with Filtering
function ajax_filter_projects() {
    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => 6,
        'paged'          => $_POST['page'] ?? 1
    );

    // Handle search
    if (!empty($_POST['search'])) {
        $search_term = sanitize_text_field($_POST['search']);
        $args['s'] = $search_term;

        // Search only in post titles
        add_filter('posts_search', function ($search, $query) use ($search_term) {
            global $wpdb;
            if ($query->is_search() && !is_admin()) {
                $search = " AND {$wpdb->posts}.post_title LIKE '%" . esc_sql($search_term) . "%' ";
            }
            return $search;
        }, 10, 2);
    }

    // Handle taxonomy filters
    foreach (['project_type', 'city', 'project_cat'] as $tax) {
        if (!empty($_POST[$tax])) {
            $args['tax_query'][] = array(
                'taxonomy' => $tax,
                'field'    => 'slug',
                'terms'    => explode(',', sanitize_text_field($_POST[$tax])),
            );
        }
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'project');
        }
    } else {
        echo '<p class="no-project">No projects found.</p>';
    }

    wp_reset_postdata();
    die();
}

add_action('wp_ajax_filter_projects', 'ajax_filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'ajax_filter_projects');