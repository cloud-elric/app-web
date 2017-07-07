<?php

/**
 * This is the model class for table "2gom_wrk_pics_calificaciones".
 *
 * The followings are the available columns in table '2gom_wrk_pics_calificaciones':
 * @property string $id_calificacion
 * @property string $id_juez
 * @property string $id_pic
 * @property string $id_rubro
 * @property string $num_calificacion
 * @property string $txt_retro
 * @property string $fch_calificacion
 *
 * The followings are the available model relations:
 * @property 2gomCatCalificacionesRubros $idRubro
 * @property 2gomEntJueces $idJuez
 * @property 2gomWrkPics $idPic
 */
class WrkPicsCalificaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_wrk_pics_calificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_juez, id_pic, id_rubro, num_calificacion', 'required'),
			array('id_juez, id_pic, id_rubro, num_calificacion', 'length', 'max'=>10),
			array('txt_retro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_calificacion, id_juez, id_pic, id_rubro, num_calificacion, txt_retro, fch_calificacion', 'safe', 'on'=>'search'),
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
			'idCategoriaPropuesta' => array(self::BELONGS_TO, 'Categoiries', 'id_categoria_propuesta'),
			'idRubro' => array(self::BELONGS_TO, 'CatCalificacionesRubros', 'id_rubro'),
			'idJuez' => array(self::BELONGS_TO, 'EntJueces', 'id_juez'),
			'idPic' => array(self::BELONGS_TO, '2gomWrkPics', 'id_pic'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_calificacion' => 'Id Calificacion',
			'id_juez' => 'Id Juez',
			'id_pic' => 'Id Pic',
			'id_rubro' => 'Id Rubro',
			'num_calificacion' => 'Num Calificacion',
			'txt_retro' => 'Txt Retro',
			'fch_calificacion' => 'Fch Calificacion',
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

		$criteria->compare('id_calificacion',$this->id_calificacion,true);
		$criteria->compare('id_juez',$this->id_juez,true);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('id_rubro',$this->id_rubro,true);
		$criteria->compare('num_calificacion',$this->num_calificacion,true);
		$criteria->compare('txt_retro',$this->txt_retro,true);
		$criteria->compare('fch_calificacion',$this->fch_calificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WrkPicsCalificaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
