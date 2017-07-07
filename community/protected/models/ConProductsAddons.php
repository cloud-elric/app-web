<?php

/**
 * This is the model class for table "2gom_con_products_addons".
 *
 * The followings are the available columns in table '2gom_con_products_addons':
 * @property string $id_addon
 * @property string $id_product
 * @property string $txt_name
 * @property string $txt_product_number
 * @property string $txt_desc
 * @property integer $num_price
 * @property integer $b_enabled
 */
class ConProductsAddons extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_products_addons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_product', 'required'),
			array('num_price, b_enabled', 'numerical', 'integerOnly'=>true),
			array('id_product', 'length', 'max'=>10),
			array('txt_name', 'length', 'max'=>100),
			array('txt_product_number', 'length', 'max'=>35),
			array('txt_desc', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_addon, id_product, txt_name, txt_product_number, txt_desc, num_price, b_enabled', 'safe', 'on'=>'search'),
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
			'id_addon' => 'Id Addon',
			'id_product' => 'Id Product',
			'txt_name' => 'Txt Name',
			'txt_product_number' => 'Txt Product Number',
			'txt_desc' => 'Txt Desc',
			'num_price' => 'Num Price',
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

		$criteria->compare('id_addon',$this->id_addon,true);
		$criteria->compare('id_product',$this->id_product,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('txt_product_number',$this->txt_product_number,true);
		$criteria->compare('txt_desc',$this->txt_desc,true);
		$criteria->compare('num_price',$this->num_price);
		$criteria->compare('b_enabled',$this->b_enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConProductsAddons the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
