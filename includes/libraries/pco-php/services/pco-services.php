<?php 

/**
* Load the base class for the PCO PHP API
* // http://planningcenter.github.io/api-docs/#schedules

*/
class PCO_PHP_Services {

	protected $method;
	protected $parameters;

	function __construct( $args )	{
		
		$options = get_option('planning_center_wp');

		$this->method = $args['method'];
		$this->parameters = $args['parameters'];

	}

	public function folders() 
	{
		return 'https://api.planningcenteronline.com/services/v2/folders';
	}


	public function people() 
	{	
		return 'https://api.planningcenteronline.com/services/v2/people';
	}

	public function songs() 
	{
		return 'https://api.planningcenteronline.com/services/v2/songs';	
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