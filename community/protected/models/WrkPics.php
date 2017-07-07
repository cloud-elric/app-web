<?php

/**
 * This is the model class for table "2gom_wrk_pics".
 *
 * The followings are the available columns in table '2gom_wrk_pics':
 * @property string $id_pic
 * @property string $ID
 * @property string $id_category_original
 * @property string $id_category
 * @property string $id_contest
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property string $txt_pic_desc
 * @property integer $b_mencion
 */
class WrkPics extends CActiveRecord {
	public $validado;
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '2gom_wrk_pics';
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
						'ID',
						'required' 
				),
				array (
						'b_mencion',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'ID',
						'length',
						'max' => 20 
				),
				array (
						'id_category_original, id_category, id_contest',
						'length',
						'max' => 11 
				),
				array (
						'txt_file_name, txt_pic_name',
						'length',
						'max' => 150 
				),
				array (
						'txt_pic_desc',
						'length',
						'max' => 1500 
				),
				array(
					'id_category_original, txt_file_name, txt_pic_name','required', 'on'=>'complete'
						
						
				),
				array (
						'validado',
						'validarFoto',
						'on' => 'incomplete' 
				),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array (
						'id_pic, ID, id_category_original, id_category, id_contest, txt_file_name, txt_pic_name, txt_pic_desc, b_mencion',
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
		return array (				'iD' => array(self::BELONGS_TO, 'UsrUsuarios', 'ID'),
				'idCategoriaOriginal' => array (
						self::BELONGS_TO,
						'ConCategoiries',
						'id_category_original' 
				),
				'idContest' => array (
						self::BELONGS_TO,
						'ConContests',
						'id_contest'
				)
		);
	}
	
	/**
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array (
				'id_pic' => 'Id Pic',
				'ID' => 'ID',
				'id_category_original' => 'Categoría',
				'id_category' => 'Id Category',
				'id_contest' => 'Id Contest',
				'txt_file_name' => 'Txt File Name',
				'txt_pic_name' => 'Nombre foto',
				'txt_pic_desc' => 'Descripción de la foto',
				'b_mencion' => 'B Mencion' 
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
		
		$criteria->compare ( 'id_pic', $this->id_pic, true );
		$criteria->compare ( 'ID', $this->ID, true );
		$criteria->compare ( 'id_category_original', $this->id_category_original, true );
		$criteria->compare ( 'id_category', $this->id_category, true );
		$criteria->compare ( 'id_contest', $this->id_contest, true );
		$criteria->compare ( 'txt_file_name', $this->txt_file_name, true );
		$criteria->compare ( 'txt_pic_name', $this->txt_pic_name, true );
		$criteria->compare ( 'txt_pic_desc', $this->txt_pic_desc, true );
		$criteria->compare ( 'b_mencion', $this->b_mencion );
		
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
	 * @return WrkPics the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * Valida si la foto es del usuario
	 */
	public static function validarUsuarioFoto($idConcurso, $idUsuario, $idFoto) {
		$criteria = new CDbCriteria ();
		$criteria->condition = "txt_pic_number=:idFoto AND ID=:idUsuario AND id_contest=:idConcurso";
		$criteria->params = array (
				":idFoto" => $idFoto,
				":idUsuario" => $idUsuario,
				":idConcurso" => $idConcurso 
		);
		
		$foto = WrkPics::model ()->find ( $criteria );
		
		return $foto;
	}
	
	/**
	 * Valida que todos los campos tengan registro
	 */
	public function validarFoto() {
		$titulo = empty ( $this->txt_pic_name );
		//$descripcion = empty ( $this->txt_pic_desc );
		$categoria = empty ( $this->id_category_original );
		$foto = empty ( $this->txt_file_name );
		
		if ($titulo ||  $categoria || $foto) {
			$this->addError ( "validado", "Foto incompleta" );
		}
	}
}
