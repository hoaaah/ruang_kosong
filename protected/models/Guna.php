<?php

/**
 * This is the model class for table "t_guna".
 *
 * The followings are the available columns in table 't_guna':
 * @property integer $id
 * @property integer $user_id
 * @property integer $kelas_id
 * @property string $DateCreate
 * @property string $tanggal_guna
 * @property integer $session_id
 * @property string $mata_kuliah
 */
class Guna extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_guna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, kelas_id, session_id', 'numerical', 'integerOnly'=>true),
			array('mata_kuliah', 'length', 'max'=>100),
			array('DateCreate, tanggal_guna', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, kelas_id, DateCreate, tanggal_guna, session_id, mata_kuliah', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'kelas_id' => 'Kelas',
			'DateCreate' => 'Date Create',
			'tanggal_guna' => 'Tanggal Guna',
			'session_id' => 'Session',
			'mata_kuliah' => 'Mata Kuliah',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('kelas_id',$this->kelas_id);
		$criteria->compare('DateCreate',$this->DateCreate,true);
		$criteria->compare('tanggal_guna',$this->tanggal_guna,true);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('mata_kuliah',$this->mata_kuliah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Guna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
