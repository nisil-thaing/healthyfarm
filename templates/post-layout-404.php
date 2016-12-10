<?php
/*
 * The template for displaying "Page 404"
 * 
 * @package Healthy Farm
*/
?>
<section>
	<article>
		<div class="page404">
			<h2 class="title404"><?php _e( '404', 'themerex' ); ?></h2>
			<p>
				<?php echo sprintf(__('Go back, or return to <a href="%s">%s</a> home page to choose a new page.', 'themerex'), home_url(), get_bloginfo()); ?>
				<br>
				<?php _e('Please report any broken links to our team.', 'themerex'); ?>
			</p>
			<?php echo do_shortcode('[trx_button skin="global" text="go back home" link="http://healthyfarm.themerex.net/" style="bg" size="medium" fullsize="no" target="no" popup="no" top="30"]') ?>
			<div class="widget404">
				<?php echo do_shortcode('[trx_sidebar name="custom-sidebar-12" columns="1"]') ?>
			</div>
		</div>
	</article>
</section>
