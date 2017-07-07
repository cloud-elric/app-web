<?php

/**
 * This is the model class for table "2gom_con_paises".
 *
 * The followings are the available columns in table '2gom_con_paises':
 * @property string $id_pais
 * @property string $txt_nombre
 * @property string $txt_token
 * @property string $txt_descripcion
 * @property string $txt_prefijo
 * @property string $b_habilitado
 */
class ConPaises extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_con_paises';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_nombre, txt_token, txt_descripcion, txt_prefijo', 'required'),
			array('txt_nombre, txt_token, txt_descripcion, txt_prefijo', 'length', 'max'=>50),
			array('b_habilitado', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pais, txt_nombre, txt_token, txt_descripcion, txt_prefijo, b_habilitado', 'safe', 'on'=>'search'),
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
			'id_pais' => 'Id Pais',
			'txt_nombre' => 'Txt Nombre',
			'txt_token' => 'Txt Token',
			'txt_descripcion' => 'Txt Descripcion',
			'txt_prefijo' => 'Txt Prefijo',
			'b_habilitado' => 'B Habilitado',
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

		$criteria->compare('id_pais',$this->id_pais,true);
		$criteria->compare('txt_nombre',$this->txt_nombre,true);
		$criteria->compare('txt_token',$this->txt_token,true);
		$criteria->compare('txt_descripcion',$this->txt_descripcion,true);
		$criteria->compare('txt_prefijo',$this->txt_prefijo,true);
		$criteria->compare('b_habilitado',$this->b_habilitado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConPaises the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Devuelve todos los países de la base de datos
	 * @return unknown
	 */
	public static function getAllCountries(){
		$criteria = new CDbCriteria ();
		$criteria->condition = "b_habilitado=1";
		$criteria->order = "txt_nombre ASC";
		
		$paises = ConPaises::model ()->findAll ( $criteria );
		return $paises;
	}
}
