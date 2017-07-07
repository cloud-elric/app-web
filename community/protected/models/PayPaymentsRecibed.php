<?php

/**
 * This is the model class for table "2gom_pay_payments_recibed".
 *
 * The followings are the available columns in table '2gom_pay_payments_recibed':
 * @property string $id_payment_recibed
 * @property string $id_usuario
 * @property string $id_tipo_pago
 * @property string $txt_transaccion_local
 * @property string $txt_ip
 * @property string $txt_notas
 * @property string $txt_estatus
 * @property string $txt_transaccion
 * @property string $txt_tipo_transaccion
 * @property string $txt_cadena_comprador
 * @property string $txt_cadena_pago
 * @property string $txt_cadena_producto
 * @property string $txt_monto_pago
 * @property string $verify_sign
 * @property string $fch_pago
 */
class PayPaymentsRecibed extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_pay_payments_recibed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, id_tipo_pago, txt_transaccion_local, txt_notas, txt_estatus, txt_transaccion', 'required'),
			array('id_usuario', 'length', 'max'=>20),
			array('id_tipo_pago, txt_monto_pago', 'length', 'max'=>10),
			array('txt_transaccion_local, txt_ip', 'length', 'max'=>32),
			array('txt_notas, txt_estatus, txt_transaccion, txt_tipo_transaccion, verify_sign', 'length', 'max'=>100),
			array('txt_cadena_comprador, txt_cadena_pago', 'length', 'max'=>2000),
			array('txt_cadena_producto', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_payment_recibed, id_usuario, id_tipo_pago, txt_transaccion_local, txt_ip, txt_notas, txt_estatus, txt_transaccion, txt_tipo_transaccion, txt_cadena_comprador, txt_cadena_pago, txt_cadena_producto, txt_monto_pago, verify_sign, fch_pago', 'safe', 'on'=>'search'),
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
			'id_payment_recibed' => 'Id Payment Recibed',
			'id_usuario' => 'id_usuario',
			'id_tipo_pago' => 'Id Tipo Pago',
			'txt_transaccion_local' => 'Txt Transaccion Local',
			'txt_ip' => 'Txt Ip',
			'txt_notas' => 'Txt Notas',
			'txt_estatus' => 'Txt Estatus',
			'txt_transaccion' => 'Txt Transaccion',
			'txt_tipo_transaccion' => 'Txt Tipo Transaccion',
			'txt_cadena_comprador' => 'Txt Cadena Comprador',
			'txt_cadena_pago' => 'Txt Cadena Pago',
			'txt_cadena_producto' => 'Txt Cadena Producto',
			'txt_monto_pago' => 'Txt Monto Pago',
			'verify_sign' => 'Verify Sign',
			'fch_pago' => 'Fch Pago',
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

		$criteria->compare('id_payment_recibed',$this->id_payment_recibed,true);
		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('id_tipo_pago',$this->id_tipo_pago,true);
		$criteria->compare('txt_transaccion_local',$this->txt_transaccion_local,true);
		$criteria->compare('txt_ip',$this->txt_ip,true);
		$criteria->compare('txt_notas',$this->txt_notas,true);
		$criteria->compare('txt_estatus',$this->txt_estatus,true);
		$criteria->compare('txt_transaccion',$this->txt_transaccion,true);
		$criteria->compare('txt_tipo_transaccion',$this->txt_tipo_transaccion,true);
		$criteria->compare('txt_cadena_comprador',$this->txt_cadena_comprador,true);
		$criteria->compare('txt_cadena_pago',$this->txt_cadena_pago,true);
		$criteria->compare('txt_cadena_producto',$this->txt_cadena_producto,true);
		$criteria->compare('txt_monto_pago',$this->txt_monto_pago,true);
		$criteria->compare('verify_sign',$this->verify_sign,true);
		$criteria->compare('fch_pago',$this->fch_pago,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayPaymentsRecibed the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
