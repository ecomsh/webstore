<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<tr class="ng-scope odd" role="row">
	<td class="ng-binding"><?= $index + 1; ?></td>
    <td class="ng-binding">
    	<?php 
		if($model->award_type == '1'){
			echo '微信红包';
		}else if($model->award_type == '2'){
			echo '优惠券';
		}else if($model->award_type == '3'){
			echo '商品';
		}
		?>
    </td>
    <td class="ng-binding"><?= Html::encode($model->award_name?$model->award_name:'--'); ?></td>
    <td class="ng-binding"><?= Html::encode($model->award_bn?$model->award_bn:'--'); ?></td>
    <td class="ng-binding"><?= Html::encode($model->award_store); ?></td>
    <td class="ng-binding"><?= Html::encode($model->award_rate); ?>‰</td>
    <td class="ng-binding">
    	<?php 
		if($model->award_state == '0'){
			echo '<span style="color:#f05050">禁用</span>';
		}else{
			echo '<span style="color:#27c24c">启用</span>';
		}
		?>
    </td>
    <td calss="ng-binding">
        <?= Html::a(Yii::t('app','编辑'), ['award/update', 'id' => $model->award_id], ['data-pjax' => 0]); ?>&nbsp;&nbsp;
        <?php 
		if($model->award_state == '0'){
			echo Html::a(Html::encode(Yii::t('app','启用')), ['award/changestate', 'id' => $model->award_id, 'state' => 1], ['data' => ['confirm' => Yii::t('app','确定启用?'),] , 'data-pjax' => 0]);
		}else{
			echo Html::a(Html::encode(Yii::t('app','禁用')), ['award/changestate', 'id' => $model->award_id, 'state' => 0], ['data' => ['confirm' => Yii::t('app','确定禁用?'),] , 'data-pjax' => 0]);
		}
		?>
    </td>
</tr>