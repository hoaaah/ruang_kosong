<?php

/**
 * This is the model class for table "t_kelas_att".
 *
 * The followings are the available columns in table 't_kelas_att':
 * @property integer $id
 * @property integer $kelas_attrib
 * @property integer $condition
 * @property string $detail
 * @property string $DateCreate
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property RKelasAtt $kelasAttrib
 */
class TKelasAtt extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_kelas_att';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kelas_attrib, condition, DateCreate, user_id', 'required'),
			array('kelas_attrib, condition, user_id', 'numerical', 'integerOnly'=>true),
			array('detail', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kelas_attrib, condition, detail, DateCreate, user_id', 'safe', 'on'=>'search'),
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
			'kelasAttrib' => array(self::BELONGS_TO, 'RKelasAtt', 'kelas_attrib'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kelas_attrib' => 'Refer ke ID r_kelas_att',
			'condition' => '0 baik, 1 rusak',
			'detail' => 'Opsional',
			'DateCreate' => 'Date Create',
			'user_id' => 'User',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kelas_attrib',$this->kelas_attrib);
		$criteria->compare('condition',$this->condition);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('DateCreate',$this->DateCreate,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TKelasAtt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
