<?php
class Utils {
	
	/**
	 * Cambia el formato del input del d-m-Y a Y-m-d H:i:s
	 *
	 * @param unknown $stringFecha        	
	 */
	public static function changeFormatInputDate($stringFecha) {
		if (! empty ( $stringFecha )) {
			$date = new DateTime ( $stringFecha );
			return $date->format ( 'Y-m-d H:i:s' );
		}
	}
	
	/**
	 * Cambia formato de fecha (Y-m-d H:i:s) a (d-m-Y)
	 *
	 * @param unknown $stringFecha        	
	 */
	public static function changeFormatDate($stringFecha) {
		if (! empty ( $stringFecha )) {
			$date = new DateTime ( $stringFecha );
			return $date->format ( 'd-m-Y' );
		}
		return '';
	}
	
	/**
	 * Obtenemos la fecha actual para almacenarla
	 *
	 * @return string
	 */
	public static function getFechaActual() {
		
		// Inicializamos la fecha y hora actual
		$fecha = date ( 'Y-m-d H:i:s', time () );
		return $fecha;
	}
	public static function getYear() {
		
		// Inicializamos la fecha y hora actual
		$anio = date ( 'Y', time () );
		return $anio;
	}
	public static function getFechaVencimiento($fechaActualTimestamp) {
		$date = date ( 'Y-m-d H:i:s', strtotime ( "+1 day", strtotime ( $fechaActualTimestamp ) ) );
		
		return $date;
	}
	public static function getFechaVencimientoUsuarioPro($fechaActualTimestamp, $stringTime) {
		$date = date ( 'Y-m-d H:i:s', strtotime ( $stringTime, strtotime ( $fechaActualTimestamp ) ) );
		
		return $date;
	}
	
	/**
	 * Valida si viene el hash
	 *
	 * @param unknown $request        	
	 * @return boolean
	 */
	public function validateHash() {
		$invitacionEnviada = Yii::app ()->user->getState ( "invitacionEnviada" );
		if (! isset ( $invitacionEnviada )) {
			
			return true;
		} else {
			
			return false;
		}
	}
	
	/**
	 * Obtenemos años
	 */
	public static function getYears() {
		$anio = self::getYear ();
		$anios = array ();
		for($i = $anio; $i >= ($anio - 5); $i --) {
			
			$anios [$i] = $i;
		}
		return $anios;
	}
	public static function changeFormatInputDate2($stringFecha) {
		$time = explode ( " ", $stringFecha );
		
		$fecha = $time [0];
		$exploded = explode ( "-", $fecha );
		$nuevaFecha = $exploded[0]."-".self::numberMonth($exploded[1])."-".$exploded[2]." ".$time[1];
		
		if (! empty ( $nuevaFecha )) {
			$date = new DateTime ( $nuevaFecha );
			return $date->format ( 'Y-m-d H:i:s' );
		}
	}
	
	/**
	 */
	public static function numberMonth($mes) {
		switch ($mes) {
			case 'Ene' :
				return "01";
				break;
			case 'Feb' :
				return "02";
				break;
			case 'Mar' :
				return "03";
				break;
			case 'Abr' :
				return "04";
				break;
			case 'May' :
				return "05";
				break;
			case 'Jun' :
				return "06";
				break;
			case 'Jul' :
				return "07";
				break;
			case 'Ago' :
				return "08";
				break;
			case 'Sep' :
				return "09";
				break;
			case 'Oct' :
				return "10";
				break;
			case 'Nov' :
				return "11";
				break;
			case 'Dic' :
				return "12";
				break;
		}
	}
}