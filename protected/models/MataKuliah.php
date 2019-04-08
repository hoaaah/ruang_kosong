<?php

/**
 * This is the model class for table "r_mata_kuliah".
 *
 * The followings are the available columns in table 'r_mata_kuliah':
 * @property integer $id
 * @property integer $kampus_id
 * @property integer $jurusan_id
 * @property integer $semester
 * @property string $name
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property string $dosen
 * @property integer $kategori
 * @property string $dasar_hukum
 */
class MataKuliah extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_mata_kuliah';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kampus_id, jurusan_id, semester, user_id, kategori', 'numerical', 'integerOnly'=>true),
			array('name, dosen, dasar_hukum', 'length', 'max'=>100),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kampus_id, jurusan_id, semester, name, created, updated, user_id, dosen, kategori, dasar_hukum', 'safe', 'on'=>'search'),
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
			'jurusan_id' => 'Jurusan',
			'semester' => 'Semester',
			'name' => 'Name',
			'created' => 'Created',
			'updated' => 'Updated',
			'user_id' => 'User',
			'dosen' => 'Dosen',
			'kategori' => 'Kategori',
			'dasar_hukum' => 'Dasar Hukum',
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
		$criteria->compare('kampus_id',$this->kampus_id);
		$criteria->compare('jurusan_id',$this->jurusan_id);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('dosen',$this->dosen,true);
		$criteria->compare('kategori',$this->kategori);
		$criteria->compare('dasar_hukum',$this->dasar_hukum,true);
     /*
                return new CActiveDataProvider(get_class($this), array(
                       'pagination'=>array(
                               'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                       ),
                       'criteria'=>$criteria,
                ));               
     */
		return new CActiveDataProvider($this, array(
			'Pagination' => array (
                                'PageSize' =>24 //edit your number items per page here
                        ),

                        'criteria'=>$criteria,
		));

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MataKuliah the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
