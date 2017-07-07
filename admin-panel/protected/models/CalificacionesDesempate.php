<?php

/**
 * This is the model class for table "2gom_calificaciones_desempate".
 *
 * The followings are the available columns in table '2gom_calificaciones_desempate':
 * @property string $id_calificacion_desempate
 * @property string $id_pic
 * @property string $id_contest
 * @property string $id_juez
 * @property string $num_calificacion
 *
 * The followings are the available model relations:
 * @property 2gomWrkPics $idPic
 * @property 2gomContests $idContest
 * @property 2gomEntJueces $idJuez
 */
class CalificacionesDesempate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_calificaciones_desempate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pic, id_contest, id_juez, num_calificacion', 'required'),
			array('id_pic, id_contest, id_juez, num_calificacion', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_calificacion_desempate, id_pic, id_contest, id_juez, num_calificacion', 'safe', 'on'=>'search'),
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
			'idPic' => array(self::BELONGS_TO, '2gomWrkPics', 'id_pic'),
			'idContest' => array(self::BELONGS_TO, '2gomContests', 'id_contest'),
			'idJuez' => array(self::BELONGS_TO, '2gomEntJueces', 'id_juez'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_calificacion_desempate' => 'Id Calificacion Desempate',
			'id_pic' => 'Id Pic',
			'id_contest' => 'Id Contest',
			'id_juez' => 'Id Juez',
			'num_calificacion' => 'Num Calificacion',
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

		$criteria->compare('id_calificacion_desempate',$this->id_calificacion_desempate,true);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('id_juez',$this->id_juez,true);
		$criteria->compare('num_calificacion',$this->num_calificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CalificacionesDesempate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
