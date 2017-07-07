<?php

/**
 * This is the model class for table "2gom_view_calificacion_by_rubro".
 *
 * The followings are the available columns in table '2gom_view_calificacion_by_rubro':
 * @property string $txt_nombre_rubro
 * @property string $id_rubro
 * @property string $id_pic
 * @property string $num_suma_calificaciones
 * @property string $num_calificacion_primedio
 * @property string $num_cantidad_jueces_calificado
 * @property string $num_calificacion_actual
 */
class ViewCalificacionByRubro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_calificacion_by_rubro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_nombre_rubro, id_rubro, id_pic', 'required'),
			array('txt_nombre_rubro', 'length', 'max'=>50),
			array('id_rubro, id_pic', 'length', 'max'=>10),
			array('num_suma_calificaciones', 'length', 'max'=>32),
			array('num_calificacion_primedio', 'length', 'max'=>14),
			array('num_cantidad_jueces_calificado', 'length', 'max'=>21),
			array('num_calificacion_actual', 'length', 'max'=>35),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('txt_nombre_rubro, id_rubro, id_pic, num_suma_calificaciones, num_calificacion_primedio, num_cantidad_jueces_calificado, num_calificacion_actual', 'safe', 'on'=>'search'),
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
			'txt_nombre_rubro' => 'Txt Nombre Rubro',
			'id_rubro' => 'Id Rubro',
			'id_pic' => 'Id Pic',
			'num_suma_calificaciones' => 'Num Suma Calificaciones',
			'num_calificacion_primedio' => 'Num Calificacion Primedio',
			'num_cantidad_jueces_calificado' => 'Num Cantidad Jueces Calificado',
			'num_calificacion_actual' => 'Num Calificacion Actual',
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

		$criteria->compare('txt_nombre_rubro',$this->txt_nombre_rubro,true);
		$criteria->compare('id_rubro',$this->id_rubro,true);
		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('num_suma_calificaciones',$this->num_suma_calificaciones,true);
		$criteria->compare('num_calificacion_primedio',$this->num_calificacion_primedio,true);
		$criteria->compare('num_cantidad_jueces_calificado',$this->num_cantidad_jueces_calificado,true);
		$criteria->compare('num_calificacion_actual',$this->num_calificacion_actual,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewCalificacionByRubro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
