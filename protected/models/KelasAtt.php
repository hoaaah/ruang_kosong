<?php

/**
 * This is the model class for table "r_kelas_att".
 *
 * The followings are the available columns in table 'r_kelas_att':
 * @property integer $id
 * @property integer $kelas_id
 * @property integer $attrib_id
 * @property string $name
 * @property string $DateCreate
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Kelas $kelas
 * @property Attribute $attrib
 */
class KelasAtt extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_kelas_att';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kelas_id, attrib_id', 'required'),
			array('kelas_id, attrib_id, user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('DateCreate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kelas_id, attrib_id, name, DateCreate, user_id', 'safe', 'on'=>'search'),
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
			'kelas' => array(self::BELONGS_TO, 'Kelas', 'kelas_id'),
			'attrib' => array(self::BELONGS_TO, 'Attribute', 'attrib_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kelas_id' => 'Kelas',
			'attrib_id' => 'Attrib',
			'name' => 'Misal AC1, AC2, Proyektor1',
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
		$criteria->compare('kelas_id',$this->kelas_id);
		$criteria->compare('attrib_id',$this->attrib_id);
		$criteria->compare('name',$this->name,true);
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
	 * @return KelasAtt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
