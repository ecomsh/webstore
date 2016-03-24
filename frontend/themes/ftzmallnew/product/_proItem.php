<?php
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $model['id'];



?>
<li>
<?= Html::a('商品'.$model['id'], ['product/view', 'id' => $model['id'],'test'=>1], ['target'=>'_blank']) ?>
</li>