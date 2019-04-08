<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $bidang_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $keterangan
 * @property string $salt
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bidang_id, username, password', 'required'),
			array('bidang_id', 'length', 'max'=>2),
			array('username, password, name', 'length', 'max'=>40),
			array('keterangan', 'length', 'max'=>50),
			array('salt', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, bidang_id, username, password, name, keterangan, salt', 'safe', 'on'=>'search'),
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
			'bidang_id' => 'Bidang',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'keterangan' => 'Keterangan',
			'salt' => 'Salt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('bidang_id',$this->bidang_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('salt',$this->salt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
#Batas salt tambahan ---------------------------------------------------------
	// hash password
	public function hashPassword($password, $salt)
	{
		return md5($salt.$password);
	}
			
	// password validation
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
			
	//generate salt
	public function generateSalt()
	{
		return uniqid('',true);
	}
			
	public function beforeValidate()
	{
		$this->salt = $this->generateSalt();
		return parent::beforeValidate();
	}
			
	public function beforeSave()
	{
		$this->password = $this->hashPassword($this->password, $this->salt);
		return parent::beforeSave();
	}
}