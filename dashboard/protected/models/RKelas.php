<?php

/**
 * This is the model class for table "r_kelas".
 *
 * The followings are the available columns in table 'r_kelas':
 * @property integer $id
 * @property integer $building_id
 * @property string $kelas
 * @property string $alias
 * @property string $image
 * @property string $keterangan
 *
 * The followings are the available model relations:
 * @property ComKelas[] $comKelases
 * @property RGuna[] $rGunas
 * @property RBuilding $building
 * @property RKelasAtt[] $rKelasAtts
 * @property RKelaspr[] $rKelasprs
 * @property TGuna[] $tGunas
 */
class RKelas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_kelas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('building_id', 'numerical', 'integerOnly'=>true),
			array('kelas', 'length', 'max'=>20),
			array('alias', 'length', 'max'=>50),
			array('image', 'length', 'max'=>100),
			array('keterangan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, building_id, kelas, alias, image, keterangan', 'safe', 'on'=>'search'),
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
			'comKelases' => array(self::HAS_MANY, 'ComKelas', 'kelas_id'),
			'rGunas' => array(self::HAS_MANY, 'RGuna', 'kelas_id'),
			'building' => array(self::BELONGS_TO, 'RBuilding', 'building_id'),
			'rKelasAtts' => array(self::HAS_MANY, 'RKelasAtt', 'kelas_id'),
			'rKelasprs' => array(self::HAS_MANY, 'RKelaspr', 'kelas_id'),
			'tGunas' => array(self::HAS_MANY, 'TGuna', 'kelas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'building_id' => 'Building',
			'kelas' => 'Kelas',
			'alias' => 'Alias',
			'image' => 'Image',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('building_id',$this->building_id);
		$criteria->compare('kelas',$this->kelas,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RKelas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
