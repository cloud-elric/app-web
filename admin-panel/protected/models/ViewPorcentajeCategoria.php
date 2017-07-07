<?php

/**
 * This is the model class for table "view_porcentaje_categoria".
 *
 * The followings are the available columns in table 'view_porcentaje_categoria':
 * @property string $id_category
 * @property string $txt_name
 * @property string $num_porcentaje_general
 * @property string $num_total_fotos
 * @property string $num_fotos_calificadas
 */
class ViewPorcentajeCategoria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_porcentaje_categoria';
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
			array('id_category', 'length', 'max'=>11),
			array('txt_name', 'length', 'max'=>50),
			array('num_porcentaje_general', 'length', 'max'=>16),
			array('num_total_fotos', 'length', 'max'=>21),
			array('num_fotos_calificadas', 'length', 'max'=>38),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_category, txt_name, num_porcentaje_general, num_total_fotos, num_fotos_calificadas', 'safe', 'on'=>'search'),
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
			'id_category' => 'Id Category',
			'txt_name' => 'Txt Name',
			'num_porcentaje_general' => 'Num Porcentaje General',
			'num_total_fotos' => 'Num Total Fotos',
			'num_fotos_calificadas' => 'Num Fotos Calificadas',
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

		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('num_porcentaje_general',$this->num_porcentaje_general,true);
		$criteria->compare('num_total_fotos',$this->num_total_fotos,true);
		$criteria->compare('num_fotos_calificadas',$this->num_fotos_calificadas,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewPorcentajeCategoria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
