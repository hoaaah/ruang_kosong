<?php

/**
 * This is the model class for table "r_guna".
 *
 * The followings are the available columns in table 'r_guna':
 * @property integer $id
 * @property integer $user_id
 * @property integer $kelas_id
 * @property string $DateCreate
 * @property string $tanggal_guna
 * @property string $session_length
 * @property string $mata_kuliah
 * @property integer $status
 * @property string $dari
 * @property integer $jumlah_peserta
 * @property string $penanggung_jawab
 * @property integer $konsumsi
 * @property integer $tor_kak
 * @property string $approver
 * @property string $approval_date
 * @property string $catatan
 *
 * The followings are the available model relations:
 * @property RKelas $kelas
 */
class RGuna extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'r_guna';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, kelas_id, status, jumlah_peserta, konsumsi, tor_kak', 'numerical', 'integerOnly'=>true),
			array('session_length, dari, penanggung_jawab, approver, catatan, yang_mengajukan', 'length', 'max'=>200),
			array('mata_kuliah', 'length', 'max'=>100),
			array('DateCreate, tanggal_guna, approval_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, kelas_id, DateCreate, tanggal_guna, session_length, mata_kuliah, status, dari, jumlah_peserta, penanggung_jawab, konsumsi, tor_kak, approver, approval_date, catatan', 'safe', 'on'=>'search'),
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
			'kelas' => array(self::BELONGS_TO, 'RKelas', 'kelas_id'),
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
			'session_length' => 'Session Length',
			'mata_kuliah' => 'Mata Kuliah',
			'status' => 'Status',
			'dari' => 'Dari',
			'jumlah_peserta' => 'Jumlah Peserta',
			'penanggung_jawab' => 'Penanggung Jawab',
			'konsumsi' => 'Konsumsi',
			'tor_kak' => 'Tor Kak',
			'approver' => 'Yang menyetujui',
			'approval_date' => 'Tanggal Persetujuan',
			'catatan' => 'Catatan',
			'yang_mengajukan' => 'Yang Mengajukan'
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
		$criteria->compare('session_length',$this->session_length,true);
		$criteria->compare('mata_kuliah',$this->mata_kuliah,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('dari',$this->dari,true);
		$criteria->compare('jumlah_peserta',$this->jumlah_peserta);
		$criteria->compare('penanggung_jawab',$this->penanggung_jawab,true);
		$criteria->compare('konsumsi',$this->konsumsi);
		$criteria->compare('tor_kak',$this->tor_kak);
		$criteria->compare('approver',$this->approver,true);
		$criteria->compare('approval_date',$this->approval_date,true);
		$criteria->compare('catatan',$this->catatan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RGuna the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
