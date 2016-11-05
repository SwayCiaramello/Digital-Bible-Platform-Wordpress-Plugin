<?php
/*
Plugin Name: Digital Bible Platform API
Plugin URI: http://www.firstfruitsmedia.com/demo/wordpress-plugin/
Description: The Digital Bible Platform API Wordpress plugin easily creates language, version, books and chapters dropdowns to choose and display the text and possible audio of a bible chapter in a selected language.
Version: 1.0
Min WP Version: 3.6 
Author: FirstFruitsMedia
Author URI: http://www.firstfruitsmedia.com
License: GPL2

Copyright 2014 First Fruits Media  (email : sway@firstfruitsmedia.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


// --------------- OPTIONS-PAGE ------------------------

add_action('admin_init', 'dbp_admin_init' );
add_action('admin_menu', 'dbp_add_admin_page');

function dbp_admin_init(){
	register_setting( 'dbp_plugin_options', 'dbp_options', 'dbp_validate_options' );
}

function dbp_validate_options($input) {
	return $input;
}

function dbp_add_admin_page() {
	add_options_page('Digital Bible Platform', 'Digital Bible Platform', 'manage_options', 'dbp_plugin', 'dbp_options_page');
}

function dbp_options_page() { ?>
	<div class="wrap">
		<h2><?php _e('Digital Bible Platform API Settings', 'dbp'); ?> </h2>

		<form action="options.php" method="post">
			<?php settings_fields('dbp_plugin_options'); ?>
			<?php $options = get_option('dbp_options'); ?>

			<table class="form-table">
				<tr>
					<th scope="row">Digital Bible Platform API-Key</th>
					<td>
						<input type="text" size="60" name="dbp_options[apikey]" value="<?php echo $options['apikey']; ?>" />
						<p class="description"><?php printf(__('The API-Key can be requested %shere%s.', 'dbp'), '<a href="http://www.digitalbibleplatform.com/docs/" target="_blank">', '</a>') ?></p>
				</tr>

			</table>
			
			<p class="submit">
				<input name="dbp_submit" type="submit" class="button-primary" value="<?php _e('Submit Changes', 'dbp') ?>" />
			</p>

		</form>

	</div> 
<?php }

// Display a Settings link on the main Plugins page
add_filter( 'plugin_action_links', 'dbp_plugin_action_links', 10, 2 );

function dbp_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$dbp_links = '<a href="'.get_admin_url().'options-general.php?page=dbp_plugin">'.__('Settings').'</a>';
		array_unshift( $links, $dbp_links );
	}
	return $links;
}
// ----------------- End of API Options ----------------------------------------

function dbp_scripts() {
	wp_register_style('dbp-plugin-css-script', plugins_url('/digital-bible-platform/dbp-scripts.css')); 
	wp_enqueue_style( 'dbp-plugin-css-script' );
}

add_action('wp_enqueue_scripts','dbp_scripts');

Class DbpQueryAPI{

	static $add_script;

	static function init() {

		//Register ShortCodes
		
		add_shortcode("dbp-language", 	array(__CLASS__, 'dbp_language' ));
		
		add_shortcode("dbp-version", 	array(__CLASS__, 'dbp_version' ));
		
		add_shortcode("dbp-book", 	array(__CLASS__, 'dbp_book'));
		
		add_shortcode("dbp-chapter", 	array(__CLASS__, 'dbp_chapter' ));	
		
		add_shortcode("dbp-audio", 	array(__CLASS__, 'dbp_audio' ));
		
		add_shortcode("dbp-verses", 	array(__CLASS__, 'dbp_verses' ));
			
		
		//Load javascript in wp_footer
		
		add_action('init', 		array(__CLASS__, 'register_script' ));
		
		add_action('wp_footer', array(__CLASS__, 'print_script' ));
		
			
	}
	
	

	//Return HTML for language drop down
	static function dbp_language() {

		//Trigger javascript scripts to load
		self::$add_script = true;
		

	 	return '<select name="dbp-language" id="dbp-language"></select>';
	}
	

	//Return HTML Bible Audio
	static function dbp_audio() {

		//Trigger javascript scripts to load
		self::$add_script = true;

	 	return '<div id="dbp-audio-data"></div>';

	}
	
	//Return HTML Bible Text
	static function dbp_verses() {

		//Trigger javascript scripts to load
		self::$add_script = true;

	 	return '<div id="dbp-book-data"></div>';
	}

	//Return HTML for versions dropdown
	static function dbp_version() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="dbp-version" id="dbp-version"></select>';
	}


	//Return HTML for books drop down
	static function dbp_book() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="dbp-book" id="dbp-book"></select>';
	}


	//Return HTML for chapters dropdown
	static function dbp_chapter() {

		//Trigger javascript scripts to load
		self::$add_script = true;

		return '<select name="dbp-chapter" id="dbp-chapter"></select>';
	}



	//Include necessary javascript files
	static function register_script() {

		wp_register_script('DigitalBiblePlatform-api-js', 'http://firstfruitsmedia.com/wp-content/uploads/dbp/digital-bible-platform-api-v1.js', array('jquery'), '1.0', true);

	}


	//check if the short codes were used, print js if required
	static function print_script() {

		//Only load javascript if the short code events were triggered
		if ( ! self::$add_script )
			return;

		wp_print_scripts('DigitalBiblePlatform-api-js');

		//initialize the dbpquery objects
		self::dbpquery_init();
	}


	//Output required dbpquery javascript to footer.
	static function dbpquery_init()
	{
		?>

	<script type='text/javascript'>
	
	$(document).ready(
	
	function()
	{
     //Create a variable for the DbpQuery object.  You can call it whatever you like.
     var dbpquery = new DbpQuery();

     //Run the dbpquery init function to get things started:
     
	 dbpquery.init();
     

     //Optional: initialize the language, version, book, and chapter drop downs by providing their element IDs
	 
	 		
		//Confirm we have an API Key to use
		<?php $options = get_option('dbp_options');
			// Check, if configured
		if(!$options['apikey']) {
			$apikey ="You need to set your API-Key";
		} else {
			$apikey = $options['apikey'];
		}
		?>
		
		api_key_info = "<?php echo $apikey;?>";
		
	 dbpquery.initLanguageVersionBookChapter('dbp-language', 'dbp-version', 'dbp-book', 'dbp-chapter', api_key_info);

	});

	</script>
	    <?php
	}
}

//Initilazed the object
DbpQueryAPI::init();