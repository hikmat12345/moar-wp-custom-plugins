<?php
/**
 * Plugin Name:       Moar multi user Registeration
 * Plugin URI:        https://no-yet
 * Description:       multi registeration
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hikmat Ullah Khan CACF
 * Author URI:        https://live_moar
 * License:           GPL v1 or later
 * License URI:       https://no
 * Text Domain:       CACF_Moar_user_resteration
 * Domain Path:       /languages
 */

// register_activation_hook( __FILE__, 'wpq_list_terms_exclusions' );
// register_deactivation_hook( __FILE__, 'wpq_list_terms_exclusions' );
// register_activation_hook( __FILE__, 'wpq_created_term' );
// register_deactivation_hook( __FILE__, 'wpq_created_term' );


/**
* Restrict album per users.
*
* Each artist can only see his own created album (admins can see all)
*
*/
// user registeration input form


// user registration login form
function vicode_registration_form() {
 
	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {
 
		// check if registration is enabled
		$registration_enabled = get_option('users_can_register');
 
		// if enabled
		if($registration_enabled) {
			$output = vicode_registration_fields();
		} else {
			$output = __('User registration is not enabled');
		}
		return $output;
	}
}
add_shortcode('register_form', 'vicode_registration_fields');

// registration form fields
function vicode_registration_fields() {
	// session_start();
	ob_start(); ?>	
	<?php 
	// show any error messages after form submission
	vicode_register_messages(); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		/* style inputs and link buttons */
		input,
		.btn {
		  width: 100%;
		  padding: 12px;
		  border: none;
		  border-radius: 4px;
		  margin: 5px 0;
		  opacity: 0.85;
		  display: inline-block;
		  font-size: 17px;
		  line-height: 20px;
		  text-decoration: none; /* remove underline from anchors */
		}
		input:hover,
		.btn:hover {
		  opacity: 1;
		}
		/* add appropriate colors to fb, twitter and google buttons */
		.fb {
		  background-color: #3B5998;
		  color: white;
		}
		.twitter {
		  background-color: #55ACEE;
		  color: white;
		}
		.google {
		  background-color: #dd4b39;
		  color: white;
		}
		.insta{
			background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
	  -webkit-background-clip: text;
	          background-clip: text;
			-webkit-text-fill-color: transparent;
		}
		.instagram{
			background-color: #c13584;
	        color: wheat;
		}
		.nsl-button-svg-container {
	    width: 2rem;
	    display: inline-block;
		}
		.nsl-button-label-container {
	    width: 70%;
	    display: inline-block;
	    vertical-align: top;
	    margin-top: 3px;
	    margin-left: 5px;
		}
		.nsl-button.nsl-button-default.nsl-button-google {
	    padding: 10px;
	    margin-top: 10px;
		}
		.inp-filed.password {
			position: relative;
		}
		.password i.fa.fa-eye, .fa.fa-eye-slash {
			position: absolute;
			top: 31%;
			right: 15px;
			cursor: pointer;
			color: #2271b1;
		}   
		.hide_it {
			display: none !important;
		}    
	</style>
		<figure class="tabBlock">
			  <div class="tabBlock-content">
					<div class="tabBlock-pane tabcontent" id="London">
						<!--       artist -->
						<form id="artist_signupform" class="vicode_form" action="" method="POST" >
							<div class="form-group input-group">
							  <div class="inp-filed">
								  <input type="text" name="vicode_user_login" id="fan_vicode_user_login" placeholder="User Name" class="vicode_user_login form-control" maxlength="20" type="text" tabindex="1" required/>
							  </div>
						 	</div> 
						 	<!-- form-group// -->
						 	<div class="form-group input-group">
							  <div class="inp-filed">
									<input name="vicode_user_first" id="fan_vicode_user_first" type="text" class="vicode_user_first form-control" placeholder="First Name" maxlength="20" tabindex="1" required/>
							  </div>
						 	</div> 
						 	<!-- form-group// -->
						 	<div class="form-group input-group"> 
						    <div class="inp-filed">
								 	<input name="vicode_user_last" id="fan_vicode_user_last" type="text" class="vicode_user_last form-control" placeholder="Last Name" maxlength="20" tabindex="1" required/>
							 	</div>
						 	</div> <!-- form-group// -->

							<div class="form-group input-group">
							  <div class="inp-filed">
								<input name="vicode_user_email" id="fan_vicode_user_email" placeholder="Email address" class="vicode_user_email form-control"  type="email" maxlength="40" tabindex="1" required/>
								</div>
							</div> <!-- form-group// -->

							<div class="form-group input-group">
							  <div class="inp-filed">
								<input name="vicode_user_phone" id="fan_vicode_user_phone" placeholder="Phone number" class="vicode_user_phone form-control" maxlength="11"  type="text" tabindex="1" required/>
								</div>
							</div> <!-- form-group// -->

							<div class="form-group input-group">
								<div class="inp-filed password">
									<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" maxlength="20" tabindex="1" tabindex="5">
									<i class="fa fa-eye password-icon"></i>
									<i class="fa fa-eye-slash password-icon hide_it"></i>
								</div>
							</div>
							<!-- form-group// -->
							<div class="form-group input-group">
								<div class="inp-filed password">
									<input type="password" name="repeatpassword" id="repeatpassword" class="form-control input-lg" placeholder="Confirm Password" tabindex="1" maxlength="20" tabindex="6">
									<i class="fa fa-eye repeatpassword-icon"></i>
									<i class="fa fa-eye-slash repeatpassword-icon hide_it"></i>
								</div>
							</div>
							<div align="center" id="bit00_3">
								<p class="role_toggle-selector"> Please choose a role </p>
							  <label class="toggle_switch">
							    <input class="toggle_checkbox" type="checkbox" id="checkbox1" tabindex="1" name="role">
							      <div class="slider round">
							        <span class="fan"> Fan </span>
							        <span class="artist"> Artist </span>
							      </div>
							  </label>
							</div>

				 			<!-- form-group end.// -->
						  <div class="form-group">
								<input type="hidden" name="vicode_csrf" value="<?php echo wp_create_nonce('vicode-csrf'); ?>"/>
								<input type="submit" id="submitbtn" class="btn btn-primary btn-block" value="<?php _e('Register Your Account'); ?>"/>
						  </div>
         		</form>

         		<?php 
	    				// Display the social login option only if the user is not logged in
							if (!is_user_logged_in()) {
								?>
									<p class="social_login-info text-center font-weight-bold"> OR </p>
		         		<?php echo do_shortcode('[nextend_social_login]');
							}
						?>
    			</div>
  		</div>
		</figure>
		<script>
			/*// tabs of js
			function openCity(evt, cityName) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("tabcontent");
			  for (i = 0; i < tabcontent.length; i++) {
			    tabcontent[i].style.display = "none";
			  }
			  tablinks = document.getElementsByClassName("tablinks");
			  for (i = 0; i < tablinks.length; i++) {
			    tablinks[i].className = tablinks[i].className.replace(" active", "");
			  }
			  document.getElementById(cityName).style.display = "block";
			  evt.currentTarget.className += " active";
			} */

			$(document).ready(function(){
				/* $("#fan_repeatpassword").keyup(function(){
					var password=$("#fan_password").val();
					var repeatpassword= $("#fan_repeatpassword").val();
					console.log("password", password)
					console.log("repeatpassword", repeatpassword)
					if(password !== repeatpassword){
						$("#msg").html("please match your password")
							return false	
						}
					else{
						$("#msg").html("");
						return true
					}
				});	*/

				jQuery("body").on("click", ".password-icon, .repeatpassword-icon", function() {
						var target = jQuery(this).parent(".password").find("input").attr("id");
						jQuery(this).parent(".password").find(".password-icon, .repeatpassword-icon").toggleClass("hide_it");
						// jQuery(this).parent(".password").find(".password-icon").toggleClass("hide_it");
						var target = document.getElementById(target);
						if (target.type === "password") {
						target.type = "text";
					} else {
						target.type = "password";
					}
					console.log(target);
				});	
			});
			var value = 1;
		  //you can put the checkbox in a variable, 
		  //this way you do not need to do a javascript query every time you access the value of the checkbox
		  var checkbox1 = document.getElementById("checkbox1")
		  checkbox1.checked = value
		  document.getElementById("checkbox1").addEventListener("change", function(element){
		    console.log(checkbox1.checked)
		  });
		  jQuery(".nsl-container-buttons").append('<a href="https://www.facebook.com/v3.0/dialog/oauth?client_id=963725711057443&amp;state=71a440853a74225979043c5df6036f01&amp;response_type=code&amp;sdk=php-sdk-5.7.0&amp;redirect_uri=https%3A%2F%2Fmoar.smartdemo.live%2Fwp-admin%2Fadmin-ajax.php%3Faction%3Dvicode_facebook_login%26nonce%3D2854c0aee2&amp;scope=email" class="fb btn"> <i class="fa fa-facebook fa-fw"></i> Login with Facebook</a>');
		  jQuery('input#fan_vicode_user_phone').keypress(function (e) {
			var regex = new RegExp("^[0-9]");
			var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			if (regex.test(str)) {
				return true;
			}

			e.preventDefault();
			return false;
		});
		</script>		
	<?php
	return ob_get_clean();
}

