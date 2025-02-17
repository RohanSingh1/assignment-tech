<?php
// Register Custom Post Type: Project
function register_project_post_type() {
    $args = array(
        'labels'       => array(
            'name'          => 'Projects',
            'singular_name' => 'Project'
        ),
        'public'       => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'projects'),
    );
    register_post_type('project', $args);
}
add_action('init', 'register_project_post_type');

// Register Taxonomies: Project Type, City, Project Category
function register_project_taxonomies() {
    $taxonomies = array(
        'project_type' => 'Project Type',
        'city'         => 'City',
        'project_cat'  => 'Project Category',
    );

    foreach ($taxonomies as $slug => $name) {
        register_taxonomy($slug, 'project', array(
            'label'             => $name,
            'hierarchical'      => true,
            'public'            => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => $slug),
        ));
    }
}
add_action('init', 'register_project_taxonomies');