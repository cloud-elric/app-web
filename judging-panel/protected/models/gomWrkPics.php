<?php

/**
 * This is the model class for table "2gom_wrk_pics".
 *
 * The followings are the available columns in table '2gom_wrk_pics':
 * @property string $id_pic
 * @property string $ID
 * @property string $id_contest
 * @property string $id_category
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property string $txt_pic_desc
 *
 * The followings are the available model relations:
 * @property 2gomCategoiries $idCategory
 * @property 2gomContests $idContest
 * @property WpUsers $iD
 * @property 2gomWrkPicsCalificaciones[] $2gomWrkPicsCalificaciones
 */
class gomWrkPics extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_wrk_pics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, id_contest, txt_file_name, txt_pic_name, txt_pic_desc', 'required'),
			array('ID', 'length', 'max'=>20),
			array('id_contest, id_category', 'length', 'max'=>11),
			array('txt_file_name, txt_pic_name', 'length', 'max'=>150),
			array('txt_pic_desc', 'length', 'max'=>1500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pic, ID, id_contest, id_category, txt_file_name, txt_pic_name, txt_pic_desc', 'safe', 'on'=>'search'),
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
			'idCategory' => array(self::BELONGS_TO, '2gomCategoiries', 'id_category'),
			'idContest' => array(self::BELONGS_TO, '2gomContests', 'id_contest'),
			'iD' => array(self::BELONGS_TO, 'WpUsers', 'ID'),
			'2gomWrkPicsCalificaciones' => array(self::HAS_MANY, '2gomWrkPicsCalificaciones', 'id_pic'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_pic' => 'Id Pic',
			'ID' => 'ID',
			'id_contest' => 'Id Contest',
			'id_category' => 'Id Category',
			'txt_file_name' => 'Txt File Name',
			'txt_pic_name' => 'Txt Pic Name',
			'txt_pic_desc' => 'Txt Pic Desc',
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
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('txt_file_name',$this->txt_file_name,true);
		$criteria->compare('txt_pic_name',$this->txt_pic_name,true);
		$criteria->compare('txt_pic_desc',$this->txt_pic_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return gomWrkPics the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
