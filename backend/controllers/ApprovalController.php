<?php

namespace backend\controllers;

use Yii;
use app\models\Approval;
use app\models\ApprovalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use app\models\Employee;
use app\models\Location;

use app\models\EmployeeHasApprovalSearch;
use app\models\EmployeeHasApproval;

/**
 * ApprovalController implements the CRUD actions for Approval model.
 */
class ApprovalController extends Controller
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
     * Lists all Approval models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApprovalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Approval model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = New EmployeeHasApprovalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Creates a new Approval model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Approval();
        
        $employee = ArrayHelper::map(Employee::find()->all(), 'id', 'first_name');
        $dt_level = ArrayHelper::map(
                [
                    ['id'=>1, 'name'=>'Supervisor'],
                    ['id'=>2, 'name'=>'Manager'],
                    ['id'=>3, 'name'=>'Deputi'],
                ],
                'id', 'name'
        );
        $location = ArrayHelper::map(Location::find()->all(), 'id', 'location_name');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'employee'=>$employee, 'dt_level'=>$dt_level,
                'location'=>$location,
            ]);
        }
    }

    /**
     * Updates an existing Approval model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $employee = ArrayHelper::map(EMployee::find()->all(), 'id', 'first_name');
        $dt_level = ArrayHelper::map(
                [
                    ['id'=>1, 'name'=>'Supervisor'],
                    ['id'=>2, 'name'=>'Manager'],
                    ['id'=>3, 'name'=>'Deputi'],
                ],
                'id', 'name'
        );
        $location = ArrayHelper::map(Location::find()->all(), 'id', 'location_name');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 
                'employee'=>$employee, 'dt_level'=>$dt_level,
                'location'=>$location,
            ]);
        }
    }

    /**
     * Deletes an existing Approval model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionAddemployeeapprove()
    {
        
    }

    /**
     * Finds the Approval model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Approval the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Approval::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
