<?php
include('assets/validation.php');

function get_display_name($user_id)
{
    if (!$user = get_userdata($user_id)) return false;
    return $user->data->display_name;
}

$post_id = $_GET['post'];

add_filter('login_headerurl', 'custom_loginlogo_url');

function custom_loginlogo_url($url)
{

    return 'http://www.cda.gov.ph';

}

function favicon4admin()
{
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="https://cda.gov.ph/wp-content/uploads/2021/03/favicon-2.ico" />';
}
add_action('admin_head', 'favicon4admin');

add_filter('gettext', 'register_text');
add_filter('ngettext', 'register_text');
function register_text($translating)
{
    $translated = str_ireplace('', 'Registered Email Address', $translating);
    return $translated;
}
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin())
    {
        show_admin_bar(false);
    }
}
remove_admin_bar();

// Custom WordPress Admin Menu
function wpb_custom_new_menu()
{
    register_nav_menu('sitemap', __('Sitemap'));;
    register_nav_menu('top_head_menu', __('Top Head Menu'));
    register_nav_menu('ctpro_menu', __('CTPRO Menu'));
    register_nav_menu('footer_links', __('Footer Links'));
    register_nav_menu('quick_links', __('Quick Links'));
    register_nav_menu('officials_menu', __('Officials Menu'));
    register_nav_menu('regional_officer', __('Regional Officer Menu'));
}
add_action('init', 'wpb_custom_new_menu');

add_action('init', 'wpb_custom_new_menu');
function admin_style()
{
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/wp-admin/style.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/wp-admin/login.css');
}
add_action('login_enqueue_scripts', 'my_login_stylesheet');

add_action('admin_init', 'wpse_110427_hide_title');
function wpse_110427_hide_title()
{
    if (current_user_can('administrator')) remove_post_type_support('cea', 'title');
    if (current_user_can('administrator')) remove_post_type_support('ctpost', 'title');
    if (current_user_can('administrator')) remove_post_type_support('certifications', 'title');
    if (current_user_can('administrator')) remove_post_type_support('accreditations', 'title');
    if (current_user_can('administrator')) remove_post_type_support('monthly_reports', 'title');
    if (current_user_can('administrator')) remove_post_type_support('quarterly_reports', 'title');
    if (current_user_can('administrator')) remove_post_type_support('yearly_reports', 'title');
    if (current_user_can('administrator')) remove_post_type_support('regional_officers', 'title');
    if (current_user_can('administrator')) remove_post_type_support('recommendations', 'title');
}

function InsertRegionalOfficer($post_id)
{
    if (get_post_type($post_id) != 'regional_officers')
    {
        return;
    }
    else
    {

        $account_username = get_field('email_address');
        $account_password = get_field('last_name');
        $email_address = get_field('email_address');
        $company_name = get_field('first_name');
        $region = get_field('region');
        $userole =  get_field('user_role');
        $update_password = get_post_meta($post_id, 'update_password', true);

        if ($update_password == "0" || empty($update_password))
        {

            $userdata = array(
                'user_login' => $account_username,
                'user_pass' => $account_password,
                'user_email' => $email_address,
                'first_name' => $company_name,
                'last_name' => $account_password,
                'display_name' => "$region - $company_name",
                'role' => $userole
            );
            $user_id = wp_insert_user($userdata);
            update_post_meta($post_id, 'update_password', 1);
            update_post_meta($post_id, 'password', $account_password);
            update_post_meta($post_id, 'confirm_password', $account_password);
            update_post_meta($post_id, 'username', $email_address);
            update_post_meta($post_id, 'update_password', 1);
            update_post_meta($post_id, 'post_id_access', $post_id);
            update_post_meta($post_id, 'title', $region);

            $my_post = array(
                'ID' => $post_id,
                'post_title' => $region
            );
            // Update the post into the database
            wp_update_post($my_post);
        }
    }

}
add_action('acf/save_post', 'InsertRegionalOfficer');

add_action('acf/save_post', 'changeUserStatus');

