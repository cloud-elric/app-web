<?php
class CHtmlExtra extends CHtml{
	
	public static function ajaxSubmitButtonExtra($label,$url,$ajaxOptions=array(),$htmlOptions=array())
	{
		$ajaxOptions['type']='POST';
		$htmlOptions['type']='submit';
		return self::ajaxButtonExtra($label,$url,$ajaxOptions,$htmlOptions);
	}
	
	public static function ajaxButtonExtra($label,$url,$ajaxOptions=array(),$htmlOptions=array())
	{
		$ajaxOptions['url']=$url;
		$htmlOptions['ajax']=$ajaxOptions;
		return self::buttonExtra($label,$htmlOptions);
	}
	
	public static function buttonExtra($label='button',$htmlOptions=array())
	{
		if(!isset($htmlOptions['name']))
		{
			if(!array_key_exists('name',$htmlOptions))
				$htmlOptions['name']=self::ID_PREFIX.self::$count++;
		}
		if(!isset($htmlOptions['type']))
			$htmlOptions['type']='button';
		if(!isset($htmlOptions['value']) && $htmlOptions['type']!='image')
			$htmlOptions['value']=$label;
		self::clientChange('click',$htmlOptions);
		return self::tag('button',$htmlOptions, $label);
	}
}