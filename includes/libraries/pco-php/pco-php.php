<?php 

/**
* Load the base class for the PCO PHP API
* // http://planningcenter.github.io/api-docs/#schedules

*/
class PCO_PHP_API {
	
	protected $app_id;
	protected $secret;

	function __construct()	{
		
		$options = get_option('planning_center_wp');

		$this->app_id = $options['app_id'];
		$this->secret = $options['secret'];

	}
	
	public function get_people() 
	{

		$response = wp_remote_get( 'https://api.planningcenteronline.com/people/v2/people/', $this->get_headers() );

		if( is_array($response) ) {
		  $header = $response['headers']; // array of http header lines
		  $body = json_decode( $response['body'] ); // use the content

		  $people = $body->data;

		} else {
			$people = 'Could not be found';
		}

		return $people;

	}

	public function get_services() 
	{
		
		$response = wp_remote_get( 'https://api.planningcenteronline.com/services/v2/people/', $this->get_headers() );

		if( is_array($response) ) {
		  $header = $response['headers']; // array of http header lines
		  $body = json_decode( $response['body'] ); // use the content

		  $services = $body->data;

		} else {
			$services = 'Could not be found.';
		}

		return $services;

	}

	public function get_donations() 
	{
		
		$response = wp_remote_get( 'https://api.planningcenteronline.com/giving/v2/donations', $this->get_headers() );

		if( is_array($response) ) {
		  $header = $response['headers']; // array of http header lines
		  $body = json_decode( $response['body'] ); // use the content

		  echo '<pre>';
		  print_r( $body );
		  echo '</pre>';

		  $donations = $body->data;

		} else {
			$donations = 'Could not be found.';
		}

		return $donations;

	}

	public function get_headers() 
	{
		return array(
		  'headers' => array(
		    'Authorization' => 'Basic ' . base64_encode( $this->app_id . ':' . $this->secret )
		  )
		);
	}

}