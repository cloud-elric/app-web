<?php

/**
 * This is the model class for table "2gom_pay_cat_payments_types".
 *
 * The followings are the available columns in table '2gom_pay_cat_payments_types':
 * @property string $id_payment_type
 * @property string $txt_name
 * @property string $txt_icon_url
 * @property integer $b_enabled
 */
class PayCatPaymentsTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_pay_cat_payments_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_name', 'required'),
			array('b_enabled', 'numerical', 'integerOnly'=>true),
			array('txt_name, txt_icon_url', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_payment_type, txt_name, txt_icon_url, b_enabled', 'safe', 'on'=>'search'),
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
			'id_payment_type' => 'Id Payment Type',
			'txt_name' => 'Txt Name',
			'txt_icon_url' => 'Txt Icon Url',
			'b_enabled' => 'B Enabled',
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

		$criteria->compare('id_payment_type',$this->id_payment_type,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('txt_icon_url',$this->txt_icon_url,true);
		$criteria->compare('b_enabled',$this->b_enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayCatPaymentsTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