// register a new user
function vicode_add_new_user() {
  if (isset( $_POST["vicode_user_login"] ) && wp_verify_nonce($_POST['vicode_csrf'], 'vicode-csrf')) {
  	// echo "<pre>";
  	// 	print_r($_POST);
  	// echo "</pre>";
    $user_login			= $_POST["vicode_user_login"];	
    $user_email			= $_POST["vicode_user_email"];
    $user_first 		= $_POST["vicode_user_first"];
    $user_last	 		= $_POST["vicode_user_last"];
    $phone_number	 	= $_POST["vicode_user_phone"];
    $user_pass			= $_POST["password"];
    $pass_confirm 	= $_POST["repeatpassword"];
	$role_as 				= $_POST["role"];
	if ($role_as == "on") {
		$role_as = "subscriber";
	} else {
		$role_as = "artist";
	}

    
    // this is required for username checks
    require_once(ABSPATH . WPINC . '/registration.php');
    
    if(username_exists($user_login)) {
      // Username already registered
      vicode_errors()->add('username_unavailable', __('Username already taken'));
    }
    if(!validate_username($user_login)) {
      // invalid username
      vicode_errors()->add('username_invalid', __('Invalid username'));
    }
    if($user_login == '') {
      // empty username
      vicode_errors()->add('username_empty', __('Please enter a username'));
    }
    if(!is_email($user_email)) {
      //invalid email
      vicode_errors()->add('email_invalid', __('Invalid email'));
    }
    if(email_exists($user_email)) {
      //Email address already registered
      vicode_errors()->add('email_used', __('Email already registered'));
    }
    if($phone_number == '') {
      //Email address already registered
      vicode_errors()->add('Phone_empty', __('Please enter a valid mobile number'));
    }
    if($user_pass == '') {
      // passwords do not match
      vicode_errors()->add('password_empty', __('Please enter a password'));
    }
    if($user_pass != $pass_confirm) {
      // passwords do not match
      vicode_errors()->add('password_mismatch', __('Passwords do not match'));
    }
    
    $errors = vicode_errors()->get_error_messages();
    // if no errors then cretate user
    if(empty($errors)) {
      $new_user_id = wp_insert_user(array(
          'user_login'								=> $user_login,
          'user_pass'	 								=> $user_pass,
          'user_email'								=> $user_email,
          'first_name'								=> $user_first,
          'last_name'									=> $user_last,
          'enter_your_mobile_number' 	=> $phone_number,
          'user_registered'						=> date('Y-m-d H:i:s'),
          'role'											=> "$role_as"
        )
      );
     	if($new_user_id) {
				// session_start();
	      // send an email to the admin
	      //   wp_new_user_notification($new_user_id);  
	      // log the new user in
	      //   wp_setcookie($user_login, $user_pass, true);
	      //    wp_set_current_user($new_user_id, $user_login);	
	      //  $_SESSION['account_success_session']="yessSession";
	      // do_action('wp_login', $user_login);
	      echo "<script> alert('you have successfully resistered'); </script>";
		  wp_redirect( wp_login_url() );
		  exit;
      }
    }
	}
}
add_action('init', 'vicode_add_new_user');

// used for tracking error messages
function vicode_errors(){
  static $wp_error; // global variable handle
  return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function vicode_register_messages() {
	if($codes = vicode_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
			// Loop error codes and display errors
			foreach($codes as $code){
			  $message = vicode_errors()->get_error_message($code);
			  echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
			}
		echo '</div>';
	}	
}