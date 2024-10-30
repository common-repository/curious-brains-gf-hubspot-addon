<?php

GFForms::include_addon_framework();
  
class GFHubspotAddOn extends GFAddOn {
 
                                      protected $_version = GF_HUBSPOT_ADDON_VERSION;
                                      protected $_min_gravityforms_version = '1.9';
                                      protected $_slug = 'hubspotaddon';
                                      protected $_path = 'hubspotaddon/hubspotaddon.php';
                                      protected $_full_path = __FILE__;
                                      protected $_title = 'GF hubspot Add-On';
                                      protected $_short_title = 'HubSpot Addon';
                                      private static $_instance = null;
 
                                      public static function get_instance() {
                                                     if ( self::$_instance == null ) {
                                                            self::$_instance = new GFHubspotAddOn();
                                                       }
                                                     return self::$_instance;
                                                }

                                      public function init() {
                                                      parent::init();
                                                      add_filter( 'gform_submit_button', array( $this, 'form_submit_button' ), 10, 2 );
                                                   }
                                    public function get_menu_icon() {

                                             return file_get_contents( $this->get_base_path() . '/image/cloud_menu_icon.svg' );

                                        }
                                      public function scripts() {
                                                       $scripts = array(
                                                                       array(
                                                                            'handle'  => 'my_script_js',
                                                                            'src'     => $this->get_base_url() . '/js/gf_hubspot_js.js',
                                                                            'version' => $this->_version,
                                                                            'deps'    => array( 'jquery' ),
                                                                            'in_footer'=>false,
                                                                         
                                                                            'enqueue' => array(
                                                                                array(
                                                                                    'admin_page' => array(  'plugin_settings' ),
                                                                                    
                                                                                 ),
                                                                               array(
                                                                                      'handle'  => 'gform_gravityforms',
                                                                                      'enqueue' => array( array( 'admin_page' => array( 'gf_entries' ) ) )
                                                                                    ),
                                                                            )
                                                                        ),
                                                                    );
                                 
                                                      return array_merge( parent::scripts(), $scripts );
                                                }
 
                                      public function styles() {
                                                       $styles = array(
                                                                    array(
                                                                        'handle'  => 'my_styles_css',
                                                                        'src'     => $this->get_base_url() . '/css/gf_hubspot_style.css',
                                                                        'version' => $this->_version,
                                                                        'enqueue' => array(
                                                                                array( 'admin_page' => array( 'form_settings', 'plugin_settings' ) )                                                                       
                                                                             ),
                                                                       
                                                                                    
                                                                        
                                                                    ),
                                                                    
                                                                );
                                                         
                                                                return array_merge( parent::styles(), $styles );
                                                          }
 
                                            function form_submit_button( $button, $form ) {
                                                                      foreach($form as $gh=>$bby){
                                                                               if($gh=='fields'){
                                                                                   foreach($bby as $bh=>$ct){
                                                                                         $vg[]=$ct->label;
                                                                                       }
                                                                                 }
                                                                            }
                                          
                                                                        $button = "</pre>
                                                                                   <div></div>
                                                                                   <pre>" . $button;
                                                                            return $button;
                                                                    }
                                  

                        // this fun used to get data that we save after mapping to hubspot field type in dropdown with form field name and save to table so that we donnot show popup when we select sink to hubspot in bulk action option in entry page and this func also show mapp data that we map using popup for first time not from form setting hubspot addon

                                // add a custom menu item to the Form Settings page menu

