<?php

/**
 * This is the model class for table "2gom_con_rel_users_contest".
 *
 * The followings are the available columns in table '2gom_con_rel_users_contest':
 * @property string $id_contest
 * @property string $id_usuario
 * @property string $id_orden_compra
 * @property string $id_payment_recibed
 */
class ConRelUsersContest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_rel_users_contest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_contest, id_usuario, id_orden_compra, id_payment_recibed', 'required'),
			array('id_contest, id_orden_compra, id_payment_recibed', 'length', 'max'=>10),
			array('id_usuario', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_contest, id_usuario, id_orden_compra, id_payment_recibed', 'safe', 'on'=>'search'),
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
						'idConcursos'=>array(self::BELONGS_TO, 'ConContests', 'id_contest'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_contest' => 'Id Contest',
			'id_usuario' => 'Id Usuario',
			'id_orden_compra' => 'Id Orden Compra',
			'id_payment_recibed' => 'Id Payment Recibed',
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
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_orden_compra',$this->id_orden_compra,true);
		$criteria->compare('id_payment_recibed',$this->id_payment_recibed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConRelUsersContest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Buscamos y validamos si el usuario ya esta inscrito en el concurso
	 *
	 * @param unknown $idCompetidor
	 * @param unknown $idConcurso
	 */
	public static function isUsuarioInscrito($idCompetidor, $idConcurso) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "id_usuario=:idUsuario AND id_contest=:idConcurso";
		$criteria->params = array (
				":idUsuario" => $idCompetidor,
				":idConcurso" => $idConcurso
		);
	
		$concursanteInscrito = ConRelUsersContest::model ()->find ( $criteria );
		if (empty ( $concursanteInscrito )) {
			return false;
		}
		return true;
	}
	
}
