<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property integer $user_id
 * @property string $tag
 * @property string $content
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 */
class Notification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, tag, content, tgl_mulai, tgl_selesai', 'required'),
			array('user_id, kampus_id', 'numerical', 'integerOnly'=>true),
			array('tag', 'length', 'max'=>20),
			array('content', 'length', 'max'=>10000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, kampus_id, tag, content, tgl_mulai, tgl_selesai', 'safe', 'on'=>'search'),
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
                    'userid' => array(self::BELONGS_TO, 'User', 'user_id'),                    
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
                        'user_id' => 'User',
			'tag' => 'Tag',
			'content' => 'Content',
			'tgl_mulai' => 'Ditampilkan Mulai',
			'tgl_selesai' => 'Akhir ditampilkan',
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
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tgl_mulai',$this->tgl_mulai,true);
		$criteria->compare('tgl_selesai',$this->tgl_selesai,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
