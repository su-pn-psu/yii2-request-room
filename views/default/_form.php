<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use suPnPsu\reserveRoom\assets\Asset;
use yii\web\View;
use yii\widgets\Pjax;
use kartik\widgets\Select2;
use suPnPsu\borrowMaterial\models\StdBelongto;
use suPnPsu\borrowMaterial\models\StdPosition;

$asset = Asset::register($this);

list(, $url) = Yii::$app->assetManager->publish('@suPnPsu/reserveRoom/assets');

$user = $model->user_id?$model->user:\suPnPsu\user\models\User::find(Yii::$app->user->id)->one();

/* @var $this yii\web\View */
/* @var $model suPnPsu\reserveRoom\models\RoomReserve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">


        <div class="row">
            <div class="col-md-12 text-center">
                <?php
                echo Html::img(['/uploads/images/PSU.png'], ['width' => '75px']);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 text-center col-sm-offset-1">
                <h3>แบบฟอร์มการขอยืมใช้ห้องประชุม</h3>
                <h4>องค์การบริหาร องค์การนักศึกษา มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตปัตตานี</h4>
            </div>
        </div>

        <div class="room">
            <div class="col-md-10 col-md-offset-2">
                <?php
                echo $user->profile->attributeLabels()['user_id'] . ' <u>' . $model->user->profile->user_id . '</u> ';
                echo $user->profile->attributeLabels()['fullname'] . ' <u>' . $model->user->profile->fullname . '</u> ';
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <?php Pjax::begin(['id' => 'belpjax']); ?>
                <?php
                echo $form->field($model, 'belongto_id', [                    
                    'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _belqadd" value="' . Url::to(['/borrow-material/default/qaddbelongto']) . '" title="add belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
                ])->widget(Select2::classname(), [
                    'data' => StdBelongto::getList(),
                    'options' => ['placeholder' => Yii::t('borrow-material', 'กรุณาเลือก...')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);

                //            ->dropDownList(
                //            $belongtolist,
                //            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);
                ?>
                <?php Pjax::end(); ?>
            </div>
            <div class="col-md-6">
                <?php Pjax::begin(['id' => 'posipjax']); ?>
                <?php
                echo $form->field($model, 'position_id', [                    
                    'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button type="button" class="btn btn-success _invttqadd" value="' . Url::to(['/borrow-material/default/qaddposition']) . '" title="add position of belong to" data-toggle="tooltip"><span class="glyphicon glyphicon-plus"></span></button></div>',
                ])->widget(Select2::classname(), [
                    'data' => StdPosition::getList(),
                    'options' => ['placeholder' => Yii::t('borrow-material', 'กรุณาเลือก...')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                //            ->dropDownList(
                //            $positionlist,
                //            ['prompt' => Yii::t( 'app', 'PleaseSelect')]);
                ?>
                <?php Pjax::end(); ?>
            </div>
        </div>



        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>        

        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'date_start')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => 'กรุณาเลือกวัน'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd',
                        //'daysOfWeekDisabled'=>true
                        //'datesDisabled'=> ['0','6']
                        'startDate'=> date('Y-m-d',strtotime("+3 day"))
                    ]
                ])
                ?>
            </div>
            <div class="col-md-3">
                <?=
                $form->field($model, 'time_start')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
            <div class="col-md-3">
                <?=
                $form->field($model, 'time_end')->widget(TimePicker::className(), [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                    ]
                ])
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                
                <?= $form->field($model, 'room_id')->hiddenInput()?>
                <div class="form-group">
                    <?= Html::button('+ เลือกห้อง', ['value' => Url::to(['/reserve-room/default/room-list']), 'title' => 'เลือกห้อง', 'class' => 'showModalButton btn btn-primary']); ?>
                </div>

                <div class="data">
                    <table class="table table-border">                        
                        <tr>
                            <th >ห้อง</th>
                            <th >รายละเอียด</th>
                            
                        </tr>
                        <tr>
                            <td class="room_tile">
                                <?=$model->room_id?$model->room->title:null?>
                            </td>
                            <td class="room_detail">
                                <?=$model->room_id?$model->room->details:null?>                           
                            </td>                            
                        </tr>
                    </table>
                </div>
                

            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-primary', 'name' => 'save']) ?>
            <?= Html::submitButton(Yii::t('app', 'ยืนใบขอใช้ห้อง'), ['class' => 'btn btn-success', 'name' => 'submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'size' => 'modal-lg',
        'clientOptions' => [
            'backdrop' => 'static',
        //'keyboard' => FALSE
        ],
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
    ]);
    echo "<div id='main-content'>" . Yii::$app->runAction('/reserve-room/default/room-list') . "</div>";
    Modal::end();



    $js = ' 
 var urlChkRoom = "' . Url::to(['/reserve-room/default/check-room'], true) . '";
';

    $this->registerJs($js, View::POS_HEAD);
    $this->registerJsFile($asset->baseUrl . '/js/create.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>
    
    <?php
    Modal::begin([
        'header' => 'Quick Op',
        'id' => 'modal1',
    ]);
    echo '<div id ="modalcontent"></div>';
    Modal::end();
    ?>