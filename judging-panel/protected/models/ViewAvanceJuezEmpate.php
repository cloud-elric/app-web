<?php

/**
 * This is the model class for table "2gom_view_avance_juez_empate".
 *
 * The followings are the available columns in table '2gom_view_avance_juez_empate':
 * @property string $id_juez
 * @property string $txt_nombre_juez
 * @property string $num_pics_desempatadas
 * @property string $num_total_empate
 */
class ViewAvanceJuezEmpate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_avance_juez_empate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_juez', 'length', 'max'=>10),
			array('txt_nombre_juez', 'length', 'max'=>50),
			array('num_pics_desempatadas, num_total_empate', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_juez, txt_nombre_juez, num_pics_desempatadas, num_total_empate', 'safe', 'on'=>'search'),
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
			'txt_nombre_juez' => 'Txt Nombre Juez',
			'num_pics_desempatadas' => 'Num Pics Desempatadas',
			'num_total_empate' => 'Num Total Empate',
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
		$criteria->compare('txt_nombre_juez',$this->txt_nombre_juez,true);
		$criteria->compare('num_pics_desempatadas',$this->num_pics_desempatadas,true);
		$criteria->compare('num_total_empate',$this->num_total_empate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewAvanceJuezEmpate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
