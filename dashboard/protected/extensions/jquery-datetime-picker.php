<?php
$this->widget('ext.jquery-ui-timepicker.BJuiDateTimePicker',array(
    'model'=>$model,
    'attribute'=>'date_from',
    'type'=>'datetime', // available parameter is datetime or time
    //'language'=>'de', // default to english
    //'themeName'=>'sunny', // jquery ui theme, file is under assets folder
    'options'=>array( 
        // put your js options here check http://trentrichardson.com/examples/timepicker/#slider_examples for more info
        'timeFormat'=>'HH:mm:ss',
        'showSecond'=>true,
        'hourGrid'=>4,
        'minuteGrid'=>10,
    ),
    'htmlOptions'=>array(
        'class'=>'input-medium'
    )
));
?>