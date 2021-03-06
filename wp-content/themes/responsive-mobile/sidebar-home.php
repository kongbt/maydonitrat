<?php
/**
 * Sidebar Home
 *
 * Displays on the Home Page
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

responsive_mobile_widgets_before(); // above widgets container hook ?>
	<div id="widgets" class="home-widgets">
		<div id="home_widget_1" class="home-widget">
			<?php responsive_mobile_widgets(); // above widgets hook ?>

			<?php if( !dynamic_sidebar( 'home-widget-1' ) ) : ?>
				<aside class="widget-wrapper">

					<h3 class="widget-title-home"><?php _e( 'Home Widget 1', 'responsive-mobile' ); ?></h3>
					<div class="textwidget"><?php _e( 'This is your first home widget box. To edit please go to Appearance > Widgets and choose 6th widget from the top in area 6 called Home Widget 1. Title is also manageable from widgets as well.', 'responsive-mobile' ); ?></div>

				</aside><!-- end of .widget-wrapper -->
			<?php endif; //end of home-widget-1 ?>

			<?php responsive_mobile_widgets_end(); // responsive after widgets hook ?>
		</div><!-- home-widget-1 -->

		<div id="home_widget_2" class="home-widget">
			<?php responsive_mobile_widgets(); // responsive above widgets hook ?>

			<?php if( !dynamic_sidebar( 'home-widget-2' ) ) : ?>
				<aside class="widget-wrapper">

					<h3 class="widget-title-home"><?php _e( 'Home Widget 2', 'responsive-mobile' ); ?></h3>
					<div class="textwidget"><?php _e( 'This is your second home widget box. To edit please go to Appearance > Widgets and choose 7th widget from the top in area 7 called Home Widget 2. Title is also manageable from widgets as well.', 'responsive-mobile' ); ?></div>

				</aside><!-- end of .widget-wrapper -->
			<?php endif; //end of home-widget-2 ?>

			<?php responsive_mobile_widgets_end(); // after widgets hook ?>
		</div><!-- home-widget-2 -->

		<div id="home_widget_3" class="home-widget">
			<?php responsive_mobile_widgets(); // above widgets hook ?>

			<?php if( !dynamic_sidebar( 'home-widget-3' ) ) : ?>
				<aside class="widget-wrapper">

					<h3 class="widget-title-home"><?php _e( 'Home Widget 3', 'responsive-mobile' ); ?></h3>
					<div class="textwidget"><?php _e( 'This is your third home widget box. To edit please go to Appearance > Widgets and choose 8th widget from the top in area 8 called Home Widget 3. Title is also manageable from widgets as well.', 'responsive-mobile' ); ?></div>

				</aside><!-- end of .widget-wrapper -->
			<?php endif; //end of home-widget-3 ?>

			<?php responsive_mobile_widgets_end(); // after widgets hook ?>
		</div><!-- home-widget-3 -->
	</div><!-- end of #widgets -->
<?php responsive_mobile_widgets_after(); // after widgets container hook ?>