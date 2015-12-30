<?php
/**
 * Header
 *
 * Displays all information in head, starts the body tag, contains theme header
 * and nav and starts the main content wrapper
 *
 * @package      responsive_mobile
 * @license      license.txt
 * @copyright    2014 CyberChimps Inc
 * @since        0.0.1
 *
 * Please do not edit this file. This file is part of the responsive_mobile Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<!DOCTYPE html>
<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<?php responsive_mobile_head_top(); ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php wp_title( '&#124;', true, 'right' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php responsive_mobile_head_bottom(); ?>

		<?php wp_head(); ?>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3Ze6ioTeWClV6zVi1BL0CDQtPM62cGVa";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71843424-1', 'auto');
  ga('send', 'pageview');

</script>
<?php responsive_mobile_body_top(); ?>
<div id="container" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'responsive-mobile' ); ?></a>
	<a class="skip-link screen-reader-text" href="#main-navigation"><?php _e( 'Skip to main menu', 'responsive-mobile' ); ?></a>
<?php responsive_mobile_container_top(); ?>
<?php if ( has_nav_menu( 'top-menu', 'responsive-mobile' ) ) { ?>
	<div id="top-menu-container" class="container-full-width">
		<nav id="top-menu" class="container" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<ul id="menu-top-menu" class="top-menu">
				<li id="menu-item-24" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-24">
					<a href="http://maydonitrat.vn"><i class="glyphicon glyphicon-home"></i> Trang chủ</a>
				</li>
				<li id="menu-item-25" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-25">
					<a href="#"><i class="glyphicon glyphicon-map-marker"></i> Cửa hàng</a>
				</li>
				<li id="menu-item-26" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-26">
					<a href="#"><i class="glyphicon glyphicon-envelope"> </i> Liên hệ</a>
				</li>
				<li id="menu-item-27" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-5 current_page_item menu-item-27">
					<a href="#"><i class="glyphicon glyphicon-shopping-cart"></i> Giỏ hàng</a>
				</li>
			</ul>
			<?php /*wp_nav_menu(
				array(
					'container'      => '',
					'fallback_cb'    => false,
					'menu_class'     => 'top-menu',
					'theme_location' => 'top-menu',
					'depth'          => 1
				)
			); */?>
		</nav>
	</div><!-- top menu container -->
<?php } ?>
<?php responsive_mobile_header_before(); ?>
	<header id="header" class="container-full-width site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<?php responsive_mobile_header_top(); ?>
		<div class="container">
			<div class="header-row">
				<div class="col-md-3" id="img-logo">
					<?php responsive_mobile_header_one(); ?>
				</div>
				<div class="col-md-6" id="camket">
					<div class="camket_top">
						<div class="camketitem">
							<span class="camket2"></span>
							<p>Thanh toán <br> khi nhận hàng</p>
						</div>
						<div class="camketitem">
							<span class="camket3"></span>
							<p>Miễn phí vận chuyển trên toàn quốc</p>
						</div>
						
					</div>
					<?php //responsive_mobile_header_two(); ?>
				</div>
				<div class="col-md-3" id="lien-he" style="padding-top:16px;">
					<div id="support-hotline">
						<div class="hotline-right">
							<ul>
								<li>
									<div id="ky-thuat" class="col-md-6"><span>Bán hàng 1: </span></div>
									<div id="dt-ky-thuat" class="col-md-6"><strong><span class="glyphicon glyphicon-phone"></span> 096 36 37 999</strong></div>
								</li>
								<li>
									<div id="tu-van"class="col-md-6"><span>Bán hàng 2: </span></div>
									<div id="dt-tu-van" class="col-md-6"><strong><span class="glyphicon glyphicon-phone"></span> 04 22 66 44 88</strong></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php responsive_mobile_header_bottom(); ?>
	</header><!-- #header -->
<?php responsive_mobile_header_end(); ?>

	<div id="main-menu-container" class="container-full-width">
		<div id="main-menu" class="container">
			<nav id="main-navigation" class="site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
				<div id="mobile-current-item"><?php responsive_mobile_menu_title(); ?></div>
				<button id="mobile-nav-button"><span class="accessibile-label"><?php _e( 'Mobile menu toggle', 'responsive-mobile' ); ?></span></button>
				<?php wp_nav_menu(
					array(
						'container'       => 'div',
						'container_class' => 'main-nav',
						'theme_location'  => 'header-menu'
					)
				); ?>
				<div id="searchboxdestop" class="pull-right" style="margin-top: 6px">
					<form id="form-search" class="form-horizontal left-inner-addon" method="get" action="http://maydonitrat.vn">
						<div class="input-group input-group-sm">
							<input id="s" class="form-control form-search" type="text" name="s" placeholder="Nhập từ khóa tìm kiếm sản phẩm">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="submit">
								<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</form>
				</div>
			</nav><!-- #site-navigation -->
						<div id="searchboxmobi" class="pull-right phone" style="margin-top: 6px">				<form id="form-search" class="form-horizontal left-inner-addon" method="get" action="http://cameraipgiare.vn">					<div class="input-group input-group-sm">						<input id="s" class="form-control form-search" type="text" name="s" placeholder="Nhập từ khóa tìm kiếm sản phẩm">						<span class="input-group-btn">							<button class="btn btn-danger" type="submit">							<i class="glyphicon glyphicon-search"></i>							</button>						</span>					</div>				</form>			</div>
		</div><!-- #main-menu -->		
	</div><!-- #main-menu-container -->	
	<div id="sub-menu-container" class="container-full-width">
		<div id="sub-menu" class="container">
			<nav id="sub-navigation" class="site-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<?php if( has_nav_menu( 'sub-header-menu', 'responsive-mobile' ) ) {
				wp_nav_menu(
					array(
						'container'      => '',
						'menu_class'     => 'sub-header-menu',
						'theme_location' => 'sub-header-menu'
					)
				);
			} ?>
			</nav><!-- #site-navigation -->
		</div><!-- #sub-menu -->
	</div><!-- #sub-menu-container -->
<?php responsive_mobile_wrapper(); // before wrapper container hook ?>
	<div id="wrapper" class="site-content container-full-width">
<?php responsive_mobile_wrapper_top(); // before wrapper content hook ?>
<?php responsive_mobile_in_wrapper(); // wrapper hook ?>