<?php

/**
 * This is the model class for table "2gom_view_usuario_pics_productos".
 *
 * The followings are the available columns in table '2gom_view_usuario_pics_productos':
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
 * @property string $id_contest
 * @property string $id_orden_compra
 * @property string $id_payment_recibed
 * @property integer $num_fotos_permitidas
 * @property string $b_primera_vez
 * @property string $b_participa
 * @property string $txt_order_number
 * @property string $txt_description
 * @property string $id_cupon
 * @property string $id_cliente
 * @property string $id_payment_type
 * @property string $fch_creacion
 * @property string $b_pagado
 * @property double $num_sub_total
 * @property string $num_products
 * @property string $num_addons
 * @property double $num_total
 * @property string $id_pic
 * @property string $id_category_original
 * @property string $id_category
 * @property string $txt_pic_number
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property string $txt_pic_desc
 * @property integer $b_mencion
 * @property string $b_status
 */
class ViewUsuarioPicsProductos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_usuario_pics_productos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_contest, id_orden_compra, id_payment_recibed, txt_order_number, txt_description, id_cliente, id_payment_type, fch_creacion, b_pagado, num_sub_total, num_products, num_addons, num_total', 'required'),
			array('num_fotos_permitidas, b_mencion', 'numerical', 'integerOnly'=>true),
			array('num_sub_total, num_total', 'numerical'),
			array('id_usuario, id_usuario_facebook, id_pic, id_category_original, id_category, b_status', 'length', 'max'=>11),
			array('txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_order_number, txt_pic_number', 'length', 'max'=>50),
			array('txt_password, b_login_social_network, id_contest, id_orden_compra, id_payment_recibed, b_primera_vez, b_participa, id_cliente, id_payment_type, b_pagado, num_products, num_addons', 'length', 'max'=>10),
			array('txt_image_url', 'length', 'max'=>300),
			array('txt_description', 'length', 'max'=>500),
			array('id_cupon', 'length', 'max'=>20),
			array('txt_file_name, txt_pic_name', 'length', 'max'=>150),
			array('txt_pic_desc', 'length', 'max'=>1500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, id_usuario_facebook, txt_correo, txt_usuario_number, txt_nombre, txt_apellido_paterno, txt_apellido_materno, txt_password, txt_image_url, b_login_social_network, id_contest, id_orden_compra, id_payment_recibed, num_fotos_permitidas, b_primera_vez, b_participa, txt_order_number, txt_description, id_cupon, id_cliente, id_payment_type, fch_creacion, b_pagado, num_sub_total, num_products, num_addons, num_total, id_pic, id_category_original, id_category, txt_pic_number, txt_file_name, txt_pic_name, txt_pic_desc, b_mencion, b_status', 'safe', 'on'=>'search'),
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
			'id_contest' => 'Id Contest',
			'id_orden_compra' => 'Id Orden Compra',
			'id_payment_recibed' => 'Id Payment Recibed',
			'num_fotos_permitidas' => 'Num Fotos Permitidas',
			'b_primera_vez' => 'B Primera Vez',
			'b_participa' => 'B Participa',
			'txt_order_number' => 'Txt Order Number',
			'txt_description' => 'Txt Description',
			'id_cupon' => 'Id Cupon',
			'id_cliente' => 'Id Cliente',
			'id_payment_type' => 'Id Payment Type',
			'fch_creacion' => 'Fch Creacion',
			'b_pagado' => 'B Pagado',
			'num_sub_total' => 'Num Sub Total',
			'num_products' => 'Num Products',
			'num_addons' => 'Num Addons',
			'num_total' => 'Num Total',
			'id_pic' => 'Id Pic',
			'id_category_original' => 'Id Category Original',
			'id_category' => 'Id Category',
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
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('id_orden_compra',$this->id_orden_compra,true);
		$criteria->compare('id_payment_recibed',$this->id_payment_recibed,true);
		$criteria->compare('num_fotos_permitidas',$this->num_fotos_permitidas);
		$criteria->compare('b_primera_vez',$this->b_primera_vez,true);
		$criteria->compare('b_participa',$this->b_participa,true);
		$criteria->compare('txt_order_number',$this->txt_order_number,true);
		$criteria->compare('txt_description',$this->txt_description,true);
		$criteria->compare('id_cupon',$this->id_cupon,true);
		$criteria->compare('id_cliente',$this->id_cliente,true);
		$criteria->compare('id_payment_type',$this->id_payment_type,true);
		$criteria->compare('fch_creacion',$this->fch_creacion,true);
		$criteria->compare('b_pagado',$this->b_pagado,true);
		$criteria->compare('num_sub_total',$this->num_sub_total);
		$criteria->compare('num_products',$this->num_products,true);
		$criteria->compare('num_addons',$this->num_addons,true);
		$criteria->compare('num_total',$this->num_total);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('id_category_original',$this->id_category_original,true);
		$criteria->compare('id_category',$this->id_category,true);
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
	 * @return ViewUsuarioPicsProductos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
