<?php

/**
 * This is the model class for table "2gom_pay_open_pay_charge".
 *
 * The followings are the available columns in table '2gom_pay_open_pay_charge':
 * @property string $id_charge
 * @property string $id_orden_compra
 * @property string $txt_token_charge
 * @property string $txt_barcode_url
 * @property string $txt_reference
 * @property double $num_amount
 * @property string $txt_currency
 * @property string $txt_descripcion
 * @property string $fch_creation_date
 */
class PayOpenPayCharge extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_pay_open_pay_charge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_orden_compra', 'required'),
			array('num_amount', 'numerical'),
			array('id_charge, id_orden_compra', 'length', 'max'=>10),
			array('txt_token_charge', 'length', 'max'=>100),
			array('txt_barcode_url', 'length', 'max'=>800),
			array('txt_reference, txt_descripcion', 'length', 'max'=>500),
			array('txt_currency, fch_creation_date', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_charge, id_orden_compra, txt_token_charge, txt_barcode_url, txt_reference, num_amount, txt_currency, txt_descripcion, fch_creation_date', 'safe', 'on'=>'search'),
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
			'id_charge' => 'Id Charge',
			'id_orden_compra' => 'Id Orden Compra',
			'txt_token_charge' => 'Txt Token Charge',
			'txt_barcode_url' => 'Txt Barcode Url',
			'txt_reference' => 'Txt Reference',
			'num_amount' => 'Num Amount',
			'txt_currency' => 'Txt Currency',
			'txt_descripcion' => 'Txt Descripcion',
			'fch_creation_date' => 'Fch Creation Date',
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

		$criteria->compare('id_charge',$this->id_charge,true);
		$criteria->compare('id_orden_compra',$this->id_orden_compra,true);
		$criteria->compare('txt_token_charge',$this->txt_token_charge,true);
		$criteria->compare('txt_barcode_url',$this->txt_barcode_url,true);
		$criteria->compare('txt_reference',$this->txt_reference,true);
		$criteria->compare('num_amount',$this->num_amount);
		$criteria->compare('txt_currency',$this->txt_currency,true);
		$criteria->compare('txt_descripcion',$this->txt_descripcion,true);
		$criteria->compare('fch_creation_date',$this->fch_creation_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayOpenPayCharge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
