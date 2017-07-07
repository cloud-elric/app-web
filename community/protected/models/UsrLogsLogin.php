<?php

/**
 * This is the model class for table "2gom_usr_logs_login".
 *
 * The followings are the available columns in table '2gom_usr_logs_login':
 * @property string $id_log
 * @property string $id_usuario
 * @property string $txt_ip
 * @property string $fch_acceso
 * @property string $fch_fin_accesso
 * @property string $b_sesion_cerrada
 */
class UsrLogsLogin extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '2gom_usr_logs_login';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'txt_ip, fch_acceso',
						'required' 
				),
				array (
						'id_usuario, txt_ip',
						'length',
						'max' => 20 
				),
				array (
						'b_sesion_cerrada',
						'length',
						'max' => 10 
				),
				array (
						'fch_fin_accesso',
						'safe' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id_log, id_usuario, txt_ip, fch_acceso, fch_fin_accesso, b_sesion_cerrada',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array ();
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id_log' => 'Id Log',
				'id_usuario' => 'Id Usuario',
				'txt_ip' => 'Txt Ip',
				'fch_acceso' => 'Fch Acceso',
				'fch_fin_accesso' => 'Fch Fin Accesso',
				'b_sesion_cerrada' => 'B Sesion Cerrada' 
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 *         based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id_log', $this->id_log, true );
		$criteria->compare ( 'id_usuario', $this->id_usuario, true );
		$criteria->compare ( 'txt_ip', $this->txt_ip, true );
		$criteria->compare ( 'fch_acceso', $this->fch_acceso, true );
		$criteria->compare ( 'fch_fin_accesso', $this->fch_fin_accesso, true );
		$criteria->compare ( 'b_sesion_cerrada', $this->b_sesion_cerrada, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return UsrLogsLogin the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * Guarda en la base de datos al usuario que inicio sesión
	 *
	 * @param integer $idUsuario 
	 * @return UsrLogsLogin       	
	 */
	public function guardarInicioSesionDB($idUsuario) {
		$this->id_usuario = $idUsuario;
		$this->txt_ip = Yii::app ()->request->getUserHostAddress ();
		$this->fch_acceso = Utils::getFechaActual ();
		$this->save ();
		
		return $this;
	}
	
	/**
	 * Guarda en la base de datos al usuario que finalizo sesión
	 *
	 * @param integer $idUsuario        	
	 */
	public function guardarSalidaSesionDB($idSession) {
		
		$s = $this->buscarSesionById ( $idSession );
		
		if (! empty ( $s )) {
			$s->fch_fin_accesso = Utils::getFechaActual ();
			$s->b_sesion_cerrada = 1;
			$s->save ();
		}
	}
	
	/**
	 * Busca la sesión actual en la base de datos
	 *
	 * @param integer $idSession        	
	 * @return UsrLogsLogin
	 */
	public function buscarSesionById($idSession) {
		$s = self::model ()->findByPk ( $idSession );
		
		return $s;
	}
}
