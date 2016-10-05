<?php

namespace suPnPsu\reserveRoom\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Description of navigate
 *
 * @author madone
 */
class BackendNavigate extends \firdows\menu\models\Navigate {

    public function getCount($router) {
        $count = '';
        $module = Url::base() . '/' . Yii::$app->controller->module->id;

        //echo $router;
        //exit();

        switch ($router) {

            case "{$module}/staff/index":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveStaffIndexSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span', $count, ['class' => 'label pull-right label-warning']) : '';
                break;
            
            case "{$module}/staff/use":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveStaffUseSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('span', $count, ['class' => 'label pull-right label-info']) : '';
                break;
            
            case "{$module}/staff/returned":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveStaffReturnedSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('b',  ' ('.$count.')',['class'=>'']) : '';
                break;
            
            case "{$module}/staff/all":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveStaffAllSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('b',  ' ('.$count.')',['class'=>'']) : '';
                break;
           
        }

        return $count;
    }

}
