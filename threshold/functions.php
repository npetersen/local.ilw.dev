<?php

	add_filter( 'wp_nav_menu_items', 'custom_menu_items', 10, 2 );

	function custom_menu_items($items) {
		
		$items .= '<li class="menu-item-2000 menu-item simple"><a href="javascript://nop" onclick="doGearWin()">gear</a></li>';
		
		if (is_user_logged_in()) {
			$user = wp_get_current_user();
			$name = $user->user_firstname; // or user_login , user_firstname, user_lastname
			$items .= '<li class="menu-item-2001 menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children simple"><a href="http://teamintermountainlivewell.org/my-account/" class="target-page"><i class="entypo-user"></i>Welcome, ' . $name . '</a><ul class="sub-menu" style="display: none; visibility: hidden;"><li><a href="http://teamintermountainlivewell.org/wp-login.php?action=logout&redirect_to=http%3A%2F%2Fteamintermountainlivewell.org" class="target-page">log out</a></li></ul></li>';
			// $items.= //Change Password, Logout, etc
		} elseif (!is_user_logged_in()) {
			$items .= '<li class="menu-item-2001 menu-item menu-item-type-custon menu-item-object-custom menu-item-has-children simple"><a href="http://teamintermountainlivewell.org/my-account/" class="target-page"><i class="entypo-user"></i>log in</a><ul class="sub-menu" style="display: none; visibility: hidden;"><li><a href="http://teamintermountainlivewell.org/wc-api/auth/facebook/?return=http%3A%2F%2Fteamintermountainlivewell.org%2Fmy-account%2F" class="target-page"><i class="entypo-facebook"></i>log in w/facebook</a></li><li><a href="http://teamintermountainlivewell.org/wc-api/auth/twitter/?return=http%3A%2F%2Fteamintermountainlivewell.org%2Fmy-account%2F" class="target-page"><i class="entypo-twitter"></i>log in w/twitter</a></li><li><a href="http://teamintermountainlivewell.org/wc-api/auth/instagram/?return=http%3A%2F%2Fteamintermountainlivewell.org%2Fmy-account%2F" class="target-page"><i class="entypo-instagram"></i>log in w/instagram</a></li></ul></li>';
			// $items.= //Sign up, Lost Password
		}
		
		return $items;
	}
	
	
	// Start custom login page code /////////////////////////////////////////
	// http://andornagy.com/customizing-the-wordpress-login-page/
	// https://premium.wpmudev.org/blog/create-a-custom-wordpress-login-page/


	// Adding the function to the login page
	add_action('login_head', 'custom_login');

	// Our custom function that includes the custom stylesheet
	function custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'stylesheet_directory' ) . '/custom-login/custom-login.css" />';
	}

	function set_login_logo_url() {
		return get_bloginfo( 'url' );
	}

	add_filter( 'login_headerurl', 'set_login_logo_url' );

	function set_login_logo_url_title() {
		return 'Threshold Sports';
	}

	add_filter( 'login_headertitle', 'set_login_logo_url_title' );

	function remove_lostpassword_text ( $text ) {
		if ($text == 'Lost your password?'){$text = '';}
		return $text;
	}

	add_filter( 'gettext', 'remove_lostpassword_text' );

	// End custom login page code ///////////////////////////////////////////


	// Add WooCommerce Social Login buttons to the wp-login.php pages  ///////
	// https://gist.github.com/bekarice/38f97b76ba3fdc2e641f /////////////////
	// http://www.skyverge.com/blog/advanced-woocommerce-social-login ////////

	function add_wc_social_login_buttons_wplogin() {
		// Displays login buttons to non-logged in users + redirect back to login
		woocommerce_social_login_buttons();
	}

	add_action( 'login_form', 'add_wc_social_login_buttons_wplogin' );
	add_action( 'register_form', 'add_wc_social_login_buttons_wplogin' );

	// Changes the login text from what's set in our WooCommerce settings so we're not talking about checkout while logging in.
	function change_social_login_text_option( $login_text ) {
		global $pagenow;
		
		// Only modify the text from this option if we're on the wp-login page
		if( 'wp-login.php' === $pagenow ) {
			$login_text = __( 'You can also create an account with your preferred social network.', 'WC_Social_Login' );
		}
		
		return $login_text;
	}

	add_filter( 'pre_option_wc_social_login_text', 'change_social_login_text_option' );
	
	// End add WooCommerce Social Login buttons to the wp-login.php pages ////


	// Remove WooCommerce related products display on product pages //////////
	// Clear the query arguments for related products so none show ///////////
	// http://docs.woothemes.com/document/remove-related-posts-output/ ///////
	
	function wc_remove_related_products( $args ) {
		return array();
	}

	add_filter('woocommerce_related_products_args','wc_remove_related_products', 10); 

	// End remove WooCommerce related products display on product pages //////


	// Change WordPress Default Email From Name And Address ////////////////////
	// http://www.deluxeblogtips.com/2010/04/change-wordpress-default-email.html

	add_filter('wp_mail_from', 'new_mail_from');
	add_filter('wp_mail_from_name', 'new_mail_from_name');

	function new_mail_from($old) {
		return 'manager@shop.teamintermountainlivewell.org';
	}

	function new_mail_from_name($old) {
		return 'Threshold Sports';
	}

	// End Change WordPress Default Email From Name And Address /////////////////
	

?>