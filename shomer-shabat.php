<?php
/*
Plugin Name: shomer-shabat שומר שבת
Plugin URI: http://www.webmarker.co.il/2012/08/02/אתר-שומר-שבת-תוסף-לוורדפרס/
Description: מערכת לסגירת אתרים בשבתות וחגים
Author: michael moyal
Version: 1.0
Author URI: http://www.webmarker.co.il/
Tags: hebrew,jewish,shabat
License: GPL http://www.gnu.org/copyleft/gpl.html
*/

function headshabat() {
 require_once(WP_PLUGIN_DIR .'/shomer-shabat/head.php');
}
add_action('wp_head', 'headshabat');


function footershabat() {
 require_once(WP_PLUGIN_DIR .'/shomer-shabat/footer.php');
}
add_action('wp_footer', 'footershabat');
?>
<?php
// admin
add_action('admin_menu', 'shomer_shabat_menu');

function shomer_shabat_menu() {

//top-level menu
	add_menu_page('shomer-shabat', 'אתר שומר שבת', 'administrator', __FILE__, 'shomer_shabat_settings_page',plugins_url('/s.ico', __FILE__));

//register settings function
	add_action( 'admin_init', 'register_mysettings' );

}
if (get_option('Creditlink')==0) {add_action('wp_footer', 'linkwebmarker');} else {add_action('wp_footer', 'nolink');}


function linkwebmarker() { 
echo '<br><a href="http://www.webmarker.co.il/">בניית אתרים</a>';
}
function nolink() { 
echo '';
}

function register_mysettings() {
	//register our settings
	register_setting( 'shomer-shabat-settings-group', 'Creditlink' );	
}

function shomer_shabat_settings_page() {
?>
<div class="wrap">
<h2>אתר שומר שבת</h2>
<br>
המערכת מספקת שירות חינמי לסגירת אתרים בשבתות וחגים. סגירת האתר מתבצעת לפני כניסת השבת עבור כל גולש בנפרד, על פי מיקומו בעולם באותו רגע.
<br>
בעזרת השירות תוכל למנוע חילול שבת של מבקרים באתרך. גולש אשר במקום הימצאו נכנסה השבת, יופנה לדף סגירה זמני עד ליציאת השבת.
<br>

<p>
<a href="<?php bloginfo('url'); ?>/#holyclock=test" TARGET="_blank">לדוגמא לדף שהגולשים שלך יראו בשבת - לחץ/י כאן</a>

<p><br></br>

<form method="post" action="options.php">
    <?php settings_fields( 'shomer-shabat-settings-group' ); ?>
    <?php do_settings_sections( 'shomer-shabat-settings-group' ); ?>
    <table class="form-table">
		<tr valign="top">
        <th scope="row">
		<?php echo '<img src="' .plugins_url( '/link.jpg' , __FILE__ ). '">'; ?>
		</th>
        </tr>
		
		<tr valign="top">
        <td>
		<input type="checkbox" name="Creditlink" value="1" <?php if(get_option('Creditlink')==1) echo('checked="checked"'); ?>/>  <?php _e('להסיר את קישור הקרדיט מתחת ללוגו ','Creditlink');?>
		</td>
        </tr>
    </table>
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>


<p><br></br>
שירות סגירת האתר בשבת פותח ע"י 
<a href="http://www.holyclock.com/" TARGET="_blank">holyclock</a>
<br>
תוסף הטמעת השירות לוורדפרס פותח ע"י <a href="http://www.webmarker.co.il/" TARGET="_blank">ווב מרקר</a> - חברה לבניית אתרי אינטרנט
<a href="http://www.webmarker.co.il/%D7%A6%D7%95%D7%A8-%D7%A7%D7%A9%D7%A8/" TARGET="_blank">(יצירת קשר)</a>
</div>
<?php } ?>