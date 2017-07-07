<?php

	class CargarScripts{

		/**
		* @var $jqueryWizard
		* @description da estilo al skdfjkljasdfjajslkfjskdjfa
		* NOTA: usar despues de validation.css
		*/
		// Css
		public $c_geek = "/assets/css/cfm-admin.css";
		public $c_geek_admin = "/assets/css/cfmAdmin.css";
		public $c_geek_impresion = "/assets/css/impresion.css";

		public $jqueryWizard = "/assets/vendor/jquery-wizard/jquery-wizard.css";
		public $login = "/assets/examples/css/pages/login.css";
		public $gridstack = "/assets/vendor/gridstack/gridstack.css";
		public $panelPortlets = "/assets/examples/css/uikit/panel-portlets.css";
		public $c_select2 = "/assets/vendor/select2/select2.css";
		public $c_asPieProgress = "/assets/vendor/aspieprogress/asPieProgress.css";
		public $c_pie_progress = "/assets/examples/css/charts/pie-progress.css";
		public $c_magnific_popup = "/assets/vendor/magnific-popup/magnific-popup.css";
		public $c_asRange = "/assets/vendor/asrange/asRange.css";
		public $c_icheck = "/assets/vendor/icheck/icheck.css";
		public $c_advanced = "/assets/examples/css/forms/advanced.css";
		public $c_nstSlider = "/assets/vendor/nstSlider/jquery.nstSlider.css";
		public $c_raty = "/assets/vendor/raty/jquery.raty.css";


		// Js
		public $formvalidation = "/assets/vendor/formvalidation/formValidation.js";
		public $jqueryPlaceholder = "/assets/vendor/jquery-placeholder/jquery.placeholder.js";
		public $lodash = "/assets/vendor/lodash/lodash.js";
		public $jqueryUi = "/assets/vendor/jquery-ui/jquery-ui.min.js";
		public $jsGridstack = "/assets/vendor/gridstack/gridstack.js";
		public $panel = "/assets/js/components/panel.js";
		public $js2gridstack = "/assets/js/components/gridstack.js";
		public $j_select2 = "/assets/vendor/select2/select2.min.js";
		public $j_jquery_placeholder = "/assets/vendor/jquery-placeholder/jquery.placeholder.js";
		public $j_select2_components = "/assets/js/components/select2.js";
		public $j_jquery_placeholder_components = "/assets/js/components/jquery-placeholder.js";
		public $j_jquery_asPieProgress = "/assets/vendor/aspieprogress/jquery-asPieProgress.js";
		public $j_aspieprogress = "/assets/js/components/aspieprogress.js";
		public $j_pie_progress = "/assets/examples/js/charts/pie-progress.js";
		public $j_magnific_popup = "/assets/vendor/magnific-popup/jquery.magnific-popup.min.js";
		public $j_filterable = "/assets/js/components/filterable.js";
		public $j_gallery = "/assets/examples/js/pages/gallery.js";
		public $j_jquery_asRange = "/assets/vendor/asrange/jquery-asRange.min.js";
		public $j_nstSlider = "/assets/vendor/nstSlider/jquery.nstSlider.js";
		public $j_icheck_min = "/assets/vendor/icheck/icheck.min.js";
		public $j_icheck = "/assets/js/components/icheck.js";
		public $j_jquery_knob = "/assets/vendor/jquery-knob/jquery.knob.js";
		public $j_components_jquery_knob = "/assets/js/components/jquery-knob.js";
		public $j_dgom_panels_juez = "/assets/js/panelsJuez.js";
		public $j_dgom_panels_admin = "/assets/js/panelsAdmin.js";
		public $j_dgom_photo_juez = "/assets/js/photoJuez.js";
		public $j_dgom_photo_admin = "/assets/js/photoAdmin.js";
		public $j_raty = "/assets/vendor/raty/jquery.raty.js";
		public $j_component_raty= "/assets/js/components/raty.js";

		/**
		* Esta funcion......
		* @param Array $scripts
		* @param 
		* @param 
		*/
		public function getScripts(Array $scripts=array(), $type="js"){

				// Registramos hojas de estilos y javascripts
				$baseUrl = Yii::app ()->theme->baseUrl;
				$cs = Yii::app()->getClientScript();

			foreach ($scripts as $value) {
				
				if($type=="css"){
					$cs->registerCssFile($baseUrl.$this->$value);	
				}
				
				if($type=="js"){
					$cs->registerScriptFile($baseUrl.$this->$value, CClientScript::POS_END);
				}
				  
			}
		}

	}

?>