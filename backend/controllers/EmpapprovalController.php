<?php

namespace backend\controllers;

use Yii;
use app\models\EmployeeHasApproval;
use app\models\EmpApprovalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpapprovalController implements the CRUD actions for EmployeeHasApproval model.
 */
class EmpapprovalController extends Controller
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
     * Lists all EmployeeHasApproval models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpApprovalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmployeeHasApproval model.
     * @param integer $employee_id
     * @param integer $approval_id
     * @return mixed
     */
    public function actionView($employee_id, $approval_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($employee_id, $approval_id),
        ]);
    }

    /**
     * Creates a new EmployeeHasApproval model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmployeeHasApproval();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'employee_id' => $model->employee_id, 'approval_id' => $model->approval_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EmployeeHasApproval model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $employee_id
     * @param integer $approval_id
     * @return mixed
     */
    public function actionUpdate($employee_id, $approval_id)
    {
        $model = $this->findModel($employee_id, $approval_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'employee_id' => $model->employee_id, 'approval_id' => $model->approval_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EmployeeHasApproval model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $employee_id
     * @param integer $approval_id
     * @return mixed
     */
    public function actionDelete($employee_id, $approval_id)
    {
        $this->findModel($employee_id, $approval_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmployeeHasApproval model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $employee_id
     * @param integer $approval_id
     * @return EmployeeHasApproval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($employee_id, $approval_id)
    {
        if (($model = EmployeeHasApproval::findOne(['employee_id' => $employee_id, 'approval_id' => $approval_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
