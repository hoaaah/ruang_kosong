<?php

class Bookguna extends CFormModel
{
	public $gedung_id;
	public $kelas_id;
	public $DateCreate;
	public $user_id;
	public $tanggal_guna;
	public $session_id;
	public $mata_kuliah;
	public $col1;
	public $col2;
	public $col3;
	public $col4;
	public $col5;
	public $col6;
	public $col7;
	public $col8;
	public $col9;
	public $col10;
	public $col11;
	public $col12;
	public $col13;
	public $col14;
	public $col15;
	public $col16;
	public $col17;
	public $col18;
	public $col19;
	public $col20;
	public $col21;
	public $col22;
	public $weeks;

	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('kelas_id, mata_kuliah, tanggal_guna', 'required'),
			array(' col1,
				    col2,
					col3,
					col4,
					col5,
					col6,
					col7,
					col8,
					col9,
					col10,
					col11,
					col12,
					col13,
					col14,
					col15,
					col16,
					col17,
					col18,
					col19,
					col20,
					col21,
					col22, weeks,',
					'numerical', 'integerOnly'=>true
					//'boolean'
					),
			array('kelas_id, gedung_id, mata_kuliah,col1,
				    col2,
					col3,
					col4,
					col5,
					col6,
					col7,
					col8,
					col9,
					col10,
					col11,
					col12,
					col13,
					col14,
					col15,
					col16,
					col17,
					col18,
					col19,
					col20,
					col21,
					col22, weeks, tanggal_guna', 'safe', 'on'=>'search'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'gedung_id' => 'Gedung',
			'kelas_id' => 'Kelas',
			'tanggal_guna' => 'Tanggal Mulai',
			'session_id' => 'sesi',
			'mata_kuliah' => 'Mata Kuliah',
			'weeks' => 'Jumlah Minggu',
			
		);
	}	

}