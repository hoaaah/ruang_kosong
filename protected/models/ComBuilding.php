<?php

/**
 * This is the model class for table "com_building".
 *
 * The followings are the available columns in table 'com_building':
 * @property integer $id
 * @property integer $building_id
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 * @property string $comment
 * @property string $image
 * @property integer $attend_id
 */
class ComBuilding extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'com_building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('building_id, user_id, attend_id', 'numerical', 'integerOnly'=>true),
			array('created, updated, comment, image', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, building_id, user_id, created, updated, comment, image, attend_id', 'safe', 'on'=>'search'),
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
			'building_id' => 'Building',
			'user_id' => 'User',
			'created' => 'Created',
			'updated' => 'Updated',
			'comment' => 'Comment',
			'image' => 'Image',
			'attend_id' => 'Attend',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('attend_id',$this->attend_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ComBuilding the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
