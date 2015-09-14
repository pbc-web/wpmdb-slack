<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://poweredbycoffee.co.uk
 * @since      1.0.0
 *
 * @package    Wp_Migrate_Db_Pro_Slack
 * @subpackage Wp_Migrate_Db_Pro_Slack/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Migrate_Db_Pro_Slack
 * @subpackage Wp_Migrate_Db_Pro_Slack/admin
 * @author     Stewart Ritchie <stewart@poweredbycoffee.co.uk>
 */
class Wp_Migrate_Db_Pro_Slack_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Migrate_Db_Pro_Slack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Migrate_Db_Pro_Slack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-migrate-db-pro-slack-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Migrate_Db_Pro_Slack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Migrate_Db_Pro_Slack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-migrate-db-pro-slack-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Check that WP Migrate DB Pro is active
	 *
	 * @since    1.0.0
	 */

	public function check_parent_active(){
		if(!is_plugin_active("wp-migrate-db-pro/wp-migrate-db-pro.php")){
			?>
			 <div class="error">
		        <p>WP Migrate DB Pro Needs To Be Active for Slack Notification to work.</p>
		    </div>
		    <?php
		}
	}

	/**
	 * Check that the Required constants are set
	 *
	 * @since    1.0.0
	 */

	public function check_constants_set(){

		$constants = array(
			'MDBP_SLACK_TEAM',
			'MDBP_SLACK_HOOK_URL',
			'MDBP_SLACK_CHANNEL'
		);

		foreach ($constants as $cont) {

			if(!defined($cont)){
				?>
				 <div class="error">
			        <p>The constant <code><?php echo $cont; ?></code> must be set in <code>wp-config.php</code>	</p>
			    </div>
			    <?php
			}
			
		}
	}

	public function slack($text){

		//echo("fuck it");
		//die("hit the callback");

		$client = new Slack\Client(MDBP_SLACK_HOOK_URL);
		$slack = new Slack\Notifier($client);

		$message = new Slack\Message\Message($text);

		$message->setChannel(MDBP_SLACK_CHANNEL)
		    ->setIconEmoji(':ghost:')
		    ->setUsername('slack-php');

		$slack->notify($message);
			
	}

	public function migration_start(){
		$this->slack($this->build_message("Started"));
	}

	public function migration_finish(){
		$this->slack($this->build_message("Finshed"));
	}

	private function get_intent(){
		return $_POST['intent'];
	}

	private function build_message($stage){

		$current_user = wp_get_current_user();

		if($this->get_intent() == "pull"){

			$intent = "Pulling";
			$from = $_POST['url'];
			$to = get_bloginfo("url");

		} elseif($this->get_intent() == "push") {

			$intent = "Pushing";
			$from = get_bloginfo("url");
			$to = $_POST['url'];

		} else {

			$intent = "An Unknown Migration";
			$from = get_bloginfo("url");
			$to = $_POST['url'];
		}

		return sprintf(
				"%1s %5s %4s a Database from %2s to %3s", 
				$current_user->user_login,
				$stage,
				$intent,
				$from,
				$to
		);

	}
}
