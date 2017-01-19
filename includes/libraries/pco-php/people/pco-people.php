<?php 

/**
* Load the base class for the PCO PHP API
* // http://planningcenter.github.io/api-docs/#schedules

*/
class PCO_PHP_People {

	protected $method;
	protected $parameters;

	function __construct( $args )	{
		
		$options = get_option('planning_center_wp');

		$this->method = $args['method'];
		$this->parameters = $args['parameters'];

	}

	public function lists() 
	{
		if ( $this->parameters ) {
			$this->parameters = $this->format_parameters( $this->parameters );
		}

		$base_url = 'https://api.planningcenteronline.com/people/v2/lists';

		return $base_url . '?' . $this->parameters;
	}

	public function people() 
	{	

		if ( $this->parameters ) {
			$this->parameters = $this->format_parameters( $this->parameters );
		}
		
		$base_url = 'https://api.planningcenteronline.com/people/v2/people/';

		return $base_url . '?' . $this->parameters;

	}



	public function format_parameters( $parameters ) 
	{
		
		$params = array();
		$string = '';

		switch ($this->method) {
			case 'lists':
				$keys = array( 'name', 'batch_completed_at', 'created_at', 'updated_at' );
				break;
			case 'people':
				$keys = array(
					'first_name',
					'last_name', 
					'nickname',
					'goes_by_name',
					'middle_name',
					'birthdate',
					'anniversary',
					'gender',
					'grade',
					'child',
					'status'
				);
			default:
				$keys = array();
				break;
		}

		

		$items = explode( ',', $parameters );

		foreach( $items as $item ) {
			$params[] = explode(':', $item );
		}

		foreach( $params as $param ) {
			
			$parameter = $param[0];
			$value = $param[1];
			
			if ( in_array( $parameter, $keys ) ) {
				$string .= 'where[' . $parameter . ']=' . $value . '&';
			}
			
		}

		return $string;
	}
}