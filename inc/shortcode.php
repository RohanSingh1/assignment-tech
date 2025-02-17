<?php
function project_filter_shortcode() {
    ob_start();
    ?>
    <section class="project-filter-main-wrapper">
        <div class="container">
            <div class="project-filter-wrapper">
                <div class="input-search-wrapper">
                    <input type="text" id="project-search" placeholder="Search Projects">
                </div>
                <div class="filter-list-wrapper">
                    <select id="filter-project-type">
                        <option value="">Project Type</option>
                        <?php
                        $types = get_terms(['taxonomy' => 'project_type', 'hide_empty' => false]);
                        foreach ($types as $type) {
                            echo "<option value='{$type->slug}'>{$type->name}</option>";
                        }
                        ?>
                    </select>
                    <select id="filter-city">
                        <option value="">City</option>
                        <?php
                        $cities = get_terms(['taxonomy' => 'city', 'hide_empty' => false]);
                        foreach ($cities as $city) {
                            echo "<option value='{$city->slug}'>{$city->name}</option>";
                        }
                        ?>
                    </select>
                    <select id="filter-category">
                        <option value="">Categories</option>
                        <?php
                        $categories = get_terms(['taxonomy' => 'project_cat', 'hide_empty' => false]);
                        foreach ($categories as $category) {
                            echo "<option value='{$category->slug}'>{$category->name}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button id="clear-all">Clear All</button>
            </div>

            <div id="project-results" class="project-grid"></div>

            <button id="load-more" style="display: none;">Load More</button>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('project_filter', 'project_filter_shortcode');
