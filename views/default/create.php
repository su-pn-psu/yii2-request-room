<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = Yii::t('app', 'Create Room Reserve');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Reserves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
 

    <div class='box-body pad'>
        <div class="room-reserve-create">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
