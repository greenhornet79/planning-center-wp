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
	
	public function get_people( $args = '') 
	{	

		$method = $args['method'];

		$people = new PCO_PHP_People($args);
		$url = $people->$method();

		$response = wp_remote_get( $url, $this->get_headers() );
		$result = '';

		if( is_array($response) ) {
		  $header = $response['headers']; // array of http header lines
		  $body = json_decode( $response['body'] ); // use the content

		  if ( isset( $body->errors[0]->detail ) ) {
		  	$result = $body->errors[0]->detail;
		  } else {
		  	$result = apply_filters( 'planning_center_wp_get_people_body', $body->data, $body );
		  }

		}

		return $result;

	}

	public function get_services( $args = '' ) 
	{
		
		$method = $args['method'];

		$services = new PCO_PHP_Services($args);
		$url = $services->$method();

		$response = wp_remote_get( $url, $this->get_headers() );
		$result = '';

		if( is_array($response) ) {
		  $header = $response['headers']; // array of http header lines
		  $body = json_decode( $response['body'] ); // use the content

		  if ( isset( $body->errors[0]->detail ) ) {
		  	$result = $body->errors[0]->detail;
		  } else {
		  	$result = apply_filters( 'planning_center_wp_get_services_body', $body->data, $body );
		  }

		}

		return $result;

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