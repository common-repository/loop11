<?php
/*
Plugin Name: Loop11
Plugin URI: http://www.loop11.com
Description: This plugin allows simple insertion of the Loop11 JavaScript code, no programming required, start your user testing today!
Author: Loop11
Version: 1.0
Author URI: http://www.loop11.com
*/

wp_register_style('loop11_wp.css', plugins_url('loop11_wp.css', __FILE__ ));

function loop11_addOptions()
{
	add_option('loop11_script');
}
register_activation_hook(__FILE__, 'loop11_addOptions');

function loop11_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=loop11-dashboard">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'loop11_settings_link' );

function loop11_menu() {
  add_menu_page('Loop11', 'Loop11', 'administrator', 'loop11-dashboard', 'loop11_options3', plugins_url('loop11/loop11_logo_wp.png'));
  //add_submenu_page('loop11-dashboard', 'Dashboard', 'Dashboard', 'administrator', 'loop11-dashboard', 'loop11_options3');
  //add_submenu_page('loop11-dashboard', 'Tracking code', 'Tracking code', 'administrator', 'loop11-for-wordpress', 'loop11_options');
}

function loop11_options3() {
  wp_enqueue_style('loop11_wp.css');
echo '

<table class="intro">
	<tr>
		<td class="top" colspan="2"><img src="' .plugins_url('loop11/loop11_logo.png', dirname(__FILE__) ). '" > 

	</tr>
	<tr>
		<td class="top2" colspan="2">
		<h2>Welcome to the Loop<sup>11</sup> WordPress Plugin</h2>
		Here you can add the Loop<sup>11</sup> JavaScript in one simple step! You\'re tests will be live instantly (if you\'ve launched them in Loop<sup>11</sup>) and you can start collecting valuable insights to inform your design and development.';

if(get_option('lp11_settings') == ''){
	echo '<h3>Get started</h3>
	In order to get started with the Loop<sup>11</sup> Wordpress-plugin you need to register an account on <a href="http://loop11.com/signup/" target="_blank" title="Loop11 - User Testing">loop11.com</a> (it&#39;t free to try). Once you have an account you simply need to paste the <div title="To find your tracking code, once signed up, click on &#39;My Account&#39; and copy the code beneath the heading &#39;JavaScript&#39;. If you are launching a test which intercepts visitors with a pop-up, you will be provided with a slightly different piece of code prior to launching your test."  class="hover"> code into Wordpress</div>. Simply go to your Loop<sup>11</sup> account, click on &#39;My Account&#39;, and find your tracking code. Copy this into the box here: <a href="' .get_option('loop11-dashboard', 'options-general.php?page=loop11'). '">Insert tracking code</a>.';
}
echo '
	</td>
	</tr>
</table>
	
<table class="square">
	<tr>
		<td class="link"><a href="' .get_option('loop11-dashboard', 'options-general.php?page=loop11'). '">
			<table class="intro2">
				<tr>';
	
$codePresent 	= get_option('lp11_settings');
$valPresent		= $codePresent['lp11_textarea_field_0'];

if($codePresent == '' || $valPresent	 == ''){
	echo '<td><img src="' .plugins_url('loop11/gear_bad.png', dirname(__FILE__) ). '" >
					</td>
					<td><h3>Insert tracking code</h3>
		In order to start running tests you need to input your <div title="To find your tracking code you must log in to Loop11.com and go to your list of websites. Click &#39;edit&#39; at the appropriate site and copy the code from the box in the bottom left corner." class="hover">tracking code</div> here, and it will automatically be inserted into every page of your Wordpress-site - it&#39;s really as easy as that.
					</td></tr>
			</table>
		</a></td>';
}
else{
	echo '<td><img src="' .plugins_url('loop11/gear_good.png', dirname(__FILE__) ). '" >
					</td>
					<td><h3>Tracking code installed</h3>
		Your tracking code is now installed. If you want to view, change or uninstall the code, click here. The installation is not complete until the first visitor is recorded on your site.
					</td></tr>
			</table>
		</a></td>';
}
		
echo '<td class="link"><a href="https://www.loop11.com/help/" target="_blank">
			<table class="intro2">
				<tr>
					<td><img src="' .plugins_url('loop11/support.png', dirname(__FILE__) ). '" >
					</td>
					<td><h3>Troubleshooting</h3>
		If you have questions or problems using Loop<sup>11</sup>, chances are you will find the answers in our extensive FAQs and other helpful information. Or you can shoot us an email at support@loop11.com.
					</td>
				</tr>
			</table>
		</a></td>
	</tr>
</table>

';

}

add_action('admin_menu', 'loop11_menu');


// New API Code
add_action( 'admin_menu', 'lp11_add_admin_menu' );
add_action( 'admin_init', 'lp11_settings_init' );


function lp11_add_admin_menu(  ) { 

	add_options_page( 'Loop11', 'Loop11', 'manage_options', 'loop11', 'lp11_options_page' );

}


function lp11_settings_init(  ) { 

	register_setting( 'pluginPageL11', 'lp11_settings' );

	add_settings_section(
		'lp11_pluginPage_section', 
		__( 'Insert tracking code (save empty field to delete)', 'loop11' ), 
		'lp11_settings_section_callback', 
		'pluginPageL11'
	);

	add_settings_field( 
		'lp11_textarea_field_0', 
		__( 'Loop<sup>11</sup> Javascript', 'loop11' ), 
		'lp11_textarea_field_0_render', 
		'pluginPageL11', 
		'lp11_pluginPage_section' 
	);


}


function lp11_textarea_field_0_render(  ) { 

	$options = get_option( 'lp11_settings' );
	?>
	<textarea cols='85' rows='5' name='lp11_settings[lp11_textarea_field_0]'><?php echo $options['lp11_textarea_field_0']; ?></textarea>
	<?php

}


function lp11_settings_section_callback(  ) { 

	echo __( 'When logged in to Loop<sup>11</sup> you can <a href="https://www.loop11.com/account/details/">find the tracking code on your "My Account" page</a>. If you don\'t yet have an account, you can easily <a href="http://loop11.com/sign-up/" target="_blank">create an account for free</a>.', 'loop11' );

}


function lp11_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>Loop<sup>11</sup></h2>

		<?php
		$currentCode 	= get_option('lp11_settings');
		$currentCode	= $currentCode['lp11_textarea_field_0'];
		
		if(get_option('lp11_settings') == '' || $currentCode == ''){
			echo "";
		} else {
			echo '<h4>Your current Loop<sup>11</sup> tracking code:</h4><code>';
			echo esc_html(str_replace(">", "&gt;",str_replace("<", "&lt;", $currentCode)));
		echo '</code>';
		}
		settings_fields( 'pluginPageL11' );
		do_settings_sections( 'pluginPageL11' );
		submit_button();
		?>

	</form>
	<?php

}


function add_loop11_script()
{
	//echo get_option('lp11_settings');
	$lp11SettingArray = get_option('lp11_settings');
	echo $lp11SettingArray['lp11_textarea_field_0'];
}
add_action('wp_footer', 'add_loop11_script');
?>