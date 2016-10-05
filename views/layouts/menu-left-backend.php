<?php

use yii\bootstrap\Html;
use mdm\admin\components\Helper;
use yii\helpers\Url;

$module = $this->context->module->id;

$this->beginContent('@app/views/layouts/main.php')
?>

<div class="row">
    <div class="col-md-3 hidden-print">


        <?php /* if (Yii::$app->user->can('user')): ?>
          <a href="<?=Url::to(["/{$module}/default/create"])?>" class="btn btn-success btn-block margin-bottom"><i class="fa fa-plus"></i> ขอใช้ห้อง</a>

          <div class="box box-solid">
          <div class="box-header with-border">
          <h3 class="box-title">
          ระบบยืม-คืนพัสดุครุภัณฑ์
          </h3>

          </div>
          <div class="box-body no-padding">




          <?php
          $menuItems = [
          [
          'label' => Html::icon('cloud-upload') . ' ' . Yii::t('borrow-material', 'แบบฟอร์มที่ยังไม่ยื่น'),
          'url' => ['/borrow-material/default/draft'],
          ],
          [
          'label' => Html::icon('inbox') . ' ' . Yii::t('app', 'รออนุมัติ'),
          'url' => ['/borrow-material/default/submited'],
          ],
          [
          'label' => Html::icon('export') . ' ' . Yii::t('app', 'ยังไม่มารับ'),
          'url' => ['/borrow-material/default/approved'],
          ],
          [
          'label' => Html::icon('import') . ' ' . Yii::t('app', 'ยังไม่ส่งคืน'),
          'url' => ['/borrow-material/default/returned'],
          ],
          [
          'label' => Html::icon('duplicate') . ' ' . Yii::t('app', 'ข้อมูลทั้งหมด'),
          'url' => ['/borrow-material/default/all'],
          //'linkOptions' => [...],
          ],
          ];

          $menuItems = Helper::filter($menuItems);
          $menuItems = suPnPsu\borrowMaterial\components\FrontendNavigate::genCount($menuItems);
          //$nav = new Navigate();
          echo dmstr\widgets\Menu::widget([
          'options' => ['class' => 'nav nav-pills nav-stacked'],
          'encodeLabels' => false,
          //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
          'items' => $menuItems,
          ])
          ?>
          </div>
          </div>



          <?php endif; */ ?>


<?php if (Yii::$app->user->can('staff')): ?>


            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
    <?php /* =BaseStringHelper::truncate($this->title,20); */ ?>
                        สำหรับเจ้าหน้าที่
                    </h3>

                </div>
                <div class="box-body no-padding">

                    <?php
                    $menuItems = [
                            [
                            'label' => Html::icon('file') . ' ' . Yii::t('app', 'รายการพิจารณา'),
                            'url' => ["/{$module}/staff/index"], #1
                        ],
                            [
                            'label' => Html::icon('inbox') . ' ' . Yii::t('app', 'รายการใช้ห้อง'),
                            'url' => ["/{$module}/staff/use"],#2
                        ],
                            [
                            'label' => Html::icon('saved') . ' ' . Yii::t('app', 'รายการที่คืนแล้ว'),
                            'url' => ["/{$module}/staff/returned"],#4
                        ],
                            [
                            'label' => Html::icon('duplicate') . ' ' . Yii::t('app', 'รายการทั้งหมด'),
                            'url' => ["/{$module}/staff/all"],#1 #2 #3 #4
                      
                        ],
                    ];

                    $menuItems = Helper::filter($menuItems);
                    $menuItems = suPnPsu\reserveRoom\components\BackendNavigate::genCount($menuItems);
                    //$nav = new Navigate();
                    echo dmstr\widgets\Menu::widget([
                        'options' => ['class' => 'nav nav-pills nav-stacked'],
                        'encodeLabels' => false,
                        //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                        'items' => $menuItems,
                    ])
                    ?>

                </div>
                <!-- /.box-body -->
            </div>

<?php endif; ?>
    </div>
    <!-- /.col -->


    <div class="col-md-9">
<?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->


</div>


<?php $this->endContent(); ?>