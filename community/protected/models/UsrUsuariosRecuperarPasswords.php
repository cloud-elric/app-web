<?php

/**
 * This is the model class for table "2gom_usr_usuarios_recuperar_passwords".
 *
 * The followings are the available columns in table '2gom_usr_usuarios_recuperar_passwords':
 * @property string $id_recuperar_password
 * @property string $id_usuario
 * @property string $txt_clave_recovery
 * @property string $txt_ip
 * @property string $fch_creacion
 * @property string $fch_expiracion
 * @property string $b_usado
 */
class UsrUsuariosRecuperarPasswords extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_usr_usuarios_recuperar_passwords';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, txt_clave_recovery, txt_ip, fch_creacion, b_usado', 'required'),
			array('id_usuario', 'length', 'max'=>11),
			array('txt_clave_recovery', 'length', 'max'=>100),
			array('txt_ip', 'length', 'max'=>50),
			array('b_usado', 'length', 'max'=>10),
			array('fch_expiracion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_recuperar_password, id_usuario, txt_clave_recovery, txt_ip, fch_creacion, fch_expiracion, b_usado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'idUsuario' => array(self::BELONGS_TO, 'UsrUsuarios', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_recuperar_password' => 'Id Recuperar Password',
			'id_usuario' => 'Id Usuario',
			'txt_clave_recovery' => 'Txt Clave Recovery',
			'txt_ip' => 'Txt Ip',
			'fch_creacion' => 'Fch Creacion',
			'fch_expiracion' => 'Fch Expiracion',
			'b_usado' => 'B Usado',
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
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_recuperar_password',$this->id_recuperar_password,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('txt_clave_recovery',$this->txt_clave_recovery,true);
		$criteria->compare('txt_ip',$this->txt_ip,true);
		$criteria->compare('fch_creacion',$this->fch_creacion,true);
		$criteria->compare('fch_expiracion',$this->fch_expiracion,true);
		$criteria->compare('b_usado',$this->b_usado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuariosRecuperarPasswords the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	/**
	 * Crea y guarda el hash del usuario
	 */
	public function saveRecoveryPass($idUsuario) {
		$this->addData ( $idUsuario );
		if ($this->save ()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Agregamos el data
	 *
	 * @param unknown $idUsuario
	 */
	public function addData($idUsuario) {
		$this->id_usuario = $idUsuario;
		$this->fch_creacion = Utils::getFechaActual ();
		$this->txt_ip = Yii::app()->request->getUserHostAddress();
		$this->fch_expiracion = Utils::getFechaVencimiento ( $this->fch_creacion );
		$this->txt_clave_recovery = $this->createHash ();
		$this->b_usado = 0;
	}
	
	/**
	 * Crea el md5
	 */
	public function createHash() {
		$md5Hash = "rpu_".md5(uniqid("rpu_")).uniqid();;
		return $md5Hash;
	}
	
	/**
	 * Busca el md5 en la base de datos
	 */
	public function searchMd5($hide) {
		$date = Utils::getFechaActual ();
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_clave_recovery =:hide AND b_usado=0 AND fch_expiracion>=:expiracion";
		$criteria->params = array (
				":hide" => $hide,
				":expiracion" => $date
		);
	
		$recovery = UsrUsuariosRecuperarPasswords::model ()->find ( $criteria );
	
		return $recovery;
	}
}
