<?php
/*
Plugin Name:  Curious Brains GF HubSpot Addon
Description:  GF HubSpot Addon seamlessly connects form data fields with WordPress admin.
Version:      1.0
Author:       WP Curious brains
Author URI:   https://wpcuriousbrains.com/
License:
License URI:
Text Domain:  wpcuriousbrains.com
*/

define( 'GF_HUBSPOT_ADDON_VERSION', '2.0' );
 
add_action( 'gform_loaded', array( 'GF_Hubspot_AddOn_Bootstrap', 'load' ), 5 );
 
   class GF_Hubspot_AddOn_Bootstrap {
 
         public static function load() {
 
                    if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
                       return;
                }
 
              require_once( 'GFHubspotAddOn.php' );
 
              GFAddOn::register( 'GFHubspotAddOn' );
          }
 
   }
 
    function gf_simple_addon() {
                return GFHubspotAddOn::get_instance();
       }

     register_activation_hook( __FILE__, 'child_plugin_activate' );
              function child_plugin_activate(){
                  delete_option('hide_div_element');
                  delete_option('hubspot_table_name1');
                  delete_option('hubspot_table_name2');
                  delete_option('save_sink_data_formhubspot_clientid');
                 delete_option('save_sink_data_formhubspot_accesstoken');
                  delete_option('hubspot_table_name1');
                 delete_option('hubspot_table_name2');
                 delete_option('statushub');
                 global $wpdb; 
                                                                               $mydb = new wpdb(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
                                                                                   
                                                                              
                                                                              $table_prefixname=$wpdb->prefix;
                                                                              $tablename='curious_brains_hubspotapidata';
                                                                              $finaltablename=$table_prefixname;
                                                                              $finaltablename.=$tablename;
                                                                              $db_table_name =$finaltablename;
                                                                              add_option('hubspot_table_name1',$db_table_name);

                                                                              // everytime we click on hubspot we delete previous hubspot field type and insert new field type
                                                                              if($wpdb->get_var( "show tables like '$db_table_name'" ) == $db_table_name ){
                                                                                    $gettablename1=get_option('hubspot_table_name1');
                                                                                    $sql20 ="DELETE FROM $gettablename1";
                                                                                    $wpdb->query($sql20);
                                                                                    $wpdb->show_errors;
                                                                                   // echo"hhh";die;
                                                                                 }

                                                                                     global $wpdb;
                                                                             $mydb1 = new wpdb(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
                                                                             //$db_table_name1='hubspot_field_data';
                                                                             $table_prefixname1=$wpdb->prefix;
                                                                              $tablename1='curious_brains_hubspot_field_data';
                                                                              $finaltablename1=$table_prefixname1;
                                                                              $finaltablename1.=$tablename1;
                                                                              $db_table_name1 =$finaltablename1;
                                                                              add_option('hubspot_table_name2',$db_table_name1);

                                                                               // everytime we click on hubspot we delete previous hubspot field type and insert new field type
                                                                              if($wpdb->get_var( "show tables like '$db_table_name1'" ) == $db_table_name1 ){
                                                                                    $gettablename2=get_option('hubspot_table_name2');
                                                                                    $sql21 ="DELETE FROM $gettablename2";
                                                                                    $wpdb->query($sql21);
                                                                                    $wpdb->show_errors;
                                                                                 }
           // Require parent plugin to check
                         if ( ! is_plugin_active( 'gravityforms/gravityforms.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
                           wp_die('Sorry, this plugin requires <a href="https://www.gravityforms.com/">Gravity Form</a> plugin to be installed and activated. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
                      }
              }
       add_filter( 'plugin_row_meta', 'hubspot_plugin_meta_links', 10, 2 );

                                    function hubspot_plugin_meta_links( $links, $file ) {
                                        if ( strpos( $file, basename(__FILE__) ) ) {
                                            $links[] = '<a href="mailto:contact@wpcuriousbrains.com" target="_blank" title="Customization">Customization</a>';
                                            $links[] = '<a href="mailto:support@wpcuriousbrains.com" target="_blank" title="Support">Support</a>';
                                            $links[] = '<a href="https://wpcuriousbrains.com/docs/" target="_blank" title="Docs">Docs</a>';
                                            
                                           
                                        }
                                        return $links;
                                    }
