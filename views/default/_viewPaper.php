<?php

use yii\helpers\Html;
use suPnPsu\reserveRoom\models\RoomReserve;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = $model->user;
$model->sent_at = $model->sent_at ? $model->sent_at : date('Y-m-d');
$uploadUrl = $this->context->module->uploadUrl;
?>


<div class="row">
    <div class="col-md-12 text-center">
        <?php
        echo Html::img($uploadUrl . '/images/PSU.png', ['width' => '75px']);
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
    <div class="col-xs-4 col-xs-offset-8 col-sm-4 col-sm-offset-8 text-center ">

        วันที่ <?= Yii::$app->formatter->asDate($model->sent_at, 'long') ?>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <br/><br/>
        <p style="text-indent: 10%;line-height: 25px;">

            ข้าพเจ้า
            <span class="text-underline">
                <?= $model->user->profile->fullname; ?>
            </span>

            รหัสศึกษา
            <span class="text-underline">
                <?= $model->user->username; ?>
            </span>

            สาขาวิชา
            <span class="text-underline">
                <?= $model->user->profile->resultInfo->major; ?>
            </span>

            คณะ
            <span class="text-underline">
                <?= $model->user->profile->resultInfo->factory; ?>
            </span>

            สังกัดองค์กร
            <span class="text-underline">
                <?= $model->belongto_id ? $model->belongto->title : null ?>
            </span>

            ตำแหน่ง
            <span class="text-underline">
                <?= $model->position_id ? $model->position->title : null ?>
            </span>

            จะดำเนินการประชุมเรื่อง
            <span class="text-underline">
                <?= $model->subject ?>
            </span>

            ในวัน
            <span class="text-underline">
                <?= Yii::$app->formatter->asDate($model->date_start, 'medium') ?>
            </span>

            ตั้งเวลา
            <span class="text-underline">
                <?= Yii::$app->formatter->asTime($model->time_start) ?>
            </span>

            ถึง
            <span class="text-underline">
                <?= Yii::$app->formatter->asTime($model->time_end) ?>
            </span>

            และมีความประสงค์ที่จะใช้ห้องดังนี
        </p>


        <br class="hidden-print"/>

        <table class="table table-bordered">                        
            <tr>
                <th >ห้อง</th>
                <th >รายละเอียด</th>
            </tr>
            <tr>
                <td class="room_tile">
                    <?= $model->room->title ?>
                </td>
                <td class="room_details">
                    <?= $model->room->details ?>                           
                </td>                            
            </tr>
        </table>



        <p style="text-indent: 10%;">
            จึงเรียนมาเพื่อพิจารณา
        </p>

    </div>
</div>

<div class="row">
    <div class="col-xs-4 col-xs-offset-8 col-sm-4 col-sm-offset-8 text-center">
        <br/><br/>
        <p style="line-height: 25px;">
            ลงชื่อ 
            <span class="text-underline">
                <?= $user->profile->fullname ?>
            </span>        
            <?= $model->getAttributeLabel('user_id') ?> <br />


            (<span class="text-underline"><?= $user->profile->fullname ?></span>) <br />
                <?=(new suPnPsu\user\models\Person)->getAttributeLabel('position_id').' '. ($user->position?$user->position->title:'-') ?> <br />
                <?=(new suPnPsu\user\models\Person)->getAttributeLabel('tel').' '. $user->tel ?> <br />
        </p>

    </div>
</div>


<?php
if ($model->confirmed_status):
    $confirmBy = $model->confirmedBy->profile;
    ?>
    <hr />
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $confirmBy->widget ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="callout <?= ($model->confirmed_status ? 'callout-success' : 'callout-danger') ?>">
                <h4><i class="icon fa <?= ($model->confirmed_status ? 'fa-check' : 'fa-ban') ?>"></i> <?= yii\helpers\ArrayHelper::getValue(RoomReserve::getItemStatusConsider(), $model->confirmed_status) ?></h4>
            </div>


            <label><?= $model->getAttributeLabel('confirmed_comment') ?></label>
            <p><?= $model->confirmed_comment ?></p>              

        </div>
        <div class="box-footer">
            <?= Yii::$app->formatter->asDatetime($model->confirmed_at) ?>
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer -->
    </div>

<?php endif; ?>

    <?php
if ($model->returned_status):
    $returnedBy = $model->returnedBy->profile;
    ?>
    <hr />
    <div class="box box-widget">
        <div class="box-header with-border">
            <?= $returnedBy->widget ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="callout <?= ($model->returned_status ? 'callout-success' : 'callout-danger') ?>">
                <h4><i class="icon fa fa-check"></i> <?= $model->getAttributeLabel('confirmed_status') ?></h4>
            </div>


            <label><?= $model->getAttributeLabel('returned_comment') ?></label>
            <p><?= $model->returned_comment ?></p>              

        </div>
        <div class="box-footer">
            <?= Yii::$app->formatter->asDatetime($model->returned_at) ?>
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer -->
    </div>

<?php endif; ?>