<?php
function search_by_title_only($search, $wp_query) {
    global $wpdb;

    if (!empty($search) && !empty($wp_query->query_vars['search_terms'])) {
        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';

        $search_terms = array_map(function($term) use ($wpdb, $n) {
            return $wpdb->prepare("$wpdb->posts.post_title LIKE %s", $n . $wpdb->esc_like($term) . $n);
        }, (array) $q['search_terms']);

        $search = ' AND (' . implode(' AND ', $search_terms) . ')';
    }

    return $search;
}
add_filter('posts_search', 'search_by_title_only', 10, 2);

// AJAX: Load Projects with Filtering
function ajax_filter_projects() {
    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => 6,
        'paged'          => $_POST['page'] ?? 1,
    );

    // Handle search (Title-only)
    if (!empty($_POST['search'])) {
        $args['s'] = sanitize_text_field($_POST['search']);
    }

    // Handle taxonomy filters
    $taxonomies = [
        'filter_project_type' => 'project_type',
        'filter_city'         => 'city',
        'filter_project_cat'  => 'project_cat'
    ];

    foreach ($taxonomies as $post_key => $taxonomy) {
        if (!empty($_POST[$post_key])) {
            $args['tax_query'][] = [
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => explode(',', sanitize_text_field($_POST[$post_key])),
            ];
        }
    }

    $query = new WP_Query($args);

    remove_filter('posts_search', 'search_by_title_only', 10); // Remove filter after search

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
