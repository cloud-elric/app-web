<?php

/**
 * This is the model class for table "2gom_ent_jueces".
 *
 * The followings are the available columns in table '2gom_ent_jueces':
 * @property string $id_juez
 * @property string $txt_nombre_juez
 * @property string $txt_iniciales
 * @property string $txt_user_name
 * @property string $txt_password
 * @property integer $b_habilitado
 * @property integer $b_juez_admin
 *
 * The followings are the available model relations:
 * @property 2gomWrkPicsCalificaciones[] $2gomWrkPicsCalificaciones
 */
class EntJueces extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_jue_ent_jueces';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('b_habilitado, b_juez_admin', 'numerical', 'integerOnly'=>true),
			array('txt_nombre_juez', 'length', 'max'=>50),
			array('txt_iniciales', 'length', 'max'=>2),
			array('txt_user_name, txt_password', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_juez, txt_nombre_juez, txt_iniciales, txt_user_name, txt_password, b_habilitado, b_juez_admin', 'safe', 'on'=>'search'),
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
				
			'WrkPicsCalificaciones' => array(self::HAS_MANY, 'WrkPicsCalificaciones', 'id_juez'),
				'AvanceTotal' => array(self::HAS_MANY, 'ViewAvanceTotalJuez', 'id_juez'),
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
			'txt_iniciales' => 'Txt Iniciales',
			'txt_user_name' => 'Txt User Name',
			'txt_password' => 'Txt Password',
			'b_habilitado' => 'B Habilitado',
			'b_juez_admin' => 'B Juez Admin',
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
		$criteria->compare('txt_iniciales',$this->txt_iniciales,true);
		$criteria->compare('txt_user_name',$this->txt_user_name,true);
		$criteria->compare('txt_password',$this->txt_password,true);
		$criteria->compare('b_habilitado',$this->b_habilitado);
		$criteria->compare('b_juez_admin',$this->b_juez_admin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EntJueces the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
