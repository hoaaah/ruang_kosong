<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $kampus_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $sex
 * @property string $kota_lahir
 * @property string $tgl_lahir
 * @property string $keterangan
 * @property string $kelas
 * @property string $salt
 * @property string $image
 * @property string $r_count
 */
class Users extends CActiveRecord
{
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
			array('kampus_id, username, password, kelas', 'required'),
			array('kampus_id', 'length', 'max'=>2),
			array('username, password', 'length', 'max'=>40),
			array('name, kota_lahir, keterangan, kelas', 'length', 'max'=>50),
			array('sex', 'length', 'max'=>1),
			array('salt', 'length', 'max'=>32),
			array('image', 'length', 'max'=>255),
			array('r_count', 'length', 'max'=>10),
			array('tgl_lahir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kampus_id, username, password, name, sex, kota_lahir, tgl_lahir, keterangan, kelas, salt, image, r_count', 'safe', 'on'=>'search'),
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
			'kampus_id' => 'Kampus',
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'sex' => 'Sex',
			'kota_lahir' => 'Kota Lahir',
			'tgl_lahir' => 'Tgl Lahir',
			'keterangan' => 'Keterangan',
			'kelas' => 'Kelas',
			'salt' => 'Salt',
			'image' => 'Image',
			'r_count' => 'R Count',
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
		$criteria->compare('kampus_id',$this->kampus_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('kota_lahir',$this->kota_lahir,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('r_count',$this->r_count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
