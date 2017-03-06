<?php	add_action('wp_ajax_glv_suscription_save', 'glv_suscription_save');
   		add_action('wp_ajax_nopriv_glv_suscription_save', 'glv_suscription_save');  

   	function glv_suscription_save(){
      	global $wpdb;
      	$email = get_option('glv_email_suscriptor_value');
      	$subject = 'Se han suscrito a los Boletines';
      	$table_name = $wpdb->prefix . 'crm_galvan';
      	$headers = array('Content-Type: text/html; charset=UTF-8');
      	$headers[] = 'From: '.get_option('blogname').' <'.get_option('admin_email').'>';

      	$save = $wpdb->insert( 
        	$table_name, 
	         array( 
	            'crm_tipo' => 's',
	            'crm_date' => date('Y-m-d'), 
	            'crm_name' => wp_filter_nohtml_kses($_POST['Nombre']), 
	            'crm_email' => wp_filter_nohtml_kses($_POST['Correo']),
	            'crm_fuente' => wp_filter_nohtml_kses($_POST['Fuente'])
	         )
      	);
      	$data='';
      	foreach($_POST as $item =>$val){
            $data.='
                  <tr>
                     <td width="150" style="padding-left: 20px;font-family:arial;">'.$item.':</td>
                     <td style="padding-left: 10px;font-family:arial;">'.sanitize_text_field($val).'</td>
                  </tr>';
      	}
      	$html='
      	<table width="100%" bgcolor="e5e5e5"  style="padding-top: 10px;padding-bottom: 10px;">
         <tr>
            <td align="center">
            <table width="570" bgcolor="#3f3f3f" style="border-radius: 20px 0px 0px 0px">
                  <tr>
                     <td align="center"> 
                        <p style="color: #fff;font-family: arial;"><b>'.get_option('blogname').'<b></p>
                     </td>
                  </tr>
               </table>
               <table width="570" bgcolor="ffffff" >
                  <tr>
                     <td>
                        <img src="http://www.galvan.com/wp-content/uploads/2016/05/logo_gag_temp021.png">
                     </td>
                     <td style="padding-top: 80px;"><h3 style="font-family: arial;font-weight: 400;">Se ha realizado un nuevo registro<h3></td>
                  <tr>
                  <tr>
                     <td colspan="2" style="padding-left: 10px;padding-right: 10px;"><hr></td>
                  </tr>
               </table>
               <table width="570" bgcolor="ffffff">
                  '.$data.'
               </table>
               <table width="570" bgcolor="#3f3f3f">
                  <tr>
                     <td align="center"> 
                        <a href="http://galvan.com" style="text-decoration: none; color:#fff; font-family: arial;">www.galvan.com</a>
                     </td>
                  </tr>
               </table>
            </td>
         <tr>
      	</table>';
      	if($save){
         	wp_mail($email, $subject, $html, $headers);
         	$status = 'Se ha registrado con exito';
      	}else{
         $status = 'No se ha podido registrar, favor de verificar';
      	}   
      	print $status;  
   	}

   	add_action('wp_ajax_glv_form_save', 'glv_form_save');
   	add_action('wp_ajax_nopriv_glv_form_save', 'glv_form_save'); 
   	
   	function glv_form_save(){
   		global $wpdb; $tosend=''; $contact = 0; $logistic = 0;
		   $email = get_option('glv_email_suscriptor_value');
		   $subject = "";
      	$table_name = $wpdb->prefix . 'glv_forms';
      	$headers = array('Content-Type: text/html; charset=UTF-8');
      	$headers[] = 'From: '.get_option('blogname').' <'.get_option('admin_email').'>';

      	$data = array();
      	
      	foreach($_POST as $item =>$val){
      		if($item != 'type' && $item != 'Servicio' && $item != "origin"){
	      		$arr = array($item => sanitize_text_field($val));
	      		$data+= $arr;
	      	
      		}
      	}
         if($_POST['origin'] == "landing"){
            $subject = "Hay un nuevo registro al evento";
         }else{
            $subject = "Nueva solicitud de información";
         }

         $Servicio=$_POST["Servicio"];$i=1;
         if ($Servicio==true) {
            foreach($Servicio as $srv){
               if($i==1){
                  $serv = $srv;
               }else{
                  $serv.=', '.$srv;
               }
               
               if ($srv == 'Áereo' || $srv == 'Marítimo' || $srv == 'Terrestre') {
                  if($logistic == 0){
                     if(!$tosend){
                        $tosend.= get_option('glv_email_logistic_value');
                     }else{
                        $tosend.= ', '.get_option('glv_email_logistic_value');
                     }                  
                  }
                  $logistic++;
               }

               if($srv == 'Operaciones Especiales'){
                  if(!$tosend){
                     $tosend.= get_option('glv_email_especiales_value');;
                  }else{
                     $tosend.= ', '.get_option('glv_email_especiales_value');;
                  }
               }

               if($srv == 'Asesoría' || $srv == 'Auditoría' || $srv == 'Bolsa de Trabajo'){
                  if($contact == 0){
                     if(!$tosend){
                        $tosend.= get_option('glv_email_suscriptor_value');
                     }else{
                        $tosend.= ', fcamacho.slp@grupogalvan.com.mx';
                     }
                  }
                  $contact++;
               }
               $i++;
            }
            $data+=array('Servicios' => $serv);# code...
         }
         

      	$save = $wpdb->insert($table_name, array(
      		'for_name'=> $_POST['type'],
      		'for_value'=> json_encode($data),
      		'for_date'=> date('Y-m-d')
      		)
      	);
      	$mail='';
      	foreach($_POST as $item =>$val){
            if($item!='Servicio'){
               $mail.='
                  <tr>
                     <td width="150" style="padding-left: 20px;font-family:arial;">'.$item.':</td>
                     <td style="padding-left: 10px;font-family:arial;">'.$val.'</td>
                  </tr>';
      	   }else{
               $mail.='
                  <tr>
                     <td width="150" style="padding-left: 20px;font-family:arial;">Servicios:</td>
                     <td style="padding-left: 10px;font-family:arial;">'.$serv.'</td>
                  </tr>';
            }
         }
      	$html='
      	<table width="100%" bgcolor="e5e5e5"  style="padding-top: 10px;padding-bottom: 10px;">
         <tr>
            <td align="center">
            <table width="570" bgcolor="#3f3f3f" style="border-radius: 20px 0px 0px 0px">
                  <tr>
                     <td align="center"> 
                        <p style="color: #fff;font-family: arial;"><b>'.get_option('blogname').'<b></p>
                     </td>
                  </tr>
               </table>
               <table width="570" bgcolor="ffffff" >
                  <tr>
                     <td>
                        <img src="http://www.galvan.com/wp-content/uploads/2016/05/logo_gag_temp021.png">
                     </td>
                     <td style="padding-top: 80px;"><h3 style="font-family: arial;font-weight: 400;">Se ha realizado un nuevo registro<h3></td>
                  <tr>
                  <tr>
                     <td colspan="2" style="padding-left: 10px;padding-right: 10px;"><hr></td>
                  </tr>
               </table>
               <table width="570" bgcolor="ffffff">
                  '.$mail.'
               </table>
               <table width="570" bgcolor="#3f3f3f">
                  <tr>
                     <td align="center"> 
                        <a href="http://galvan.com" style="text-decoration: none; color:#fff; font-family: arial;">www.galvan.com</a>
                     </td>
                  </tr>
               </table>
            </td>
         <tr>
      	</table>';
      	if ($save) {
      		if(wp_mail($tosend, $subject, $html, $headers)){
               echo "Hemos recibido su informacion, ¡Gracias!";
            }else{
               echo "No se ha enviado el correo";
            }
      		//print $tosend;
      		
      	}else{
      		echo 'no se han podido registrar los datos';
      	}
   	}
?>