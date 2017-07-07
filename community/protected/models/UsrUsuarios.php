<?php

/**
 * This is the model class for table "2gom_usr_usuarios".
 *
 * The followings are the available columns in table '2gom_usr_usuarios':
 * @property string $id_usuario
 * @property string $id_usuario_facebook
 * @property string $txt_correo
 * @property string $txt_usuario_number
 * @property string $txt_nombre
 * @property string $txt_apellido_paterno
 * @property string $txt_apellido_materno
 * @property string $txt_password
 * @property string $txt_image_url
 * @property string $b_login_social_network
 * @property string $b_participa
 */
class UsrUsuarios extends CActiveRecord {
	/**
	 * atributo para repetir contraseña
	 *
	 * @var unknown
	 */
	public $repetirPassword;
	public $b_participa;

	/**
	 * Usar esta propiedad mientras termina las siguientes tablas
	 * @var unknown
	 */
	//public $valorAdicional;
	
	/**
	 * Nombre de la imagen
	 *
	 * @var unknown
	 */
	public $nombreImagen;
	
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '2gom_usr_usuarios';
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
						'txt_correo',
						'validaUsuarioExistente',
						'on' => 'register' 
				),
				array (
						'nombreImagen',
						'file',
						'types' => 'jpg, png, gif',
						'allowEmpty'=>true,
						'safe' => false,
						'on'=>'register',
						'maxSize' => 360 * 360 * 1,
						'tooLarge' => 'La imagen es muy grande'
				),
				
				array (
						'txt_password,txt_correo, repetirPassword, txt_nombre, txt_apellido_paterno',
						'required', 'on'=>'register'
				),
// 				array(
// 						'txt_correo',
// 						'email',
// 						'on' => 'register'
// 				),
				array(
						'txt_correo',
						'email',
						'on' => 'correo'
				),
				
				array (
						'txt_password, repetirPassword',
						'required', 'on'=>'recovery' 
				),
				array (
						'txt_password, repetirPassword',
						'validarRepetirPass', 'on'=>'recovery'
				),
				array (
						'txt_correo, txt_nombre, txt_apellido_paterno, txt_apellido_materno',
						'length',
						'max' => 50 
				),
				array (
						'txt_password',
						'length',
						'max' => 20 
				),
				
				array (
						'repetirPassword',
						'length',
						'max' => 20
				),
				
				array (
						'txt_password,txt_correo, repetirPassword, txt_nombre, txt_apellido_paterno',
						'required', 'on'=>'correo'
				),
				
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id_usuario, txt_correo, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_password, txt_image_url',
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
				'id_usuario' => 'Id Usuario',
				'txt_correo' => 'Correo electrónico',
				'txt_nombre' => 'Nombre',
				'txt_apellido_paterno' => 'Apellido paterno',
				'txt_apellido_materno' => 'Apellido materno',
				'txt_password' => 'Contraseña',
				'txt_image_url' => 'Imagen',
				'repetirPassword' => 'Repetir contraseña' 
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
		
		$criteria->compare ( 'id_usuario', $this->id_usuario, true );
		$criteria->compare ( 'txt_correo', $this->txt_correo, true );
		$criteria->compare ( 'txt_nombre', $this->txt_nombre, true );
		$criteria->compare ( 'txt_apellido_paterno', $this->txt_apellido_paterno, true );
		$criteria->compare ( 'txt_apellido_materno', $this->txt_apellido_materno, true );
		$criteria->compare ( 'txt_password', $this->txt_password, true );
		$criteria->compare ( 'txt_image_url', $this->txt_image_url, true );
		
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
	 * @return UsrUsuarios the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * Validar que la contraseña y el repetir contraseña sean iguales
	 */
	public function validarRepetirPass() {
		if (!$this->validarPassword()) {
			$this->addError ( "txt_password", "La contraseña no coincide" );
			$this->addError ( "repetirPassword", "La contraseña no coincide" );
		}
	}
	
	
	/**
	 * Valida si la contraseña es igual
	 * @return boolean
	 */
	public function validarPassword(){
		
		if($this->txt_password == $this->repetirPassword){
			return true;
		}
		return false;
	}
	
	/**
	 * valida que el usuario no exista en la base de datos
	 */
	public function validaUsuarioExistente() {
		
		
		if ($this->validaUsuarioExistente2()) {

			$this->addError ( "txt_correo", "Correo ya registrado" );
		}
	}
	
	public function validaUsuarioExistente2() {
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_correo=:txtCorreo";
		$criteria->params = array (
				":txtCorreo" => $this->txt_correo
		);
		$usuario = UsrUsuarios::model ()->find ( $criteria );
	
		if (! empty ( $usuario )) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Valida correo electronico
	 */
	public function validarEmail(){
		$this->scenario="correo";
		if($this->validate()){
			return true;	
		}
		
		return false;
	}
	
	/**
	 * Buscar usuario de facebook en la base de datos
	 */
	public function searchUsuarioIdFacebook(){
		$criteria = new CDbCriteria ();
		$criteria->condition = "id_usuario_facebook=:idFacebook OR txt_correo=:email";
		$criteria->params = array (
				":idFacebook" => $this->id_usuario_facebook,
				":email"=>$this->txt_correo
		);
		$usuario = UsrUsuarios::model ()->find ( $criteria );
		return $usuario;
	}
	
	public function validarPasswordLength(){
		
		$longitudPass = strlen($this->txt_password);
		
		if($longitudPass<8){
			return false;
		}
		
		return true;
	}
	
	
	public function validacionDatosRegistrar(){
		
		
	}
	
}

