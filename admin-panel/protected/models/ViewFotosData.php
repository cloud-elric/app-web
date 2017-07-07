<?php

/**
 * This is the model class for table "view_fotos_data".
 *
 * The followings are the available columns in table 'view_fotos_data':
 * @property string $id_pic
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property string $txt_pic_desc
 * @property string $id_product
 * @property string $txt_product_name
 * @property string $id_category
 * @property string $txt_category_name
 */
class ViewFotosData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_fotos_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_file_name, txt_pic_name, txt_pic_desc, txt_product_name, txt_category_name', 'required'),
			array('id_pic, id_category', 'length', 'max'=>11),
			array('txt_file_name, txt_pic_name', 'length', 'max'=>150),
			array('txt_pic_desc', 'length', 'max'=>1500),
			array('id_product', 'length', 'max'=>10),
			array('txt_product_name', 'length', 'max'=>100),
			array('txt_category_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pic, txt_file_name, txt_pic_name, txt_pic_desc, id_product, txt_product_name, id_category, txt_category_name', 'safe', 'on'=>'search'),
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
			'id_pic' => 'Id Pic',
			'txt_file_name' => 'Txt File Name',
			'txt_pic_name' => 'Txt Pic Name',
			'txt_pic_desc' => 'Txt Pic Desc',
			'id_product' => 'Id Product',
			'txt_product_name' => 'Txt Product Name',
			'id_category' => 'Id Category',
			'txt_category_name' => 'Txt Category Name',
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

		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('txt_file_name',$this->txt_file_name,true);
		$criteria->compare('txt_pic_name',$this->txt_pic_name,true);
		$criteria->compare('txt_pic_desc',$this->txt_pic_desc,true);
		$criteria->compare('id_product',$this->id_product,true);
		$criteria->compare('txt_product_name',$this->txt_product_name,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('txt_category_name',$this->txt_category_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewFotosData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
