<?php 
/**
 * Plugin Name: BangLa Plugin
 * Author: Bang
 * Version: 1.0
 * Description: Hello 
 */
function hi_you()
{
    $content= "This is the Basic plugin.";
    $content .= "<div>This is a div </div>";
    $content.="<p>This is a block of paragraph</p>";
    return $content;
}
add_shortcode('example','hi_you');


function bangla_admin_menu_option()
{
    add_menu_page('Header & Footer Scripts','Site Scripts','manage_options','bangla-admin-menu','bangla_scripts_page','',200);
}
add_action('admin_menu','bangla_admin_menu_option');

function bangla_scripts_page()
{
    if(array_key_exists('submit_scripts_update',$_POST))
    {
        update_option('bangla_header_scripts', $_POST['header_scripts']);
        update_option('bangla_footer_scripts', $_POST['footer_scripts']);
        ?>
        <div id="setting-error-setting-updated" class="update_setting_error notice is-dismissible"><strong>Setting have been save.</strong></div>
        <?php
    }
    $header_scripts = get_option('bangla_header_scripts','none');
    $footer_scripts = get_option('bangla_footer_scripts','none');
    ?>
    <div class="wrap">
        <h2>Update Scripts</h2>
        <form method ="post" action="">
            <label for="header_scripts">Header Scripts</label>
            <textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>
            <label for="footer_scripts">Footer Scripts</label>
            <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts; ?></textarea>
            <input type="submit" name ="submit_scripts_update" class="button button-primary">
        </form>
    </div>
    <?php
}
function bangla_display_header_scripts()
{
    $header_scripts = get_option('bangla_header_scripts','none');
    print $header_scripts;
}
add_action('wp_head','bangla_display_header_scripts');

function bangla_display_footer_scripts()
{
    $footer_scripts = get_option('bangla_footer_scripts','none');
    print $footer_scripts;
}
add_action('wp_footer','bangla_display_footer_scripts');

function bangla_form()
{
    $content = '';
    $content .= '<form method ="post" action="http://localhost/bangla/thank-you/">';
        
        $content .= '<input type ="text" name ="full_name" placeholder="Your Full Name"/>';
        $content .='<br/>';

        $content .= '<input type ="text" name ="email_address" placeholder="Email Address"/>';
        $content .='<br/>';

        $content .= '<input type ="text" name ="phone_number" placeholder="Phone Number"/>';
        $content .='<br/>';

        $content .= '<textarea name ="comments" placeholder="Give us your comments"/></textarea>';
        $content .='<br/>';

        $content .= '<input type ="submit" name="bangla_submit_form" value="SUBMIT YOUR INFORMATION"/>';
    $content.='</form>';
    return $content;
}
add_shortcode('bangla_contact_form', 'bangla_form');

function set_html_content_type()
{
    return 'text/html';
}
function bangla_form_capture()
{
    if(array_key_exists('bangla_submit_form',$_POST))
    {
        global $post,$wpdb;

        $to = $_POST['email_address'];
        $subject = "BangLa site Form submission";
        $body ='';
        $body .= 'Name: '. $_POST['full_name'].'<br/>';
        $body .= 'Email: '. $_POST['email_address'].'<br/>';
        $body .= 'Phone: '. $_POST['phone_number'].'<br/>';
        $body .= 'Comments: '. $_POST['comments'].'<br/>';

        add_filter('wp_mail_content_type','set_html_content_type');
        wp_mail($to,$subject,$body);
        remove_filter('wp_mail_content_type','set_html_content_type');
        

        /*$time = current_time('mysql');
        $data = array(
            'comment_post_ID' => $post->ID,
            'comment_content' => $body,
            'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
            'comment_date' => $time,
            'comment_approved' => 1,
        );
        wp_insert_comment($data);*/


        //insert data to database we create
        $insertData = $wpdb->get_results("INSERT INTO ".$wpdb->prefix."form_submissions (data) VALUES ('" .$body. "')");
    }
}
add_action('wp_head','bangla_form_capture');
?>