<?php

/**
 * This is the model class for table "2gom_admin_usuarios".
 *
 * The followings are the available columns in table '2gom_admin_usuarios':
 * @property string $id_admin_usuario
 * @property string $id_cliente
 * @property string $txt_nombre
 * @property string $txt_usuario
 * @property string $txt_apellido
 * @property string $txt_password
 * @property string $b_habilitado
 * @property string $b_juez_admin
 *
 * The followings are the available model relations:
 * @property 2gomCliEntClientes $idCliente
 */
class AdminUsuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_admin_usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cliente, txt_nombre, txt_usuario, txt_apellido, txt_password', 'required'),
			array('id_cliente, b_habilitado, b_juez_admin', 'length', 'max'=>10),
			array('txt_nombre, txt_usuario, txt_apellido, txt_password', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_admin_usuario, id_cliente, txt_nombre, txt_usuario, txt_apellido, txt_password, b_habilitado, b_juez_admin', 'safe', 'on'=>'search'),
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
			'idCliente' => array(self::BELONGS_TO, '2gomCliEntClientes', 'id_cliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_admin_usuario' => 'Id Admin Usuario',
			'id_cliente' => 'Id Cliente',
			'txt_nombre' => 'Txt Nombre',
			'txt_usuario' => 'Txt Usuario',
			'txt_apellido' => 'Txt Apellido',
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

		$criteria->compare('id_admin_usuario',$this->id_admin_usuario,true);
		$criteria->compare('id_cliente',$this->id_cliente,true);
		$criteria->compare('txt_nombre',$this->txt_nombre,true);
		$criteria->compare('txt_usuario',$this->txt_usuario,true);
		$criteria->compare('txt_apellido',$this->txt_apellido,true);
		$criteria->compare('txt_password',$this->txt_password,true);
		$criteria->compare('b_habilitado',$this->b_habilitado,true);
		$criteria->compare('b_juez_admin',$this->b_juez_admin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminUsuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
