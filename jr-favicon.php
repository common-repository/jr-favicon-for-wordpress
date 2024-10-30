<?php
/*
Plugin Name: JR Favicon for Wordpress
Plugin URI: http://www.jacobras.nl/wordpress/favicon-for-wordpress/
Description: Auto adds your favicon (small icon) in the browser's title bar, making your blog easier to recognize. Also works in Internet Explorer, unlike some other plugins.
Version: 1.1
Author: Jacob Ras
Author URI: http://www.jacobras.nl

	Copyright 2009  Jacob Ras  (email : info@jacobras.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

--------------------

~ Changelog:
v1.1 (November 9, 2009)
- Plugin now automatically selects favicon.ico from your website root
- Displays a preview of your favicon at the plugin page

v1.0 (November 7, 2009)
- First final release

*/

function jr_favicon() {
	
	$jr = get_option('jr_favicon');
	if (!empty($jr['ico_url'])) { echo '<link rel="shortcut icon" href="' . $jr['ico_url'] . '" type="image/x-icon" />' . "\n"; }
	
}

function jr_favicon_admin() { ?>
	
	<div class="wrap">
		<a href="http://www.jacobras.nl"><img src="http://www.jacobras.nl/logo-32.png" width="32" height="32" style="float:left;margin:14px 6px 0 6px;" alt="" /></a>
		<h2>JR Favicon for Wordpress</h2>
		
		<?php if($_POST['jr_hidden'] == 'Y') {
			$jr['ico_url'] = $_POST['jr_ico_url'];
			update_option('jr_favicon', $jr);
			?>
			<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
			<?php
		} else {
			$jr = get_option('jr_favicon');
		} ?>
		
		<div class="postbox-container" style="width:70%;"><div class="metabox-holder">
			<form action="" method="post">
			<input type="hidden" name="jr_hidden" value="Y" />
				<div class="postbox">
					<h3><span>Settings for JR Favicon</span></h3>
					<div class="inside">
						<table class="form-table">
							<tr>
								<th valign="top">
									<label>Favicon URL:</label><br/>
									<small>The location of your favicon. Ex: http://www.site.com/favicon.ico . Please read <a href="http://www.jacobras.nl/wordpress/favicon-for-wordpress/#installation">How to make a favicon</a> first.</small>
								</th>
								<td valign="top"><input type="text" name="jr_ico_url" value="<?php echo $jr['ico_url']; ?>" size="50" /></td>
							</tr>
							<tr>
								<th valign="top">
									<label>Favicon preview:</label><br/>
									<small>Did you enter the correct URL?</small>
								</th>
								<td valign="top">
									<img src="<?php echo $jr['ico_url']; ?>" width="16" height="16" alt="If you see this text, your URL is not correct. Please check the URL you've entered." />
								</td>
							</tr>
						</table>
						<div style="margin:20px 0 12px 0;padding-left:12px;"><input type="submit" class="button-primary" name="submit" value="Save settings" /></div>
					</div>
				</div>
			</form>
		</div></div>
		
		<div class="postbox-container" style="width:20%;">
			<div class="metabox-holder">
				<div class="postbox">
					<h3><span>Need help?</span></h3>
					<div class="inside" style="padding:0 12px;">
						<p>If you have any problems with this plugin or good ideas for improvements or new features, please <a href="http://www.jacobras.nl/contact/">let me know</a>.</p>
					</div>
				</div>
				
				<div class="postbox">
					<h3><span>Like this plugin?</span></h3>
					<div class="inside" style="padding:0 12px;">
						<p>Why don't you:</p>
						
						<a href="http://www.jacobras.nl/wordpress/" style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Check out my other handy plugins</a>
						
						<a href="http://wordpress.org/extend/plugins/jr-favicon/" style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Vote for the plugin on WordPress.org.</a>
						
						<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=F8RVLT4RZTVJY&lc=NL&item_name=JR%20Favicon%20for%20Wordpress&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" style="padding:4px;display:block;padding-left:25px;background-repeat:no-repeat;background-position:2px 50%;text-decoration:none;border:none;background-image:url(http://www.jacobras.nl/logo-16.png);">Donate a token of your appreciation.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php }

function jr_favicon_configpagina() {
	add_options_page("JR Favicon for Wordpress", "JR Favicon", 1, "jr-favicon", "jr_favicon_admin");  
}


// default settings
$jr 					= array();
$jr['ico_url']			= get_bloginfo('url') . '/favicon.ico';
add_option('jr_favicon', $jr);
add_action('admin_menu', 'jr_favicon_configpagina');
add_action('wp_head', 'jr_favicon');
?>