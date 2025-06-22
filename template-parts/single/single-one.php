<?php 

$blog_single_cat = minerva_get_option('blog_single_cat');
$blog_single_author= minerva_get_option('blog_single_author', false);
$blog_single_navigation = minerva_get_option('blog_nav');
$blog_single_related = minerva_get_option('blog_related', false);
$blog_single_taglist = minerva_get_option('blog_tags');
$blog_single_views = minerva_get_option('blog_views');
$blog_social = minerva_get_option('blog_social', false);
?>


<div id="main-content" class="bloglayout__One main-container blog-single post-layout-style2 single-one-bwrap"  role="main">
	<div class="container">
		<div class="row single-blog-content">

		<div class="<?php if(is_active_sidebar('sidebar-1')) { echo "col-lg-8"; } else { echo "col-lg-12";}?> col-md-12">
		<?php while (have_posts()):
		the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(["post-content", "post-single"]); ?>>

				<div class="blog_layout_one_Top">
					<div class="post-header-style1">
						<header class="entry-header clearfix single-blog-header">

							<?php if($blog_single_cat == true) :?>
							<div class="post-single-cat-box">
								<?php require MINERVA_THEME_DIR . '/template-parts/cat-alt-template.php'; ?>
							</div>
							<?php endif; ?>	
							
							<h1 class="post-title single_blog_inner__Title">
							<?php the_title(); ?>
							</h1>

							<div class="post-details-meta-wrap">
								<div class="post-meta-left">

									<div class="post-meta-left-author">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
									</div>
									
									<div class="post-meta-left-content">

										<h4 class="post-author-name">
											<?php echo get_the_author_link(); ?>
										</h4>

										<ul class="post-bottom-meta-list">
											<li class="post-meta-date"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></li>
											<li class="post-read-time"> <?php echo minerva_reading_time(); ?></li>
										</ul>
									</div>
								</div>

								<?php if($blog_social == true) :?>
									<?php echo minerva_social_sharing(); ?>
								<?php endif; ?>	

							</div>
						</header>
					</div>  

				</div>
							
				<div class="theme-blog-details">
				
				<?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
				<div class="post-featured-image">
				<?php if(get_post_format()=='video'): ?>
					<?php get_template_part( 'template-parts/single/post', 'video' ); ?>  
					<?php else: ?>
					<img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
				<div class="post-body clearfix single-blog-header single-blog-inner blog-single-block blog-details-content">
					<!-- Article content -->
					<div class="entry-content clearfix">
						
						<?php
						if ( is_search() ) {
							the_excerpt();
						} else {
							the_content();
							minerva_link_pages();
						}
						?>
						
					<?php if(has_tag() && $blog_single_taglist == true ) : ?>
					<div class="post-footer clearfix theme-tag-list-wrapp">
						<?php minerva_single_post_tags(); ?>
					</div>
					 
					<?php endif; ?>	

					</div>
				</div>
				
				</div>
							
			</article>
					   
			<?php if($blog_single_navigation == true) :?>
				<?php minerva_theme_post_navigation(); ?>
			<?php endif; ?>

			<?php comments_template(); ?>
			<?php endwhile; ?>
			</div>
					
			<?php get_sidebar(); ?>

		</div>
		
		<?php if($blog_single_related == true) :?>
		<div class="theme_related_posts_Wrapper">
			
			<div class="row">
				<div class="col-md-12">
					<?php get_template_part('template-parts/single/related', 'posts'); ?>
				</div>
			</div>
			
		</div>
		<?php endif; ?>
	</div> 
	
</div>






