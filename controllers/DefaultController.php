<?php

namespace suPnPsu\reserveRoom\controllers;

use Yii;
//use suPnPsu\room\models\Room;
use suPnPsu\reserveRoom\models\RoomReserve;
//use suPnPsu\reserveRoom\models\RoomReserveSearch;
use suPnPsu\reserveRoom\models\RoomReserveDefaultIndexSearch;
use suPnPsu\reserveRoom\models\RoomReserveDefaultDraftSearch;
use suPnPsu\reserveRoom\models\RoomReserveDefaultOfferSearch;
use suPnPsu\reserveRoom\models\RoomReserveDefaultResultSearch;
use suPnPsu\reserveRoom\models\RoomReserveDefaultReturnedSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\data\ActiveDataProvider;
//use suPnPsu\room\models\RoomSearch;
use suPnPsu\room\models\RoomListSearch;
use yii\helpers\Json;

/**
 * DefaultController implements the CRUD actions for RoomReserve model.
 */
class DefaultController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RoomReserve models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RoomReserveDefaultIndexSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RoomReserve model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RoomReserve model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RoomReserve();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();

            $model->status = 0;
            $model->user_id = Yii::$app->user->id;
            $model->created_by = Yii::$app->user->id;

            if ($model->save()) {
                if (isset($post['submit'])) {
                    return $this->redirect(['confirm', 'id' => $model->id]);
                }
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
                exit();
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing RoomReserve model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();

            $model->user_id = Yii::$app->user->id;
            $model->created_by = Yii::$app->user->id;
            //if(date('Y-m-d',strtotime("+3 day"))<)

            if ($model->save()) {
                if (isset($post['submit'])) {
                    return $this->redirect(['confirm', 'id' => $model->id]);
                }
            } else {
                print_r($model->getErrors());
                exit();
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RoomReserve model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RoomReserve model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RoomReserve the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RoomReserve::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    ##############################

    public function actionRoomList() {

        $searchModel = new RoomListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        //$this->view->title = 'รายการห้องทั้งหมด';
        return $this->renderPartial('room-list', [
                    //'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);

//        if (Yii::$app->request->isAjax) {
//            return $this->renderAjax('room-list', [
//                        //'model' => $model,
//                        'searchModel' => $searchModel,
//                        'dataProvider' => $dataProvider,
//            ]);
//        }else{            
//            return $this->renderPartial('room-list', [
//                    //'model' => $model,
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//        ]);
//        }
    }

    public function actionJsoncalendar($start = NULL, $end = NULL, $_ = NULL) {
        $events = RoomReserve::getActivity();
        header('Content-type: application/json');
        echo Json::encode($events);
        Yii::$app->end();
    }

    public function actionPresent() {
        $searchModel = new \suPnPsu\reserveRoom\models\RoomReservePresentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date_start' => SORT_ASC];
        return $this->renderPartial('present', [
                    //'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCheckRoom($start = NULL, $end = NULL) {

        //echo date("Y-m-d H:i:s");
        $date_start = date('Y-m-d', $start);
        $time_start = date('Y-m-d', $start);
        //echo "<br/>" ; 
        $model = RoomReserve::find()
                ->select(['room_id', 'time_start', 'time_end'])
                ->where([
                    'date_start' => $date_start,
                        //'time_start'=>$time_start,
                ])
                //->andWhere(['s'])
                ->all();
        $act_use = [];
        foreach ($model as $act) {
            $act_start = Yii::$app->formatter->asTimestamp($date_start . ' ' . $act->time_start);
            $act_end = Yii::$app->formatter->asTimestamp($date_start . ' ' . $act->time_end);
            $intime = false;
            //echo $act_start .date('H:i:s',$act_start).'='. $start.date('H:i:s',$start)."<br/>";
            if ($act_start <= $start && $act_end >= $start) {
                $intime = true;
            }
            if ($act_start <= $end && $act_end >= $end) {
                $intime = true;
            }

            if ($intime) {
                $act_use[] = ['room_id' => $act->room_id];
            }
        }
        //print_r($model);
        //echo Yii::$app->formatter->asDatetime(date("Y-m-d H:i:s"),'php:Y-m-d H:i:s');
        //echo "<br/>" ;       
        //echo Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"));
        //echo "<br/>" ;       
        //echo date('H:i:s',$start);
        //echo "<br/>" ;
        //echo date('Y-m-d H:i:s',$end);
        return json_encode($act_use);
    }

    public function actionConfirm($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->sent_at = time();
            $model->status = 1;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('confirm', [
                    'model' => $this->findModel($id),
        ]);
    }
    
    
    public function actionDraft() {
        $searchModel = new RoomReserveDefaultDraftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('draft', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionOffer() {
        $searchModel = new RoomReserveDefaultOfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('offer', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionResult() {
        $searchModel = new RoomReserveDefaultResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('result', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReturned() {
        $searchModel = new RoomReserveDefaultReturnedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('returned', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    

}
