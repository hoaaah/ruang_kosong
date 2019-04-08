<?php
$this->breadcrumbs=array(
        'complaint',
);
echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Berikut adalah daftar seluruh ruang dan atributnya. Biru menunjukkan kondisi baik, merah menunjukkan kondisi rusak/bermasalah. Klik untuk merubah kondisi atribut ruang.</em><br>';                                
?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th width="15%">Ruang</th>
                <th>Attribute</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $kelas_id = 0;
                foreach( $complaint as $c) :?>
                <?php 
                IF($kelas_id <> $c['kelas_id'] && $kelas_id ==0){
                    echo '  </tr> <td>'
                    .$c['kelas'].'</td>'
                        . '<td>';
                }ELSEIF($kelas_id <> $c['kelas_id']){
                    echo '</td>  </tr> <td>'
                    .$c['kelas'].'</td>'
                        . '<td>';
                }
                IF($c['kondisi'] == 0){
                    echo CHtml::link('<button type="button" class="btn btn-xs btn-info">'.$c['abbr'].'</button>',Yii::app()->createUrl('Site/broken', array('id'=>$c['id'])), array('confirm' => 'Atribut ini Rusak?'));
                    //echo CHtml::button($c['abbr'], array('class' => 'btn btn-xs btn-info','link' =>Yii::app()->createUrl("/site/broke", array("id" => $c['id'])), 'confirm'=>'Are you sure?'/*, 'name'=>'accept'*/));
                }ElSEIF($c['kondisi'] == 1){
                    echo CHtml::link('<button type="button" class="btn btn-xs btn-danger">'.$c['abbr'].'</button>',Yii::app()->createUrl('Site/fixed', array('id'=>$c['id'])), array('confirm' => 'Sudah Diperbaiki?'));  
                }    
                ?>
                <?php $kelas_id = $c['kelas_id'];?>

                <?php            endforeach; ?>            
            </tr>
        </tbody>
    </table>
</div>