<?php

/**
 * This is the model class for table "2gom_view_calificacion_final".
 *
 * The followings are the available columns in table '2gom_view_calificacion_final':
 * @property string $id_pic
 * @property string $b_status
 * @property string $txt_name
 * @property string $txt_name_es
 * @property string $txt_pic_number
 * @property string $txt_usuario_number
 * @property string $id_contest
 * @property string $id_category
 * @property string $txt_file_name
 * @property string $txt_pic_name
 * @property integer $b_mencion
 * @property string $ID
 * @property string $display_name
 * @property string $txt_email
 * @property string $b_calificada
 * @property string $num_calificacion
 * @property string $num_calificacion_maxima
 * @property string $num_calificacion_minima
 * @property string $num_suma_calificacion
 * @property string $num_calificacion_nueva
 * @property string $b_empate
 * @property string $b_empate_alterno
 * @property string $num_calificacion_desempate
 * @property string $b_calificada_desempate
 */
class ViewCalificacionFinal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '2gom_view_calificacion_final';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('txt_name, txt_name_es', 'required'),
			array('b_mencion', 'numerical', 'integerOnly'=>true),
			array('id_pic, b_status, id_contest, id_category, ID, b_empate, b_empate_alterno', 'length', 'max'=>11),
			array('txt_name, txt_name_es, txt_pic_number, txt_usuario_number, display_name, txt_email', 'length', 'max'=>50),
			array('txt_file_name, txt_pic_name', 'length', 'max'=>150),
			array('b_calificada, num_calificacion, num_suma_calificacion, b_calificada_desempate', 'length', 'max'=>16),
			array('num_calificacion_maxima, num_calificacion_minima, num_calificacion_desempate', 'length', 'max'=>32),
			array('num_calificacion_nueva', 'length', 'max'=>38),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pic, b_status, txt_name, txt_name_es, txt_pic_number, txt_usuario_number, id_contest, id_category, txt_file_name, txt_pic_name, b_mencion, ID, display_name, txt_email, b_calificada, num_calificacion, num_calificacion_maxima, num_calificacion_minima, num_suma_calificacion, num_calificacion_nueva, b_empate, b_empate_alterno, num_calificacion_desempate, b_calificada_desempate', 'safe', 'on'=>'search'),
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
			'id_pic' => 'Id Pic',
			'b_status' => 'B Status',
			'txt_name' => 'Txt Name',
			'txt_name_es' => 'Txt Name Es',
			'txt_pic_number' => 'Txt Pic Number',
			'txt_usuario_number' => 'Txt Usuario Number',
			'id_contest' => 'Id Contest',
			'id_category' => 'Id Category',
			'txt_file_name' => 'Txt File Name',
			'txt_pic_name' => 'Txt Pic Name',
			'b_mencion' => 'B Mencion',
			'ID' => 'ID',
			'display_name' => 'Display Name',
			'txt_email' => 'Txt Email',
			'b_calificada' => 'B Calificada',
			'num_calificacion' => 'Num Calificacion',
			'num_calificacion_maxima' => 'Num Calificacion Maxima',
			'num_calificacion_minima' => 'Num Calificacion Minima',
			'num_suma_calificacion' => 'Num Suma Calificacion',
			'num_calificacion_nueva' => 'Num Calificacion Nueva',
			'b_empate' => 'B Empate',
			'b_empate_alterno' => 'B Empate Alterno',
			'num_calificacion_desempate' => 'Num Calificacion Desempate',
			'b_calificada_desempate' => 'B Calificada Desempate',
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

		$criteria->compare('id_pic',$this->id_pic,true);
		$criteria->compare('b_status',$this->b_status,true);
		$criteria->compare('txt_name',$this->txt_name,true);
		$criteria->compare('txt_name_es',$this->txt_name_es,true);
		$criteria->compare('txt_pic_number',$this->txt_pic_number,true);
		$criteria->compare('txt_usuario_number',$this->txt_usuario_number,true);
		$criteria->compare('id_contest',$this->id_contest,true);
		$criteria->compare('id_category',$this->id_category,true);
		$criteria->compare('txt_file_name',$this->txt_file_name,true);
		$criteria->compare('txt_pic_name',$this->txt_pic_name,true);
		$criteria->compare('b_mencion',$this->b_mencion);
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('display_name',$this->display_name,true);
		$criteria->compare('txt_email',$this->txt_email,true);
		$criteria->compare('b_calificada',$this->b_calificada,true);
		$criteria->compare('num_calificacion',$this->num_calificacion,true);
		$criteria->compare('num_calificacion_maxima',$this->num_calificacion_maxima,true);
		$criteria->compare('num_calificacion_minima',$this->num_calificacion_minima,true);
		$criteria->compare('num_suma_calificacion',$this->num_suma_calificacion,true);
		$criteria->compare('num_calificacion_nueva',$this->num_calificacion_nueva,true);
		$criteria->compare('b_empate',$this->b_empate,true);
		$criteria->compare('b_empate_alterno',$this->b_empate_alterno,true);
		$criteria->compare('num_calificacion_desempate',$this->num_calificacion_desempate,true);
		$criteria->compare('b_calificada_desempate',$this->b_calificada_desempate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewCalificacionFinal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
