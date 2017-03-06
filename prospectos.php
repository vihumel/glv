<?php /*
      Plugin Name: Galván 
      Plugin URI: galvan.com
      Description: Captura de prospectos y suscriptores, registro de eventos/conversiones
      Version: v2.2.3
      Author: Victor Mestizo
      Author URI: vmestizo@grupogalvan.com.mx
   */
   define("SPEE_PLUGIN_URL", WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)));
   define("SPEE_PLUGIN_DIR", WP_PLUGIN_DIR.'/'.basename(dirname(__FILE__)));
   register_activation_hook( __FILE__, 'glv_create_tables' );
   function glv_create_tables(){
      //obtenemos el objeto $wpdb
       global $wpdb;
    
       //el nombre de la tabla, utilizamos el prefijo de wordpress
       $table_forms = $wpdb->prefix.'glv_forms'; 

       //sql con el statement de la tabla     
       $glv_form = "CREATE TABLE ".$table_forms."(
         for_id int(11) NOT NULL AUTO_INCREMENT,
         for_name varchar(100) DEFAULT NULL,
         for_value text DEFAULT NULL,
         for_date date,
         UNIQUE KEY for_id (for_id)
       )";

      //upgrade contiene la función dbDelta la cuál revisará si existe la tabla o no
       require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
       //creamos la tabla
       dbDelta($glv_form);
   }

   //Archivos donde estan la funciones del plugin
   require_once('admin/shortcode.php');
   require_once('admin/save_data.php');
   require_once('admin/GLV_admin.php');

   //Agregamos los archvios de estilos del plugin en el head de wordpress
   function add_style_script(){
      wp_enqueue_style('glv-style', plugins_url("GLV-Prospectos/admin/include/css/").'glv-style.css');
      wp_enqueue_style('select2-style', plugins_url("GLV-Prospectos/admin/include/css/").'select2.css');
      wp_enqueue_script('select-script', plugins_url("GLV-Prospectos/admin/include/js/").'select2.js');
      wp_enqueue_script('glv-script', plugins_url("GLV-Prospectos/admin/include/js/").'function.js');
      
   }

   add_action('wp_head', 'add_style_script');

   //Agregamos el pixel de facebook para hacer un seguimiento de eventos en el sitio
   function add_pixel(){
      $id = get_option('glv_pixel_value');
      $pixel = "
         <!-- Facebook Pixel Code -->
            <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '".$id."'); // Insert your pixel ID here.
            fbq('track', 'PageView');
         </script>
         <noscript><img height='1' width='1' style='display:none'
         src='https://www.facebook.com/tr?id=".$id."&ev=PageView&noscript=1'
         /></noscript>
         <!-- DO NOT MODIFY -->
         <!-- End Facebook Pixel Code -->
      ";
      print $pixel;
   }
   add_action('wp_head', 'add_pixel');

   function add_property_ogg(){
      global $post; $thumbID = get_post_thumbnail_id($post->ID);?>
      <meta property="og:url" content="<?php print home_url( add_query_arg( array()));?>" />
      <meta property="og:type" content="article" />
      <?php if(home_url( add_query_arg( array())) == get_site_url().'/'){ $img ='portada'; ?>
      <meta property="og:description" content="<?php bloginfo('description');?>" />
      <?php }else{ $img = wp_get_attachment_url($thumbID); } ?>    
      <meta property="og:image" content="<?php print $img; ?>"/>
   <?php print $meta;
   }
   add_action('wp_head', 'add_property_ogg');




   /*/Desactivar plugin, borrar tabla y todos los datos, no recomendable para evitar perdida de datos no se activa esta función
   register_deactivation_hook(__FILE__, 'udp_remove_tables' );
   function udp_remove_tables(){
      //obtenemos el objeto $wpdb
      ->//global $wpdb;

       //el nombre de la tabla, utilizamos el prefijo de wordpress
      -> //$table_name = $wpdb->prefix.'glv_forms';

       //sql con el statement de la tabla
      -> //$sql = "DROP table IF EXISTS ".$table_name;

      ->//$wpdb->query($sql);
   }*/
?>