<?php

/**
 * This is the model class for table "view_pagos_recibidos".
 *
 * The followings are the available columns in table 'view_pagos_recibidos':
 * @property string $id_usuario
 * @property string $txt_correo
 * @property string $id_payment_recibed
 * @property string $txt_estatus
 * @property string $txt_transaccion
 * @property string $fch_pago
 * @property string $txt_monto_pago
 * @property string $txt_name_payment_type
 * @property string $id_contest
 * @property string $txt_name
 * @property string $txt_description
 * @property string $fch_creacion
 * @property string $b_pagado
 * @property string $num_products
 * @property string $id_cupon
 * @property string $txt_identificador_unico
 * @property string $txt_cadena_comprador
 */
class ViewPagosRecibidos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'view_pagos_recibidos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_estatus, txt_transaccion, txt_name_payment_type, txt_name, txt_description, fch_creacion, b_pagado, num_products', 'required'),
			array('id_usuario, id_contest', 'length', 'max'=>11),
			array('txt_correo, txt_name, txt_identificador_unico', 'length', 'max'=>50),
			array('id_payment_recibed, txt_monto_pago, b_pagado, num_products', 'length', 'max'=>10),
			array('txt_estatus, txt_transaccion, txt_name_payment_type', 'length', 'max'=>100),
			array('txt_description', 'length', 'max'=>500),
			array('id_cupon', 'length', 'max'=>20),
			array('fch_pago, txt_cadena_comprador', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, txt_correo, id_payment_recibed, txt_estatus, txt_transaccion, fch_pago, txt_monto_pago, txt_name_payment_type, id_contest, txt_name, txt_description, fch_creacion, b_pagado, num_products, id_cupon, txt_identificador_unico, txt_cadena_comprador', 'safe', 'on'=>'search'),
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
			'txt_correo' => 'Txt Correo',
			'id_payment_recibed' => 'Id Payment Recibed',
			'txt_estatus' => 'Txt Estatus',
			'txt_transaccion' => 'Txt Transaccion',
			'fch_pago' => 'Fch Pago',
			'txt_monto_pago' => 'Txt Monto Pago',
			'txt_name_payment_type' => 'Txt Name Payment Type',
			'id_contest' => 'Id Contest',
			'txt_name' => 'Txt Name',
			'txt_description' => 'Txt Description',
			'fch_creacion' => 'Fch Creacion',
			'b_pagado' => 'B Pagado',
			'num_products' => 'Num Products',
			'id_cupon' => 'Id Cupon',
			'txt_identificador_unico' => 'Txt Identificador Unico',
			'txt_cadena_comprador' => 'Txt Cadena Comprador',
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
		$criteria->compare('txt_correo',$this->txt_correo,true);
		$criteria->compare('id_payment_recibed',$this->id_payment_recibed,true);
		$criteria->compare('txt_estatus',$this->txt_estatus,true);
		$criteria->compare('txt_transaccion',$this->txt_transaccion,true);
		$criteria->compare('fch_pago',$this->fch_pago,true);
		$criteria->compare('txt_monto_pago',$this->txt_monto_pago,true);
		$criteria->compare('txt_name_payment_type',$this->txt_name_payment_type,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('txt_description',$this->txt_description,true);
		$criteria->compare('fch_creacion',$this->fch_creacion,true);
		$criteria->compare('b_pagado',$this->b_pagado,true);
		$criteria->compare('num_products',$this->num_products,true);
		$criteria->compare('id_cupon',$this->id_cupon,true);
		$criteria->compare('txt_identificador_unico',$this->txt_identificador_unico,true);
		$criteria->compare('txt_cadena_comprador',$this->txt_cadena_comprador,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewPagosRecibidos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
