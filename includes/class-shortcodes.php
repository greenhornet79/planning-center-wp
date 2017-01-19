<?php 

/**
* Load the base class
*/
class Planning_Center_WP_Shortcodes {
	
	function __construct()	{
		
		add_shortcode( 'pcwp_people', array( $this, 'people' ) );
		add_shortcode( 'pcwp_services', array( $this, 'services' ) );
		add_shortcode( 'pcwp_households', array( $this, 'households' ) );
		// add_shortcode( 'pcwp_donations', array( $this, 'donations' ) );

	}

	public function people( $atts ) 
	{
		$args = shortcode_atts( array(
	        'first_name' => '',
	        'last_name' => '',
	        'nickname' => '',
	        'goes_by_name' => '',
	        'middle_name' => '',
	        'last_name' => '',
	        'birthdate' => '',
	        'anniversary' => '',
	        'gender' 	=> '',
	        'grade'		=> '',
	        'child'		=> '',
	        'status'	=> '',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$people = $api->get_people( $args );

    	ob_start(); ?>

    	<?php 
    		if ( is_array( $people ) ) {
				echo '<h3>People in People</h3>';
				echo '<ul class="planning-center-wp people-list">';
				foreach( $people as $person ) {
					
					echo '<li>' . $person->attributes->first_name . ' ' . $person->attributes->last_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p>No results found.</p>';
			}
		?>
	
		<?php  $content = ob_get_contents();
		ob_end_clean();

		return apply_filters('planning_center_wp_people_shortcode_output', $content ); 	

	}

	public function households( $atts ) 
	{
		$a = shortcode_atts( array(
	        'foo' => 'something',
	        'bar' => 'something else',
    	), $atts );

    	$api = new PCO_PHP_API;
    	$households = $api->get_households();

    	ob_start(); ?>

    	<?php 
    		if ( is_array( $households ) ) {
				echo '<h3>Households in People</h3>';
				echo '<ul>';
				foreach( $households as $house ) {
					echo '<li>Name: ' . $house->attributes->name . ' Contact: ' . $house->attributes->primary_contact_name . '</li>';
				}
				echo '</ul>';
			} else {
				echo '<p>' . $households . '</p>';
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


			