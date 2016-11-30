<?php global $md_theme_options; ?>
<?php
	$device = (md_detect_mobile()) ? 'mobile' : 'desktop';
	$css3_animations = ($device == 'desktop' && !detect_ie_9()) ? 'enabled' : 'disabled';

	$header_style = $md_theme_options['header-style'];
	$onepage = false;
	$onepage_data = 'false';
	$onepage_class = false;

	if(isset($post)){

		if(is_home()):

			if(get_option('page_for_posts')){
				$page_id = get_option('page_for_posts');
			} else {}

		elseif (class_exists('Woocommerce') && is_shop()):

			$page_id = woocommerce_get_page_id( 'shop' );

		else:
			$page_id = get_the_id();

		endif;

		if( get_post_meta( $page_id, '_wp_page_template', true ) == 'tpl-onepage.php' ){
			$onepage = true;
			$onepage_data = 'true';
			$onepage_class = 'onepage';
		}
	}

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Mobile Specifics -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Title -->
<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>

<!-- Favicon -->
<?php if(!empty($md_theme_options['favicon']['url'])) { ?>
<link rel="shortcut icon" href="<?php echo $md_theme_options['favicon']['url'] ?>" />
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/assets/img/placeholder/favicon.png' ?>" />
<?php } ?>

<!-- Apple Touch Icons -->    
<?php if(!empty($md_theme_options['apple-icon-57']['url'])) { ?>
<link rel="apple-touch-icon" href="<?php echo $md_theme_options['apple-icon-57']['url']; ?>" />
<?php } ?>
<?php if(!empty($md_theme_options['apple-icon-72']['url'])) { ?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $md_theme_options['apple-icon-72']['url']; ?>" />
<?php } ?>
<?php if(!empty($md_theme_options['apple-icon-114']['url'])) { ?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $md_theme_options['apple-icon-114']['url']; ?>" />
<?php } ?>
<?php if(!empty($md_theme_options['apple-icon-144']['url'])) { ?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $md_theme_options['apple-icon-144']['url']; ?>" />
<?php } ?>

<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri();?>/asset/js/vendor/html5.js"></script>
<![endif]--> 

<?php wp_head(); ?>
	 
</head>

<body <?php body_class($onepage_class.' header-static header-'.$header_style);?> data-device="<?php echo $device; ?>" data-css3-animations="<?php echo $css3_animations;?>">

<?php get_template_part( '/templates/page/loading' ); ?>

<div id="wrap">

<header id="header">
	<div class="header-content" id="header-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="logo">
						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
							<?php 
								if(isset($md_theme_options['logo']) && isset($md_theme_options['logo']['url']) && $md_theme_options['logo']['url'] != ''){
									echo '<img src="'.esc_url($md_theme_options['logo']['url']).'" alt="" id="logo-solid" />';
								}
								else{
									echo '<img src="'.esc_url(get_template_directory_uri()).'/assets/img/placeholder/logo.png" alt="" id="logo-solid" />';
								}


								if($header_style != 'solid'){

									if(isset($md_theme_options['logo-transparent']) && isset($md_theme_options['logo-transparent']['url']) && $md_theme_options['logo-transparent']['url'] != ''){
										echo '<img src="'.esc_url($md_theme_options['logo-transparent']['url']).'" alt="" id="logo-transparent" />';
									}
									else{
										echo '<img src="'.esc_url(get_template_directory_uri()).'/assets/img/placeholder/logo-transparent.png" alt="" id="logo-transparent" />';
									}

								}

							?>
						</a>
					</div>
					<div id="header-right">
						<nav id="header-menu">
							
							<ul id="menu-mainnavoriginal" class="menu">
								<li class="menu-item-869 menu-item menu-item-type-custom menu-item-object-custom simple">
									<a href="http://teamintermountainlivewell.com/shop/2015-membership/" class="target-page">2015 Membership</a>
								</li>
								<li class="menu-item-868 menu-item menu-item-type-custom menu-item-object-custom simple">
									<a href="http://teamintermountainlivewell.org/shop/" class="target-page">Gear</a>
								</li>
								<li class="menu-item-867 menu-item menu-item-type-custom menu-item-object-custom simple">
									<a href="#" class="">Test Link</a>
								</li>
							</ul>
							
						</nav>

						<?php
						if (class_exists('Woocommerce')){
							if(isset($md_theme_options['header-woocommerce']) && $md_theme_options['header-woocommerce']){
							global $woocommerce; ?>
							
				            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', MD_THEME_NAME); ?>" id="shop-button" class="cart-contents"><i class="entypo-basket"></i> <span class="cart-info">(<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>

							<?php  } 
						}?>

					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<a href="#" id="menu-mobile-trigger"><i class="icon-reorder"></i></a>

<div id="header-mobile">	
	<div id="header-mobile-menu">
		<?php 
			if(isset($md_theme_options['logo-transparent']) && isset($md_theme_options['logo-transparent']['url']) && $md_theme_options['logo-transparent']['url'] != ''){
				echo '<img src="'.esc_url($md_theme_options['logo-transparent']['url']).'" alt="" id="logo-transparent" />';
			}
			else{
				echo '<img src="'.esc_url(get_template_directory_uri()).'/assets/img/placeholder/logo-transparent.png" alt="" id="logo-mobile" />';
			}							
		?>
		<ul id="menu-mainnavoriginal" class="menu">
			<li class="menu-item-869 menu-item menu-item-type-custom menu-item-object-custom simple">
				<a href="http://teamintermountainlivewell.com/shop/2015-membership/" class="target-page">2015 Membership</a>
			</li>
			<li class="menu-item-868 menu-item menu-item-type-custom menu-item-object-custom simple">
				<a href="http://teamintermountainlivewell.org/shop/" class="target-page">Gear</a>
			</li>
			<li class="menu-item-867 menu-item menu-item-type-custom menu-item-object-custom simple">
				<a href="#" class="">Test Link</a>
			</li>
		</ul>
	</div>
</div>


<div id="page-container">
	<?php
	if(!$onepage) get_template_part( '/templates/page/page-header' );
	?>