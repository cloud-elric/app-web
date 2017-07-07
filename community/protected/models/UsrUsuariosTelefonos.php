<?php

/**
 * This is the model class for table "2gom_usr_usuarios_telefonos".
 *
 * The followings are the available columns in table '2gom_usr_usuarios_telefonos':
 * @property string $id_telefono
 * @property string $id_usaurio
 * @property string $txt_telefono
 * @property integer $b_primario
 */
class UsrUsuariosTelefonos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_usr_usuarios_telefonos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_telefono', 'required'),
			array('b_primario, txt_telefono', 'numerical', 'integerOnly'=>true),
			array('id_usaurio', 'length', 'max'=>11),
			array('txt_telefono', 'length', 'max'=>15),
				array('txt_telefono', 'length', 'min'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_telefono, id_usaurio, txt_telefono, b_primario', 'safe', 'on'=>'search'),
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
			'id_telefono' => 'Id Telefono',
			'id_usaurio' => 'Id Usaurio',
			'txt_telefono' => 'Telefono',
			'b_primario' => 'Telefono principal',
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

		$criteria->compare('id_telefono',$this->id_telefono,true);
		$criteria->compare('id_usaurio',$this->id_usaurio,true);
		$criteria->compare('txt_telefono',$this->txt_telefono,true);
		$criteria->compare('b_primario',$this->b_primario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuariosTelefonos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
