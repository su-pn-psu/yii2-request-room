<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = Yii::t('app', 'ปรับแก้ฉบับร่าง {modelClass}: ', [
    'modelClass' => 'ขอใช้ในเรื่อง ',
]) . $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการขอใช้ห้อง'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class='box box-info'>    

    <div class='box-body pad'>
        <div class="room-reserve-update">
            
            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