function changeUserStatus($post_id)
{
    if (get_post_type($post_id) != 'cea')
    {
        return;
    }
    else
    {

        $username = get_post_meta($post_id, 'email', true);
        $status = get_post_meta($post_id, 'status', true);
        $firstname = get_post_meta($post_id, 'first_name', true);
        $lastname = get_post_meta($post_id, 'last_name', true);
        $update_password = get_post_meta($post_id, 'update_password', true);

        $password = $lastname;

        if ($status == 'Approved')
        {
            if ($update_password == "0")
            {
                $the_user = get_user_by('login', $username);
                $the_user_id = $the_user->ID;

                wp_update_user(array(
                    'ID' => $the_user_id,
                    'first_name' => $firstname . " " . $lastname,
                    'role' => 'cea'
                ));

                wp_set_password($password, $the_user_id);
                update_post_meta($post_id, 'password', $password);
                update_post_meta($post_id, 'confirm_password', $password);
                update_post_meta($post_id, 'username', $username);
                update_post_meta($post_id, 'update_password', 1);
                update_post_meta($post_id, 'post_id_access', $post_id);

            }
        }
        else
        {

        }
    }
}

add_action('acf/save_post', 'changeUserStatusCTPRO');

function changeUserStatusCTPRO($post_id)
{
    if (get_post_type($post_id) != 'ctpro')
    {
        return;
    }
    else
    {

        $username = get_post_meta($post_id, 'email', true);
        $status = get_post_meta($post_id, 'status', true);
        $firstname = get_post_meta($post_id, 'first_name', true);
        $lastname = get_post_meta($post_id, 'last_name', true);
        $update_password = get_post_meta($post_id, 'update_password', true);
        $password = $lastname;

        if ($status == 'Approved')
        {
            if ($update_password == "0")
            {
                $the_user = get_user_by('login', $username);
                $the_user_id = $the_user->ID;

                wp_update_user(array(
                    'ID' => $the_user_id,
                    'first_name' => $firstname . " " . $lastname,
                    'role' => 'ctpro'
                ));

                wp_set_password($password, $the_user_id);
                update_post_meta($post_id, 'password', $password);
                update_post_meta($post_id, 'confirm_password', $password);
                update_post_meta($post_id, 'username', $username);
                update_post_meta($post_id, 'update_password', 1);
            }
        }
        else
        {

        }
    }
}

//Include search
function cf_search_join($join)
{
    global $wpdb;
    if (is_search())
    {
        $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join');

function cf_search_where($where)
{
    global $pagenow, $wpdb;
    if (is_search())
    {
        $where = preg_replace("/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where');

/**
 * Prevent duplicates
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct($where)
{
    global $wpdb;
    if (is_search())
    {
        return "DISTINCT";
    }
    return $where;
}
add_filter('posts_distinct', 'cf_search_distinct');

// hide update notifications
function remove_core_updates()
{
    global $wp_version;
    return (object)array(
        'last_checked' => time() ,
        'version_checked' => $wp_version,
    );
}
add_filter('pre_site_transient_update_core', 'remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins', 'remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes', 'remove_core_updates'); //hide updates for all themes
function remove_stupid_php_nag()
{
    remove_meta_box('dashboard_php_nag', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_stupid_php_nag');

function optionsettings()
{
    if (function_exists('acf_add_options_page'))
    {
        acf_add_options_page(array(
            'page_title' => 'Account Settings',
            'menu_title' => 'Account Settings',
            'menu_slug' => 'account-settings',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-admin-site',
            'menu_position' => '1',
            'redirect' => false,
        ));
    }
}
optionsettings();

function trainingReports()
{
    if (function_exists('acf_add_options_page'))
    {
        acf_add_options_page(array(
            'page_title' => 'Training Reports',
            'menu_title' => 'Training Reports',
            'menu_slug' => 'training-reports',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-media-spreadsheet',
            'menu_position' => '3',
            'redirect' => false,
        ));
    }
}
trainingReports();

// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_page(array(
// 		'page_title' 	=> 'Page Settings',
// 		'menu_title'	=> 'Settings',
// 		'menu_slug' 	=> 'my-settings', 
// 		'capability'	=> 'edit_posts',
// 		'redirect'		=> false
// 	));
// }
add_action('init', 'blockusers_init');
function blockusers_init()
{
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX))
    {
        wp_redirect(home_url() . "/profile");
        exit;
    }
}

// Admin footer modification
function remove_footer_admin()
{
    echo '<span id="footer-thankyou">Developed by <a href="http://www.mybusybee.net" target="_blank">Mybusybee Inc</a></span>';
}

add_filter('admin_footer_text', 'remove_footer_admin');



