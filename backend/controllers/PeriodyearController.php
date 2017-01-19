<?php

namespace backend\controllers;

use Yii;
use app\models\PeriodYear;
use app\models\PeriodYearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PeriodyearController implements the CRUD actions for PeriodYear model.
 */
class PeriodyearController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all PeriodYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeriodYearSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PeriodYear model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'hari_next'=>$this->dateNext($this->findModel($id)->date_start),
        ]);
    }

    
    /**
     * Creates a new PeriodYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PeriodYear();

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())){
            $model->date_end = $this->dateNext($model->date_start);
            $model->name_period = $this->datePeriodName($model->date_start);
            $model->date_day = $this->dateDay($model->date_start);
            $model->date_month = $this->dateMonth($model->date_start);
            $model->date_year = $this->dateYear($model->date_start);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PeriodYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())){
            $model->date_end = $this->dateNext($model->date_start);
            $model->name_period = $this->datePeriodName($model->date_start);
            $model->date_day = $this->dateDay($model->date_start);
            $model->date_month = $this->dateMonth($model->date_start);
            $model->date_year = $this->dateYear($model->date_start);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PeriodYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultipleDelete()
    {
        //$pk = Yii::$app->request->post('row_id');
        $pk = Yii::$app->request->post('row_id');
        foreach ($pk as $key => $value) 
        {
            //$sql = "DELETE FROM detilfaktor WHERE id = $value";
            //$query = Yii::$app->db->createCommand($sql)->execute();
            $this->findModel($value)->delete();
        }

        return $this->redirect(['index']);

    }

    /**
     * Finds the PeriodYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PeriodYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PeriodYear::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function dateNext($date_now)
    {
        $date1 = strtotime('+1 years',strtotime($date_now));
        return date('Y-m-d', strtotime('-1 days', $date1));
    }

    private function datePeriodName($date_now)
    {
        $var1 = strtotime($date_now);
        return date('F Y', strtotime($var1));
    }

    private function dateDay($date_now){        
        return date('d', strtotime($date_now));
    }

    private function dateMonth($date_now){
        return date('m', strtotime($date_now));
    }

    private function dateYear($date_now){
        return date('Y', strtotime($date_now));
    }


}
