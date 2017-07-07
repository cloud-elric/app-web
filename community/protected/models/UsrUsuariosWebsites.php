<?php

/**
 * This is the model class for table "2gom_usr_usuarios_websites".
 *
 * The followings are the available columns in table '2gom_usr_usuarios_websites':
 * @property string $id_website
 * @property string $id_usuario
 * @property string $txt_url
 */
class UsrUsuariosWebsites extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_usr_usuarios_websites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('txt_url', 'required'),
			array('id_usuario', 'length', 'max'=>11),
			array('txt_url', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_website, id_usuario, txt_url', 'safe', 'on'=>'search'),
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
			'id_website' => 'Id Website',
			'id_usuario' => 'Id Usuario',
			'txt_url' => 'Url',
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

		$criteria->compare('id_website',$this->id_website,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('txt_url',$this->txt_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuariosWebsites the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
