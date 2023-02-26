<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package newssite
 */

get_header();
?>
<header class="page-header news-header">
	<?php
		$post_type = get_post_type_object(get_post_type());
		echo '<h1 class="news-header__title">' . $post_type->labels->singular_name . '</h1>';
	?>
</header>

<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter" class="news-filter">
<?php
if( $terms = get_terms( 'animals', 'orderby=name' ) ) : 
	echo '<label class="news-filter__label news-filter__label--all active"><input class="active" type="checkbox" name="nothing_selected" checked> All </label>';
    foreach ($terms as $term) :
        echo '<label class="news-filter__label"><input type="checkbox" name="'. $term->slug .'" value="' . $term->term_id . '">' . $term->name . '</label>'; 
    endforeach;
    
endif;
?>
<div class="news-filter__inner-btn">
	<div class="news-filter__inner-reset">Reset filters</div>
	<button>Apply filters</button>
</div>
<input type="hidden" name="action" value="myfilter">
</form>

	<main id="primary" class="site-main news-main">
		<div class="container">
	<div id="response" class="news-inner">
		<?php if ( have_posts() ) : ?>
			<?php

			while ( have_posts() ) :
				the_post();
			
				get_template_part( 'template-parts/content-animals', get_post_type() );

			endwhile;
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		$news = new WP_Query(array('post_type' => 'news', 'posts_per_page' => 5, 'paged' => 1));
		
		echo '<ul class="news-pagination">';
		
		if($news->max_num_pages == 1){

		}else{
			for($i = 1; $i <= $news->max_num_pages; $i++ ){
				if($i == 1){
					echo '<span>'. $i .'</span>';
				}else{ 
					echo '<li id="'. $i .'">'. $i .'</li>';
				}
			}
		}
		echo '</ul>';
		echo '</div>';

		wp_reset_postdata();
		?>

	</div>
	</div>
	<!-- #main -->
<div class="spinner-wrapper none" id="loading">
    <div class="spinner"></div>
    <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
</main>

<?php
get_footer();
