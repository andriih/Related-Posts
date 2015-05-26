<?php 
	/*
	Plugin Name: AWP ELATED POSTS
	Description: Description
	Plugin URI: http://#
	Author: Author
	Author URI: http://#
	Version: 1.0
	License: GPL2
	Text Domain: Text Domain
	Domain Path: Domain Path
	*/
	
	add_filter('the_content' , 'awp_rel_posts');

	function awp_rel_posts ($content){
	if(!is_single( )) return $content;
		$id = get_the_ID();
		$categories = get_the_category( $id );
		
		foreach ($categories as $category) 
		{
			$cats_id[] = $category->cat_ID;
		}
		
		$query = new WP_Query (
			array(
				'posts_per_page' => '5' ,
				'category__in' => $cats_id,
				'orderby' => 'rand',
				'post__not_in' => array($id)
				)
		);

		//print_r($cats_id);
		//print_r($categories);
	
	if(have_posts())
	{
		$content .= '<div class="related-posts"><h1>Записи які вас зацікавлять:</h1>';
			
			while ($query->have_posts()) 
			{
				$query->the_post();
				$content .= '<a href="'.get_the_permalink().'">'.get_the_title( ).'</a></br>';
			}
		
		$content .= '</div>';

		wp_reset_query();

	}
		
		return $content;
		
		 
	}
	
	?>
