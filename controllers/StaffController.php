<?php

namespace suPnPsu\reserveRoom\controllers;

use Yii;
use suPnPsu\reserveRoom\models\RoomReserve;
use suPnPsu\reserveRoom\models\RoomReserveStaffIndexSearch;
use suPnPsu\reserveRoom\models\RoomReserveStaffUseSearch;
use suPnPsu\reserveRoom\models\RoomReserveStaffReturnedSearch;
use suPnPsu\reserveRoom\models\RoomReserveStaffAllSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StaffController implements the CRUD actions for RoomReserve model.
 */
class StaffController extends Controller {

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
        $searchModel = new RoomReserveStaffIndexSearch();
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

    public function actionConsider($id) {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->confirmed_by = Yii::$app->user->id;
            $model->confirmed_at = time();
            $model->status = $model->confirmed_status ? 2 : 3;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
                exit();
            }
        }
        return $this->render('consider', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new RoomReserve model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RoomReserve();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RoomReserve model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
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

    public function actionUse() {
        $searchModel = new RoomReserveStaffUseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('use', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRemand($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->returned_by = Yii::$app->user->id;
            $model->returned_at = time();
            if ($model->returned_status) {
                $model->status = 4;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
                exit();
            }
        }
        return $this->render('remand', [
                    'model' => $model,
        ]);
    }
    
    public function actionReturned() {
        $searchModel = new RoomReserveStaffReturnedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('returned', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAll() {
        $searchModel = new RoomReserveStaffAllSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }


}
