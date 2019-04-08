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
		return 't_users';
	}



	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kampus_id, username, password', 'required'),
			array('kampus_id, tos, peran, sex, semester, preferred_building', 'length', 'max'=>2),
			array('kelas, jurusan_id', 'length', 'max'=>6),
			array('username, password, name, kota_lahir, email', 'length', 'max'=>40),
			array('keterangan', 'length', 'max'=>50),
			array('contact', 'numerical'),
			array('salt, contact', 'length', 'max'=>32),
			array('DateCreate, tgl_lahir, r_count', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kampus_id, username, password, name, keterangan, salt, r_count, jurusan_id, semester', 'safe', 'on'=>'search'),
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
                    'kampusid' => array(self::BELONGS_TO, 'Kampus', 'kampus_id'),
                    'jurusanid' => array(self::BELONGS_TO, 'Jurusan', 'jurusan_id'),
		    'buildingid' => array(self::BELONGS_TO, 'Building', 'preferred_building'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kampus_id' => 'Universitas',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'name' => 'Nama',
			'sex' => 'Jenis kelamin',
			'jurusan_id' => 'Jurusan',
			'semester' => 'Semester',
			'kota_lahir' => 'Tempat Lahir',
			'tgl_lahir' => 'Tanggal Lahir',
			'keterangan' => 'Keterangan Tambahan',
			'kelas' => 'Nama Kelas',
			'salt' => 'Salt',
			'image'=> 'Foto',
			'r_count' => 'Hold',
			'contact' => 'Phone',
			'peran' => 'Regist as',
			'preferred_building' => 'Gedung Favorit',
			'DateCreate' => 'DateCreate',
			'tos' => 'TOS',
	
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
		IF(Yii::app()->session['peran']>0 && Yii::app()->session['peran'] <=3){
			$criteria->addCondition("peran = 3");
			$criteria->addCondition("kampus_id = ".Yii::app()->session['kampus_id']);
		}			

		$criteria->compare('id',$this->id);
		$criteria->compare('kampus_id',$this->kampus_id,true);
		$criteria->compare('jurusan_id',$this->jurusan_id);
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('semester',$this->semester,true);
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