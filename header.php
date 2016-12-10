<?php
/**
 * The Header for our theme.
 *
 * @package Healthy Farm
 */

global 	$THEMEREX_mainmenu, 
		$THEMEREX_mainmenu_right,
		$logo_image;
		themerex_init_template();	// Init theme template - prepare global variables
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" type="image/x-icon" href="<?php echo get_custom_option('favicon') != '' ? get_theme_option('favicon') : get_template_directory_uri().'/images/favicon.ico'; ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<?php 

	$body_style =  get_custom_option('body_style');
	$blog_style = get_custom_option('blog_style');
	$side_bar = get_custom_option('show_sidebar_main');
	$slider_show	= get_custom_option('slider_show')=='yes';
	$pagination_style = get_theme_option('blog_pagination');
	$show_user_header = get_custom_option('show_user_header')=='yes';

	$class_array  = array();
	//body class / theme color style
	$class_array[] = get_custom_option('color_scheme_theme');
	//sideBar menu position left/right
	$class_array[] = $side_bar;
	$class_array[] = $side_bar != 'fullWidth' ? 'sideBarShow' : '';
	$class_array[] = get_custom_option('menu_style') != '' ? 'menuStyle'.get_custom_option('menu_style') : 'menuStyle1';
	$class_array[] = sc_param_is_on(get_custom_option('menu_smart_scroll')) ? 'menuSmartScrollShow' : '';
	//blog style
	$class_array[] = 'blogStyle'.(strpos($blog_style,'portfolio') !== false ? 'Portfolio' : 'Excerpt');
	//boxed, body style
	if(is_single()  && $body_style == 'fullWide' ) { $body_style = 'wide'; }
	
	$class_array[] = ' bodyStyle'.ucfirst($body_style);
	$class_array[] = $show_user_header ? 'userHeaderShow' : '';
	//BG style
	if ( $body_style == 'boxed') {
		//background custom style
		if( get_custom_option('bg_image') != '' && get_custom_option('bg_image') != 0 ) {
			$class_array[] = 'bgImage_'. get_custom_option('bg_image');
		} else if( get_custom_option('bg_pattern') != '' && get_custom_option('bg_pattern') != 0) {
			$class_array[] = 'bgPattern_'. get_custom_option('bg_pattern');
		}
	}
	//main top menu position & style
	$class_array[] = get_custom_option('menu_position') == 'Fixed' ? 'menuStyle'.get_custom_option('menu_position') : '';
	$class_array[] = get_custom_option('menu_display').'MenuDisplay';
	$class_array[] = get_custom_option('logo_type').'Style';
	$class_array[] = get_custom_option('logo_background') == 'yes' ? 'logoStyleBG' : '';
	$class_array[] = $slider_show ? 'sliderShow' : '';

	//echo style/class
	$style = !empty($style_array) ? 'style="background: '.join(' ', $style_array).'"' : '';
	$class = !empty($class_array) ? ' '.join(' ', $class_array) : '';

?>

<body <?php body_class(); ?>>
<?php do_action('before'); ?>

