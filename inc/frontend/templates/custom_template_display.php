<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<?php
	// echo "<pre>";
	// print_r($custom_template);
	// echo "</pre>";
	if ($display_settings['layout']['select_template_type'] == 'custom') :
 ?>
<style type="text/css">

	<?php if ($display_settings['layout']['bar_template_type'] == 'Template-5'): ?>
		.wpcui-cookie-bar-display .wpcui-cookie-bar-body.wpcui_template_Template-5:before{
			<?php
			//When Custom colors are enabled
				echo "background: " . esc_attr($custom_template['info_bar_bg']) . ";";
		    ?>
		}
	<?php else: ?>
		#wpcui_cookie_bar_main_body{
			<?php
			//When Custom colors are enabled
				echo "background: " . esc_attr($custom_template['info_bar_bg']) . ";";
		    ?>
		}
	<?php endif ?>

	.wpcui-cookie-bar-info-wrap{
		<?php
		//When Custom colors are enabled
			echo "color: " . esc_attr($custom_template['info_bar_color']) . ";";
		?>
	}

	div#wpcui_cookie_bar_main_body .wpcui-cookie-bar-info-wrap a{
		<?php
			echo "color: " . esc_attr($custom_template['info_bar_color']) . ";";
		?>
	}

	.wpcui-cookie-bar-display .wpcui-cookie-bar-body .wpcui-1-column p {
		<?php
			echo "font-family: " . esc_attr($custom_template['font_family']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-info-confirm{
		<?php
		//When Custom colors are enabled
			echo "color: " . esc_attr($custom_template['info_bar_button_color']) . ";"; 
			echo "background: " . esc_attr($custom_template['info_bar_button_bg']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-info-confirm:hover{
		<?php
			echo "color: " . esc_attr($custom_template['info_bar_hover_button_text_color']) . ";";
			echo "background: " . esc_attr($custom_template['info_bar_hover_button_bg_color']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-close-button {
	    <?php
		//When Custom colors are enabled
	    	echo "background: " . esc_attr($custom_template['close_button_button_bg']) . ";";
	    ?>
	}

	#wpcui_cookie_bar_main_body .wpcui-3-column:after {
		<?php
			echo "color: " . esc_attr($custom_template['close_button_button_color']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-3-column:hover:after{
		<?php
		echo "color: " . esc_attr($custom_template['close_button_hover_button_text_color']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-close-button:hover{
		<?php
		//When Custom colors are enabled
	    	
	    	echo "background: " . esc_attr($custom_template['close_button_hover_button_bg_color']) . ";";
	    ?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-more_info{
		<?php
			echo "color: " . esc_attr($custom_template['more_info_bar_button_color']) . ";";
			echo "background: " . esc_attr($custom_template['more_info_bar_button_bg']) . ";";
		?>
	}

	#wpcui_cookie_bar_main_body .wpcui-cookie-bar-more_info:hover{
		<?php
			echo "color: " . esc_attr($custom_template['more_info_bar_hover_button_text_color']) . ";";
			echo "background: " . esc_attr($custom_template['more_info_bar_hover_button_bg_color']) . ";";
		?>
	}
</style>
<?php endif; ?>