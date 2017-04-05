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
use yii\db\ActiveQuery;

/**
 * ApprovalController implements the CRUD actions for Approval model.
 */
class ApprovalController extends Controller
{
    
   public $approval_id; 
   public $employee_id;
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
        
        //add new EmployeeHasApproval
        $model2 = new EmployeeHasApproval();
        $model2->approval_id = $id;
        $dt_employee = ArrayHelper::map(
            Employee::find()
                ->leftJoin('employee_has_approval b', 'b.employee_id = employee.id')
                ->andWhere('b.employee_id is Null')
                ->all()
            , 'id', 'first_name'
        );
        
        if ($model2->load(yii::$app->request->post()) && $model2->validate() && $model2->save()){
            return $this->redirect(['view', 'id'=>$id]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            'model2'=>$model2,
            'dt_employee'=>$dt_employee,
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
                'model' => $model,
                'employee'=>$employee, 
                'dt_level'=>$dt_level,
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
    
    public function actionDelete2($employee_id, $approval_id)
    {
        //$approval_id = 1;
        //$employee_id = 7;
        //$model2 = New EmployeeHasApproval();
        $model2= EmployeeHasApproval::findOne(['employee_id'=>$employee_id, 'approval_id'=>$approval_id]);
        $model2->approval_id = $approval_id;
        $model2->employee_id = $employee_id;
        //$model2->delete();
        if($model2->delete()){
            return $this->redirect(['view', 'id'=>$approval_id]);
        }
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
