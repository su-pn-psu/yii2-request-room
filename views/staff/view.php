<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Reserves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = $model->user;
?>
<div class='box'>
    <div class='box-body'>
        <div class="row">
            <div class="col-md-12">
                <?=$this->render('../default/_viewPaper',['model'=>$model]);?>
            </div>
        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
