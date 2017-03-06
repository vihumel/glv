<?php function get_data($form){ 
		global $wpdb; 
		$table_name = $wpdb->prefix . "glv_forms";
		$prospectos = $wpdb->get_results( "SELECT for_id, for_value, for_date FROM $table_name WHERE for_name='$form'");
 	$i=0; $val=''; $dt = array();
 	foreach ($prospectos as $pro) {
 			$data = json_decode($pro->for_value);
 			$body.='<tr class="data-'.$pro->for_id.'">';
 			if ($i==0) {
 				$head.='<td>Fecha</td>';
 			}
 			$body.="<td>".$pro->for_date."</td>";
 			foreach ($data as $name => $v) {
 					if($i==0){ $head.= '<td>'.$name.'</td>'; }
 		 		$body.= '<td>'.$v.'</td>';
 			}
 			
 			$body.='</tr>';
 			$i++;
 	}
 
 	print '<table class="wp-list-table widefat fixed">
 		<thead><tr>'.$head.'</tr></thead>
 		<tbody>'.$body.'</tbody>
 	</table>';

		if($i==0){
			print '<table><tr><td colspan="7">No hay registros.<td></tr></table>';
		}
	 
 } 

 function get_prospectos(){ 
		global $wpdb; 
		$table_name = $wpdb->prefix . "glv_forms";
		$prospectos = $wpdb->get_results( "SELECT for_value FROM $table_name" );
 	$i=0; $val=''; $dt = array();

 	foreach ($prospectos as $pro) {
 			$data = json_decode($pro->for_value);
 			$body.='<tr>';
 			foreach ($data as $name => $v) {
 					if($i==0){ $head.= '<td>'.$name.'</td>'; }
 		 		$body.= '<td>'.$v.'</td>';
 			}
 			$body.='</tr>';
 			$i++;
 	}
 	//print_r($dt);
 	print '<table class="wp-list-table widefat fixed">
 		<thead><tr>'.$head.'</tr></thead>
 		<tbody>'.$body.'</tbody>
 	</table>';

		if($i==0){
			echo '<table><tr><td colspan="7">No hay registros.<td></tr></table>';
		}

 } 
	
	function glv_config(){ ?>
		<form method="post" action="options.php">
			<h2>Suscriptores</h2>
			<?php 
				settings_fields('glv-email-setting-group'); 
				do_settings_sections('glv-email-setting-group');
			?>
			<label><b>Correo:</b></label>
			<input type="text" name="glv_email_suscriptor_value" id="glv_email_suscriptor_value" style="width: 300px;" value="<?php echo wp_filter_nohtml_kses(get_option('glv_email_suscriptor_value')); ?>">
			<br><small>(Cuenta de correo a donde se enviara la información de los suscriptores).</small>
			<?php submit_button(); ?>
		</form>

		<form method="post" action="options.php">
			<h2>Logistíca</h2>
			<?php 
				settings_fields('glv-email-logistic-setting-group'); 
				do_settings_sections('glv-email-logistic-setting-group');
			?>
			<label><b>Correo:</b></label>
			<input type="text" name="glv_email_logistic_value" id="glv_email_logistic_value" style="width: 300px;" value="<?php echo wp_filter_nohtml_kses(get_option('glv_email_logistic_value')); ?>">
			<br><small>(Cuenta de correo a donde se enviara la información de los interesados en los tipos de transporte).</small>
			<?php submit_button(); ?>
		</form>

		<form method="post" action="options.php">
			<h2>Operaciones Especiales</h2>
			<?php 
				settings_fields('glv-email-especiales-setting-group'); 
				do_settings_sections('glv-email-especiales-setting-group');
			?>
			<label><b>Correo:</b></label>
			<input type="text" name="glv_email_especiales_value" id="glv_email_especiales_value" style="width: 300px;" value="<?php echo wp_filter_nohtml_kses(get_option('glv_email_especiales_value')); ?>">
			<br><small>(Cuenta de correo a donde se enviara la información de los interesados en operaciones especiales).</small>
			<?php submit_button(); ?>
		</form>

		<form method="post" action="options.php">
			<h2>ID del Pixel</h2>
			<?php 
				settings_fields('glv-pixel-setting-group'); 
				do_settings_sections('glv-pixel-setting-group');
			?>
			<label><b>ID:</b></label>
			<input type="text" name="glv_pixel_value" id="glv_pixel_value" style="width: 300px;" value="<?php echo wp_filter_nohtml_kses(get_option('glv_pixel_value')); ?>">
			<br><small>(ID del pixel de Facebook para el <i>Tracking</i> de eventos).</small>
			<?php submit_button(); ?>
		</form>

<?php } 
	//Correo a donde se enviaran los sucriptores
	add_action('admin_init','glv_email_suscriptor_setting');
	function glv_email_suscriptor_setting(){
		register_setting(
			'glv-email-setting-group',
			'glv_email_suscriptor_value'
		);
	}
	//Correo a donde se enviaran los interesados en trafico areó, terrestre y maritimo
	add_action('admin_init','glv_email_logistic_setting');
	function glv_email_logistic_setting(){
		register_setting(
			'glv-email-logistic-setting-group',
			'glv_email_logistic_value'
		);
	}
	//Correo a donde se enviaran las operaciones especiales
	add_action('admin_init','glv_email_especiales_setting');
	function glv_email_especiales_setting(){
		register_setting(
			'glv-email-especiales-setting-group',
			'glv_email_especiales_value'
		);
	}

	//Se almacena el ID del Pixel
	add_action('admin_init','glv_pixel_setting');
		function glv_pixel_setting(){
		register_setting(
			'glv-pixel-setting-group',
			'glv_pixel_value'
		);
	}

 function get_campanias(){ 
 } 
 
 function get_shortcode(){ 
 //Lista de Formularios disponibles y shortcode correspondiente para utilizar
 $sh ='{ 
 	"sh":[{ 
        "title":"Suscripción", 
        "shortcode":"form_suscription" 
    },{ 
        "title":"Contacto", 
        "shortcode":"form_contact" 
    },{ 
        "title":"Contacto MKT", 
        "shortcode":"form_mkt" 
    }
  ]}';
 	
 	$dt='<table class="wp-list-table widefat fixed" style="margin-top:10px;"><thead><tr><td>Formulario</td><td>Shortcode</td><tr></thead><tbody>';
 	$data = json_decode($sh);
 	 foreach ($data as $sc =>$v) {
 	 	foreach ($v as $key => $value) {
 	 	 $dt.='<tr><td>'.$value->title.'</td><td>['.$value->shortcode.']</td></tr>';
 	 	}
 	}
 	$dt.='</body></table>';
 	print $dt;
 }

 function get_menu($data){plugins_url("GLV-Prospectos/GLV_Export.php");
		$GLV_menu = "<div style='margin-top:10px;float:left; background:#3f3f3f;width:100%;'>
			<a style='background:#d84d3b;color:#fff;float:left;text-align:center;text-decoration:none;padding:5px 10px 5px 10px;' href='".plugins_url("GLV-Prospectos/GLV_Export.php?export=$data")."' target='_blank'>
										<i class='fa fa-download'></i> Exportar
									</a>
		</div>";
		print $GLV_menu;
	} ?>