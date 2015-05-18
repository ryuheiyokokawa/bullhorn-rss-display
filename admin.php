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
	register_setting( 'bhrss-settings-group', 'rss_url' );
	register_setting( 'bhrss-settings-group', 'load_styling' );
	register_setting( 'bhrss-settings-group', 'cache' );
}

function bhrss_settings_page() {
?>
<h2>Bullhorn </h2>

<form method="post" action="options.php">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <?php do_settings_sections( 'baw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        	<th scope="row">URL</th>
	        <td>
	        	<input type="text" name="rss_url" value="<?php echo esc_attr( get_option('rss_url') ); ?>" />
	        </td>
        </tr>
         
        <tr valign="top">
        	<th scope="row">Load Styling?</th>
	        <td>
	        	<input type="text" name="load_styling" value="<?php echo esc_attr( get_option('load_styling') ); ?>" />
	        </td>
        </tr>
        
        <tr valign="top">
	        <th scope="row">Cache for 10 min?</th>
	        <td>
	        	<input type="text" name="cache" value="<?php echo esc_attr( get_option('cache') ); ?>" />
	        </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>

<?php
}//end of bhrss_settings_page
?>