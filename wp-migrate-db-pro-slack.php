<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://poweredbycoffee.co.uk
 * @since             1.0.0
 * @package           Wp_Migrate_Db_Pro_Slack
 *
 * @wordpress-plugin
 * Plugin Name:       WP Migrate DB Pro Slack Notifications
 * Plugin URI:        http://poweredbycoffee.co.uk
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Stewart Ritchie
 * Author URI:        http://poweredbycoffee.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-migrate-db-pro-slack
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-migrate-db-pro-slack-activator.php
 */
function activate_wp_migrate_db_pro_slack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-migrate-db-pro-slack-activator.php';
	Wp_Migrate_Db_Pro_Slack_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-migrate-db-pro-slack-deactivator.php
 */
function deactivate_wp_migrate_db_pro_slack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-migrate-db-pro-slack-deactivator.php';
	Wp_Migrate_Db_Pro_Slack_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_migrate_db_pro_slack' );
register_deactivation_hook( __FILE__, 'deactivate_wp_migrate_db_pro_slack' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-migrate-db-pro-slack.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_migrate_db_pro_slack() {

	$plugin = new Wp_Migrate_Db_Pro_Slack();
	$plugin->run();

}

include('vendor/autoload.php');
run_wp_migrate_db_pro_slack();
