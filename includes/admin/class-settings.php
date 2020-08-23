<?php 

/**
* Load the base class
*/
class Planning_Center_WP_Settings {
	
	protected $options;

	function __construct()	{

		$this->options = get_option('planning_center_wp');

		add_action( 'admin_init', array($this, 'save_settings' ) );
		add_action( 'admin_menu', array($this, 'create_settings_page' ) );

	}

	public function create_settings_page() 
	{
		add_menu_page(
	        __( 'Planning Center WP', 'planning-center-wp' ),
	        'Planning Center',
	        'manage_options',
	        'planning-center-wp/planning-center-wp-admin.php',
	        array( $this, 'settings_page'),
	        'dashicons-admin-users',
	        99
	    );
	}

	public function settings_page() 
	{
		$options = $this->options;

		?>

		<div class="wrap">
			<h1>Planning Center WP</h1>

			<?php if ( !$options['app_id'] || !$options['secret'] ) {
				?>
				<p>First, you need to create your personal access tokens.</p>
				<a target="_blank" href="http://api.planningcenteronline.com/oauth/applications">Go here to create your API keys.</a>
				<?php 
			} ?>
		
			
			<form method="post" action="<?php echo admin_url(); ?>admin.php?page=planning-center-wp%2Fplanning-center-wp-admin.php">

			<table class="form-table">
				<tr>
					<th>
						<label for="app_id">App ID</label>
					</th>
					<td>
						<input type="text" value="<?php echo $options['app_id']; ?>" name="planning_center_wp[app_id]" class="regular-text">
					</td>
				</tr>
				<tr>
					<th>
						<label for="secret">Secret</label>
					</th>
					<td>
						<input type="text" value="<?php echo $options['secret']; ?>" name="planning_center_wp[secret]" class="regular-text">
					</td>
				</tr>

				<?php wp_nonce_field('submit_planning_center_wp_options', 'planning_center_wp_nonce' ); ?>
			</table>

			<input id="submit" class="button button-primary" name="submit" value="Save Changes" type="submit">

			</form>

			<div class="container">
				<p><strong>Available shortcodes</strong></p>
				<p>[pcwp_people method="people"]</p>
				<p>[pcwp_services method="songs"]</p>
			</div>
			
		</div>
		<?php 
	}

	public function save_settings() 
	{
		
		if ( ! isset( $_POST['planning_center_wp_nonce'] ) 
		    || ! wp_verify_nonce( $_POST['planning_center_wp_nonce'], 'submit_planning_center_wp_options' ) 
		) {
		  return;
		} 

		$options = $this->options;

		if ( isset( $_POST['planning_center_wp']['app_id'] ) ) {
			$options['app_id'] = sanitize_text_field( $_POST['planning_center_wp']['app_id'] );

		}

		if ( isset( $_POST['planning_center_wp']['secret'] ) ) {
			$options['secret'] = sanitize_text_field( $_POST['planning_center_wp']['secret'] );
		}

		update_option( 'planning_center_wp', $options );

		$this->options = get_option('planning_center_wp');

	}

	
}
