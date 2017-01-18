<?php 

/**
* Load the base class
*/
class Planning_Center_WP_Shortcodes {
	
	function __construct()	{
		
		add_shortcode( 'pcwp_people', array( $this, 'people' ) );
		add_shortcode( 'pcwp_services', array( $this, 'services' ) );
		// add_shortcode( 'pcwp_donations', array( $this, 'donations' ) );
		
	}

	public function people( $atts ) 
	{
		$a = shortcode_atts( array(
	        'foo' => 'something',
	        'bar' => 'something else',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$people = $api->get_people();

    	ob_start(); ?>

    	<?php 
    		if ( is_array( $people ) ) {
				echo '<h3>People in People</h3>';
				echo '<ul>';
				foreach( $people as $person ) {
					echo '<li>' . $person->attributes->first_name . ' ' . $person->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p>' . $people . '</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return $content; 	

	}

	public function services( $atts ) 
	{
		$a = shortcode_atts( array(
	        'foo' => 'something',
	        'bar' => 'something else',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$services = $api->get_services();

    	ob_start(); ?>

    	<?php 

    		if ( is_array( $services ) ) {
				echo '<h3>People in Services</h3>';
				echo '<ul>';
				foreach( $services as $item ) {
					echo '<li>' . $item->attributes->first_name . ' ' . $item->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p>' . $services . '</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return $content; 	
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


			