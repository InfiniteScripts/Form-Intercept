<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.infinitescripts.com/form_intercept
 * @since      1.0.0
 *
 * @package    form_intercept
 * @subpackage form_intercept/public
 */

/**
 *
 * @since      1.0.0
 * @package    form_intercept
 * @subpackage form_intercept/public
 * @author     Kevin Greene <kevin@infinitescripts.com>
 */
class form_intercept_public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $form_intercept    The ID of this plugin.
	 */
	private $form_intercept;

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
	 * @param      string    $form_intercept       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	private $on_nda_list;
	private $first_name;
	private $last_name;

	public function __construct( $form_intercept, $version ) {

		$this->form_intercept = $form_intercept;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function form_intercept_public_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in form_intercept_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The form_intercept_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->form_intercept, plugin_dir_url( __FILE__ ) . 'css/form-intercept-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function form_intercept_public_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in form_intercept_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The form_intercept_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->form_intercept, plugin_dir_url( __FILE__ ) . 'js/form-intercept-public.js', array( 'jquery' ), $this->version, false );

	}
	

	public function form_intercept_settings(){

		/**
		* This funcion adds the menu item and register the page with Wordpress
		**/

		add_menu_page('Email Intercept', 'Email Intercept', 'manage_options', 'form_intercept_settings', 'form_intercept_settings_page_render');
	}
	
	public function form_intercept_settings_init(  ) {


		register_setting( 'interceptPage', 'mailchimp_api_key' );
		register_setting( 'interceptPage', 'mailchimp_yes_list' );
		register_setting( 'interceptPage', 'mailchimp_no_list' );		
		register_setting( 'interceptPage', 'email_field_id' );

		add_settings_section( 'form_intercept_interceptPage_section',	__( 'Settings', 'form_intercept' ),	'form_intercept_settings_section_callback',	'interceptPage');

		if(isset($_FILES['nda_list']) && $_FILES['nda_list'] != ''){

            
                // 0 means the content is not associated with any other posts
                $uploaded=media_handle_upload('nda_list', 0);                // Error checking using WP functions

                
                if(is_wp_error($uploaded)){
                     echo "Error uploading file: " . $uploaded->get_error_message();
                }else{
                    echo "File upload successful!";                    
                    
         				update_option('nda_list_x', $uploaded);
    				

                        

                }


        }
	}
	public function post_submission($entry, $form){
		$email = $entry[get_option('email_field_id')];
		$domain_name = substr(strrchr($email, "@"), 1);
		
		$this->first_name = rgar( $entry, '1.3' );
		$this->last_name = rgar( $entry, '1.6' );

		$nda_file = get_attached_file( get_option('nda_list_x'), $unfiltered );
		$nda_list = file_get_contents($nda_file);

		$this->mailchimp_email = $email;

		if (strpos($nda_list, $domain_name) !== false) {
    		$this->on_nda_list = get_option('mailchimp_yes_list');
    		
		} else {
			$this->on_nda_list = get_option('mailchimp_no_list');
			
		}
		

		$this->mailchimp_api();
	}

	public function mailchimp_api(){
	

		$MailChimp = new MailChimp(get_option('mailchimp_api_key'));
		//echo $this->on_nda_list;

		$result = $MailChimp->get('lists');		
		
		$lists = $result['lists'];
		$key = array_search ($this->on_nda_list, array_column($lists, 'web_id'));
		
		$list_id = $lists[$key]['id'];

		

		 $result = $MailChimp->post("lists/$list_id/members", [
				'email_address' => $this->mailchimp_email,
				'status'        => 'subscribed',
			]);
		
		$subscriber_hash = $MailChimp->subscriberHash($this->mailchimp_email);

		$result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", [
				'merge_fields' => ['FNAME'=> $this->first_name, 'LNAME'=> $this->last_name]
				
			]);

		
	}
	
}



	
	
