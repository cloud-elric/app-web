<?php

/**
 * This is the model class for table "2gom_wrk_pics_juez_cal".
 *
 * The followings are the available columns in table '2gom_wrk_pics_juez_cal':
 * @property string $id_juez_cal
 * @property string $id_juez
 * @property string $id_pic
 * @property string $id_status_calificacion
 * @property string $id_usuario
 * @property string $id_contest
 *
 * The followings are the available model relations:
 * @property 2gomConContests $idContest
 * @property 2gomConCatEstatusCalificaciones $idStatusCalificacion
 * @property 2gomJueEntJueces $idJuez
 * @property 2gomUsrUsuarios $idUsuario
 * @property 2gomWrkPics $idPic
 */
class WrkPicsJuezCal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_wrk_pics_juez_cal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_juez, id_pic, id_status_calificacion, id_usuario, id_contest', 'required'),
			array('id_juez, id_pic, id_status_calificacion, id_contest', 'length', 'max'=>10),
			array('id_usuario', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_juez_cal, id_juez, id_pic, id_status_calificacion, id_usuario, id_contest', 'safe', 'on'=>'search'),
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
			'idContest' => array(self::BELONGS_TO, '2gomConContests', 'id_contest'),
			'idStatusCalificacion' => array(self::BELONGS_TO, '2gomConCatEstatusCalificaciones', 'id_status_calificacion'),
			'idJuez' => array(self::BELONGS_TO, '2gomJueEntJueces', 'id_juez'),
			'idUsuario' => array(self::BELONGS_TO, '2gomUsrUsuarios', 'id_usuario'),
			'idPic' => array(self::BELONGS_TO, '2gomWrkPics', 'id_pic'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_juez_cal' => 'Id Juez Cal',
			'id_juez' => 'Id Juez',
			'id_pic' => 'Id Pic',
			'id_status_calificacion' => 'Id Status Calificacion',
			'id_usuario' => 'Id Usuario',
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

		$criteria->compare('id_juez_cal',$this->id_juez_cal,true);
		$criteria->compare('id_juez',$this->id_juez,true);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('id_status_calificacion',$this->id_status_calificacion,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_contest',$this->id_contest,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WrkPicsJuezCal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
