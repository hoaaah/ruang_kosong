<?php
Yii::import('zii.widgets.CMenu', true);

class ActiveMenu extends CMenu
{
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        //$criteria->condition = '`status` = 1';
        $criteria->order = '`tahun` DESC';

        $items = Sources::model()->findAll($criteria);

        foreach ($items as $item)
            $this->items[] = array('label'=>'Tahun Anggaran '.$item->tahun, 'url'=>array('site/ta&id='.$item->tahun));
        
        parent::init();
    }
}