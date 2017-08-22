<?php

/**
 * This is the model class for table "2gom_view_calificaciones".
 *
 * The followings are the available columns in table '2gom_view_calificaciones':
 * @property string $id_pic
 * @property string $id_juez
 * @property string $txt_nombre_juez
 * @property integer $b_mencion
 * @property string $txt_retro
 * @property string $num_calificacion_nueva
 * @property string $id_contest
 */
class ViewCalificaciones extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_calificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pic, id_juez, id_contest', 'required'),
			array('b_mencion', 'numerical', 'integerOnly'=>true),
			array('id_pic, id_juez, id_contest', 'length', 'max'=>10),
			array('txt_nombre_juez', 'length', 'max'=>50),
			array('num_calificacion_nueva', 'length', 'max'=>32),
			array('txt_retro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pic, id_juez, txt_nombre_juez, b_mencion, txt_retro, num_calificacion_nueva, id_contest', 'safe', 'on'=>'search'),
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
			'id_juez' => 'Id Juez',
			'txt_nombre_juez' => 'Txt Nombre Juez',
			'b_mencion' => 'B Mencion',
			'txt_retro' => 'Txt Retro',
			'num_calificacion_nueva' => 'Num Calificacion Nueva',
			'id_contest' => 'Id Contest',
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
		$criteria->compare('id_juez',$this->id_juez,true);
		$criteria->compare('txt_nombre_juez',$this->txt_nombre_juez,true);
		$criteria->compare('b_mencion',$this->b_mencion);
		$criteria->compare('txt_retro',$this->txt_retro,true);
		$criteria->compare('num_calificacion_nueva',$this->num_calificacion_nueva,true);
		$criteria->compare('id_contest',$this->id_contest,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewCalificaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
