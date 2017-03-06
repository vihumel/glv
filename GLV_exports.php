<?php function export_data($form){
	global $wpdb; 
	$table_name = $wpdb->prefix . "glv_forms";
	$prospectos = $wpdb->get_results( "SELECT for_id, for_value, for_date FROM $table_name WHERE for_name='$form'");
	if(file_exists(SPEE_PLUGIN_DIR.'/admin/require/PHPExcel.php')){ 
		require_once (SPEE_PLUGIN_DIR . "/admin/require/PHPExcel.php");
	 	$objPHPExcel = new PHPExcel();

	 	$dt=array();$i=1;
	 	foreach ($prospectos as $pro) {
	 		$data = json_decode($pro->for_value);
	 		$body=array(); $a=65; 
	 		foreach ($data as $name => $v) {
	 		 	array_push($body,$v);
	 		 
	 		 	if($i==1){
	 		 		$objPHPExcel->getActiveSheet()->setCellValue(chr($a).($i), $name);
	 		 		//print chr($a).'-'.$i.'-'.$name.'<br>';
	 		 	}else{
	 		 		//print chr($a).'-'.$i.'-'.$v.'<br>';
	 		 		$objPHPExcel->getActiveSheet()->setCellValue(chr($a).($i), $v);
	 		  }$a++;
	 		 	
	 		}$i++;
	 		array_push($body, $pro->for_date);
	 		array_push($dt,$body);
 		}
 		$objPHPExcel->getActiveSheet()->setTitle($form);
		$objPHPExcel->setActiveSheetIndex(0);
		header("Content-type: text/csv");
		header("Cache-Control: no-store, no-cache");
		header('Content-Disposition: attachment;filename="'.$form.'_'.date('d-m-y_h:i:s').'.csv"');			
		$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
		$objWriter->setDelimiter(',');
		$objWriter->setEnclosure('"');
		$objWriter->setLineEnding("\r\n");
		//$objWriter->setUseBOM(true);
		$objWriter->setSheetIndex(0);
		$objWriter->save('php://output');
	} 
} ?>