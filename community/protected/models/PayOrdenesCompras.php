<?php

/**
 * This is the model class for table "2gom_pay_ordenes_compras".
 *
 * The followings are the available columns in table '2gom_pay_ordenes_compras':
 * @property string $id_orden_compra
 * @property string $txt_order_number
 * @property string $id_cupon
 * @property string $id_usuario
 * @property string $id_contest
 * @property string $id_cliente
 * @property string $id_payment_type
 * @property string $fch_creacion
 * @property string $b_pagado
 * @property double $num_sub_total
 * @property string $num_products
 * @property string $num_addons
 * @property double $num_total
 * @property string $b_habilitado
 */
class PayOrdenesCompras extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '2gom_pay_ordenes_compras';
	}
	
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array (
				array (
						'txt_order_number, id_usuario, id_contest, id_cliente, fch_creacion, b_pagado, num_sub_total, num_products, num_addons, num_total, b_habilitado',
						'required' 
				),
				array (
						'num_sub_total, num_total',
						'numerical' 
				),
				array (
						'txt_order_number',
						'length',
						'max' => 50 
				),
				array (
						'id_cupon, id_usuario',
						'length',
						'max' => 20 
				),
				array (
						'id_contest, id_cliente, id_payment_type, b_pagado, num_products, num_addons, b_habilitado',
						'length',
						'max' => 10 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id_orden_compra, txt_order_number, id_cupon, id_usuario, id_contest, id_cliente, id_payment_type, fch_creacion, b_pagado, num_sub_total, num_products, num_addons, num_total, b_habilitado',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array (
				
				'idPaymentType' => array (
						self::BELONGS_TO,
						'PayCatPaymentsTypes',
						'id_payment_type' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id_orden_compra' => 'Id Orden Compra',
				'txt_order_number' => 'Txt Order Number',
				'id_cupon' => 'Id Cupon',
				'id_usuario' => 'Id Usuario',
				'id_contest' => 'Id Contest',
				'id_cliente' => 'Id Cliente',
				'id_payment_type' => 'Id Payment Type',
				'fch_creacion' => 'Fch Creacion',
				'b_pagado' => 'B Pagado',
				'num_sub_total' => 'Num Sub Total',
				'num_products' => 'Num Products',
				'num_addons' => 'Num Addons',
				'num_total' => 'Num Total',
				'b_habilitado' => 'B Habilitado' 
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
	 *         based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id_orden_compra', $this->id_orden_compra, true );
		$criteria->compare ( 'txt_order_number', $this->txt_order_number, true );
		$criteria->compare ( 'id_cupon', $this->id_cupon, true );
		$criteria->compare ( 'id_usuario', $this->id_usuario, true );
		$criteria->compare ( 'id_contest', $this->id_contest, true );
		$criteria->compare ( 'id_cliente', $this->id_cliente, true );
		$criteria->compare ( 'id_payment_type', $this->id_payment_type, true );
		$criteria->compare ( 'fch_creacion', $this->fch_creacion, true );
		$criteria->compare ( 'b_pagado', $this->b_pagado, true );
		$criteria->compare ( 'num_sub_total', $this->num_sub_total );
		$criteria->compare ( 'num_products', $this->num_products, true );
		$criteria->compare ( 'num_addons', $this->num_addons, true );
		$criteria->compare ( 'num_total', $this->num_total );
		$criteria->compare ( 'b_habilitado', $this->b_habilitado, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className
	 *        	active record class name.
	 * @return PayOrdenesCompras the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * Obtiene la orden de compra a partir de un id
	 *
	 * @param string $t        	
	 * @param string $idContest        	
	 * @return PayOrdenesCompras
	 */
	public static function getOrdenCompraByToken($t, $idContest) {
		$c = new CDbCriteria ();
		$c->condition = 'txt_order_number=:token AND id_contest=:idContest';
		$c->params = array (
				':token' => $t,
				':idContest' => $idContest 
		);
		
		$ordenCompra = PayOrdenesCompras::model ()->find ( $c );
		
		return $ordenCompra;
	}
}
