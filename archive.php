<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package minerva
 */

get_header();

?>

    <!-- Archive Breadcrumb -->
    <div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
					<div class="breadcrumb-nav-top">
						<ul>
							<li class="breadcrumb-home-menu"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'minerva'); ?></a></li>
							<li class="breadcrumb-item-menu"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Archives', 'minerva'); ?></a></li>
							<li class="breadcrumb-key-menu"><a href="#"><?php the_archive_title(); ?></a></li>
						</ul>
					</div>
					<h1 class="theme-breacrumb-title">
						 <?php the_archive_title(); ?>
					</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Archive Breadcrumb End -->
	
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

