<?php

/**
 * This is the model class for table "2gom_pay_cupons".
 *
 * The followings are the available columns in table '2gom_pay_cupons':
 * @property string $id_cupon
 * @property string $id_contest
 * @property string $txt_identificador_unico
 * @property string $txt_descripcion
 * @property string $num_porcentaje_descuento
 * @property string $num_cupones
 * @property string $b_grupo
 * @property string $b_porcentaje
 * @property string $fch_inicio
 * @property string $fch_final
 */
class PayCupons extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_pay_cupons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_contest, txt_identificador_unico, txt_descripcion, num_porcentaje_descuento, num_cupones, fch_inicio, fch_final', 'required'),
			array('id_contest, num_porcentaje_descuento, num_cupones, b_grupo, b_porcentaje', 'length', 'max'=>10),
			array('txt_identificador_unico, txt_descripcion', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cupon, id_contest, txt_identificador_unico, txt_descripcion, num_porcentaje_descuento, num_cupones, b_grupo, b_porcentaje, fch_inicio, fch_final', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cupon' => 'Id Cupon',
			'id_contest' => 'Id Contest',
			'txt_identificador_unico' => 'Txt Identificador Unico',
			'txt_descripcion' => 'Txt Descripcion',
			'num_porcentaje_descuento' => 'Num Porcentaje Descuento',
			'num_cupones' => 'Num Cupones',
			'b_grupo' => 'B Grupo',
			'b_porcentaje' => 'B Porcentaje',
			'fch_inicio' => 'Fch Inicio',
			'fch_final' => 'Fch Final',
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

		$criteria->compare('id_cupon',$this->id_cupon,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('txt_identificador_unico',$this->txt_identificador_unico,true);
		$criteria->compare('txt_descripcion',$this->txt_descripcion,true);
		$criteria->compare('num_porcentaje_descuento',$this->num_porcentaje_descuento,true);
		$criteria->compare('num_cupones',$this->num_cupones,true);
		$criteria->compare('b_grupo',$this->b_grupo,true);
		$criteria->compare('b_porcentaje',$this->b_porcentaje,true);
		$criteria->compare('fch_inicio',$this->fch_inicio,true);
		$criteria->compare('fch_final',$this->fch_final,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayCupons the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Obtenemos el cupon a partir del token recibido
	 * @param string $t
	 * @param string $idContest
	 * @return PayCupons
	 */
	public static function getCupon($t, $idContest){
		$c = new CDbCriteria();
		$c->condition = 'txt_identificador_unico=:t AND id_contest=:idContest';
		$c->params = array(':t'=>$t, ':idContest'=>$idContest);
	
		$cupon = PayCupons::model()->find($c);
	
	
		return $cupon;
	
	}
}
