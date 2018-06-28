<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://infinitescripts.com/form_intercept
 * @since      1.0.0
 *
 * @package    Plugin Name
 * @subpackage form_intercept/public/partials
 */


function form_intercept_options_page(  ) {
 
	?>
	<form action='options.php' method='post'>
		
		<h2>Form Intercept Settings</h2>
		
		<?php
			settings_fields( 'form-intercept' );
			do_settings_sections( 'form-intercept' );
			submit_button();
		?>
		
	</form>
	<?php

}


function form_intercept_settings_section_callback(  ) { 

	echo __( 'Words', 'form_intercept' );

}



 
