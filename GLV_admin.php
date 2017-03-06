<?php require_once('GLV_results.php');
			require_once('GLV_exports.php');
	//Se crea la vista de administrador del CRM 
	function crm_admin(){
		add_menu_page(
			'CRM Grupo Galván',
			'CRM Galvan',
			'administrator',
			'crm-glv-settings',
			'crm_glv_page_settings',
				plugins_url('include/img/icon-glv.png', __FILE__)
		);
	}
	add_action('admin_menu','crm_admin');

	function crm_glv_page_settings(){
		print '<link href="'.plugins_url('include/css/font-awesome.css', __FILE__).'" rel="stylesheet">';
		print '<div class="wrap">
		<h2>CRM Galván</h2>';
		if(isset($_GET['tab'])) {$active_tab = $_GET[ 'tab' ]; } ?>
		<h2 class="nav-tab-wrapper">
			<a href="?page=crm-glv-settings&tab=configurar" class="nav-tab <?php echo $active_tab == 'configurar' ? 'nav-tab-active' : ''; ?>">
				Configuración
		    </a>
		    <a href="?page=crm-glv-settings&tab=landing" class="nav-tab <?php echo $active_tab == 'landing' ? 'nav-tab-active' : ''; ?>">
		    	Landing
		    </a>
		    <a href="?page=crm-glv-settings&tab=suscripcion" class="nav-tab <?php echo $active_tab == 'suscripcion' ? 'nav-tab-active' : ''; ?>">
		    	Suscriptores
		    </a>
		    <a href="?page=crm-glv-settings&tab=contacto" class="nav-tab <?php echo $active_tab == 'contacto' ? 'nav-tab-active' : ''; ?>">
		    	Contacto
		    </a>
		    <a href="?page=crm-glv-settings&tab=shortcode" class="nav-tab <?php echo $active_tab == 'shortcode' ? 'nav-tab-active' : ''; ?>">
		    	Shortcode
		    </a>
		    <!--<a href="?page=crm-glv-settings&tab=campaña" class="nav-tab <?php echo $active_tab == 'campaña' ? 'nav-tab-active' : ''; ?>">Campañas
		    </a>-->
		</h2>
<?php $i=0; 
		switch ($active_tab) {
			case 'landing':
				get_menu($active_tab);
				get_data($active_tab);
				break;
	 		case 'suscripcion':
				get_menu($active_tab);
				get_data($active_tab);
				break;
			case 'contacto':
				get_menu($active_tab);
				get_data($active_tab);
			  	break;
			case 'configurar':
				glv_config();
			break;
			case 'export-data':
				//get_data($active_tab);
				$forms= $_GET['export'];
				export_data($forms);
				break;
			case 'campaña':
				get_campanias();
				break;
			case 'shortcode':
				get_shortcode();
				break;
			default:
				glv_config();
					break;
		}			         
?></div>
<?php } ?>