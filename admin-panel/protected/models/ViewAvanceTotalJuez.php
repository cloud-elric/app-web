<?php

/**
 * This is the model class for table "view_avance_total_juez".
 *
 * The followings are the available columns in table 'view_avance_total_juez':
 * @property string $id_juez
 * @property string $id_category
 * @property string $txt_name
 * @property string $num_fotos_calificadas
 * @property string $num_fotos_total
 * @property string $num_porcentaje
 */
class ViewAvanceTotalJuez extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_avance_total_juez';
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
			array('id_juez', 'length', 'max'=>10),
			array('id_category', 'length', 'max'=>11),
			array('txt_name', 'length', 'max'=>50),
			array('num_fotos_calificadas, num_fotos_total', 'length', 'max'=>21),
			array('num_porcentaje', 'length', 'max'=>26),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_juez, id_category, txt_name, num_fotos_calificadas, num_fotos_total, num_porcentaje', 'safe', 'on'=>'search'),
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
			'id_juez' => 'Id Juez',
			'id_category' => 'Id Category',
			'txt_name' => 'Txt Name',
			'num_fotos_calificadas' => 'Num Fotos Calificadas',
			'num_fotos_total' => 'Num Fotos Total',
			'num_porcentaje' => 'Num Porcentaje',
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

		$criteria->compare('id_juez',$this->id_juez,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('num_fotos_calificadas',$this->num_fotos_calificadas,true);
		$criteria->compare('num_fotos_total',$this->num_fotos_total,true);
		$criteria->compare('num_porcentaje',$this->num_porcentaje,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewAvanceTotalJuez the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