<div id="wrap" class="wrap <?php echo esc_attr($class); ?>" <?php echo esc_attr($style); ?>>
<div id="wrapBox" class="wrapBox">

	<header id="header">

		<?php if ( get_custom_option('menu_position') == 'Fixed' && get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
			<div class="menuFixedWrapBlock"></div>
				<div class="menuFixedWrap">
		<?php } ?>

					<a href="#" class="openMobileMenu"></a>
				<?php if ( get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
					<a href="#" class="openTopMenu"></a>
				<?php } 

				if( get_custom_option('show_login') == 'yes' ) { ?>
					<div class="usermenuArea">
					<?php 
						global $THEMEREX_usermenu_show;
						$THEMEREX_usermenu_show = false;
						get_template_part('/templates/page-part-user-panel'); 
					?>
					</div>
				<?php } 

				//show main centered menu
				if ( get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
				<div class="wrapTopMenu">
					<div class="topMenu main">
						<?php echo balanceTags($THEMEREX_mainmenu); ?>
					</div>
				</div>
				<?php }

				if ( get_custom_option('main_menu_show') == 'yes' && !$THEMEREX_mainmenu) echo '<h3 class="sc_show_menu_error">Please choose or create menu in Appearance > Menus.</h3>'; ?>

		<?php if ( get_custom_option('menu_position') == 'Fixed' && get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
		</div> <!-- /menuFixedWrap -->
		<?php } ?>

		<div class="logoHeader">
			<?php //logo text style
			if( get_custom_option('logo_type') == 'logoImage'){ ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url($logo_image); ?>" alt=""></a>
			<?php } else { ?>
				<a href="<?php echo home_url(); ?>"><?php echo get_custom_option('title_logo'); ?></a>
			<?php } ?>
		</div>
		<?php 
		if( get_custom_option('sub_title_logo') != '' ){ ?>
		<h1 class="subTitle"><?php echo get_custom_option('sub_title_logo'); ?></h1>
		<?php } ?>
	</header>

	<?php 
		$top_widget = (get_custom_option('show_sidebar_top') == 'yes' && is_active_sidebar( get_custom_option('sidebar_top')));
		if( $top_widget ){ ?>
	<div class="topWidget">
		<div class="main">

			<?php  // ---------------- top sidebar ----------------------
			if ( $top_widget  ) { 
				global $THEMEREX_CURRENT_SIDEBAR;
				$THEMEREX_CURRENT_SIDEBAR = 'top'; 
					do_action( 'before_sidebar' );
					if ( !dynamic_sidebar( get_custom_option('sidebar_top') ) ) {
						// Put here html if user no set widgets in sidebar
					}
			} ?>
		</div><!-- /top widget -->
	</div>
	<?php } 

	//------------------- category & breadcrumbs -------------------

	$show_description_lable = sc_param_is_on( get_custom_option('description_lable_show'));
	$show_breadcrumbs = sc_param_is_on(get_custom_option('show_breadcrumbs'));
	$catTitle = getBlogTitle(); 

	if( ( $show_description_lable || $show_breadcrumbs || empty($catTitle) ) && !is_404() && !is_page() ){
		$catStyle = get_custom_option('description_lable_style'); ?>
		<div class="topTitle <?php echo 'subCategoryStyle'.($catStyle != '' ? $catStyle : 1).($show_breadcrumbs ? ' showBreadcrumbs' : '' ); ?>">
		<?php
			//category title & description
			if (is_category() && $show_description_lable ) { 
				$catDescription = get_queried_object() -> category_description; 				
				if($catTitle || $catDescription){ ?>
					<div class="subCategory">
						<h4 class="categoryTitle main"><?php echo esc_attr($catTitle) ?></h4>
						<?php echo esc_attr($catDescription) ? '<div class="categoryDescription main">'.$catDescription.'</div>' : '' ?>
					</div><?php 
				}
			} 

			//breadcrumbs
			if ( $show_breadcrumbs ) { ?>
			<div class="breadcrumbs main">
				<?php showBreadcrumbs( array('home' => __('Home', 'themerex'), 'truncate_title' => 50 ) ); ?>
			</div><?php
			} 
		?>
		</div>
	<?php }

	//------------------- category & breadcrumbs -------------------

	//slider
	get_template_part('templates/page-part-slider'); 

	//user header
	if ($show_user_header) {
		$user_header = themerex_strclear(get_custom_option('user_header_content'), 'p');
		$user_bg = get_custom_option('user_header_bg');
		if (!empty($user_header)) {
			$user_header = substituteAll($user_header); ?>
			<div class="userHeaderSection" <?php echo esc_attr($user_bg) != '' ?  'style="background-color:'.$user_bg.'"' : ''; ?>>
				<?php echo do_shortcode($user_header); ?>
			</div><?php
		}
	}
	?>


	<div class="wrapContent">
		<div id="wrapWide" class="wrapWide">

			<!--[if lt IE 9]>
			<?php echo '<center>'.do_shortcode("[trx_infobox style='info' title='Your browser needs to be updated.' closeable='no']
				[trx_columns indent='no' columns='4']
				[trx_column_item][trx_icon icon='icon-chrome' align='center' box_style='circle' size='30' bottom='5']<a href='https://www.google.com/intl/en/chrome/browser/' target='_blank'>Chrome</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-safari' align='center' box_style='circle' size='30' bottom='5']<a href='http://support.apple.com/kb/dl1531' target='_blank'>Safari</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-firefox' align='center' box_style='circle' size='30' bottom='5']<a href='http://www.mozilla.org/en-US/firefox/new/' target='_blank'>FireFox</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-ie' align='center' box_style='circle' size='30' bottom='5']<a href='http://windows.microsoft.com/en-us/internet-explorer/download-ie' target='_blank'>Internet Exp</a>.[/trx_column_item]
				[/trx_columns]

			[/trx_infobox]").'</center>'; ?>
			<![endif]-->

			<div class="content">
				<?php
				$fstyle = strpos($blog_style,'portfolio') !== false;
				echo (($body_style == 'boxed' &&  $side_bar != 'fullWidth' && !$fstyle) || (is_single()  && get_custom_option('body_style') == 'fullWide')) ? '<div class="main">' : '' ?>

