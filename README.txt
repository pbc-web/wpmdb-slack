=== Plugin Name ===
Contributors: stewarty
Tags: slack, wp-db-migrate-pro, notifications, migrate
Requires at least: 4.2.0
Tested up to: 4.3.1
Stable tag: 4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Send Notifications into a Slack Channel when someone starts and finishes a database migration from WP DB Migrate Pro by Delicious Brains

== Description ==

Send Notifications into a <a href="http://slack.com">Slack</a> Channel when someone starts and finishes a database migration from WP DB Migrate Pro by Delicious Brains.

You'll need to go to Slack and configure an Incoming Webhook for you team.

This plugin is great if you work in a team with a local development, staging and production enviroments.  It will let you know who did the most recent push to the database.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-migrate-db-pro-slack.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Login to Slack and setup an Incoming Webhook for the channel you want to post to.
4. Add  `define('MDBP_SLACK_HOOK_URL, "xxxx");` to wp-config.php where `xxxx` is the URL of your Slack Incoming Webhook.

BONUS
If you are using the free tier on Slack for your team you have a limied number in incoming webhooks available to you.  You can use the Same WebHook URL for mutiple Slack Channels


== Frequently Asked Questions ==

= Where is the admin UI? =

There isn't one.  This is a developer plugin and is controlled completely through the constants in `wp-config.php`



== Screenshots ==

No UI, NO Screenshots.

== Changelog ==

= 0.1 =
* Initial release.

== Upgrade Notice ==

= 0.1 =
Initial release.



Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`