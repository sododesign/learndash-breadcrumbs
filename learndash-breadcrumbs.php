<?php

function simple_breadcrumb() {
	global $post;
	// Simply change the separator to what ever you need e.g. / or >
	$separator = '<span class="breadcrumb-separator"> / </span>'; 
	echo '<div class="row">';
	echo '<div class="col-md-9 pull-right breadcrumb" id="breadcrumbs">';
	
		if (!is_front_page()) {	
			echo '<a href="';	
			echo get_option('home');	
			echo '">';
			bloginfo('name');
			echo "</a> ".$separator;

			if ( is_category() || is_single() ) {				
			 	$learning_url = '<a href="'.site_url().'/learning/">Learning</a>';
			 
			 if( is_single() && get_post_type( get_the_ID() ) == 'sfwd-lessons' ){			 	 
				$course_id = get_post_meta(get_the_ID(),'course_id',true);
					echo $learning_url.$separator.'<a href="';		
					echo get_permalink($course_id); 		
					echo '">';		
					echo get_the_title($course_id);		
					echo "</a>";
			 }
			 
			 elseif( is_single() && get_post_type( get_the_ID() ) == 'sfwd-topic' ){			
				$course_id = get_post_meta(get_the_ID(),'course_id',true);
				$lesson_id = get_post_meta(get_the_ID(),'lesson_id',true);
					echo $learning_url.$separator.'<a href="';		
					echo get_permalink($course_id); 		
					echo '">';		
					echo get_the_title($course_id);		
					echo "</a>";
					echo $separator.'<a href="';		
					echo get_permalink($lesson_id); 		
					echo '">';		
					echo get_the_title($lesson_id);		
					echo "</a>";
			 }
			 
			 elseif( is_single() && get_post_type( get_the_ID() ) == 'sfwd-quiz' ){			
				$course_id = get_post_meta(get_the_ID(),'course_id',true);
				$lesson_id = get_post_meta(get_the_ID(),'lesson_id',true);
					echo $learning_url.$separator.'<a href="';		
					echo get_permalink($course_id); 		
					echo '">';		
					echo get_the_title($course_id);		
					echo "</a>";
					echo $separator.'<a href="';		
					echo get_permalink($lesson_id); 		
					echo '">';		
					echo get_the_title($lesson_id);		
					echo "</a>";
			 }
			 
			 elseif( is_single() && get_post_type( get_the_ID() ) == 'sfwd-courses' ){			
					echo $learning_url;
					
			 }
			 
			 else
			   the_category(', ');	
				
					if ( is_single() ) {		
						echo $separator;		
						the_title();	
					}
			} 
			
			elseif ( is_page() && $post->post_parent ) {	
			$home = get_page(get_option('page_on_front'));
			
			for ($i = count($post->ancestors)-1; $i >= 0; $i--) {		
				if (($home->ID) != ($post->ancestors[$i])) {			
					echo '<a href="';		
					echo get_permalink($post->ancestors[$i]); 		
					echo '">';		
					echo get_the_title($post->ancestors[$i]);		
					echo "</a>".$separator;	
				}	
			}	
			
			echo the_title();	
			} 
			
			elseif (is_page()) {		
				echo the_title();	
			} 
		
			elseif (is_404()) {	
			echo "404 page not found";	
			}
		}
		
		else {
		bloginfo('name');
		}
		
	echo '</div>';
	echo '</div>';
}

?>