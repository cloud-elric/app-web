<?php

/**
 * This is the model class for table "2gom_view_pics_calificadas".
 *
 * The followings are the available columns in table '2gom_view_pics_calificadas':
 * @property string $id_pic
 * @property string $id_category
 * @property string $num_jueces_calificaron
 * @property string $b_calificada
 */
class ViewPicsCalificadas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_pics_calificadas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pic', 'required'),
			array('id_pic', 'length', 'max'=>10),
			array('id_category', 'length', 'max'=>11),
			array('num_jueces_calificaron', 'length', 'max'=>21),
			array('b_calificada', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pic, id_category, num_jueces_calificaron, b_calificada', 'safe', 'on'=>'search'),
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
				
				'idPic' => array(self::BELONGS_TO, 'WrkPics', 'id_pic'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pic' => 'Id Pic',
			'id_category' => 'Id Category',
			'num_jueces_calificaron' => 'Num Jueces Calificaron',
			'b_calificada' => 'B Calificada',
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
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('num_jueces_calificaron',$this->num_jueces_calificaron,true);
		$criteria->compare('b_calificada',$this->b_calificada,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewPicsCalificadas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
