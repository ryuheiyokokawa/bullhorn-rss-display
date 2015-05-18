<?php
//Admin system section:

// create custom plugin settings menu
add_action('admin_menu', 'yd_bh_create_menu');

function yd_bh_create_menu() {

	//create new top-level menu
	add_menu_page('Bullhorn RSS Plugin Settings', 'BHRSS Settings', 'administrator', __FILE__, 'bhrss_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_bhrss_settings' );
}

function register_bhrss_settings() {
	//register our settings
	register_setting( 'bhrss-settings-group', 'bh_rss_url' );
	register_setting( 'bhrss-settings-group', 'bh_load_styling' );
	register_setting( 'bhrss-settings-group', 'bh_cache' );
}

function bhrss_settings_page() { //yup, classc WP stuff. ?>

	<div class="wrap">
	<h2>Bullhorn RSS Feed Puller</h2>

	<form method="post" action="options.php">
	    <?php settings_fields( 'bhrss-settings-group' ); ?>
	    <?php do_settings_sections( 'bhrss-settings-group' ); ?>
	    <table class="form-table">
	        <tr valign="top">
	        	<th scope="row">URL</th>
		        <td>
		        	<input type="text" name="bh_rss_url" value="<?php echo esc_attr( get_option('bh_rss_url') ); ?>" />
		        </td>
	        </tr>
	         
	        <tr valign="top">
	        	<th scope="row">Load Styling?</th>
		        <td>
		        	<input type="checkbox" name="bh_load_styling" <?php echo esc_attr( get_option('bh_load_styling') ) ? 'checked' : ''  ; ?> />
		        </td>
	        </tr>
	        
	        <tr valign="top">
		        <th scope="row">Cache for 10 min?</th>
		        <td>
		        	<input type="checkbox" name="bh_cache" <?php echo esc_attr( get_option('bh_cache') ) ? 'checked' : ''  ; ?> />
		        </td>
	        </tr>
	    </table>
	    
	    <?php submit_button(); ?>

	</form>
	</div>

	<?php

}//end of bhrss_settings_page
