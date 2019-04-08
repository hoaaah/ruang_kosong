<?php

/**
 * This is the model class for table "r_kampus".
 *
 * The followings are the available columns in table 'r_kampus':
 * @property integer $id
 * @property string $kode_ptn
 * @property string $name
 * @property string $inisial
 * @property integer $established
 * @property string $rektor
 * @property string $kota
 * @property string $alamat
 * @property string $phone
 * @property string $website
 * @property string $keterangan
 * @property string $logo
 * @property string $image
 * @property string $akreditasi
 */
class Kampus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_kampus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('established', 'numerical', 'integerOnly'=>true),
			array('kode_ptn, inisial', 'length', 'max'=>10),
			array('name, rektor, kota, phone, website, logo, image', 'length', 'max'=>100),
			array('alamat, keterangan', 'length', 'max'=>255),
			array('akreditasi', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_ptn, name, inisial, established, rektor, kota, alamat, phone, website, keterangan, logo, image, akreditasi', 'safe', 'on'=>'search'),
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
			'kode_ptn' => 'Kode Ptn',
			'name' => 'Name',
			'inisial' => 'Inisial',
			'established' => 'Established',
			'rektor' => 'Rektor',
			'kota' => 'Kota',
			'alamat' => 'Alamat',
			'phone' => 'Phone',
			'website' => 'Website',
			'keterangan' => 'Keterangan',
			'logo' => 'Logo',
			'image' => 'Image',
			'akreditasi' => 'Akreditasi',
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
		$criteria->compare('kode_ptn',$this->kode_ptn,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('inisial',$this->inisial,true);
		$criteria->compare('established',$this->established);
		$criteria->compare('rektor',$this->rektor,true);
		$criteria->compare('kota',$this->kota,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('akreditasi',$this->akreditasi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kampus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
