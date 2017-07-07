<?php

/**
 * This is the model class for table "2gom_con_products".
 *
 * The followings are the available columns in table '2gom_con_products':
 * @property string $id_product
 * @property string $id_contest
 * @property string $id_related_payment_type
 * @property string $txt_name
 * @property string $txt_product_number
 * @property string $txt_desc
 * @property string $txt_product_id
 * @property string $num_price
 * @property string $num_photos
 * @property string $num_order
 * @property integer $b_enabled
 */
class ConProducts extends CActiveRecord {
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '2gom_con_products';
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
						'id_contest, txt_name, txt_desc, txt_product_id, num_price, num_photos, num_order',
						'required' 
				),
				array (
						'b_enabled',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'id_contest, id_related_payment_type, num_price, num_photos, num_order',
						'length',
						'max' => 10 
				),
				array (
						'txt_name',
						'length',
						'max' => 100 
				),
				array (
						'txt_desc',
						'length',
						'max' => 250 
				),
				array (
						'txt_product_id',
						'length',
						'max' => 40 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id_product, id_contest, id_related_payment_type, txt_name, txt_desc, txt_product_id, num_price, num_photos, num_order, b_enabled',
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
				'conProductsAddonses' => array (
						self::HAS_MANY,
						'ConProducts',
						'id_product_parent' 
				) 
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id_product' => 'Id Product',
				'id_contest' => 'Id Contest',
				'id_related_payment_type' => 'Id Related Payment Type',
				'txt_name' => 'Txt Name',
				'txt_desc' => 'Txt Desc',
				'txt_product_id' => 'Txt Product',
				'num_price' => 'Num Price',
				'num_photos' => 'Num Photos',
				'num_order' => 'Num Order',
				'b_enabled' => 'B Enabled' 
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
		
		$criteria->compare ( 'id_product', $this->id_product, true );
		$criteria->compare ( 'id_contest', $this->id_contest, true );
		$criteria->compare ( 'id_related_payment_type', $this->id_related_payment_type, true );
		$criteria->compare ( 'txt_name', $this->txt_name, true );
		$criteria->compare ( 'txt_desc', $this->txt_desc, true );
		$criteria->compare ( 'txt_product_id', $this->txt_product_id, true );
		$criteria->compare ( 'num_price', $this->num_price, true );
		$criteria->compare ( 'num_photos', $this->num_photos, true );
		$criteria->compare ( 'num_order', $this->num_order, true );
		$criteria->compare ( 'b_enabled', $this->b_enabled );
		
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
	 * @return ConProducts the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * Obtenemos todos los productos por id de concurso
	 * 
	 * @param unknown $idConcurso        	
	 */
	public static function obtenerProductosPorConcurso($idConcurso) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "id_contest=:idContest AND id_product_parent IS NULL";
		$criteria->params = array (
				":idContest" => $idConcurso 
		);
		$criteria->order = "num_order ASC";
		
		$productos = ConProducts::model ()->findAll ( $criteria );
		
		return $productos;
	}
	
	/**
	 * Busca producto por token
	 * 
	 * @param unknown $token        	
	 */
	public static function getProductoByToken($token) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_product_number=:token";
		$criteria->params = array (
				":token" => $token 
		);
		
		$producto = ConProducts::model ()->find ( $criteria );
		return $producto;
	}
	
	/**
	 * Obtiene el producto por el token y id del concurso
	 * @param unknown $token
	 * @param unknown $idContest
	 */
	public static function getProductoByTokenContests($token, $idContest){
		
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_product_number=:token AND id_contest=:idContest";
		$criteria->params = array (
				":token" => $token,
				':idContest'=>$idContest
		);
		
		$producto = ConProducts::model ()->find ( $criteria );
		return $producto;
	}
}
