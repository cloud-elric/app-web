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
 *
 * The followings are the available model relations:
 * @property 2gomConContests[] $2gomConContests
 * @property 2gomConTerminosCondiciones[] $2gomConTerminosCondiciones
 * @property 2gomPayOrdenesCompras[] $2gomPayOrdenesComprases
 * @property 2gomPayPaymentsRecibed[] $2gomPayPaymentsRecibeds
 * @property 2gomPayRelUsersContestsPayments[] $2gomPayRelUsersContestsPayments
 * @property 2gomUsrUsuariosRecuperarPasswords[] $2gomUsrUsuariosRecuperarPasswords
 * @property 2gomUsrUsuariosTelefonos[] $2gomUsrUsuariosTelefonoses
 * @property 2gomUsrUsuariosWebsites[] $2gomUsrUsuariosWebsites
 * @property 2gomWrkPics[] $2gomWrkPics
 */
class UsrUsuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_usr_usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario_facebook', 'length', 'max'=>11),
			array('txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno', 'length', 'max'=>50),
			array('txt_password', 'length', 'max'=>20),
			array('txt_image_url', 'length', 'max'=>300),
			array('b_login_social_network, b_participa', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_usuario_facebook, txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_password, txt_image_url, b_login_social_network, b_participa', 'safe', 'on'=>'search'),
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
			'2gomConContests' => array(self::MANY_MANY, '2gomConContests', '2gom_con_rel_users_contest(id_usuario, id_contest)'),
			'2gomConTerminosCondiciones' => array(self::MANY_MANY, '2gomConTerminosCondiciones', '2gom_con_rel_users_terminos(id_usuario, id_termino)'),
			'2gomPayOrdenesComprases' => array(self::HAS_MANY, '2gomPayOrdenesCompras', 'id_usuario'),
			'2gomPayPaymentsRecibeds' => array(self::HAS_MANY, '2gomPayPaymentsRecibed', 'id_usuario'),
			'2gomPayRelUsersContestsPayments' => array(self::HAS_MANY, '2gomPayRelUsersContestsPayments', 'ID'),
			'2gomUsrUsuariosRecuperarPasswords' => array(self::HAS_MANY, '2gomUsrUsuariosRecuperarPasswords', 'id_usuario'),
			'2gomUsrUsuariosTelefonoses' => array(self::HAS_MANY, '2gomUsrUsuariosTelefonos', 'id_usaurio'),
			'2gomUsrUsuariosWebsites' => array(self::HAS_MANY, '2gomUsrUsuariosWebsites', 'id_usuario'),
			'WrkPics' => array(self::HAS_MANY, 'WrkPics', 'ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'id_usuario_facebook' => 'Id Usuario Facebook',
			'txt_correo' => 'Txt Correo',
			'txt_usuario_number' => 'Txt Usuario Number',
			'txt_nombre' => 'Txt Nombre',
			'txt_apellido_paterno' => 'Txt Apellido Paterno',
			'txt_apellido_materno' => 'Txt Apellido Materno',
			'txt_password' => 'Txt Password',
			'txt_image_url' => 'Txt Image Url',
			'b_login_social_network' => 'B Login Social Network',
			'b_participa' => 'B Participa',
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

		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_usuario_facebook',$this->id_usuario_facebook,true);
		$criteria->compare('txt_correo',$this->txt_correo,true);
		$criteria->compare('txt_usuario_number',$this->txt_usuario_number,true);
		$criteria->compare('txt_nombre',$this->txt_nombre,true);
		$criteria->compare('txt_apellido_paterno',$this->txt_apellido_paterno,true);
		$criteria->compare('txt_apellido_materno',$this->txt_apellido_materno,true);
		$criteria->compare('txt_password',$this->txt_password,true);
		$criteria->compare('txt_image_url',$this->txt_image_url,true);
		$criteria->compare('b_login_social_network',$this->b_login_social_network,true);
		$criteria->compare('b_participa',$this->b_participa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
