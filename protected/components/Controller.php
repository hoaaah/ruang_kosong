<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	

/*
    public function init(){
		

	Yii::app()->theme = 'abound';									
      parent::init();

    }	
*/
	public $user_log;
        public function init(){
            IF(isset(Yii::app()->user->Id)){
                $this->user_log=User::model()->find(array(
					'select'=>'*',
					'condition'=>'id=:id',
					'params'=>array(':id'=>Yii::app()->user->Id),
				));               
            }
		//Yii::app()->theme = Yii::app()->user->getCurrentTheme();
		
		parent::init();
	}	 
}