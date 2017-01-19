<?php 

/**
* Load the base class
*/
class Planning_Center_WP_Shortcodes {
	
	function __construct()	{
		
		add_shortcode( 'pcwp_checkins', array( $this, 'checkins' ) );
		add_shortcode( 'pcwp_giving', array( $this, 'giving' ) );
		add_shortcode( 'pcwp_people', array( $this, 'people' ) );
		add_shortcode( 'pcwp_services', array( $this, 'services' ) );

	}

	public function people( $atts ) 
	{
		$args = shortcode_atts( array(
			'method' 	=> '',
			'parameters'	=> '',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$people = $api->get_people( $args );

    	ob_start(); ?>

    	<?php 
    		echo '<h3 class="planning-center-wp-title">' . ucwords( $args['method'] ) . ' in People</h3>';
    		if ( is_array( $people ) ) {
				
				echo '<ul class="planning-center-wp-list planning-center-wp-people-list">';
				foreach( $people as $person ) {
					
					echo '<li>' . $person->attributes->first_name . ' ' . $person->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p class="planning-center-wp-not-found">No results found.</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return apply_filters('planning_center_wp_people_shortcode_output', $content ); 	

	}



	public function services( $atts ) 
	{
		$args = shortcode_atts( array(
			'method' 	=> '',
			'parameters'	=> '',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$services = $api->get_services( $args );

    	ob_start(); ?>

    	<?php 
    		echo '<h3 class="planning-center-wp-title">' . ucwords( $args['method'] ) . ' in Services</h3>';
    		if ( is_array( $services ) && !empty( $services ) ) {
				// @todo load a certain view based on the method passed
				echo '<ul class="planning-center-wp-list planning-center-wp-services-list">';
				foreach( $services as $service ) {
					echo '<li>' . $service->attributes->first_name . ' ' . $service->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p class="planning-center-wp-not-found">No results found.</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return apply_filters('planning_center_wp_services_shortcode_output', $content ); 	
	}

	public function donations( $atts ) 
	{
		$a = shortcode_atts( array(
	        'foo' => 'something',
	        'bar' => 'something else',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$donations = $api->get_donations();

    	ob_start(); ?>

    	<?php 

    		if ( is_array( $donations ) ) {
				echo '<h3>Donations</h3>';
				echo '<ul>';
				foreach( $donations as $item ) {
					echo '<pre>';
					print_r( $item );
					echo '</pre>';
					// echo '<li>' . $item->attributes->first_name . ' ' . $item->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p>' . $donations . '</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return $content; 	
	}
	
}


			