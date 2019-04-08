<?php

/**
 * This is the model class for table "r_building".
 *
 * The followings are the available columns in table 'r_building':
 * @property integer $id
 * @property string $kampus_id
 * @property string $name
 * @property string $alias
 * @property string $jurusan
 * @property string $image
 */
class Building extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kampus_id', 'length', 'max'=>10),
			array('name, alias, jurusan, image', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kampus_id, name, alias, jurusan, image', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'alias' => 'Alias',
			'jurusan' => 'Jurusan',
			'image' => 'Image',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('jurusan',$this->jurusan,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Building the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
