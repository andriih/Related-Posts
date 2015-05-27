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
	//if(!is_single( )) return $content; 
		
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

	
	if(have_posts())
	{
		$content .= '<div class="related-posts"><h1>Записи які вас зацікавлять:</h1>';
			
			while ($query->have_posts()) 
			{
				$query->the_post();

				if(has_post_thumbnail())
					{
						$img = get_the_post_thumbnail( get_the_ID() , 
													array(100,100), 
													array('alt'=>get_the_title( ),
														'title'=>get_the_title( ) ) );
					} 
				else 
					{
						$img = '<img src="'.plugins_url( 'images/no_img.jpg', __FILE__).'" alt="'.get_the_title( ).'" title="'.get_the_title( ).'" width="100" height="100">';
					}

				$content .= '<a href="'.get_the_permalink().'">'.$img.'</a>';
			}
		
		$content .= '</div>';

		wp_reset_query();

	}
		
		return $content;
		
		 
	}
	
	?>
