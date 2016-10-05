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
class FrontendNavigate extends \firdows\menu\models\Navigate {

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;

        switch ($router) {            

            case "{$module}/default/index":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultIndexSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                //$count = $count ? Html::tag('b',  ' ('.$count.')',['class'=>'text-default']) : '';
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;
            
            case "{$module}/default/draft":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultDraftSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('b',  ' ('.$count.')',['class'=>'text-danger']) : '';
                break;
            
            case "{$module}/default/offer":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultOfferSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                //$count = $count ? Html::tag('span',  $count,['class'=>'label label-warning pull-right']) : '';
                $count = $count ? Html::tag('span',  $count,['class'=>'badge pull-right']) : '';
                break;
            
            
            case "{$module}/default/result":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultResultSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                //$count = $count ? Html::tag('span',  $count,['class'=>'label label-warning pull-right']) : '';
                $count = $count ? Html::tag('b',  ' ('.$count.')') : '';
                break;
            
            case "{$module}/default/returned":
                $searchModel = new \suPnPsu\reserveRoom\models\RoomReserveDefaultReturnedSearch;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                //$count = $count ? Html::tag('span',  $count,['class'=>'label label-warning pull-right']) : '';
                $count = $count ? Html::tag('b',  ' ('.$count.')') : '';
                break;

        }
        
        return $count;
    }

}
