<?php
 Yii::import('zii.widgets.CPortlet');
  class SubMenu extends CPortlet
  {
    public $title;
    public $menu;
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        //$criteria->condition = '`status` = 1';
        $criteria->order = '`tahun` ASC';

        $items = Sources::model()->findAll($criteria);

        foreach ($items as $item)
            $this->items[] = array('label'=>'Tahun Anggaran '.$item->tahun, 'url'=>$item->tahun);
        
        parent::init();
    }
  }