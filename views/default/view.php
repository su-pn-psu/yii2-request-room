<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Reserves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>
    <div class='box-header'>
        <h3 class='box-title'><?= Html::encode($this->title) ?></h3>
    </div><!--box-header -->

    <div class='box-body pad'>
        <div class="room-reserve-view">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                ],
                ]) ?>
            </p>

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'id',
            'room_id',
            'subject',
            'date_start',
            'date_end',
            'time_start',
            'time_end',
            'status',
            'user_id',
            'confirmed_comment:ntext',
            'confirmed_by',
            'confirmed_at',
            'returned_comment:ntext',
            'returned_by',
            'returned_at',
            'note',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            ],
            ]) ?>

        </div>
    </div><!--box-body pad-->
</div><!--box box-info-->
