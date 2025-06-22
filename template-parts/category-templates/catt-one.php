<div class="main-content-inner category-layout-one">
  
	<?php while ( have_posts() ) : the_post(); ?>



	<article <?php post_class('post-block-list-item-wrapper post-block-list-item post-block-template-one post-block-template-loadmore'); ?>>

		<div class="post-block-list-item-inner post-block-list-item-inner-wrap">

				<?php if(has_post_thumbnail()): ?>
				<div class="post-block-media-wrap">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_attr(esc_url(get_the_post_thumbnail_url(null, 'full'))); ?>" alt="<?php the_title_attribute(); ?>">
					</a>
				</div>
				<?php endif; ?>
			
				<div class="post-block-content-wrap">
			
							
					<div class="post-item-title">
						<h2 class="post-title">
						<a href="<?php the_permalink(); ?>"><?php echo esc_html( wp_trim_words(get_the_title(), 100,'') ); ?></a>
						</h2>
					</div>

					
					<div class="post-excerpt-box">
						<p><?php echo esc_html( wp_trim_words(get_the_excerpt(), 25 ,'') );?></p>
					</div>

						
					<div class="post-bottom-meta-list">
						
						<div class="post-meta-author-box">
							By <?php echo get_the_author_link(); ?>
						</div>

						<div class="post-meta-date-box">
							<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
						</div>
						
					</div>


					</div>
		</div>
		
	</article>


	<?php endwhile; ?>

</div>