                                     public function form_settings_fields( $form ) {
                                                                                    $form_id_get_v=sanitize_text_field($_GET['id']);
                                                                                    if(is_numeric($form_id_get_v)){
                                                                                        $form_id_get=$form_id_get_v;
                                                                                    }
                                                                                    $formid3_v=sanitize_text_field($_GET['id']);
                                                                                    if(is_numeric($formid3_v)){
                                                                                        $formid3=$formid3_v;
                                                                                    }
                                                                                    $gg[0]="Select";//pass default value when not selected
                                                                                    $getentryidd= GFAPI::get_entries($form_id_get);

                                                         
                                                         
                                                            foreach ($form['fields'] as $key => $value) {
                                                            
                                                                if($value->inputs){
                                                                    foreach ($value->inputs as $arr) {
                                                                        
                                                                            foreach ($arr as $key2 => $value2) {
                                                                               
                                                                                $formarr1[]=$arr['label'];
                                                                              
                                                                            }
                                                                            
                                                                        
                                                                    }

                                                                }else{
                                                                    if($value->label){
                                                                      $formarr1[]=$value->label;
                                                                    }
                                                                }
                                                           
                                                            $formarr=array_unique($formarr1);
                                                        

                                                                     if(!empty(get_option('fieldform'))){
                                                                        delete_option('fieldform');
                                                                        update_option('fieldform',$formarr);
                                                                     }else{
                                                                        update_option('fieldform',$formarr);
                                                                    }
                                                                                 // get all field type from hubspot that we stored on option
                                                                            }
                                                                              
                                                                              $gettablename1=get_option('hubspot_table_name1');
                                                                                   global $wpdb; 
                                                                                          $sql = "SELECT `field` FROM $gettablename1";
                                                                                          $wpdb->show_errors;
                                                                                          $result=$wpdb->get_results($sql);

                                                                                        $statushub=get_option('statushub');//get all lead status from hubspot
                                                                                        if(!empty($statushub)){
                                                                                             foreach($statushub as $gy=>$op){
                                                                                                       $status[]=$op;// all status
                                                                                                    }
                                                                                                }
                                                                                                        if (!empty($result)) {
                                                                                                              foreach($result as $vu=>$nh) {
                                                                                                                      foreach($nh as $vo){
                                                                                                                              $gg[]=$vo;
                                                                                                                            }
                                                                                                                        }
                                                                                                                } else {
                                                                                                                       
                                                                                                                      }
                  
                                                                                      $table=get_option('fieldform');
                                                                                     
                                                                                    $gettablename2=get_option('hubspot_table_name2');
                                                                                       global $wpdb; 
                                                                                       // get form id to check whether this form is already mapped through popup if yes then we show mapped data in form setting hubspot addon page else not
                                                                                      $get_popup_save_form_id_key="hubspot_savefieldid_show_inform_save".$form_id_get;
                                                                                       $sql = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$get_popup_save_form_id_key'";
                                                                                       $wpdb->show_errors;
                                                                                       $sql_result=$wpdb->get_results($sql);
                                                                                    
                                                                                       if(!empty($sql_result[0]->fieldvalue)){
                                                                                             $final_results=$sql_result[0]->fieldvalue;
                                                                                          }
                                                                                         
                                                                                       if (!empty($final_results)) {
                                                                                             $formid_save_field_formid=json_decode($final_results);
                                                                                           }
                                                                                       // get mapped data that mapped through popup in entry page using bulk action sink to hubspot first time                                                
                                                                                     $save_mapfield_arr_hubspot_form_key="save_mapfield_arr_hubspot_form".$form_id_get;
                                                                                     $gettablename2=get_option('hubspot_table_name2');
                                                                                      $sqld = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$save_mapfield_arr_hubspot_form_key'";
                                                                                      $wpdb->show_errors;
                                                                                      $sql_resultd=$wpdb->get_results($sqld);

                                                                                       if(!empty($sql_resultd[0]->fieldvalue)){
                                                                                             $final_result8=$sql_resultd[0]->fieldvalue;
                                                                                           }
                                                                                       if (!empty($final_result8)) {
                                                                                             $formid_save_field_formid_value=json_decode($final_result8);
                                                                                            }                                  
                                                                                                                           
                                                                                             if(!empty($formid_save_field_formid)){
                                                                                                                          if(!empty($getentryidd)){//check at least one entry exit or not
                                                                                     foreach($getentryidd as $key1=>$value1){
                                                                                         foreach ($value1 as $key2 => $value2) {
                                                                                             if($key2=='id'){
                                                                                                    $getallentryid[]=$value2;
                                                                                                }
                                                                                             }
                                                                                        }
                                                                                  foreach($getallentryid as $bh=>$vab){
                                                                                            $get_all_entry_detail[]=GFAPI::get_entry($vab);
                                                                                     }
                                                    
                                                                                 foreach ($get_all_entry_detail as $key => $value) {
                                                                                     foreach($value as $key2=>$value4){
                                                                                             if(!empty($value4)){
                                                                                                    if(is_numeric($key2) ){
                                                                                                        $entry_field_id_macth[$form_id_get][]=$key2;
                                                                                                    }
                                                                                                }
                                                                                        }
                                                                                  }
                                                                                  //get form entry field label name after creating at least one entry
                                                                                foreach($form['fields'] as $key3=>$val3){
                                                             
                                                                                      if($val3->inputs){
                                                                                           foreach($val3->inputs as $key4=>$val4){
                                                                                            foreach ($val4 as $key5 => $value5) {
                                                                                                if($key5=='id'){
                                                                                                    foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                      
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($value5==$value7){
                                                                                                                $entry_field_name[$form_id_get][]=$val4['label'];
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                           }
                                                                                        }
                                                                                        else{
                                                                                            if($val3->id){
                                                                                                 foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($val3->id==$value7){
                                                                                                                $entry_field_name[$form_id_get][]=$val3->label;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                            }
                                                                                        }
                                                                                }
                                                                        foreach($entry_field_name as $key=>$val){
                                                                        $new_entry_field_name[]=$val;
                                                                     }
                                                                     $remove_dub_field=array_unique($new_entry_field_name[0]);
                                                                     if(!empty(get_option('fieldform'))){
                                                                        delete_option('fieldform');
                                                                        update_option('fieldform',$remove_dub_field);
                                                                     }else{
                                                                        add_option('fieldform',$remove_dub_field);
                                                                    }
                                                                    $table=get_option('fieldform');
                                                                }
                                                                                                         if($form_id_get==$formid_save_field_formid){//if form id match then we stored status and hubspot field
                                                                                                              $remove_dub_status=$formid_save_field_formid_value->status;
                                                                                                     foreach($formid_save_field_formid_value as $y){
                                                                                                               if(is_array($y)){
                                                                                                                    foreach($y as $h=>$hvalue){
                                                                                                                            $remove_dub_field_val[]=$hvalue;
                                                                                                                             }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                          
                                                                                         if(!empty($remove_dub_field_val)) {                                              
                                                                                              $ghn=array_diff($gg, $remove_dub_field_val);//remove data got from popup field map 
                                                                                            } 
                                                                                           
                                                                                            //after get popup mapped field we pass all to dynamic array ff so that field will save in dropdown after refresh   
                                                                                             $cfg=array();
                                                                                             $arrayt=array();
                                                                                             
                                                                                         if(!empty($formid_save_field_formid)){           
                                                                                              if($form_id_get==$formid_save_field_formid){//first push all hubspot field without popup mapp data
                                                                                                   foreach($ghn as $j=>$tt){
                                                                                                          array_push($arrayt,array('label'=>$tt,'value'=>$tt));
                                                                                                        }
                                                                                                    }
                                                                                            }else{
                                                                                                foreach($gg as $k=>$kval){//push all fubspot field if form id not save using popup
                                                                                                   array_push($arrayt,array('label'=>$kval,'value'=>$kval));}
                                                                                              }
                                                                        // dynamic pass hubspot field which not contain hubspot field that mapped in popup for each dropdown for each field type in form 
                                                                                           if(!empty($formid_save_field_formid)){
                                                                                          
                                                                                                if($form_id_get==$formid_save_field_formid){
                                                                                                     $arrayt2=array();
                                                                                                    
                                                                                                   foreach ($remove_dub_field_val as $key => $value) { 
                                                                                                       
                                                                                                             array_push($arrayt2,array('label'=>$value,'value'=>$value));
                                                                                                     
                                                                                                     }
                                                                                                      
                                                                                                   foreach ($arrayt2 as $key => $value) {
                                                                                                            $set=array();
                                                                                                            $set=$arrayt2[$key];
                                                                                                            unset($arrayt2[$key]);
                                                                                                            $gh[]=$arrayt2;
                                                                                                            array_push($arrayt2,$set);
                                                                                                            unset($set[$key]);
                                                                                                         }
                                                                                                      } 
                                                                                                     
                                                                                                  if($form_id_get==$formid_save_field_formid){
                                                                                                 
                                                                                                      foreach ($gh as $key => $value) {
                                                                                                     
                                                                                                               $nmnn='my_custom_field_check';
                                                                                                               $nmnn.=$key;

                                                                                                               $sam=array();
                                                                                                               $arr2=$arrayt;
                                                                                                      foreach ($value as $key2=>$value2) {
                                                                                                                array_push($sam,$value2);        
                                                                                                             }
                                                                                                               $arr4=array_merge($arr2,$sam);
                                                                                                               unset($sam);
                                                                                                               
                                                                                                      if($form_id_get==$formid_save_field_formid){
                                                                                                          foreach($formid_save_field_formid_value as $y){
                                                                                                                   if(is_array($y)){
                                                                                                                  
                                                                                                                       foreach($y as $h=>$hvalue){
                                                                                                                                if($key==$h){
                                                                                                                                    
                                                                                                                //here we show hubspot field that mapped using popup as default so that after page refresh value will be saved
                                                                                                                                  
                                                                                                                                   $arr4[0]['label']=$hvalue;
                                                                                                                                   $arr4[0]['value']=$hvalue;
                                                                                                                                    
                                                                                                                                  } 
                                                                                                                        }
                                                                                                                       
                                                                                                                    }
                                                                                                             }
                                                                                             }                                                     
                                                                                          
                                                                                             array_push($cfg,array('name'=>$nmnn,'choices'=>$arr4));
                                                                                                          unset($arr2);
                                                                                                }
                                                                                          }
                                                                                   
                                                                                     }
                                                                                    

                                                                                      else{//if not match form id then we pass all hubspot field type in dropdown
                                                                                  
                                                                                        if(is_array($table)){
                                                                                           foreach($table as $key=>$valu){
                                                                                                        $gfhh='select';
                                                                                                        $nmnn='my_custom_field_check';
                                                                                                        $nmnn.=$key;
                                                                                                        $gfhh.=$key; 
                                                                                                            
                                                                                                   array_push($cfg,array('name'=>$nmnn,'choices'=>$arrayt));
                                                                                                }  
                                                                                                }                                  
                                                                                          }
                                                                                  
                                                                                                 $srr=array();
                                                                                                 if(!empty($status)){
                                                                                                    foreach($status as $st=>$stt){
                                                                                                        if(!empty($formid_save_field_formid)){// here we pass lead status that we save using popup 
                                                                                                        if($form_id_get==$formid_save_field_formid){
                                                                                                            if(!empty($remove_dub_status)){
                                                                                                            if($stt!=$remove_dub_status){
                                                                                                               array_push($srr,array('label'=>$stt)); 
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                                 else{
                                                                                                     array_push($srr,array('label'=>$stt)); 
                                                                                                }
                                                                                         }
                                                                                     }
                                                                                        
                                                                                          $count=count($srr);              
                                                                                          $mysatus="status";
                                                                                          $nmn='my_custom_field_checkbox';
                                                                                          $cfg['status']=array();

                                                                                            if(!empty($formid_save_field_formid)){
                                                                                                 if($form_id_get==$formid_save_field_formid){
                                                                                                       foreach ($srr as $key => $value) {
                                                                                                                  $srr1[$key+1]=$value;
                                                                                                        }
                                                                                        //here we show hubspot lead status that mapped using popup as default so that after page refresh value will be saved
                                                                                            $srr2[0]['label']=$formid_save_field_formid_value->status;
                                                                                            $fsrr=array_merge($srr2,$srr1);
                                                                                             array_push($cfg['status'],array('name'=>$nmn,'choices'=>$fsrr));  
                                                                                         }
                                                                                    }
                                                                                    else{
                                                                                           array_push($cfg['status'],array('name'=>$nmn,'choices'=>$srr));  
                                                                                    }
                                                                          
                                                                                     $fff=array(
                                                                                                array(
                                                                                                'title'  => esc_html__( 'HubSpot Addon Form Settings', 'hubspotaddon' ),
                                                                                                'fields' => array(
                                                                                                     array(
                                                                                                        'label' => esc_html__( '', 'hubspotaddon' ),
                                                                                                        'type'  => 'my_custom_field_type',
                                                                                                        'name'  => 'my_custom_field',
                                                                                                        'args'  =>$cfg,// conatin all dynamic data or deafult data 
                                                                                                    ),
                                                                                                      
                                                                                               ),
                                                                                          ),
                                                                                  );
                                                                               
                                                                                       return $fff;
                                                    }

                    // this fun used to display dynamic array that we got from above fun in plugin setting page
                              public function settings_my_custom_field_type( $field, $echo = true ) {
                                                                $formid4_v=sanitize_text_field($_GET['id']);
                                                                if(is_numeric($formid4_v)){
                                                                    $formid4=$formid4_v;
                                                                }
                                                                
                                                                      $entryexit=  GFAPI::get_entries( $formid4 );
                                                                      $expire_time=get_option('expres_token_entry');
                                                                             echo'<input type="hidden" id="foo" name="zyxkl" value="'.esc_html($expire_time).'"/>';
                                                                      
                                                                                        $table=get_option('fieldform');
                                                                                  
                                                                                     foreach($table as $key=>$val){
                                                                                             if(is_array($val)){//check whether entry created or without entry created
                                                                                                 foreach($val as $key2=>$val2){
                                                                                                        $newtable[]=$val2;   
                                                                                                    }
                                                                                                break;
                                                                                             }
                                                                                         else{
                                                                                                $newtable[]=$val;
                                                                                            }
                                                                                     }
                                                                   $cdc=count($newtable);
                                                                 
                                                            
                                                                             foreach($newtable as $key=>$valu){
                                                                                 echo'<p>'.esc_html($valu).'</p><div>';
                                                                                 $gfh='select';
                                                                                 $gfh.=$key;
                                                                        
                                                                                 $this->settings_select( $field['args'][$key]);
                                                                       
                                                                             }// display all hubspot field in dropdown
                                                                          echo'</div>';
                                                            
                                                          
                                                                    echo"<p>Lead Status</p>";
                                                                    $this->settings_select( $field['args']['status'][0]);//display alllead status

                                                                 // after click on save setting button we got all form setting data
                                                                   if(isset($_POST['gform-settings-save'])){
                                                                         foreach ($_POST as $key => $value) {
                                                                        
                                                                                    if($key!='_gform_setting_my_custom_field_checkbox' && $key!='gform-settings-save' && $key!='gform_settings_save_nonce' && $key!='_wp_http_referer' && $key!='zyxkl'){
                                                                                        $map_value_form_hubspot_v=sanitize_text_field($value);
                                                                                        if(!empty($map_value_form_hubspot_v)){
                                                                                          $map_value_form_hubspot[]=$map_value_form_hubspot_v;
                                                                                        }
                                                                                     }
                                                                            }
                                                                           
                                                                            $new_value_form_hubspot=array_combine($newtable,$map_value_form_hubspot);
                                                                          
                                                                    if(isset($_POST['_gform_setting_my_custom_field_checkbox'])){//get status
                                                                        $statusev=sanitize_text_field($_POST['_gform_setting_my_custom_field_checkbox']);
                                                                        if(!empty($statusev)){
                                                                                    $statuse=$statusev;
                                                                                }

                                                                    }
                                                                        $finalarr_send['label_value']=$new_value_form_hubspot;
                                                                        $finalarr_send['status']=$statuse;
                                                                        global $wpdb;
                                                                        $form_map_save_v=sanitize_text_field($_GET['id']);
                                                                        if(is_numeric($form_map_save_v)){
                                                                            $form_map_save=$form_map_save_v;
                                                                        }
                                                                        $map_arr_value_save_key="save_mapfield_arr_hubspot_formm".$form_map_save;
                                                                        $formid_map_done_key="formid_maphubspot_savee".$form_map_save;
                                                                        $map_value_arr_final=json_encode($finalarr_send);
                                                                        // insert hubspot mapped field data in table
                                                                        $gettablename2=get_option('hubspot_table_name2');
                                                                        $sql_hub1 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$map_arr_value_save_key','$map_value_arr_final')";
                                                                              $wpdb->query($sql_hub1);
                                                                              $wpdb->show_errors;

                                                                              global $wpdb;
                                                                             $map_arr_value_save_key2="save_mapfield_arr_hubspot_formm".$form_map_save;
                                                                            $map_value_arr_final2=json_encode($finalarr_send);
                                                                             $sql6 = "UPDATE $gettablename2 SET `fieldvalue`='$map_value_arr_final2' WHERE `field`='$map_arr_value_save_key2'";
                                                                                $wpdb->query($sql6);
                                                                             $wpdb->show_errors;
                                                                        // insert form id so that we donoy show popup in entry page in table
                                                                        $sql_hub = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$formid_map_done_key','$form_map_save')";
                                                                              $wpdb->query($sql_hub);
                                                                              $wpdb->show_errors;

                                                                              global $wpdb;
                                                                                 // add form id save by popup will show in form save setting field
                                                                                  $popup_save_id_show_field_form_save2="hubspot_check_popup_formid".$form_map_save;
                                                                                  $gettablename2=get_option('hubspot_table_name2');
                                                                                  $sql_hubgh3 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$popup_save_id_show_field_form_save2','$form_map_save')";
                                                                                  $wpdb->query($sql_hubgh3);
                                                                                  $wpdb->show_errors;
                                                                                  foreach ($map_value_form_hubspot as $key => $value) {
                                                                                         if($value=='email' )
                                                                                            $check_value=$value;
                                                                                         if( $value=='phone'){
                                                                                            $check_value=$value;
                                                                                         } 
                                                                                           if($value=='mobilephone'){
                                                                                            $check_value=$value;
                                                                                           }
                                                                                       }
                                                                                   if(empty($check_value)){
                                                                                
                                                                                                   ?>
                                                                                                   <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                    jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_error" role="alert">Incorrect form mapping. Please select atleast and map one mandatory field required by HubSpot like email or phone number or mobile phone.<br> Need some help in plugin configuration? <a href="mailto:support@wpcuriousbrains.com">Contact us here for Support</a></div>');
                                                                                                      
                                                                                                   </script><?php
                                                                                                 }else{
                                                                                                    ?>
                                                                                                     <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                       jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_success" role="alert">Settings updated and form mapped successfully.</div>');
                                                                                                   </script>
                                                                                                   <?php
                                                                                                 }
                                                                   }

                                    }

                              public function is_valid_setting( $value ) {
                                                             return strlen( $value ) > 5;
                                    }
                         
                 }
                               
               
                  //  after form submit we got each entry data of given form and create contact in hubspot 
                        add_action( 'gform_after_submission', 'post_formdata_to_hubspot_app', 10, 2 );

                                          function post_formdata_to_hubspot_app( $entry, $form ) {
                                           
                                                                                     if(!empty($form['hubspotaddon'])){
                                                                                      
                                                                            $entry_form_id=$entry['form_id'];
                                                                        
                                                                              foreach ($entry as $key1 => $value2) {
                                                                                                            if(is_numeric($key1)){
                                                                                                                if(!empty($value2)){
                                                                                                                 $entryvalue[$entry['id']][]=$value2;
                                                                                                                }
                                                                                                                
                                                                                                             }
                                                                                                      }
                                                                                
                                                                                          foreach ($entryvalue as $key => $value) {
                                                                                              
                                                                                                  $new_entry_value=$value;
                                                                                             
                                                                                          }
                                                                                $getentryidd= GFAPI::get_entries($entry_form_id);

                                                                                   if(!empty($getentryidd)){//check at least one entry exit or not
                                                                                     foreach($getentryidd as $key1=>$value1){
                                                                                         foreach ($value1 as $key2 => $value2) {
                                                                                             if($key2=='id'){
                                                                                                    $getallentryid[]=$value2;
                                                                                                }
                                                                                             }
                                                                                        }
                                                                                  foreach($getallentryid as $bh=>$vab){
                                                                                            $get_all_entry_detail[]=GFAPI::get_entry($vab);
                                                                                     }
                                                    
                                                                                 foreach ($get_all_entry_detail as $key => $value) {
                                                                                     foreach($value as $key2=>$value4){
                                                                                             if(!empty($value4)){
                                                                                                    if(is_numeric($key2) ){
                                                                                                        $entry_field_id_macth[$entry_form_id][]=$key2;
                                                                                                    }
                                                                                                }
                                                                                        }
                                                                                  }
                                                                                     //get form entry field label name after creating at least one entry
                                                                                  $formexactfield=GFAPI::get_form($entry_form_id);
                                                                                foreach($formexactfield['fields'] as $key3=>$val3){
                                                             
                                                                                      if($val3->inputs){
                                                                                           foreach($val3->inputs as $key4=>$val4){
                                                                                            foreach ($val4 as $key5 => $value5) {
                                                                                                if($key5=='id'){
                                                                                                    foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                      
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($value5==$value7){
                                                                                                                $entry_field_name[$entry_form_id][]=$val4['label'];
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                           }
                                                                                        }
                                                                                        else{
                                                                                            if($val3->id){
                                                                                                 foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($val3->id==$value7){
                                                                                                                $entry_field_name[$entry_form_id][]=$val3->label;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                            }
                                                                                        }
                                                                                }//formexact
                                                                        foreach($entry_field_name as $key=>$val){
                                                                        $new_entry_field_name[]=$val;
                                                                     }
                                                                 }
                                                             

                                                             
                                                                     $remove_dub_field=array_unique($new_entry_field_name[0]);
                                                                    
                                                    $gettablename2=get_option('hubspot_table_name2');
                                                                     
                                                                                            global $wpdb; 
                                                                                            $save_hubspot_map_field_key="save_mapfield_arr_hubspot_formm".$entry_form_id;
                                                                                             $sql = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$save_hubspot_map_field_key'";
                                                                                           
                                                                                             $wpdb->show_errors;
                                                                                             $sql_result=$wpdb->get_results($sql);
                                                                                           
                                                                                             $final_resultt=$sql_result[0]->fieldvalue;
                                                                                             $res=json_decode($final_resultt,true);
                                                                                             

                                                                                             if(array_key_exists('label_value',$res)){
                                                                                                 foreach ($res['label_value'] as $key1 => $value1) {
                                                                                                  
                                                                                                         foreach ($remove_dub_field as $key => $value) {
                                                                                                             if($key1==$value){
                                                                                                                $new_res[]=$value1;
                                                                                                             }
                                                                                                         }
                                                                                                 }
                                                                                                 if(array_key_exists('status',$res)){
                                                                                             
                                                                                                $finalstatus=$res['status'];
                                                                                                
                                                                                             }
                                                                                         }

                                                                                         foreach ($new_res as $key => $value) {
                                                                                             
                                                                                            if($key!=='status'){
                                                                                                $new_save_hubspot_map_field[]=$value;
                                                                                            }
                                                                                         }
                                                                                         foreach ($new_save_hubspot_map_field as $key => $value) {
                                                                                         if($value=='email' ){
                                                                                            $check_value=$value;
                                                                                        }
                                                                                         if( $value=='phone'){
                                                                                            $check_value=$value;
                                                                                         } 
                                                                                           if($value=='mobilephone'){
                                                                                            $check_value=$value;
                                                                                           }
                                                                                       }
                                                                                       if(empty($check_value)){
                                                                                        echo 'Incorrect form mapping. Please select atleast and map one mandatory field required by HubSpot like email or phone number or mobile phone.';die;
                                                                                       }
                                                                                         
                                                                                        $final_sendarr= array_combine($new_save_hubspot_map_field,$new_entry_value);
                                                                                        $final_sendarr['hs_lead_status']=$finalstatus;
                                                                                        $arrcombine['properties']=$final_sendarr;
                                                                                     
                                                                                          foreach ($arrcombine['properties'] as $key => $value) {
                                                                                                             if($key=='Select'){
                                                                                                                unset($arrcombine['properties']['Select']);
                                                                                                             }
                                                                                                         }
                                                                                            
                                                                                             
                                                                                            $clientrefresh= get_option('refreshtoken');
                                                                                            $clientidd= get_option('clientid');
                                                                                            $clientsec= get_option('clientsecret');
                                                                    //get access token from refresh token so that if user not click on hubspot (except first time)then also entry will created on hubspot on click on submit button
                                                                                            $redirecturl="https://dev.perimattic.com/hubspot/hubspot-callback.php";

                                                                                            $url3="https://api.hubapi.com/oauth/v1/token";
                                                                                            $result6 = wp_remote_post( $url3, array(
                                                                                                                'method'      => 'POST',
                                                                                                                'headers'     => array('Content-Type'=>'application/x-www-form-urlencoded'),
                                                                                                                'body'        => array(
                                                                                                                    array('grant_type'=>'refresh_token',
                                                                                                                                       'client_id'=> $clientidd,
                                                                                                                                       'client_secret'=> $clientsec,
                                                                                                                                         'redirect_uri'=> $redirecturl,
                                                                                                                                        'refresh_token'=> $clientrefresh
                                                                                                                                       )
                                                                                                                ),
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result6 ) ) {
                                                                                                                $error_message = $result6->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                             
                                                                                                      $response=wp_remote_retrieve_body($result6);
                                                                                                         $decode3=json_decode($response,true);
                                                                                                    foreach($decode3 as $gy=>$vh){
                                                                                                                    if($gy=='access_token'){
                                                                                                                          delete_option('tokennn');
                                                                                                                           add_option('tokennn',$vh);
                                                                                                                       }
                                                                                                                    }
                                                                                                          }
                                                                            // hubspot api call to create contact on hubspot
                                                                                            $tokenm= get_option('tokennn');
                                                                                          
                                                                                             $url2 = "https://api.hubapi.com/crm/v3/objects/contacts?archived=false";
                                                                                                                      $token3 ="Bearer ";
                                                                                                                      $token3.=$tokenm;
                                                                                                                      $body1=json_encode($arrcombine);

                                                                                                                      $result5 = wp_remote_post( $url2, array(
                                                                                                                'method'      => 'POST',
                                                                                                                'headers'     => array('Content-Type'=>'application/json','Authorization'=>$token3),
                                                                                                                'body'        =>$body1
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result5 ) ) {
                                                                                                                $error_message = $result5->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                              
                                                                                                      $response=wp_remote_retrieve_body($result5);
                                                                                                         $decode2=json_decode($response,true);
                                                                                                       
                                                                                                          $view_jsonobjectt=json_encode($response);
                                                                                                         
                                                                                                          global $wpdb;
                                                                                                          $entry_id=$entry['id'];
                                                                                                          $entry_form_id=$entry['form_id'];
                                                                                                  //after create contact we stored response json in table so that we show this on click on button view json on each entry page in hubspot area 
                                                                                                   $gettablename2=get_option('hubspot_table_name2'); 
                                                                                                          $hubspot_entryview_subtohubspot="hubspot_entryview_subtohubspot".$entry_id.$entry_form_id;
                                                                                                          $sql_hub5 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryview_subtohubspot','$view_jsonobjectt')";
                                                                                                            $wpdb->query($sql_hub5);
                                                                                                             $wpdb->show_errors;
                                                                                                //we save form id so that we check given form with all entry belog to this form submitted or not at hubspot area in each entry page
                                                                                                             $hubspot_formid_subtohubspot="hubspot_formid_subtohubspot".$entry_form_id;
                                                                                                             $sql_hub6 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_formid_subtohubspot','$entry_form_id')";
                                                                                                            $wpdb->query($sql_hub6);
                                                                                                             $wpdb->show_errors;
                                                                                                //same, check form entry submitted or not
                                                                                                             $hubspot_entryid_subtohubspot="hubspot_entryid_subtohubspot".$entry_id.$entry_form_id;
                                                                                                             $sql_hub7 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryid_subtohubspot','$entry_id')";
                                                                                                            $wpdb->query($sql_hub7);
                                                                                                             $wpdb->show_errors;
                                                                                                       }
                                                                                                       }
                                                                                            
                                                                       }
                               // adding hubspot entry

                            add_filter( 'gform_settings_menu', 'add_custom_settings_tab' );// add specific tab in page setting page in gravity form
                                    function add_custom_settings_tab( $tabs ) {
                                             $tabs[] = array( 'name' => 'my_tab', 'label' => 'HubSpot Entries','icon'=>'gform-icon--floppy-disk' );
                                             return $tabs;
                                    }
                                       add_filter( 'gform_settings_menu', 'add_custom_settings_tab_sink' );// add specific tab in page setting page in gravity form
                                    function add_custom_settings_tab_sink( $tabs ) {
                                             $tabs[] = array( 'name' => 'hubspotsinkmap', 'label' => 'HubSpot Entries Sync','icon'=>'gform-icon--renew' );
                                             return $tabs;
                                    }
                            add_filter( 'gform_settings_menu', 'add_custom_settings_tab_hub' );// add specific tab in page setting page in gravity form
                                    function add_custom_settings_tab_hub( $tabs ) {
                                             $tabs[] = array( 'name' => 'hubspotaddon', 'label' => 'HubSpot Addon','icon'=>'<svg style="color: rgb(235, 100, 10);" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"> <path d="M24.219 10.573v-3.792c1.026-0.479 1.682-1.505 1.688-2.641v-0.089c-0.005-1.609-1.307-2.917-2.922-2.922h-0.089c-1.615 0.005-2.922 1.307-2.927 2.922v0.089c0.005 1.125 0.656 2.146 1.672 2.63l0.016 0.010v3.802c-1.448 0.219-2.818 0.823-3.958 1.745l0.016-0.010-10.438-8.13c0.943-3.521-3.651-5.776-5.859-2.875-2.214 2.896 1.167 6.729 4.318 4.896l-0.016 0.010 10.26 7.984c-0.906 1.365-1.391 2.964-1.385 4.599 0 1.786 0.568 3.448 1.531 4.807l-0.016-0.026-3.125 3.12c-0.25-0.078-0.51-0.12-0.771-0.125h-0.005c-2.411 0-3.625 2.922-1.917 4.63 1.708 1.703 4.63 0.495 4.63-1.917-0.005-0.271-0.052-0.542-0.135-0.797l0.005 0.021 3.089-3.089c2.042 1.557 4.688 2.089 7.172 1.438 2.479-0.656 4.526-2.411 5.536-4.771 1.016-2.359 0.885-5.052-0.354-7.302-1.234-2.25-3.443-3.802-5.974-4.208l-0.052-0.010zM22.932 23.078c-3.807-0.010-5.703-4.615-3.005-7.302 2.693-2.688 7.292-0.781 7.292 3.026v0.005c0 2.359-1.911 4.271-4.276 4.271z" fill="#eb640a"></path> </svg>' );
                                             return $tabs;
                                    }

                            //call this function to show form entries in hubspot entry 
                                    function my_function($formid) {// func show in specific tab my_tab
                                        
                                                                 $forms2 = GFAPI::get_forms();// call this to get all form id
                                                                
                                                                 if(!empty($forms2)){
                                                                                foreach ($forms2 as $key) {
                                                                                        foreach ($key as $key1 ) {
                                                                                                 if(!empty($key1) && is_array($key1)){
                                                                                                    foreach ($key1 as $key2) {
                                                                                                             if(!empty($key2->formId)){
                                                                                                                   $check_entry_exits[]=$key2->formId;
                                                                                                               }
                                                                                                     }
                                                                                                }
                                                                                          }
                                                                         }
                                                                      
                                                                             $ghe=array_unique($check_entry_exits);//get unique form id
                                                                    
                                                                         foreach ($ghe as $key => $value) {
                                                                                             $result4[] = GFAPI::get_entries( $value );
                                                                                             
                                                                                         }
                                                                                         
                                                                                         foreach($result4 as $key=>$val){
                                                                                            foreach($val as $key1=>$val2){
                                                                                            $entryidarr1[]=$val2['id'];
                                                                                         }
                                                                                     }
                                                                 }
                                                                
                                                    if(!empty($entryidarr1)){//check any entry exit or not then we display all entry
                                                                          $expire_time=get_option('expres_token_entry');
                                                                             echo'<input type="hidden" id="foo" name="zyx" value="'.esc_html($expire_time).'"/>';//add this since javacsript show error
                                                                            $ajaxurl=site_url()."/wp-admin/admin-ajax.php";
                                                                              echo'<input type="hidden" id="foo1" name="zyx1" value="'.esc_html($ajaxurl).'"/>';//  dynamic pass url for ajax call

                                                                                $forms = GFAPI::get_forms();// call this to get all form id
                                                                            foreach ($forms as $key) {
                                                                                    foreach ($key as $key1 ) {
                                                                                             if(!empty($key1) && is_array($key1)){
                                                                                                foreach ($key1 as $key2) {
                                                                                                         if(!empty($key2->formId)){
                                                                                                               $idarr[]=$key2->formId;
                                                                                                           }
                                                                                                 }
                                                                                            }
                                                                                      }
                                                                         }
                                                              
                                                     $gh=array_unique($idarr);//get unique form id
                                                                        foreach ($gh as $key => $value) {
                                                                                
                                                                                        $getentryidd= GFAPI::get_entries($value);
                                                                                        foreach($getentryidd as $key1=>$value1){
                                                                                            foreach ($value1 as $key2 => $value2) {
                                                                                            
                                                                                                if($key2=='id'){
                                                                                                    $getallentryid[]=$value2;
                                                                                                }
                                                                                            }
                                                                                        }

                                                                            }
                                                                        foreach($getallentryid as $bh=>$vab){
                                                                                             $get_all_entry_detail[]=GFAPI::get_entry($vab);
                                                                             }
                                                                                        
                                                                                     foreach ($get_all_entry_detail as $key => $value) {
                                                                                                     foreach($value as $key2=>$value4){
                                                                                                        if(!empty($value4)){
                                                                                                                 if(is_numeric($key2) ){
                                                                                                                         
                                                                                                                         $entry_field_id_macth[$value['id']][]=$key2;
                                                                                                                     }
                                                                                                         }
                                                                                                     }
                                                                                         }
                                                    
                                                                 foreach($gh as $ghkey=>$formidd){
                                                                             $form=GFAPI::get_form($formidd);
                                                                          
                                                                                foreach($form['fields'] as $key3=>$val3){
                                                                                        
                                                                                            if($val3->inputs){
                                                                                               foreach($val3->inputs as $key4=>$val4){
                                                                                                foreach ($val4 as $key5 => $value5) {
                                                                                                    if($key5=='id'){
                                                                                                        foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                            foreach ($value6 as $key7 => $value7) {
                                                                                                                if($value5==$value7){
                                                                                                                    $entry_field_name[$formidd][]=$val4['label'];
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                               }
                                                                                            }
                                                                                            else{
                                                                                                if($val3->id){
                                                                                                     foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                            foreach ($value6 as $key7 => $value7) {
                                                                                                                if($val3->id==$value7){
                                                                                                                    $entry_field_name[$formidd][]=$val3->label;
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                }
                                                                                            }
                                                                                       
                                                                                    }
                                                                                }
                                                                                foreach($entry_field_name as $key=>$arr){
                                                                                    $jk[$key]=array_unique($arr);
                                                                                }
                                                                                                                                    
                                                                                $gh=array_unique($idarr);//get unique form id
                                                                      foreach ($gh as $key => $value) {
                                                                                     $result = GFAPI::get_entries( $value );
                                                                                  foreach ($result as $key1=>$val2) {
                                                                                             foreach ($val2 as $key=>$val1) {
                                                                                                        if(is_numeric($key)){
                                                                                                            if(!empty($val1)){
                                                                                                             $bn[$value][$val2['id']][]=$val1;//get all entry field value
                                                                                                            }
                                                                                                          }
                                                                                                     }
                                                                                                }
                                                                                           }
                                                                      foreach ($bn as $key => $valuee) {//contain field value
                                                                                    foreach ($jk as $key1 => $value1) {//contain field type
                                                                                             if($key==$key1){
                                                                                               
                                                                                                  foreach($valuee as $key2=>$njki){
                                                                                                
                                                                                                           if(array_key_exists($key2, $valuee)){
                                                                                                               $ulp[$key][$key2][]=array_combine($value1,$njki);// combine entry field with its value 
                                                                                                                }
                                                                                                            }
                                                                                                    }
                                                                                               }
                                                                                 }
                                                                               

                                                                     if(!empty(get_option('ajaxbull_array')))  {// passing array to ajax fun get_data,this caontain entry detail
                                                                                delete_option('ajaxbull_array');
                                                                                update_option('ajaxbull_array',$ulp);
                                                                         } else{
                                                                                add_option('ajaxbull_array',$ulp);
                                                                             }
                                                                                 $finalarr=[];
                                                                     foreach ($idarr as $key => $value) {
                                                                              $result = GFAPI::form_id_exists( $value);
                                                                                if($result){
                                                                                     $ghhk=GFAPI::get_entry_ids($value);
                                                                                     $entryexit=GFAPI::entry_exists($ghhk);
                                                                                     $iddefault=$value;
                                                                                 }
                                                                            }

                                                              $value=$iddefault;
                                                               ?> <select name="entry" id="entry"><?php
                                                               ?> <option value="<?php echo esc_html($value);?>"> Form-id <?php echo esc_html($value);?></option><?php

                                                               foreach ($gh as $key => $value) {
                                                                   if($value!=$iddefault){
                                                                       ?> <option value="<?php echo esc_html($value);?>"> Form-id <?php echo esc_html($value);?></option><?php
                                                                     } 
                                                                }
                                                              ?></select><?php
                                                             $result = GFAPI::get_entries($value);//showing first form entry detail when first time page load
                                                             ?><div id="ajaxentry" style="margin-top: 0.5rem;"></div><div style="margin-top: 0.5rem;"><table id="table" class="table1"style="width:100%;"> 
                                                                <style type="text/css">
                                                                   .table1 {
                                                                           font-family: Arial, Helvetica, sans-serif;
                                                                           border-collapse: collapse;
                                                                           width: 100%;
                                                                       }
                                                                   .table1 td, .table1 th {
                                                                           border: 2px solid #lightblue;
                                                                           padding: 8px;
                                                                      }
                                                                   .table1 tr:nth-child(even){background-color: #f2f2f2;}
                                                                  .table1 tr:hover {background-color: #ddd;}
                                                                  .table1 th {
                                                                          padding-top: 12px;
                                                                          padding-bottom: 12px;
                                                                          text-align: left;
                                                                          background-color: #3e7da6;
                                                                         }  
                                                                  .table1, th, td {
                                                                          border: 1px solid black;
                                                                          border-collapse: collapse;
                                                                        }
                                                            </style>
                                                              <th><b><center>Entry Id</center></b></th>
                                                            <th><b><center>Submitted on</center></b></th>
                                                            <th><b><center>User IP</center></b></th>
                                                            <th><b><center>Embed Url</center></b></th>
                                                            <th><b><center>Status</center></b></th>
                                                            <th><b><center> Entry Fields</center></b></th>
                                                    <?php
                                                    foreach ($result as $key1=>$val2) {
                                                              foreach ($ulp as $key=>$val1) {
                                                                       if($key==$value){
                                                                           foreach ($val1 as $key3 => $value3) {
                                                                                    if($key3==$val2['id']){
                                                                                         ?><tr>
                                                                                         <td><?php  echo esc_html($val2['id']); ?></td>
                                                                                         <td><?php echo esc_html($val2['date_updated']);?></td>
                                                                                         <td><?php echo esc_html($val2['ip']);?></td>
                                                                                         <td style="width:60%"><?php echo esc_html($val2['source_url']);?></td>
                                                                                         <td><?php echo esc_html($val2['status']); ?></td>

                                                                                         <td colspan="10"><?php

                                                                                           foreach ($value3 as $key4 => $value4) {
                                                                                                     foreach ($value4 as $key5 => $value5) {// showing entry field and value in default case
                                                                                                               echo "<b>".esc_html($key5)."</b>:"; echo esc_html($value5)."<br>";
                                                                                                         }
                                                                                                   }
                                                                                                ?></td></tr><?php
                                                                                       }
                                                                                }
                                                                          }
                                                                    }
                                                               }?>
                                                    </table></div><?php
                                                }else{
                                                       echo"<p>You don't have any entry. Let's go create one</p>";
                                                    }
                                                }

                                    function get_data2() {//ajax fun to pass form entry detail when select form id
                                                            $bnv=sanitize_text_field($_POST['id']);
                                                        if(is_numeric($bnv)){
                                                         $bn=$bnv;
                                                     }
                                                         $finalarr=[];
                                                         $result1 = GFAPI::get_entries( $bn);
                                                         $ulp=get_option('ajaxbull_array');

                                                         foreach ($result1 as $key1=>$val2) {
                                                                  foreach ($ulp as $key=>$val1) {
                                                                             if($key==$bn){
                                                                                 foreach ($val1 as $key3 => $value3) {
                                                                                             if($key3==$val2['id']){
                                                            
                                                                                                $m1['id']= $val2['id']; 
                                                                                                $m1['date']=$val2['date_updated'];
                                                                                                $m1['ip']= $val2['ip'];
                                                                                                $m1['url']=$val2['source_url']; 
                                                                                                  $m1['status']=  $val2['status'];

                                                                                                        foreach ($value3 as $key4 => $value4) {
                                                                                                                     $gu=array_merge($m1,$value4);
                                                                                                                          $bk=array_unique($gu);
                                                                                                                            $bh= array_push($finalarr, array($bn=>array($key3=>$bk)));       
                                                                                                                 }
                                                                                                 }
                                                                                  }
                                                                              }
                                                                     }
                                                          }
                                                           wp_send_json_success($finalarr);
                                                      }

                        add_action( 'gform_settings_my_tab', 'my_function', 10, 1 );//call fun on specific tab
                         add_action( 'gform_settings_hubspotsinkmap', 'sink_map_hubspot', 10, 1 );//call fun on specific tab

                         //fun to show mapping with hubspot entry field when click on sync to hubspot action and click apply only for formid pass in url and redirect to hubspot entries sync tab for first time other wise direct update entry on hubspot
                         function sink_map_hubspot(){
                                                                    if(isset($_GET['formid'])){
                                                                        $expire_time=get_option('expres_token_entry');
                                                             echo'<input type="hidden" id="foo" name="zymxy" value="'.esc_html($expire_time).'"/>';

                                                                    $formid_v=sanitize_text_field($_GET['formid']);
                                                                    if(is_numeric($formid_v)){
                                                                        $formid=$formid_v;
                                                                    }
                                                                 
                                                                    global $wpdb; 
                                                                    $gettablename1=get_option('hubspot_table_name1');
                                                                      $sql = "SELECT `field` FROM $gettablename1";
                                                                        $wpdb->show_errors;
                                                                    $result=$wpdb->get_results($sql);
                                                                    foreach($result as $key=>$vale){
                                                                        $hubspot_field[]=$vale->field;
                                                                    }
                                                                    
                                                                        $statushub=get_option('statushub');
                                                                    $get_all_entry_select=get_option('entry_slelect_from_entry_list');
                                                                   $get_entry_formid= GFAPI::get_entries($formid);
                                                                          

                                                                                         foreach($get_all_entry_select as $bh=>$vab){
                                                                                                     $get_all_entry_detail[]=GFAPI::get_entry($vab);
                                                                                                    }
                                                                                         foreach ($get_all_entry_detail as $key => $value) {
                                                                                                         foreach($value as $key2=>$value4){
                                                                                                            if(!empty($value4)){
                                                                                                                     if(is_numeric($key2) ){
                                                                                                                             
                                                                                                                             $entry_field_id_macth[$value['id']][]=$key2;
                                                                                                                         }
                                                                                                                                }
                                                                                                                         }
                                                                                                              }
                                                                                            
                                                                                             $form=GFAPI::get_form($formid);
                                                                                          //get all entry field label name after creating at least one entry for given form
                                                                                                foreach($form['fields'] as $key3=>$val3){
                                                                                                        
                                                                                                            if($val3->inputs){
                                                                                                               foreach($val3->inputs as $key4=>$val4){
                                                                                                                foreach ($val4 as $key5 => $value5) {
                                                                                                                    if($key5=='id'){
                                                                                                                        foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                                            foreach ($value6 as $key7 => $value7) {
                                                                                                                                if($value5==$value7){
                                                                                                                                    $entry_field_name[$val4['id']]=$val4['label'];
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                               }
                                                                                                            }
                                                                                                            else{
                                                                                                                if($val3->id){
                                                                                                                     foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                                            foreach ($value6 as $key7 => $value7) {
                                                                                                                                if($val3->id==$value7){
                                                                                                                                    $entry_field_name[$val3->id]=$val3->label;
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                }
                                                                                                            }
                                                                                                       
                                                                                                    }
                                                                                          
                                                                    // display mess and mapping with dropdown with hubspot field
                                                                    ?>
                                                                            <div id="showmess"></div>
                                                                         <fieldset id="gform-settings-section-hubspot-addon-form-settings" class="gform-settings-panel gform-settings-panel--with-title">
                                                                             <legend class="gform-settings-panel__title gform-settings-panel__title--header">HubSpot Mapped Entry Field Settings </legend>
                                                                        <div class="gform-settings-panel__content"><form action="" method="post">
                                                                            <?php foreach ($entry_field_name as $key => $value) {?>

                                                                                      <div id="gform_setting_" class="gform-settings-field gform-settings-field__">
                                                                                         <h4><?php echo esc_html($value);?></h4>
                                                                                         <div class="my_class">
                                                                                            <span class="gform-settings-input__container">
                                                                                                 <select name="<?php echo esc_html($key); ?>">
                                                                                                      <option value="Select">Select</option>
                                                                                                          <?php foreach ($hubspot_field as $key => $value) {
                                                                                                            ?>
                                                                                                                         <option value="<?php echo esc_html($value);?>"> <?php echo esc_html($value);?></option> <?php
                                                                                                                 }?>

                                                                                                 </select>
                                                                                             </span>

                                                                                         </div>
                                                                                     </div><?php
                                                                             }?>
                                                                         <div id="gform_setting_" class="gform-settings-field gform-settings-field__">
                                                                            <h4>Lead Status</h4>
                                                                             <div class="my_class">
                                                                                <span class="gform-settings-input__container">
                                                                                    <select name="status" id=""><?php
                                                                                        

                                                                                            foreach($statushub as $key=>$val){
                                                                                                ?>
                                                                                                        <option value="<?php echo esc_html($val);?>"><?php echo esc_html($val);?></option>
                                                                                                <?php
                                                                                            }
                                                                                   ?>
                                                                                    </select>
                                                                                 </span>
                                                                            </div>
                                                                        </div>
                                                                            <input id="synhub" style="cursor: pointer;"class="" type="submit" name="contacthub" value="Sync to HubSpot">
                                                                             </form>
                                                                        </div>
                                                                </fieldset>
                                                            <?php
                                                            //on click on sync to hubspot we create and update contact on hubspot
                                                                if(isset($_POST['contacthub'])){

                                                                                $status_leadv=sanitize_text_field($_POST['status']);
                                                                                if(!empty($status_leadv)){
                                                                                    $status_lead=$status_leadv;
                                                                                }
                                                                                $message=array();
                                                                                
                                                                                 global $wpdb;
                                                                                 // add form id save by popup will show in form save setting field
                                                                                  $popup_save_id_show_field_form_save="hubspot_savefieldid_show_inform_save".$formid;
                                                                                  $gettablename2=get_option('hubspot_table_name2');
                                                                                  $sql_hubgh = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$popup_save_id_show_field_form_save','$formid')";
                                                                                  $wpdb->query($sql_hubgh);
                                                                                  $wpdb->show_errors;

                                                                                   global $wpdb;
                                                                                 // add form id save by popup will show in form save setting field
                                                                                  $popup_save_id_show_field_form_save2="hubspot_check_popup_formid".$formid;
                                                                                  $gettablename2=get_option('hubspot_table_name2');
                                                                                  $sql_hubgh3 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$popup_save_id_show_field_form_save2','$formid')";
                                                                                  $wpdb->query($sql_hubgh3);
                                                                                  $wpdb->show_errors;
                                                                                  // insert mapped hubspot field data
                                                                                 global $wpdb;
                                                                                 $formid_maphubspot_save_key="formid_maphubspot_save".$formid;
                                                                                 $formid_maphubspot_save_value=$formid;
                                                                                 $sql_hub2 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$formid_maphubspot_save_key','$formid_maphubspot_save_value')";//mo2
                                                                                 $wpdb->query($sql_hub2);
                                                                                 $wpdb->show_errors;
                                                                               

                                                                                       foreach ($get_all_entry_detail as $key => $value) {
                                                                                                  foreach($value as $key2=>$value4){
                                                                                                            if(is_numeric($key2)){
                                                                                                                if(!empty($value4)){
                                                                                                                 $entryvalue[$value['id']][]=$value4;
                                                                                                                }
                                                                                                             }
                                                                                                   }
                                                                                         }
                                                                                       foreach ($_POST as $key => $value) {
                                                                                                   if($key!='status' && $key!='contacthub'){
                                                                                                        $entryfieldv=sanitize_text_field($value);
                                                                                                        if(!empty($entryfieldv)){
                                                                                                        $entryfield[]=$entryfieldv;
                                                                                                    }
                                                                                                     }
                                                                                          }

                                                                                 global $wpdb;
                                                                                 $entryfield_to_database[]=$entryfield;
                                                                                 $entryfield_to_database['status']=$status_lead;
                                                                                 $save_mapfield_arr_hubspot_form_key="save_mapfield_arr_hubspot_form".$formid;

                                                                                 //insert popup mapped data
                                                                                 $gettablename2=get_option('hubspot_table_name2');
                                                                                 $save_mapfield_arr_hubspot_form_value=json_encode($entryfield_to_database);
                                                                                 $sql_hub3 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$save_mapfield_arr_hubspot_form_key','$save_mapfield_arr_hubspot_form_value')";//mo3
                                                                                 $wpdb->query($sql_hub3);
                                                                                 $wpdb->show_errors;

                                                                                   global $wpdb;
                                                                             $save_mapfield_arr_hubspot_form_key2="save_mapfield_arr_hubspot_form".$formid;
                                                                            $save_mapfield_arr_hubspot_form_value2=json_encode($entryfield_to_database);
                                                                             $sql61 = "UPDATE $gettablename2 SET `fieldvalue`='$save_mapfield_arr_hubspot_form_value2' WHERE `field`='$save_mapfield_arr_hubspot_form_key2'";
                                                                                $wpdb->query($sql61);
                                                                             $wpdb->show_errors;

                                                                                 global $wpdb;
                                                                                
                                                                                 $save_mapfield_arr_hubspot_form_key2="save_mapfield_arr_hubspot_formm".$formid;
                                                                                 $sql_hub4 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$save_mapfield_arr_hubspot_form_key2','$save_mapfield_arr_hubspot_form_value')";//mo3
                                                                                 $wpdb->query($sql_hub4);
                                                                                 $wpdb->show_errors;
                                                                                 // set query parameter
                                                                               
                                                                                foreach ($entryfield as $key => $value) {
                                                                                         if($value=='email' )
                                                                                            $check_value=$value;
                                                                                         if( $value=='phone'){
                                                                                            $check_value=$value;
                                                                                         } 
                                                                                           if($value=='mobilephone'){
                                                                                            $check_value=$value;
                                                                                           }
                                                                                       }
                                                                                   if(empty($check_value)){
                                                                                                      ?>
                                                                                                   <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                    jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_error" role="alert">Incorrect form mapping. Please select atleast and map one mandatory field required by HubSpot like email or phone number or mobile phone.<br> Need some help in plugin configuration? <a href="mailto:support@wpcuriousbrains.com">Contact us here for Support</a></div>');
                                                                                                      
                                                                                                   </script><?php
                                                                                                 }else{
                                                                                                    ?>
                                                                                                     <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                       jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_success" role="alert">Settings updated and form mapped successfully.</div>');
                                                                                                   </script>
                                                                                                   <?php
                                                                                                 }
                                                                                  
                                                                                foreach ($entryvalue as $key3 => $value3) {
                                                                                            $query_para=array_combine($entryfield,$value3);
                                                                                           foreach ($query_para as $key => $value) {
                                                                                                        if($key=='email'){
                                                                                                              $query_parameter=$value;
                                                                                                                       break;
                                                                                                          }
                                                                                                        if($key=='phone'){
                                                                                                              $query_parameter=$value;
                                                                                                                        break;
                                                                                                           }
                                                                                                        if($key=='mobilephone'){
                                                                                                              $query_parameter=$value;
                                                                                                                        break;
                                                                                                          }
                                                                                                  
                                                                                              }
                                                                                            
                                                                                                $final_arr2=array_combine($entryfield,$value3);
                                                                                                $final_arr2['hs_lead_status']=$status_lead;
                                                                                                $arrcombine['properties']=$final_arr2;
                                                                                               
                                                                                                // get access token from refresh token
                                                                                                 $clientrefresh= get_option('refreshtoken');
                                                                                                 $clientidd= get_option('clientid');
                                                                                                 $clientsec= get_option('clientsecret');
                                                                                                 $redirecturl="https://dev.perimattic.com/hubspot/hubspot-callback.php";

                                                                                                 $url3="https://api.hubapi.com/oauth/v1/token";
                                                                                                  $result6 = wp_remote_post( $url3, array(
                                                                                                                'method'      => 'POST',
                                                                                                                'headers'     => array('Content-Type'=>'application/x-www-form-urlencoded'),
                                                                                                                'body'        => 
                                                                                                                    array('grant_type'=>'refresh_token',
                                                                                                                        'client_id'=> $clientidd,
                                                                                                                        'client_secret'=> $clientsec,
                                                                                                                        'redirect_uri'=> $redirecturl,
                                                                                                                        'refresh_token'=> $clientrefresh
                                                                                                                                    
                                                                                                                ),
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result6 ) ) {
                                                                                                                $error_message = $result6->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                              
                                                                                                           $response=wp_remote_retrieve_body($result6);
                                                                                                           $decode3=json_decode($response,true);
                                                                                                     foreach($decode3 as $gy=>$vh){
                                                                                                                      if($gy=='access_token'){
                                                                                                                            if(!empty(get_option('nopopup1_accesstoken')))  {
                                                                                                                                  delete_option('nopopup1_accesstoken');
                                                                                                                                  update_option('nopopup1_accesstoken',$vh);
                                                                                                                              }
                                                                                                                                else{
                                                                                                                                       add_option('nopopup1_accesstoken',$vh);
                                                                                                                                  }
                                                                                                                         }
                                                                                                                 }
                                                                                                        }

                                                                                                // get contact property if exits
                                                                                                    $tokenm=get_option('nopopup1_accesstoken');
                                                                                                    if(!empty($query_parameter)){
                                                                                                    $urle = "https://api.hubapi.com/contacts/v1/search/query?q=".$query_parameter;//hapikey=demo&count=2
                                                                                                    $token ="Bearer ";
                                                                                                    $token.=$tokenm;
                                                                                                    $resultr= wp_remote_get( $urle ,
                                                                                                         array(
                                                                                                             'headers' => array( 'Content-Type'=> 'application/json', // if the content type is json
                                                                                                                'Authorization'=>$token
                                                                                                                 ) 
                                                                                                         ));
                                                                                                      if ( is_wp_error( $resultr ) ) {
                                                                                                                // Error out.
                                                                                                        echo"error";
                                                                                                                $keep_going = false;
                                                                                                            }else{

                                                                                                            $response=wp_remote_retrieve_body($resultr);
                                                                                                            $decod3=json_decode($response,true);
                                                                                                              if(!empty($decod3['contacts'][0]['vid'])){
                                                                                                                     $recordid=$decod3['contacts'][0]['vid'];
                                                                                                                }
                                                                                                           }
                                                                                                          
                                                                                                // update contact property if exits
                                                                                                           foreach ($arrcombine['properties'] as $key => $value) {
                                                                                                             if($key=='Select'){
                                                                                                                unset($arrcombine['properties']['Select']);
                                                                                                             }
                                                                                                         }
                                                                                            
                                                                                                $body=json_encode($arrcombine);

                                                                                                if(!empty($recordid)){
                                                                                                     $token1 ="Bearer ";
                                                                                                     $token1.=$tokenm;
                                                                                                     $url1 = "https://api.hubapi.com/crm/v3/objects/contacts/".$recordid;
                                                                                                     $result2= wp_remote_post( $url1, array(
                                                                                                                'method'      => 'PATCH',
                                                                                                                'headers'     => array('Content-Type'=>'application/json', 
                                                                                                                   'Authorization'=>$token1),
                                                                                                                    'body'=>$body
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result2 ) ) {
                                                                                                                $error_message = $result2->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                              
                                                                                                      $response3=wp_remote_retrieve_body($result2);
                                                                                                         $decode3=json_decode($response3,true);?>
                                                                                                        <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                       jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_success" role="alert">The selected entries have been created on HubSpot.</div>');
                                                                                                   </script><?php
                                                                                                       
                                                                                                                $view_jsonobject4=json_encode($response3);
                                                                                                                 global $wpdb;
                                                                                                                 // insert json response after contact create
                                                                                                                 $gettablename2=get_option('hubspot_table_name2');
                                                                                                                $hubspot_entryview_subtohubspot3="hubspot_entryview_subtohubspot".$key3.$formid;
                                                                                                                
                                                                                                                 $sql3 = "UPDATE $gettablename2 SET `fieldvalue`='$view_jsonobject4' WHERE `field`='$hubspot_entryview_subtohubspot3'";
                                                                                                                  $wpdb->query($sql3);
                                                                                                                  $wpdb->show_errors;

                                                                                                            $message[]="updated";
                                                                                                         }
                                                                                                }
                                                                                                  else{
                                                                                                        // create contact if not present
                                                                                                         $url2 = "https://api.hubapi.com/crm/v3/objects/contacts?archived=false";
                                                                                                         $token3 ="Bearer ";
                                                                                                         $token3.=$tokenm;// "generated token code";
                                                                                                       
                                                                                                         $body1=json_encode($arrcombine);
                                                                                                          $result5= wp_remote_post( $url2, array(
                                                                                                                'method'      => 'POST',
                                                                                                                'headers'     => array('Content-Type'=>'application/json', 
                                                                                                                   'Authorization'=>$token3),
                                                                                                                    'body'=>$body1
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result5 ) ) {
                                                                                                                $error_message = $result5->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                               
                                                                                                      $response1=wp_remote_retrieve_body($result5);
                                                                                                         $decode2=json_decode($response1,true);

                                                                                                            ?>
                                                                                                        <script>
                                                                                                       jQuery('.gforms_note_success').hide();
                                                                                                       jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_success" role="alert">The selected entries have been created on HubSpot.</div>');
                                                                                                   </script><?php
                                                                                                               // $decode2=json_decode($result5,true);
                                                                                                                $view_jsonobject3=json_encode($response1);
                                                                                                                 global $wpdb;
                                                                                                                 // insert json response after contact create
                                                                                                                 $gettablename2=get_option('hubspot_table_name2');
                                                                                                                $hubspot_entryview_subtohubspot2="hubspot_entryview_subtohubspot".$key3.$formid;
                                                                                                                 $sql_hubd = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryview_subtohubspot2','$view_jsonobject3')";
                                                                                                                  $wpdb->query($sql_hubd);
                                                                                                                  $wpdb->show_errors;
                                                                                                            // insert form id for which any entry created conatct on hubspot or not
                                                                                                                  $hubspot_formid_subtohubspot2="hubspot_formid_subtohubspot".$formid;
                                                                                                                  $sql_hubd2 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_formid_subtohubspot2','$formid')";
                                                                                                                  $wpdb->query($sql_hubd2);
                                                                                                                  $wpdb->show_errors;
                                                                                                            // insert entry id for which any entry created on hubspot or not
                                                                                                                  $hubspot_entryid_subtohubspot2="hubspot_entryid_subtohubspot".$key3.$formid;
                                                                                                                  $sql_hubd3 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryid_subtohubspot2','$key3')";
                                                                                                                   $wpdb->query($sql_hubd3);
                                                                                                                   $wpdb->show_errors;

                                                                                                                  // $mess=$decode2['properties']['firstname'];
                                                                                                                   $message[]="created";    
                                                                                                            }

                                                                                                        }
                                                                                                }



                                                                                     }   // display all related messages 
                                                                                                if(!empty($message)){
                                                                                                      $html4="";
                                                                                                        foreach ($message as $key => $value) {
                                                                                                                   if($value=='updated'){
                                                                                                                          $html4.="This Entry &nbsp";
                                                                                                                          $html4.=$key."&nbsp are &nbsp ";
                                                                                                                          $html4.=$value."<br>&nbsp";
                                                                                                                       }else{
                                                                                                                              $html4.="This Entry";
                                                                                                                              $html4.=$key."&nbsp";
                                                                                                                               $html4.=$value."<br>&nbsp";
                                                                                                                          }
                                                                                                           }
                                                                                                           // display message if contatc created 
                                                                                                           //$html4.="</div>";// we display mess using jquery so donot echo html here
                                                                                                            //echo "<div class='gforms_note_success' role='alert'>synced</div>";

                                                                                                  }
                                                                        }
                                                            }//else isset formid
                                                            else{
                                                                echo"<p>Mapping with HubSpot field for given entry is already done! Go to entry list page and directly sync entries to HubSpot. </p>";
                                                            }



                                        }//isset contacthub if
                         
                        add_action( 'wp_ajax_nopriv_get_data2', 'get_data2' );//ajax call hook
                        add_action( 'wp_ajax_get_data2', 'get_data2' );//ajax call hook

                        // this fun show hubspot tab in each entry page which display whether form submitted or not or view json button
                                   function register_ur_meta_box1( $meta_boxes, $entry, $form ) {
                            
                                                                                                 $meta_boxes['notes'] = array(
                                                                                                    'title'    => esc_html__( 'HubSpot Status', 'gravityforms' ),
                                                                                                    'callback' => 'meta_box_notes',//callback fun to display json data
                                                                                                    'context'  => 'normal',
                                                                                                );
                                                                                                 
                                                                                                    return $meta_boxes;
                                             }

                           add_filter( 'gform_entry_detail_meta_boxes', 'register_ur_meta_box1', 10, 3 );

                               function meta_box_notes($args ) {
                                   
                                                             $expire_time=get_option('expres_token_entry');
                                                             echo'<input type="hidden" id="foo" name="zymxy" value="'.esc_html($expire_time).'"/>';//here because js page not able to find access token expire time in jquery
                                                             $ajaxurl=site_url()."/wp-admin/admin-ajax.php";
                                                             $html="";
                                                             echo'<input type="hidden" id="foo3" name="zyx1" value="'.esc_html($ajaxurl).'"/>';//here because js page not able to find ajax url
                                                             $value_form_v=sanitize_text_field($_GET['id']);
                                                             if(is_numeric($value_form_v)){
                                                                        $value_form=$value_form_v;
                                                                    }
                                                             $value_entry_v=sanitize_text_field($_GET['lid']);
                                                             if(is_numeric($value_entry_v)){
                                                                        $value_entry=$value_entry_v;
                                                                    }
                       
                                                         global $wpdb;
                                                         // get form id to check whether any entry created or not for particular form page we view
                                                         $gettablename2=get_option('hubspot_table_name2');
                                                                $get_form_id_key="hubspot_formid_subtohubspot".$value_form;
                                                                $sql_hub10 = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$get_form_id_key'";//mo
                                                                $wpdb->show_errors;
                                                                $sql_result5=$wpdb->get_results($sql_hub10);

                                                                 if(!empty($sql_result5)){
                                                                       $final_result5=$sql_result5[0]->fieldvalue;//
                                                                 if (!empty($final_result5)) {
                                                                        $get_form_id=$final_result5;
                                                                     }
                                                                  }

                                                           global $wpdb; 
                                                           // get entry id for particular form, exit or not in table
                                                           $gettablename2=get_option('hubspot_table_name2');
                                                                  $get_entry_id_key="hubspot_entryid_subtohubspot".$value_entry.$value_form;
                                                                  $sql_hub11 = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$get_entry_id_key'";//mo
                                                                  $wpdb->show_errors;
                                                                  $sql_result6=$wpdb->get_results($sql_hub11);

                                                                   if(!empty($sql_result6)){
                                                                       $final_result6=$sql_result6[0]->fieldvalue;
                                                                          if (!empty($final_result6)) {
                                                                                  $get_entry_id=$final_result6;
                                                                            }
                                                                     }

                                                                   if(!empty($get_entry_id)){
                                                                       if($get_entry_id){
                                                                           if($get_form_id){
                                                                               if($_GET['id']==$get_form_id){
                                                                                    $result3 = GFAPI::get_entries( $get_form_id );//display view json for each entry if ti is submit or not
                                                                                       foreach ($result3 as $key3 => $value4) {
                                                                                                  foreach ($value4 as $keye => $valuee) {
                                                                                                           if($get_entry_id==$valuee){
                                                                                                            $expire_time1=$expire_time;
                                                                                                            $get_entry_id1=$get_entry_id;
                                                                                                            $get_form_id1=$get_form_id;
                                                                                                            $html1=true;
                                                                                                              }
                                                                                                    }
                                                                                         }
                                                                                     }
                                                                                }
                                                                            }
                                                                        }
                                                                        if(!empty($html1)){
                                                                            ?><input type="hidden" id="foo" name="zymxyv" value="<?php echo esc_html($expire_time1);?>"/>
                                                                           <input type="hidden" id="entryidy" name="zy" value="<?php echo esc_html($get_entry_id1);?>"/>
                                                                           <input type="hidden" id="formidd" name="zyrf" value="<?php echo esc_html($get_form_id1);?>"/>
                                                                            <div class="alert gforms_note_success"style="font-size: .870rem;font-weight: 500;">HubSpot form submitted&nbsp(Entry ID  <?php echo esc_html($get_entry_id);?>)&nbsp&nbsp&nbsp
                                                                             <input id="viewjson" style="background: #3e7da6;border: 1px solid transparent;
                                                                                                         border-radius: 3px;
                                                                                                         color: #fff;
                                                                                                         font-family: inherit;
                                                                                                         font-size: .875rem;
                                                                                                         font-weight: 500;
                                                                                                         height: auto;
                                                                                                         line-height: 1;
                                                                                                         margin-left: 0;
                                                                                                         padding: 0.625rem 1.125rem;cursor: pointer;"type=button value="View JSON"></div>
                                                                              <div id="viewentry"></div><?php
                                                                        }
                                                                          else{
                                                                                echo '<div style="font-size: .870rem;
                                                                                      font-weight: 500;">HubSpot form not submitted</div>';
                                                                           }
                                                                                               
                                                            } 
                        //ajax call to display response json on button click view json
                            function get_dataa3(){ 
                                                    $entryidv=sanitize_text_field($_POST['entryidd']);
                                                    if(is_numeric($entryidv)){
                                                        $entryid=$entryidv;
                                                    }
                                                    $formidv=sanitize_text_field($_POST['formidd']);
                                                    if(is_numeric($formidv)){
                                                        $formid=$formidv;
                                                    }
                                                    global $wpdb; 
                                                    $gettablename2=get_option('hubspot_table_name2');
                                                    $hubspot_entryview_subtohubspot="hubspot_entryview_subtohubspot".$entryid.$formid;
                                                    $sql_hub9 = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$hubspot_entryview_subtohubspot'";//mo
                                                    $wpdb->show_errors;
                                                    $sql_result2=$wpdb->get_results($sql_hub9);
                                                    $final_result2=$sql_result2[0]->fieldvalue;

                                                   $split_arr= chunk_split($final_result2,15);
                                                    
                                                    if (!empty($final_result2)) {
                                                            $entrysuccess=$split_arr;
                                                        }
                                                        wp_send_json_success($entrysuccess);

                                        }  

                add_action( 'wp_ajax_nopriv_get_dataa3', 'get_dataa3' );//ajax call hook
                add_action( 'wp_ajax_get_dataa3', 'get_dataa3' );//ajax call hook

                 //add bulk action hubspot
                add_filter( 'gform_entry_list_bulk_actions', 'add_actions', 10, 2 );

                                //fun return one option name in bulk action in entry page
                                function add_actions( $actions, $form_id ){
                                                                            $actions['my_hubspot_action'] = 'Sync to HubSpot';
                                                                            return $actions;
                                        }
                            // callback fun when sink to hubspot action apply
                add_action( 'gform_entry_list_action_my_hubspot_action', 'bulk_sink_to_hubspot', 10, 3 );

                                    // fun display popup when sink to hubspot action applied
                                function bulk_sink_to_hubspot($action,$entries,$form_id){
                                                                               $get_all_entry=$entries;//all entry array
                                                                                 if(!empty(get_option('entry_slelect_from_entry_list'))) {
                                                                                                    delete_option('entry_slelect_from_entry_list');
                                                                                                    update_option('entry_slelect_from_entry_list',$entries); 
                                                                                                    }
                                                                                                    else{
                                                                                                        add_option('entry_slelect_from_entry_list',$entries);
                                                                                                    } 
                                                                                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
                                                                                    $link = "https";
                                                                                }
                                                                                else{
                                                                                      $link = "http";
                                                                                  }
                                                                                $link .= "://";
                                                                                $link .= sanitize_text_field($_SERVER['HTTP_HOST']);
                                                                                $link .= sanitize_text_field($_SERVER['REQUEST_URI']);
                                                                                $current_page3=$link;
                                                                                
                                                                                $newurl= substr($current_page3, 0, strpos($current_page3, "page"));
                                                                                $newurl.="page=gf_settings&subview=hubspotsinkmap";
                                                                                 $expire_time=get_option('expres_token_entry');
                                                                                echo'<input type="hidden" id="foo" name="zymxy" value="'.esc_html($expire_time).'"/>';//jqery error
                                                                                   

                                                                                    global $wpdb;
                                                                                 // add form id save by popup will show in form save setting field
                                                                                  $popup_save_id_show_field_form_save2="hubspot_check_popup_formid".$form_id;
                                                                                  $gettablename2=get_option('hubspot_table_name2');
                                                                                  $sql_hubgh3 = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$popup_save_id_show_field_form_save2'";
                                                                                 
                                                                                  $wpdb->show_errors;
                                                                                  $sql_result2=$wpdb->get_results($sql_hubgh3);
                                                                                  if(!empty($sql_result2)){
                                                                                                $final_result2=$sql_result2[0]->fieldvalue;
                                                                                                if (!empty($final_result2)) {
                                                                                                      $formid_map_hubspot_save_value=$final_result2;
                                                                                                   }
                                                                                              }
                                                                                              if(empty($formid_map_hubspot_save_value)){
                                                                                               $formid_map_hubspot_save_value=" ";
                                                                                              }

                                                                                   if($form_id!=$formid_map_hubspot_save_value){
                                                                                           header("Location:".$newurl."&formid=".$form_id);
                                                                                     }//if move to hubspot sink map
                                                                                    else{
                                                                                                 $message=array();
                                                                                                  $formid1=$form_id;
                                                                                                  foreach($entries as $key=>$val){
                                                                                                           $get_all_entry_detail[]=GFAPI::get_entry($val);
                                                                                                   }
                                                                                            
                                                                                        foreach ($get_all_entry_detail as $key => $value) {
                                                                                                  foreach ($value as $key1 => $value2) {
                                                                                                            if(is_numeric($key1)){
                                                                                                                if(!empty($value2)){
                                                                                                                 $entryvalue[$value['id']][]=$value2;
                                                                                                                }
                                                                                                                
                                                                                                             }
                                                                                                      }
                                                                                          }

                                                                                     
                                                                                 $getentryidd= GFAPI::get_entries($form_id);

                                                                                   if(!empty($getentryidd)){//check at least one entry exit or not
                                                                                     foreach($getentryidd as $key1=>$value1){
                                                                                         foreach ($value1 as $key2 => $value2) {
                                                                                             if($key2=='id'){
                                                                                                    $getallentryid[]=$value2;
                                                                                                }
                                                                                             }
                                                                                        }
                                                                                  foreach($getallentryid as $bh=>$vab){
                                                                                            $get_all_entry_detail[]=GFAPI::get_entry($vab);
                                                                                     }
                                                    
                                                                                 foreach ($get_all_entry_detail as $key => $value) {
                                                                                     foreach($value as $key2=>$value4){
                                                                                             if(!empty($value4)){
                                                                                                    if(is_numeric($key2) ){
                                                                                                        $entry_field_id_macth[$form_id][]=$key2;
                                                                                                    }
                                                                                                }
                                                                                        }
                                                                                  }
                                                                                  //get form entry field label name after creating at least one entry
                                                                                  $formexactfield=GFAPI::get_form($form_id);
                                                                                foreach($formexactfield['fields'] as $key3=>$val3){
                                                             
                                                                                      if($val3->inputs){
                                                                                           foreach($val3->inputs as $key4=>$val4){
                                                                                            foreach ($val4 as $key5 => $value5) {
                                                                                                if($key5=='id'){
                                                                                                    foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                      
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($value5==$value7){
                                                                                                                $entry_field_name[$form_id][]=$val4['label'];
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                           }
                                                                                        }
                                                                                        else{
                                                                                            if($val3->id){
                                                                                                 foreach ($entry_field_id_macth as $key6 => $value6) {
                                                                                                        foreach ($value6 as $key7 => $value7) {
                                                                                                            if($val3->id==$value7){
                                                                                                                $entry_field_name[$form_id][]=$val3->label;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                            }
                                                                                        }
                                                                                }//formexact
                                                                        foreach($entry_field_name as $key=>$val){
                                                                        $new_entry_field_name[]=$val;
                                                                     }
                                                                 }
                                                                     $remove_dub_field=array_unique($new_entry_field_name[0]);
                                                          
                                                                                            $gettablename2=get_option('hubspot_table_name2');
                                                                      
                                                                                            global $wpdb; 
                                                                                            $save_hubspot_map_field_key="save_mapfield_arr_hubspot_formm".$form_id;//def
                                                                                             $sql = "SELECT `fieldvalue` FROM $gettablename2 WHERE `field`='$save_hubspot_map_field_key'";//mo
                                                                                           
                                                                                             $wpdb->show_errors;
                                                                                             $sql_result=$wpdb->get_results($sql);
                                                                                           
                                                                                             $final_resultt=$sql_result[0]->fieldvalue;
                                                                                             $res=json_decode($final_resultt,true);
                                                                                          
                                                                                             
                                                                                            if(array_key_exists('label_value',$res)){
                                                                                                 foreach ($res['label_value'] as $key1 => $value1) {
                                                                                                 
                                                                                                         foreach ($remove_dub_field as $key => $value) {
                                                                                                             if($key1==$value){
                                                                                                                $new_res[]=$value1;
                                                                                                             }
                                                                                                         }
                                                                                                 }
                                                                                                 if(array_key_exists('status',$res)){
                                                                                             
                                                                                                $finalstatus=$res['status'];
                                                                                                
                                                                                             }
                                                                                                $field_map_data[]=$new_res;
                                                                                                $field_map_data['status']=$finalstatus;
                                                                                                 global $wpdb;
                                                                                                 $save_hubspot_map_field_key_update="save_mapfield_arr_hubspot_formm".$form_id;
                                                                                                 $map_value_arr_final_new=json_encode($field_map_data);
                                                                                                 $sql2 = "UPDATE $gettablename2 SET `fieldvalue`='$map_value_arr_final_new' WHERE `field`='$save_hubspot_map_field_key_update'";
                                                                                                 $wpdb->query($sql2);
                                                                                                   $wpdb->show_errors;
                                                                                             }else{
                                                                                                    $new_res=$res;
                                                                                                    $finalstatus=$res['status'];
                                                                                                 }//die;
                                                                                                 $finalres=$new_res;
                                                                                                 global $wpdb;
                                                                                            $formid_map_hubspot_save[]=$finalres;
                                                                                            
                                                                                         foreach ($formid_map_hubspot_save[0] as $key => $value) {
                                                                                        
                                                                                            if($key!=='status'){
                                                                                                $new_save_hubspot_map_field[]=$value;
                                                                                            }
                                                                                         }
                                                                                    
                                                                                        if(is_array($new_save_hubspot_map_field[0])){
                                                                                            $final_map_field=$new_save_hubspot_map_field[0];
                                                                                        }else{
                                                                                            $final_map_field=$new_save_hubspot_map_field;
                                                                                        }

                                                                                         foreach ($entryvalue as $key3 => $value3) {
                                                                                                $query_para1=array_combine($final_map_field,$value3);
                                                                                                   // get query parameter based on priority said
                                                                                                     foreach ($query_para1 as $key => $value) {
                                                                                                              if($key=='email'){
                                                                                                                   $query_parameter=$value;
                                                                                                                     break;
                                                                                                                                            }
                                                                                                                if($key=='phone'){
                                                                                                                    $query_parameter=$value;
                                                                                                                    break;
                                                                                                                }
                                                                                                                if($key=='mobilephone'){
                                                                                                                    $query_parameter=$value;
                                                                                                                    break;
                                                                                                                }
                                                                                                      
                                                                                                      }
                                                                                                    $finalarr4=array_combine($final_map_field,$value3);
                                                                                                    $finalarr4['hs_lead_status']=$finalstatus;
                                                                                                    $arrcombine['properties']=$finalarr4;
                                                                                                   // stored all property data for update or create which send to hubspot curl body
                                                                                                    foreach ($arrcombine['properties'] as $key => $value) {
                                                                                                             if($key=='Select'){
                                                                                                                unset($arrcombine['properties']['Select']);
                                                                                                             }
                                                                                                         }
                                                                                                  
                                                                                                // get access token from refresh token in backgroud because here donnot any option to get acces token on button click

                                                                                                    $clientrefresh= get_option('refreshtoken');
                                                                                                    $clientidd= get_option('clientid');
                                                                                                    $clientsec= get_option('clientsecret');
                                                                                                    $redirecturl="https://dev.perimattic.com/hubspot/hubspot-callback.php";
                                                                                                    $url3="https://api.hubapi.com/oauth/v1/token";

                                                                                                   $result6 = wp_remote_post( $url3, array(
                                                                                                                'method'      => 'POST',
                                                                                                                'headers'     => array('Content-Type'=>'application/x-www-form-urlencoded'),
                                                                                                                'body'=> 
                                                                                                                    array('grant_type'=>'refresh_token',
                                                                                                                          'client_id'=> $clientidd,
                                                                                                                         'client_secret'=> $clientsec,
                                                                                                                        'redirect_uri'=> $redirecturl,
                                                                                                                        'refresh_token'=> $clientrefresh
                                                                                                                         
                                                                                                                ),
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result6 ) ) {
                                                                                                                $error_message = $result6->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                               
                                                                                                      $response=wp_remote_retrieve_body($result6);
                                                                                                         $decode3=json_decode($response,true);
                                                                                                           foreach($decode3 as $gy=>$vh){
                                                                                                                    if($gy=='access_token'){
                                                                                                                         if(!empty(get_option('nopopup_accesstoken')))  {
                                                                                                                             delete_option('nopopup_accesstoken');
                                                                                                                              update_option('nopopup_accesstoken',$vh);
                                                                                                                             }
                                                                                                                     else{
                                                                                                                           add_option('nopopup_accesstoken',$vh);
                                                                                                                      }
                                                                                                                    }
                                                                                                            }
                                                                                                        }
                                                                                             // get contact property if exits using query parameter as we set static
                                                                                                        if(!empty($query_parameter)){
                                                                                                          $tokenm=get_option('nopopup_accesstoken');
                                                                                                          $urle = "https://api.hubapi.com/contacts/v1/search/query?q=".$query_parameter;
                                                                                                          $token ="Bearer ";
                                                                                                          $token.=$tokenm;
                                                                                                          $resultr= wp_remote_get( $urle ,
                                                                                                         array(
                                                                                                             'headers' => array( 'Content-Type'=> 'application/json', // if the content type is json
                                                                                                                'Authorization'=>$token
                                                                                                                 ) 
                                                                                                         ));
                                                                                                      if ( is_wp_error( $resultr ) ) {
                                                                                                                // Error out.
                                                                                                        echo"error";
                                                                                                                $keep_going = false;
                                                                                                            }else{

                                                                                                        $response=wp_remote_retrieve_body($resultr);
                                                                                                      $decod3=json_decode($response,true);
                                                                                         
                                                                                                            if(!empty($decod3['contacts'][0]['vid'])){
                                                                                                                    $recordid=$decod3['contacts'][0]['vid'];
                                                                                                                }else{
                                                                                                                     $recordid='';
                                                                                                                    }
                                                                                                             }
                                                                                                               // update contact property if exits record id for nay entry on hubspot
                                                                                                            
                                                                                                             $body=json_encode($arrcombine);
                                                                                                             if(!empty($recordid)){
                                                                                                                 $token1 ="Bearer ";
                                                                                                                 $token1.=$tokenm;
                                                                                                                  $url1 = "https://api.hubapi.com/crm/v3/objects/contacts/".$recordid;
                                                                                                                  $result2= wp_remote_post( $url1, array(
                                                                                                                'method'      => 'PATCH',
                                                                                                                'headers'     => array('Content-Type'=>'application/json', 
                                                                                                                   'Authorization'=>$token1),
                                                                                                                    'body'=>$body
                                                                                                                )
                                                                                                            );

                                                                                                            if ( is_wp_error( $result2 ) ) {
                                                                                                                $error_message = $result2->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                               
                                                                                                         $response1=wp_remote_retrieve_body($result2);
                                                                                                         $decode3=json_decode($response1,true);
                                                                                                                $view_jsonobject_up=json_encode($response1);

                                                                                                                   global $wpdb;
                                                                                                                   // save each entry response json data
                                                                                                                   $gettablename2=get_option('hubspot_table_name2');
                                                                                                                   $hubspot_entryview_subtohubspot_up="hubspot_entryview_subtohubspot".$key3.$formid1;
                                                                                                                   $sql_entry = "UPDATE $gettablename2 SET `fieldvalue`='$view_jsonobject_up' WHERE `field`='$hubspot_entryview_subtohubspot_up'";
                                                                                                                  $wpdb->query($sql_entry);
                                                                                                                  $wpdb->show_errors;
                                                                                                                               //  $mess=$decode3['properties']['firstname'];
                                                                                                                                 $message[]="updated";
                                                                                                                                }
                                                                                                               }
                                                                                                                else{
                                                                                                                     // create contact if not present any record id

                                                                                                                      $url2 = "https://api.hubapi.com/crm/v3/objects/contacts?archived=false";
                                                                                                                      $token3 ="Bearer ";
                                                                                                                      $token3.=$tokenm;
                                                                                                                      $body1=json_encode($arrcombine);
                                                                                                                      $result5= wp_remote_post( $url3, array(
                                                                                                                'method'      => 'PATCH',
                                                                                                                'headers'     => array('Content-Type'=>'application/json', 
                                                                                                                   'Authorization'=>$token3),
                                                                                                                    'body'=>$body
                                                                                                                )
                                                                                                            );

                                                                                                        if ( is_wp_error( $result5 ) ) {
                                                                                                                $error_message = $result5->get_error_message();
                                                                                                                echo "Something went wrong:".esc_html($error_message);
                                                                                                            } else {
                                                                                                              
                                                                                                      $response2=wp_remote_retrieve_body($result5);
                                                                                                        $decode2=json_decode($response2,true);
                                                                                                           $view_jsonobject2=json_encode($response2);

                                                                                                                   global $wpdb;
                                                                                                                   // save each entry response json data
                                                                                                                   $gettablename2=get_option('hubspot_table_name2');
                                                                                                                   $hubspot_entryview_subtohubspot1="hubspot_entryview_subtohubspot".$key3.$formid1;
                                                                                                                   $sql_hub5 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryview_subtohubspot1','$view_jsonobject2')";
                                                                                                                  $wpdb->query($sql_hub5);
                                                                                                                  $wpdb->show_errors;
                                                                                                               // mark form id for which any entry created on hubspot
                                                                                                                  $hubspot_formid_subtohubspot="hubspot_formid_subtohubspot".$formid1;
                                                                                                                   $sql_hub6 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_formid_subtohubspot','$formid1')";
                                                                                                                   $wpdb->query($sql_hub6);
                                                                                                                   $wpdb->show_errors;
                                                                                                                // mark which entry id for given form id created or not
                                                                                                                   $hubspot_entryid_subtohubspot="hubspot_entryid_subtohubspot".$key3.$formid1;
                                                                                                                   $sql_hub7 = "INSERT INTO $gettablename2 (`field`,`fieldvalue`) VALUES ('$hubspot_entryid_subtohubspot','$key3')";
                                                                                                                    $wpdb->query($sql_hub7);
                                                                                                                    $wpdb->show_errors;
                                                                                                                   //$mess=$decode2['properties']['firstname'];
                                                                                                                   $message[]="created";// stored all created message for later display
                                                                                                              }//elsedatabase
                                                                                                           }//elseupdate
                                                                                                       }//notemtyqueryparameter
                                                                                          }//for each arr combine The selected entries have been synced to HubSpot
                                                                                         
                                                                                         // show entry created or updated with entry name as message
                                                                                            if(!empty($message)){
                                                                                                 $html3="<div class='alert gforms_note_success' role='alert'> ";
                                                                                                ?><div class='alert gforms_note_success' role='alert'> The selected entries have been synced to HubSpot</div><?php
                                                                                                 foreach ($message as $key => $value) {
                                                                                                           if($value=='updated'){
                                                                                                               $html3.="This Entry &nbsp";
                                                                                                               $html3.=$key."&nbsp ";
                                                                                                               $html3.=$value."&nbsp on &nbsp Hubspot<br>&nbsp";
                                                                                                             }
                                                                                                             else{
                                                                                                                  $html3.="This Entry &nbsp";
                                                                                                                  $html3.=$key."&nbsp";
                                                                                                                  $html3.=$value."&nbsp on &nbsp Hubspot<br>&nbsp";
                                                                                                              }
                                                                                                  }
                                                                                                $html3.="</div>";
                                                                                                //echo esc_html($html5);
                                                                                             }
                                                                        //  }//else no popup
                                                }//else direct create contact
                            }
                                  
                            // this func add sink to hubspot and change account and display data fetch from hubspot
                                     function my_function1(){
                                                         if(isset($_GET['access_token'])){
                                                            if(!empty($_GET['access_token'])){
                                                                                    ?><div class="alert gforms_note_success" role='alert'>You've successfully connected with HubSpot.<br> 
                                                                                            If needed, you can go ahead and map your forms from entry page. </div><?php
                                                                                        }
                                                                                }
                                                               
                                                                        ?><div id="hideconnect">
                                                                           
                                                                        <fieldset id="gform-settings-section" class="gform-settings-panel gform-settings-panel--full gform-settings-panel--with-title">
                                                                             <legend class="gform_panel_title gform_think_header">HubSpot Addon Settings </legend>
                                                                             <div class="gform_think_content">
                                                                                 <div class="gform-settings-description">HubSpot is a popular customer relationship management (CRM) platform that provides a suite of software tools designed to help businesses attract, engage, and delight customers.</div>
                                                                                <form action="" method="post">
                                                                                    <div id="input_hub">
                                                                                        <input id="co_button" style="margin-top: 8px;cursor: pointer;"class="hubspot_account1"type="submit" name="hubspot" value="Connect with HubSpot">
                                                                                    </div>
                                                                                </form>
                                                                             </div>
                                                                        </fieldset></div><?php
                                                                       
                                                                         if(!empty(get_option('hide_div_element'))){
                                                                                ?><script type="text/javascript">jQuery('#hideconnect').hide();</script><?php
                                                                             }
                                                                    
                                                            if(isset($_POST['hubspot'])){
                                                                            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
                                                                                    $link = "https";
                                                                                }
                                                                                else{
                                                                                      $link = "http";
                                                                                  }
                                                                                $link .= "://";
                                                                                $link .= sanitize_text_field($_SERVER['HTTP_HOST']);
                                                                                $link .= sanitize_text_field($_SERVER['REQUEST_URI']);
                                                                                $current_page=$link;

                                                                        //using this we get dynamic url for each user who click on this  button
                                                                        add_option('after_token_expire_re_url',$current_page);
                                                                
                                                                        global $wpdb; 
                                                                               $mydb = new wpdb(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST);
                                                                                   
                                                                              
                                                                              $table_prefixname=$wpdb->prefix;
                                                                              $tablename='curious_brains_hubspotapidata';
                                                                              $finaltablename=$table_prefixname;
                                                                              $finaltablename.=$tablename;
                                                                              $db_table_name =$finaltablename;
                                                                              add_option('hubspot_table_name1',$db_table_name);
                                                                              
                                                                        if($wpdb->get_var( "show tables like '$db_table_name'" ) != $db_table_name ) {//checking already table hubspidata exit or not
                                                                    // creating table which contain hubspot all field type  
                                                                                $sql5 = "CREATE TABLE $db_table_name (
                                                                                                  id INT(250) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                                                                  field VARCHAR(250) NOT NULL
                                                                                                )";
                    
                                                                                $mydb->query($sql5);
                                                                                $mydb->show_errors;
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
                                                                             if($wpdb->get_var( "show tables like '$db_table_name1'" ) != $db_table_name1 ) {
                                                                     // table conatain all dynamic data which used to check whether form is map through form setting or using popup mapping and also contain json data for each entry submit to hubspot account
                                                                                $sql6 = "CREATE TABLE $db_table_name1 (
                                                                                                  id INT(250) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                                                                  field VARCHAR(250) NOT NULL,
                                                                                                  fieldvalue longtext NOT NULL
                                                                                                )";
                    
                                                                                $mydb1->query($sql6);
                                                                                $mydb1->show_errors;
                                                                             }

                                                                            
                                                                    // staic link(since client id static pass)where we redirect to hubspot using this link after click on hubspot and after redirect to user wepsiite
                                                                                 $urlty=" https://app.hubspot.com/oauth/authorize?client_id=23494e12-3d2e-433c-8d45-95b4027a666d&redirect_uri=https://hubspot.wpcuriousbrains.com/hubspot-callback.php&scope=oauth%20crm.lists.read%20crm.objects.contacts.read%20crm.objects.contacts.write%20crm.lists.write&state=";
                                                                                 $urlty.=$current_page;
                                                                                 header('Location:'.$urlty);
                                                                             }
                                                                             
                                                                             
                                                            //display clientid and token after click on connect with hubspot
                                                         if(isset($_GET['access_token'])){

                                                            add_option('hide_div_element',true);
                                                            if(!empty(get_option('hide_div_element'))){
                                                                                ?><script type="text/javascript">jQuery('#hideconnect').hide();</script><?php
                                                                             }
                                                                               

                                                                 $accesstoken_v=sanitize_text_field($_GET['access_token']);
                                                                 if(!empty($accesstoken_v)){
                                                                    $accesstoken=$accesstoken_v;
                                                                 }
                                                                                    $tokentype_v=sanitize_text_field($_GET['token_type']);
                                                                    if(!empty($tokentype_v)){
                                                                    $tokentype=$tokentype_v;
                                                                 }
                                                                                    $clientid_v=sanitize_text_field($_GET['client_id']);


                                                                    if(!empty($clientid_v)){
                                                                    $clientid=$clientid_v;
                                                                 }
                                                                                    $clientsecret_v=sanitize_text_field($_GET['client_secret']);
                                                                    if(!empty($clientsecret_v)){
                                                                    $clientsecret=$clientsecret_v;
                                                                 }
                                                                                    $refereshtoken_v=sanitize_text_field($_GET['refresh_token']);
                                                                    if(!empty($refereshtoken_v)){
                                                                    $refereshtoken=$refereshtoken_v;
                                                                 }

                                                                        if(!empty(get_option('clientsecret')))  {
                                                                                       delete_option('clientsecret');
                                                                                       update_option('clientsecret',$clientsecret);
                                                                             
                                                                              } else{
                                                                                    delete_option('clientsecret');
                                                                                     add_option('clientsecret',$clientsecret);
                                                                            }

                                                                         if(!empty(get_option('refreshtoken')))  {
                                                                                      delete_option('refreshtoken');
                                                                                      update_option('refreshtoken',$refereshtoken);
                                                                             
                                                                              } else{
                                                                                delete_option('refreshtoken');
                                                                                     add_option('refreshtoken',$refereshtoken);
                                                                             }


                                                                        if(!empty(get_option('tokennn'))){
                                                                                     delete_option('tokennn');
                                                                                     update_option('tokennn',$accesstoken);
                                                                                }
                                                                                else{
                                                                                    delete_option('tokennn');
                                                                                       add_option('tokennn',$accesstoken);
                                                                                 }
                                                       
                                                                                   add_option('clientid',$clientid);
                                                    
                                                            // hubspot api call to get hubspot field type and status using bearer token
                                                                     $url = "https://api.hubapi.com/crm/v3/properties/contact?archived=false";
                                                                     $token ="Bearer ";
                                                                     $token.=$accesstoken;// "generated token code";
                                                                    $result= wp_remote_get( $url ,
                                                                                     array(
                                                                                         'headers' => array( 'Content-Type'=> 'application/json', // if the content type is json
                                                                                            'Authorization'=>$token
                                                                                             ) 
                                                                                     ));
                                                                      if ( is_wp_error( $result ) ) {
                                                                                // Error out.
                                                                        echo"error";
                                                                                $keep_going = false;
                                                                            }else{
                                                                
                                                                                
                                                                                         $response=wp_remote_retrieve_body($result);
                                                                                         $decode=json_decode($response,true);
                                                                                        // var_dump($decode);die;
                                                                                         if(isset($decode['status'])){
                                                                                        if($decode['status']=='error'){
                                                                                           ?><script type="text/javascript"> jQuery('.gforms_note_success').hide();
                                                                                                    jQuery('.gform-settings__content').prepend('<div class="alert gforms_note_error" role="alert"><?php echo esc_html($decode['message'])?>  <br>Trouble in getting access token then First click on HubSpot Addon Tab and then click on  connect with hubspot button.<br> Need some help in plugin configuration? <a href="mailto:support@wpcuriousbrains.com">Contact us here for Support</a></div>');
                                                                                                    </script><?php
                                                                                    }
                                                                                }
                                                                                            foreach($decode as $key){
                                                                                                     foreach($key as $vale=>$bb){
                                                                                                              foreach($bb as $hh=>$nn){
                                                                                                                        $lead=$nn;
                                                                                                                         if($hh=="name"){
                                                                                                                              $arr[]=$nn;
                                                                                        }
                                                                            if( $hh=="options" && $bb['name']=="hs_lead_status"){
                                                                                     foreach($bb['options'] as $vg=>$bu){
                                                                                              foreach($bu as $ty=>$nji){
                                                                                                       if($ty=='value'){
                                                                                                          $statusapi[]=$nji;
                                                                                                        }
                                                                                                     }
                                                                                                }
                                                                                           }
                                                                                      }
                                                                                  }
                                                                }
                                                                             $jsondata=json_encode($arr);
                                                                             global $wpdb;
                                                                // // everytime we click on hubspot we delete previous hubspot field type and insert new field type
                                                            
                                                                             $db_table_name2=get_option('hubspot_table_name1');
                                                                             if($wpdb->get_var( "show tables like '$db_table_name2'" ) == $db_table_name2 ){
                                                                                   
                                                                                    $sql20 ="DELETE FROM $db_table_name2";
                                                                                    $wpdb->query($sql20);
                                                                                    $wpdb->show_errors;
                                                                                  
                                                                                 }
                                                                                     
                                                                  //insert all field of hubspot on this table
                                                                            $gettablename=get_option('hubspot_table_name1');
                                                                               foreach ($arr as $value=>$gg) {
                                                                                         $sql4 = "INSERT INTO $gettablename (`field`) VALUES ('$gg')";
                                                                                          $wpdb->query($sql4);
                                                                                          $wpdb->show_errors;
                                                                                      }
                                                                //insert new hubspot status in option
                                                                                if(!empty(get_option('statushub')))  {
                                                                                          //delete_option('statushub');
                                                                                          update_option('statushub',$statusapi);
                                                                                      }
                                                                                          else{
                                                                                                add_option('statushub',$statusapi);
                                                                                          }
                                                                                //hubspot api call to find hubspot expire time so that we display message that access token willexpired or not
                                                                                  $tokenm=get_option('tokennn');
                                                                                
                                                                                  $urle = "https://api.hubapi.com/oauth/v1/access-tokens/";
                                                                                  $urle.=$tokenm;
                                                                                  $resultr= wp_remote_get( $url ,
                                                                                     array(
                                                                                         'headers' => array( 'Content-Type'=> 'application/json', // if the content type is json
                                                                                            'Authorization'=>$token
                                                                                             ) 
                                                                                     ));
                                                                      if ( is_wp_error( $resultr ) ) {
                                                                                // Error out.
                                                                        echo"error";
                                                                                $keep_going = false;
                                                                            }else{
                                                                                    $response3=wp_remote_retrieve_body($resultr);
                                                                                         $decod3=json_decode($response3,true);
                                                                                          foreach($decod3 as $rt=>$bg){
                                                                                              if($rt=='expires_in'){
                                                                                               $redirect_url_after_expire=get_option('after_token_expire_re_url');//add expire time in milisec in option
                                                                                                $data = $redirect_url_after_expire;    
                                                                                                $urlredirect = substr($data, strpos($data, "?") + 1); 
                                                                                                $fgg="admin.php?";
                                                                                                $fgg.=$urlredirect;   
                                                                                                $ggi=$bg;
                                                                                                $gghi=1000*$ggi;//change sec to milisec since display mess using jquery funtion take time in milisec
                                                                                                 if(!empty(get_option('expres_token_entry')))  {
                                                                                                          delete_option('expres_token_entry');
                                                                                                          update_option('expres_token_entry',$gghi);
                                                                             
                                                                                                         } else{
                                                                                                               add_option('expres_token_entry',$gghi);
                                                                                                              }
                                                                                            //display expire time in hidden to get using juery
                                                                                                 echo'<input type="hidden" id="foo" name="zyx" value="'.esc_html($gghi).'" />';
                                                                                             //if access token expire we refresh page after that time so that again redirect from required page otherwise it not redirect to hubspot           
                                                                                                         header( 'refresh: '.$ggi.'; url='.$fgg );

                                                                                            }
                                                                                    }
                                                               
                                                                               }
                                                                           }
                                                                     

                                                                                    $accesstoken_v=sanitize_text_field($_GET['access_token']);
                                                                                     if(!empty($accesstoken_v)){
                                                                                            $accesstoken=$accesstoken_v;
                                                                                    }
                                                                                    $clientid_v=sanitize_text_field($_GET['client_id']);
                                                                                    if(!empty($clientid_v)){
                                                                                            $clientid=$clientid_v;
                                                                                    }

                                                                                    ?><fieldset id="field" class="think_gform gform_think_title">
                                                                                         <legend style="border-bottom: 1px solid #ebebf2; margin-bottom:1rem ;font-size: .875rem; line-height: 2.875rem;padding-left: 1.0625rem; position: absolute;top:0;
                                                                                                 width: 96%;font-weight: 500;"class="gform_panel_title gform_think_header">HubSpot Addon Settings </legend><div style="margin-top: 3rem;">
                                                                                        <div style="margin-left:1.1rem;color: #23282d;font-size: .8125rem;font-weight:500;">Client ID:</div>
                                                                                        <div class="gform_think_content1">
                                                                                            <span class="gform-settings-input__container gform-settings-input__container--feedback-success">
                                                                                                <input class="text1"type="text" name="tt" class="gform-admin-input gform-settings-panel__content"value="<?php echo esc_html($clientid) ;?>">
                                                                                            </span>
                                                                                        </div>
                                                                                         <div style="margin-left:1.1rem;color: #23282d;font-size: .8125rem;font-weight:500;">Access Token:</div>
                                                                                         <div class="gform_think_content1">
                                                                                            <span class="gform-settings-input__container gform-settings-input__container--feedback-success">
                                                                                                <input class="text1"type="text" name="tt" class="gform-admin-input gform-settings-panel__content"value="<?php echo esc_html($accesstoken);?>">
                                                                                            </span>
                                                                                        </div><span class="a">
                                                                                            <div id="input_hub">
                                                                                                <form action="" method="post">
                                                                                                <input style="cursor: pointer;"class="hubspot_account1"type="submit" name="hubspot" value="Connect with HubSpot">
                                                                                                </form>
                                                                                                </div>
                                                                                        <div id="acc_test">
                                                                                         <form action="" method="post">
                                                                                            <input style="cursor: pointer;"class="hubspot_account"type="submit" name="hubspot_account" value="Change HubSpot Account">
                                                                                            
                                                                                            </form></div>
                                                                                            
                                                                                                
                                                                                                </span></div>
                                                                                        </fieldset><?php

                                                                                    $clientid_text="Client ID:";
                                                                                    add_option('clientid_hub_show',$clientid_text);//display clientid name after page refresh
                                                                                    $accesstoken_text="Access Token:";// save so that name will display after page refresh
                                                                                    add_option('accesstoken_hub_show',$accesstoken_text);
                                                                                    // save client id and access token show this value fetch after page refresh
                                                                                     if(!empty(get_option('save_sink_data_formhubspot_clientid'))) {
                                                                                                    delete_option('save_sink_data_formhubspot_clientid');
                                                                                                    update_option('save_sink_data_formhubspot_clientid',$clientid); 
                                                                                                    }
                                                                                                    else{
                                                                                                        add_option('save_sink_data_formhubspot_clientid',$clientid);
                                                                                                    }   
                                                                                     if(!empty(get_option('save_sink_data_formhubspot_accesstoken'))) {
                                                                                                 delete_option('save_sink_data_formhubspot_accesstoken');
                                                                                                update_option('save_sink_data_formhubspot_accesstoken',$accesstoken); 
                                                                                                    }
                                                                                                    else{
                                                                                                    add_option('save_sink_data_formhubspot_accesstoken',$accesstoken);
                                                                                                     }                                        

                                                                                
                                                                               }
                                                                                else{// show client id and access token name and value after page refresh
                                                                                    if(!empty(get_option('hide_div_element'))){
                                                                                     if(!empty(get_option('save_sink_data_formhubspot_clientid'))){
                                                                                         ?> <fieldset id="field" class="think_gform gform_think_title">
                                                                                             <legend style="border-bottom: 1px solid #ebebf2; margin-bottom:1rem ;font-size: .875rem; line-height: 2.875rem;padding-left: 1.0625rem; position: absolute;top:0;
                                                                                                 width: 95%;font-weight: 500;"class="gform_panel_title1 gform_think_header1">HubSpot Addon Settings </legend><div style="margin-top: 3rem;">
                                                                                            <div style="margin-left:1.1rem;margin-top:0.2rem;color: #23282d;font-size: .8125rem;font-weight:500;"><?php echo esc_html(get_option('clientid_hub_show'));?></div>
                                                                                            <div class="gform_think_content1">
                                                                                                <span class="gform-settings-input__container gform-settings-input__container--feedback-success">
                                                                                                    <input class="text1"type="text" name="tt" class="gform-admin-input gform-settings-panel__content"value="<?php  echo esc_html(get_option('save_sink_data_formhubspot_clientid'));?>">
                                                                                                </span>
                                                                                            </div>
                                                                                     
                                                                                           <div style="margin-left:1.1rem;color: #23282d;font-size: .8125rem;font-weight:500;"><?php echo esc_html(get_option('accesstoken_hub_show'));?></div>
                                                                                           <div class="gform_think_content1">
                                                                                            <span class="gform-settings-input__container gform-settings-input__container--feedback-success">
                                                                                                <input class="text1"type="text" name="tt" class="gform-admin-input gform-settings-panel__content"value="<?php echo esc_html(get_option('save_sink_data_formhubspot_accesstoken'));?>">
                                                                                            </span>
                                                                                        </div>
                                                                                        <span class="a">
                                                                                            <div id="input_hub">
                                                                                                <form action="" method="post">
                                                                                                <input style="cursor: pointer;" class="hubspot_account1"type="submit" name="hubspot" value="Connect with HubSpot">
                                                                                                </form>
                                                                                                </div>
                                                                                        <div id="acc_test">
                                                                                         <form action="" method="post">
                                                                                            <input style="cursor:pointer;" class="hubspot_account"type="submit" name="hubspot_account" value="Change HubSpot Account">
                                                                                        </form></div>
                                                                                        </span>
                                                                                    </div>
                                                                                        </fieldset><?php 
                                                                                    }
                                                                                   }
                                                                               }
                                                                                   //open hubspot login page when click on hubspot change account
                                                                               if(isset($_POST['hubspot_account'])){
                                                                                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
                                                                                    $link = "https";
                                                                                }
                                                                                else{
                                                                                      $link = "http";
                                                                                  }
                                                                                $link .= "://";
                                                                                $link .= sanitize_text_field($_SERVER['HTTP_HOST']);
                                                                                $link .= sanitize_text_field($_SERVER['REQUEST_URI']);
                                                                                $current_page2=$link;
                                                                                    
                                                                                    $new_page=str_replace("=","%3D",$current_page2);//replace = to url resource code so that this link sucessfully redirect to hubspot login page
                                                                                    
                                                                                           $url3="https://app.hubspot.com/login/?loginRedirectUrl=https%3A%2F%2Fapp.hubspot.com%2Foauth%2Fauthorize%3Fclient_id%3D23494e12-3d2e-433c-8d45-95b4027a666d%26redirect_uri%3Dhttps%3A%2F%2Fhubspot.wpcuriousbrains.com%2Fhubspot-callback.php%26scope%3Doauth%2520crm.lists.read%2520crm.objects.contacts.read%2520crm.objects.contacts.write%2520crm.lists.write%26state%3D".$new_page."&authFailureReason=401%20Unauthorized";
                                                                                           
                                                                                           header("Location:".$url3);
                                                                                       }

                                            }
              add_action( 'gform_settings_hubspotaddon', 'my_function1', 10, 1 );//call fun on specific tab
