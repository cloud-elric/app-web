<?php

/**
 * This is the model class for table "2gom_view_usuario_pics".
 *
 * The followings are the available columns in table '2gom_view_usuario_pics':
 * @property string $id_usuario
 * @property string $id_usuario_facebook
 * @property string $txt_correo
 * @property string $txt_usuario_number
 * @property string $txt_nombre
 * @property string $txt_apellido_paterno
 * @property string $txt_apellido_materno
 * @property string $txt_password
 * @property string $txt_image_url
 * @property string $b_login_social_network
 * @property string $b_participa
 * @property string $id_pic
 * @property string $ID
 * @property string $id_category_original
 * @property string $id_category
 * @property string $id_contest
 * @property string $txt_pic_number
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property string $txt_pic_desc
 * @property integer $b_mencion
 * @property string $b_status
 */
class ViewUsuarioPics extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_usuario_pics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID', 'required'),
			array('b_mencion', 'numerical', 'integerOnly'=>true),
			array('id_usuario, id_usuario_facebook, id_pic, id_category_original, id_category, id_contest, b_status', 'length', 'max'=>11),
			array('txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_pic_number', 'length', 'max'=>50),
			array('txt_password, b_login_social_network, b_participa', 'length', 'max'=>10),
			array('txt_image_url', 'length', 'max'=>300),
			array('ID', 'length', 'max'=>20),
			array('txt_file_name, txt_pic_name', 'length', 'max'=>150),
			array('txt_pic_desc', 'length', 'max'=>1500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_usuario_facebook, txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_password, txt_image_url, b_login_social_network, b_participa, id_pic, ID, id_category_original, id_category, id_contest, txt_pic_number, txt_file_name, txt_pic_name, txt_pic_desc, b_mencion, b_status', 'safe', 'on'=>'search'),
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
			'id_usuario' => 'Id Usuario',
			'id_usuario_facebook' => 'Id Usuario Facebook',
			'txt_correo' => 'Txt Correo',
			'txt_usuario_number' => 'Txt Usuario Number',
			'txt_nombre' => 'Txt Nombre',
			'txt_apellido_paterno' => 'Txt Apellido Paterno',
			'txt_apellido_materno' => 'Txt Apellido Materno',
			'txt_password' => 'Txt Password',
			'txt_image_url' => 'Txt Image Url',
			'b_login_social_network' => 'B Login Social Network',
			'b_participa' => 'B Participa',
			'id_pic' => 'Id Pic',
			'ID' => 'ID',
			'id_category_original' => 'Id Category Original',
			'id_category' => 'Id Category',
			'id_contest' => 'Id Contest',
			'txt_pic_number' => 'Txt Pic Number',
			'txt_file_name' => 'Txt File Name',
			'txt_pic_name' => 'Txt Pic Name',
			'txt_pic_desc' => 'Txt Pic Desc',
			'b_mencion' => 'B Mencion',
			'b_status' => 'B Status',
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

		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_usuario_facebook',$this->id_usuario_facebook,true);
		$criteria->compare('txt_correo',$this->txt_correo,true);
		$criteria->compare('txt_usuario_number',$this->txt_usuario_number,true);
		$criteria->compare('txt_nombre',$this->txt_nombre,true);
		$criteria->compare('txt_apellido_paterno',$this->txt_apellido_paterno,true);
		$criteria->compare('txt_apellido_materno',$this->txt_apellido_materno,true);
		$criteria->compare('txt_password',$this->txt_password,true);
		$criteria->compare('txt_image_url',$this->txt_image_url,true);
		$criteria->compare('b_login_social_network',$this->b_login_social_network,true);
		$criteria->compare('b_participa',$this->b_participa,true);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('id_category_original',$this->id_category_original,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('txt_pic_number',$this->txt_pic_number,true);
		$criteria->compare('txt_file_name',$this->txt_file_name,true);
		$criteria->compare('txt_pic_name',$this->txt_pic_name,true);
		$criteria->compare('txt_pic_desc',$this->txt_pic_desc,true);
		$criteria->compare('b_mencion',$this->b_mencion);
		$criteria->compare('b_status',$this->b_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewUsuarioPics the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
