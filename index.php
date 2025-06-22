<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package minerva
 */

$blog_title = minerva_get_option('blog_title', true);
$blog_breadcrumb = minerva_get_option('blog_breadcrumb_enable', true);

get_header();

?>

	<?php if($blog_breadcrumb == true) :?>
    <!-- Blog Breadcrumb -->
    <div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
					<div class="breadcrumb-nav-top blog-breadcrumb-bg">
						<ul>
							<li class="breadcrumb-home-menu"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'minerva'); ?></a></li>
							<li class="breadcrumb-item-menu"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Blog', 'minerva'); ?></a></li>
						</ul>
					</div>
					<h1 class="theme-breacrumb-title">
						<?php esc_html_e('Blog Page', 'minerva'); ?>
					</h1>
				</div>
            </div>
        </div>
    </div>
    <!-- Blog Breadcrumb End -->
	<?php endif; ?>
	
	<section id="main-content" class="blog main-container blog-spacing" role="main">
		<div class="container">
			<div class="row">
				<div class="<?php if(is_active_sidebar('sidebar-1')) { echo "col-xl-9"; } else { echo "col-xl-12";}?> col-lg-12">
					<div class="category-layout-two main-blog-layout blog-new-layout theme-layout-mainn">
					<?php if (have_posts()): ?>
					
						<div class="main-content-inner category-layout-one">
						<?php while (have_posts()): the_post(); ?>
							<?php get_template_part('template-parts/content', get_post_format());?>
						<?php
						endwhile; ?>
						</div>	
						
						<div class="theme-pagination-style">
							<?php
								the_posts_pagination(array(
								'next_text' => '<i class="icofont-long-arrow-right"></i>',
								'prev_text' => '<i class="icofont-long-arrow-left"></i>',
								'screen_reader_text' => ' ',
								'type'               => 'list'
							));
							?>
						</div>
						
						<?php else: ?>
							<?php get_template_part('template-parts/content', 'none'); ?>
						<?php endif; ?>
						
					</div>
				</div>

				<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
				   <div class="col-xl-3 col-lg-12">
				      <div id="sidebar" class="sidebar blog-sidebar">
				         <?php dynamic_sidebar( 'sidebar-1' ); ?>
				      </div> 
				   </div>
				<?php } ?>

			</div>
		</div>
	</section>
	
	<?php get_footer(); ?>
