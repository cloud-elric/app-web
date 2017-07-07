<?php
class LaddaWidget extends CWidget {
	public $id = 'submit-button';
	public $options = array ();
	public $cssFile;
	public $scriptFile;
	public function init() {
		return parent::init ();
	}
	public function run() {
		$assets = Yii::app ()->getAssetManager ()->publish ( dirname ( __FILE__ ) . '/assets' );
		
		$cs = Yii::app ()->getClientScript ();
		
		if ($this->cssFile !== false) {
			$cs->registerCssFile ( $this->cssFile ? $this->cssFile : $assets . '/ladda.css');
		}
		
		if ($this->scriptFile !== false) {
			$cs->registerScriptFile ( $this->scriptFile ? $this->scriptFile : $assets . '/spin.min.js', CClientScript::POS_END );
			$cs->registerScriptFile ( $this->scriptFile ? $this->scriptFile : $assets . '/ladda.min.js', CClientScript::POS_END );
		}
		
		$this->registerCorescript ();
	}
	private function registerCorescript() {
		$id = $this->id;
		
// 		if(isset($options['ajax']) && $options['ajax']){
			
// 		}
		
		$options = CJavaScript::encode ( $this->options );
		$script = '$("#submit-button").on("click",function(e){
	 	e.preventDefault();
	 	var l = Ladda.create(this);
	 	l.start();
	 	
	 	return false;
	});';
		$cs = Yii::app ()->getClientScript ();
		$cs->registerScript ( "nic_$id", $script );
	}
}