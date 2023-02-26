<article id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				newssite_posted_on();
				newssite_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="news-item__thumbnail-box">
		<?php newssite_post_thumbnail(); ?>
	</div>
	<div class="news-item__bottom">
		<?php
			$limit = 12; 
			$title = get_the_title(); 
			$short_title = (mb_strlen($title) > $limit) ? mb_substr($title, 0, $limit) . '...' : $title; 

			echo '<a href="'. get_permalink() .'"> <h2 class="news-item__title">' . $short_title . '</h2></a>'; 
		?>
		<div class="entry-content">

		</div><!-- .entry-content -->
		<div class="news-item__bottom-terms news-terms">
			<?php
				$terms = get_the_terms( $post->ID, 'animals' ); 
			if($terms != ''){
				if(count($terms) <= 1){
					echo '<span class="news-terms__title">Term:</span>';
				}else{
					echo '<span class="news-terms__title">Terms:</span>';	
				}
				if ( $terms && ! is_wp_error( $terms ) ) :
					echo '<ul class="news-terms">';
					foreach ( $terms as $key => $term ) {
						if ($key == count($terms) - 1) {
							echo '<li>' . esc_html( $term->name ) . '</li>';	
						} else {
							echo '<li>' . esc_html( $term->name ) . ',</li>';
						}
					}
					echo '</ul>';
				endif;
			}
			?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->

