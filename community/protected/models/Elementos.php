<?php
class Elementos {
	public static function buttonLadda($label = 'Submit', $htmlOptions = array(), $id = 'button-ladda', $typeAnimation = 'zoom-in') {
		$laddaLabelClass = 'ladda-label';
		$laddaSpinner = 'ladda-spinner';
		$classButton = 'ladda-button';
		
		return CHtml::link ( '<span class="'.$laddaLabelClass.'">' . $label . '</spans><span class="'.$laddaSpinner.'"></span>',array('#'), array (
				'class' => 'btn btn-info ' . $classButton,
				'data-style' => $typeAnimation,
				'id'=>$id
		) );
	}
}