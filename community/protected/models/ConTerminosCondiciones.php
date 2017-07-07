<?php

/**
 * This is the model class for table "2gom_con_terminos_condiciones".
 *
 * The followings are the available columns in table '2gom_con_terminos_condiciones':
 * @property string $id_terminos_condiciones
 * @property string $id_contest
 * @property string $txt_terminos
 * @property string $txt_condiciones
 * @property string $fch_actualizacion
 * @property integer $b_Actual
 */
class ConTerminosCondiciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_terminos_condiciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_contest, txt_terminos, txt_condiciones', 'required'),
			array('b_Actual', 'numerical', 'integerOnly'=>true),
			array('id_contest', 'length', 'max'=>11),
			array('fch_actualizacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_terminos_condiciones, id_contest, txt_terminos, txt_condiciones, fch_actualizacion, b_Actual', 'safe', 'on'=>'search'),
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
			'id_terminos_condiciones' => 'Id Terminos Condiciones',
			'id_contest' => 'Id Contest',
			'txt_terminos' => 'Txt Terminos',
			'txt_condiciones' => 'Txt Condiciones',
			'fch_actualizacion' => 'Fch Actualizacion',
			'b_Actual' => 'B Actual',
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

		$criteria->compare('id_terminos_condiciones',$this->id_terminos_condiciones,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('txt_terminos',$this->txt_terminos,true);
		$criteria->compare('txt_condiciones',$this->txt_condiciones,true);
		$criteria->compare('fch_actualizacion',$this->fch_actualizacion,true);
		$criteria->compare('b_Actual',$this->b_Actual);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConTerminosCondiciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
