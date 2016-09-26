<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-reserve-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'room_id') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'date_start') ?>

    <?= $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'confirmed_comment') ?>

    <?php // echo $form->field($model, 'confirmed_by') ?>

    <?php // echo $form->field($model, 'confirmed_at') ?>

    <?php // echo $form->field($model, 'returned_comment') ?>

    <?php // echo $form->field($model, 'returned_by') ?>

    <?php // echo $form->field($model, 'returned_at') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
