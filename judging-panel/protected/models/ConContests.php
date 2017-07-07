<?php

/**
 * This is the model class for table "2gom_con_contests".
 *
 * The followings are the available columns in table '2gom_con_contests':
 * @property string $id_contest
 * @property string $txt_token
 * @property string $id_cliente
 * @property string $txt_name
 * @property string $txt_contest_dec
 * @property string $txt_bases
 * @property string $txt_fondo_url
 * @property string $txt_ico_url
 * @property integer $b_enabled
 * @property string $fch_fin_inscripcion
 *
 * The followings are the available model relations:
 * @property 2gomConCalificacionesDesempate[] $2gomConCalificacionesDesempates
 * @property 2gomConCategoiries[] $2gomConCategoiries
 * @property 2gomCliEntClientes $idCliente
 * @property 2gomConProducts[] $2gomConProducts
 * @property 2gomPayCatPaymentsTypes[] $2gomPayCatPaymentsTypes
 * @property 2gomUsrUsuarios[] $2gomUsrUsuarioses
 * @property 2gomConTerminosCondiciones[] $2gomConTerminosCondiciones
 * @property 2gomJueEntJueces[] $2gomJueEntJueces
 * @property 2gomPayCupons[] $2gomPayCupons
 * @property 2gomPayOrdenesCompras[] $2gomPayOrdenesComprases
 * @property 2gomPayRelUsersContestsPayments[] $2gomPayRelUsersContestsPayments
 * @property 2gomWrkPics[] $2gomWrkPics
 */
class ConContests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_contests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_name, txt_contest_dec, txt_bases', 'required'),
			array('b_enabled', 'numerical', 'integerOnly'=>true),
			array('txt_token, txt_fondo_url, txt_ico_url', 'length', 'max'=>200),
			array('id_cliente', 'length', 'max'=>11),
			array('txt_name', 'length', 'max'=>50),
			array('fch_fin_inscripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_contest, txt_token, id_cliente, txt_name, txt_contest_dec, txt_bases, txt_fondo_url, txt_ico_url, b_enabled, fch_fin_inscripcion', 'safe', 'on'=>'search'),
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
			'2gomConCalificacionesDesempates' => array(self::HAS_MANY, '2gomConCalificacionesDesempate', 'id_contest'),
			'2gomConCategoiries' => array(self::HAS_MANY, '2gomConCategoiries', 'id_contest'),
			'idCliente' => array(self::BELONGS_TO, '2gomCliEntClientes', 'id_cliente'),
			'2gomConProducts' => array(self::HAS_MANY, '2gomConProducts', 'id_contest'),
			'2gomPayCatPaymentsTypes' => array(self::MANY_MANY, '2gomPayCatPaymentsTypes', '2gom_con_rel_contest_payments(id_contest, id_tipo_pago)'),
			'2gomUsrUsuarioses' => array(self::MANY_MANY, '2gomUsrUsuarios', '2gom_con_rel_users_contest(id_contest, id_usuario)'),
			'2gomConTerminosCondiciones' => array(self::HAS_MANY, '2gomConTerminosCondiciones', 'id_contest'),
			'2gomJueEntJueces' => array(self::MANY_MANY, '2gomJueEntJueces', '2gom_jue_rel_jueces_contests(id_contests, id_juez)'),
			'2gomPayCupons' => array(self::HAS_MANY, '2gomPayCupons', 'id_contest'),
			'2gomPayOrdenesComprases' => array(self::HAS_MANY, '2gomPayOrdenesCompras', 'id_contest'),
			'2gomPayRelUsersContestsPayments' => array(self::HAS_MANY, '2gomPayRelUsersContestsPayments', 'id_contest'),
			'2gomWrkPics' => array(self::HAS_MANY, '2gomWrkPics', 'id_contest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_contest' => 'Id Contest',
			'txt_token' => 'Txt Token',
			'id_cliente' => 'Id Cliente',
			'txt_name' => 'Txt Name',
			'txt_contest_dec' => 'Txt Contest Dec',
			'txt_bases' => 'Txt Bases',
			'txt_fondo_url' => 'Txt Fondo Url',
			'txt_ico_url' => 'Txt Ico Url',
			'b_enabled' => 'B Enabled',
			'fch_fin_inscripcion' => 'Fch Fin Inscripcion',
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

		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('txt_token',$this->txt_token,true);
		$criteria->compare('id_cliente',$this->id_cliente,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('txt_contest_dec',$this->txt_contest_dec,true);
		$criteria->compare('txt_bases',$this->txt_bases,true);
		$criteria->compare('txt_fondo_url',$this->txt_fondo_url,true);
		$criteria->compare('txt_ico_url',$this->txt_ico_url,true);
		$criteria->compare('b_enabled',$this->b_enabled);
		$criteria->compare('fch_fin_inscripcion',$this->fch_fin_inscripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConContests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Busqueda de concurso por el token
	 *
	 * @param unknown $token
	 */
	public static function buscarPorToken($token) {
	
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_token=:token";
		$criteria->params = array (
				":token" => $token
		);
		$concurso = ConContests::model ()->find ($criteria);
	
		return $concurso;
	}
}
