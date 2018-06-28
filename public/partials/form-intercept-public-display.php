<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://infinitescripts.com/form_intercept
 * @since      1.0.0
 *
 * @package    Form Intercept
 * @subpackage form_intercept/public/form_intercept
 */

function form_intercept_settings_page_render(  ) {

	?>
	<form action='options.php' method='post' enctype="multipart/form-data">		

		<?php


			settings_fields( 'interceptPage' );
			do_settings_sections( 'interceptPage' );
      ?>
      <form action='options.php' method='post' enctype="multipart/form-data">			
      <label class="doc-settings">Mailchimp API Key: </label><input value="<?php echo get_option('mailchimp_api_key'); ?>" class="docu-input" type="text" name="mailchimp_api_key"> <br>
      <label class="doc-settings">ID of Mailchimp "Yes" list: </label><input value="<?php echo get_option('mailchimp_yes_list'); ?>" class="docu-input" type="text" name="mailchimp_yes_list"> <br>
      <label class="doc-settings">ID of Mailchimp "No" list: </label><input value="<?php echo get_option('mailchimp_no_list'); ?>" class="docu-input" type="text" name="mailchimp_no_list"> <br>
      <label class="doc-settings">ID of GForms Email Field: </label><input value="<?php echo get_option('email_field_id'); ?>" class="docu-input" type="text" name="email_field_id"> <br>
      <input type='file' id='nda_list' name='nda_list'></input>
      <?php
			submit_button();

		?>



	<h2>Current List File:</h2>
	<?php echo basename ( get_attached_file( get_option('nda_list_x'), $unfiltered )); ?>


	<?php

}

function form_intercept_settings_section_callback(  ) {
  register_setting( 'interceptPage', 'mailchimp_api_key' );
}

function form_intercept_update_settings(){
  register_setting( 'interceptPage', 'mailchimp_api_key' );
}

