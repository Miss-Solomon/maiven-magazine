<?php
/**
 * Template Name: Magazine Homepage (Native)
 * Description: A homepage template that uses native WordPress functions instead of Elementor
 *
 * @package maiven
 */

get_header();
?>

<div class="maiven-magazine-homepage">
    <div class="container">
        <!-- Featured Posts Section -->
        <section class="featured-posts-section">
            <h2 class="section-title"><?php echo esc_html__('Featured Posts', 'maiven'); ?></h2>
            <?php
            // Display featured posts in default layout
            maiven_display_featured_posts(
                array(
                    'posts_per_page' => 3,
                    'category_name' => 'featured', // Optional: Can use a designated category for featured posts
                ),
                'default'
            );
            ?>
        </section>

        <!-- Latest Posts Section -->
        <section class="latest-posts-section">
            <h2 class="section-title"><?php echo esc_html__('Latest Articles', 'maiven'); ?></h2>
            <?php
            // Display latest posts in a 3-column grid
            maiven_display_post_grid(
                array(
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ),
                '3', // 3 columns
                true, // show excerpt
                true, // show meta
                true  // show thumbnail
            );
            ?>
        </section>

        <!-- Category Sections -->
        <?php
        // Get some popular categories
        $categories = get_categories(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 3,
            'hide_empty' => true,
        ));

        // Display a section for each popular category
        foreach ($categories as $category) :
        ?>
            <section class="category-posts-section">
                <h2 class="section-title">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </h2>
                <?php
                // Display category posts in a 3-column grid
                maiven_display_post_grid(
                    array(
                        'posts_per_page' => 3,
                        'cat' => $category->term_id,
                    ),
                    '3', // 3 columns
                    false, // don't show excerpt
                    true,  // show meta
                    true   // show thumbnail
                );
                ?>
                <div class="category-link-more">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="btn-view-more">
                        <?php echo esc_html__('View More', 'maiven'); ?>
                    </a>
                </div>
            </section>
        <?php endforeach; ?>

        <!-- You can add more sections here as needed -->
    </div>
</div>

<?php
get_footer();
