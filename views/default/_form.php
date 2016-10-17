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

$user = $model->user_id ? $model->user->profile->resultInfo : Yii::$app->user->identity->profile->resultInfo;

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

        <div class="row">
            <div class="col-sm-4 text-center col-sm-offset-8">
                วันที่ <?= Yii::$app->formatter->asDate(date("Y-m-d"), 'long') ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <br/>
                <br/>
                <p style="text-indent: 10%;line-height: 25px;">

                    ข้าพเจ้า
                    <span class="text-underline">
                        <?= $user->fullname; ?>
                    </span>

                    รหัสศึกษา
                    <span class="text-underline">
                        <?= $user->username; ?>
                    </span>

                    สาขาวิชา
                    <span class="text-underline">
                        <?= $user->major; ?>
                    </span>

                    คณะ
                    <span class="text-underline">
                        <?= $user->faculty; ?>
                    </span>
                </p>
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
                        'startDate' => date('Y-m-d', strtotime("+3 day"))
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

                
                <div class="form-group">
                    <?= Html::button('+ เลือกห้อง', ['value' => Url::to(['/reserve-room/default/room-list']), 'title' => 'เลือกห้อง', 'class' => 'showModalButton btn btn-primary']); ?>
                </div>
                <?= $form->field($model, 'room_id')->hiddenInput()->label(false) ?>
                <div class="data">
                    <table class="table table-bordered">                        
                        <tr>
                            <th >ห้อง</th>
                            <th >รายละเอียด</th>

                        </tr>
                        <tr>
                            <td class="room_tile">
                                <?= $model->room_id ? $model->room->title : null ?>
                            </td>
                            <td class="room_details">
                                <?= $model->room_id ? $model->room->details : null ?>                           
                            </td>                            
                        </tr>
                    </table>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-8 text-center">
                <br/><br/>
                ลงชื่อ 
                <span class="text-underline">
                    <?= $user->fullname; ?>
                </span>
                <?= $model->getAttributeLabel('user_id') ?> <br />
                (<span class="text-underline"> <?= $user->fullname ?> </span>) <br />
                <?=(new suPnPsu\user\models\Person)->getAttributeLabel('position_id').' '. ($user->position?$user->position->title:'-') ?> <br />
                <?=(new suPnPsu\user\models\Person)->getAttributeLabel('tel').' '. $user->tel ?> <br />

            </div>
        </div>



        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-primary', 'name' => 'save']) ?>
            <?= Html::submitButton(Yii::t('app', 'ยืนใบขอใช้ห้อง'), ['class' => 'btn btn-success', 'name' => 'submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
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