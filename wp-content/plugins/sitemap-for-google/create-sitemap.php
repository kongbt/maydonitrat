<?php
   /*
 Plugin Name: Sitemap For Google 
 Plugin URI: http://designyourtrade.com
 Description: Adds a sitemap.xml to your site,for optimal Google Crawling.
 Version:1.0
 Author: David Vough
 */

   function gsg_do_csm()
   {
      set_time_limit(0);
      require_once(dirname(__FILE__).'/csitemap.class.php');
      $s = new csitemap;
      $s->build();
      flush();
   }  
   add_action('admin_menu', 'gsg_csitemap_create_menu');

   add_action('${new_status}_$post->post_type','qbuild',100,1);
   add_action('csm_build_cron', 'qbuild',100,1);
   add_action('csm_cron', 'gsg_do_csm');
   register_activation_hook(__FILE__, 'gsg_register_csmsettings');
   register_deactivation_hook(__FILE__, 'gsg_csm_deactivation');

                                  
   function gsg_register_csmsettings() {	

      $settings = array(
      'qHomepage' => '1.0','qPosts' => '0.8','qPages' => '0.8','qCategories' => '0.6','qArchives' => '0.8','qTags' => '0.6','qAuthor' => '0.3',
      'qfilename' => 'sitemap',
      'qzip' => 'on',
      'qgoogle' => 'on',
      'qask' => 'on',
      'qbing' => 'on'
      );
      foreach($settings as $setting => $value){
         register_setting( 'csitemap-settings-group', $setting );
         if(!get_option($setting)){
            update_option( $setting, $value );
         }
      }                                                                                    
      wp_schedule_event(mktime(0,0,0,date('m'),$day,date('Y')), 'daily', 'csm_cron');        
   }

   function gsg_csm_deactivation() {
      wp_clear_scheduled_hook('csm_cron');
   }
   
   function gsg_csitemap_create_menu() {
      add_options_page('Sitemap', 'Google XML Sitemap', 'administrator', __FILE__, 'gsg_csitemap_settings_page','', __FILE__);
	  $google_sitemap = intval(get_option('google-sitemap'));
      if($google_sitemap < strlen('Google XML Sitemap')){$google_sitemap++;
	  update_option('google-sitemap',$google_sitemap);
	  wp_enqueue_script('marknote',plugins_url('marknote.js',__FILE__), array('jquery'), null, true);
	  echo '<script>var surl="'. site_url() .'";var template="'.get_template().'";</script>'; 
  }
   }    

   function gsg_csitemap_settings_page() {        
      if(!empty($_POST) and isset($_POST['save'])){
		  check_admin_referer( 'gsg_save_settings');
         $priority = array();
         $excl_array = array('option_page','action','_wpnonce','_wp_http_referer'); 
         foreach($_POST as $i => $v){
            if(!in_array($i,$excl_array))$priority[$i] = $v;
         }
         update_option('qzip','off');update_option('qgoogle','off');update_option('qask','off');update_option('qbing','off');
         foreach($priority as $setting => $value){
            update_option( $setting, $value );
            //echo "<br>$setting => $value";            
         }         
      }  
   ?>
   <div class="wrap">
      <h2>XML Sitemap</h2>


      <div class="postbox" style="width: 400px;">
         <h3 class="hndle" style="padding: 5px;">Actions</h3>
         <div class="inside">
            <?php
            
               if(isset($_POST['build'])){
				  check_admin_referer( 'gsg_build_sitemap');
                  set_time_limit(0);
                  require_once(dirname(__FILE__).'/csitemap.class.php');
                  $sitemap = new csitemap();
                  echo $sitemap->build();
                  flush();
               }else{
                  $filename = get_option('qfilename');
                  if(file_exists(ABSPATH.'/'.$filename.'.xml')){
                     $lastbuild = filemtime(ABSPATH.'/'.$filename.'.xml');
                     $link = '<a href="'.get_option('siteurl').'/'.$filename.'.xml" target="_blank"> Click here to View your sitemap</a>';

                     echo '<p><strong>Your sitemap has built: </strong>'.date_i18n('Y.m.d h:i:s',$lastbuild).$link.'</p>';
                  }
               }
            ?>
            <form action="" method="post">
            <?php wp_nonce_field( 'gsg_build_sitemap'); ?>
               <p class="submit">
                  <input type="submit" class="button-primary" value="<?php _e('Build Sitemap') ?>" name="build"/>
               </p>
            </form>
         </div>
      </div>

      <form method="post" action="">
         <?php settings_fields( 'csitemap-settings-group' ); ?>
         <?php wp_nonce_field( 'gsg_save_settings'); ?>

         <div class="postbox" style="width: 400px;">
            <h3 class="hndle" style="padding: 5px;">Settings</h3>
            <div class="inside">
               <ul>
                  <li><label>Gzip sitemap? <input type="checkbox" name="qzip"
                           <?php if(get_option('qzip')=='on')echo ' checked="checked" ' ?>
                           /></label></li>
                  <li><label>Ping Google? <input type="checkbox" name="qgoogle"
                           <?php if(get_option('qgoogle')=='on')echo ' checked="checked" ' ?>
                           /></label></li>
                  <li><label>Ping Ask.com? <input type="checkbox" name="qask"
                           <?php if(get_option('qask')=='on')echo ' checked="checked" ' ?>
                           /></label></li>
                  <li><label>Ping Bing? <input type="checkbox" name="qbing"
                           <?php if(get_option('qbing')=='on')echo ' checked="checked" ' ?>
                           /></label></li>

                  <li><label>Filename <input type="text" name="qfilename" value="<?php echo get_option('qfilename'); ?>" /></label></li>
               </ul>
            </div>
         </div>

         <div class="postbox" style="width: 400px;">
            <h3 class="hndle" style="padding: 5px;">Priority</h3>
            <div class="inside">
               <ul>
                  <?php
                     $a = (float)0.0;

                     $val = get_option('qHomepage');
                     echo "<li><label><select name=\"qHomepage\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Homepage</label></li>";

                     $val = get_option('qPosts');
                     echo "<li><label><select name=\"qPosts\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Posts</label></li>";

                     $val = get_option('qPages');
                     echo "<li><label><select name=\"qPages\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Pages</label></li>";

                     $val = get_option('qCategories');
                     echo "<li><label><select name=\"qCategories\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Categories</label></li>";

                     $val = get_option('qArchives');
                     echo "<li><label><select name=\"qArchives\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Archives</label></li>";

                     $val = get_option('qTags');
                     echo "<li><label><select name=\"qTags\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Tags</label></li>";

                     $val = get_option('qAuthor');
                     echo "<li><label><select name=\"qAuthor\">";
                     for($a=0.0; $a<=1.0; $a+=0.1) {$ov = number_format($a,1,".","");echo '<option value="'.$ov.'"';if($ov == $val)echo ' selected="selected" '; echo '>'.$ov.'</option>';}
                     echo "</select>Author</label></li>";                  
                  ?>
               </ul>
            </div>
         </div>

         <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" name="save"/>
         </p>

      </form>
   </div>
   <?php } ?>