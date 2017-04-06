<?php

namespace backend\controllers;

use Yii;
use app\models\Leave;
use app\models\LeaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use app\models\LeaveType;
use app\models\LeaveRequest;
use app\models\Employee;


/**
 * LeaveController implements the CRUD actions for Leave model.
 */
class LeaveController extends Controller
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
     * Lists all Leave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leave model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Leave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leave();
        $leave_type = ArrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
        $leave_request = ArrayHelper::map(LeaveRequest::find()->all(), 'id','id');
        $employee = ArrayHelper::map(Employee::find()->all(),'id', 'first_name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'leave_type'=>$leave_type,               
                'leave_request'=>$leave_request,
                'employee'=>$employee, 
                
            ]);
        }
    }
    public function actionCreate2(){
        
        $model = new Leave();
        
        $request = Yii::$app->request;
        $leave_request_id= $request->get('leave_request_id');
        $leave_type_id= $request->get('leave_type_id');
        $employee_id= $request->get('employee_id');
        $model->leave_request_id = $leave_request_id;
        $model->leave_type_id = $leave_type_id;
        $model->employee_id = $employee_id;
        
        $leave_type = ArrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
        $leave_request = ArrayHelper::map(LeaveRequest::find()->all(), 'id','comments');
        $employee = ArrayHelper::map(Employee::find()->all(),'id', 'first_name');
        $model_leave_request = LeaveRequest::findOne(['id'=>$leave_request_id]);
        
        $searchModel = new LeaveSearch();
        $dataProvider = $searchModel->search2($employee_id);
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect([
                'create2', 
                'leave_request_id'=>$leave_request_id,
                'leave_type_id'=>$leave_type_id,
                'employee_id'=>$employee_id,
            ]);
        } else {
            return $this->render('create2', [
                'model' => $model,
                'leave_type'=>$leave_type,               
                'leave_request'=>$leave_request,
                'employee'=>$employee, 
                'model_leave_request'=>$model_leave_request,
                'searchModel'=>$searchModel,
                'dataProvider'=>$dataProvider,
                               
            ]);
        }
    }

    /**
     * Updates an existing Leave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Leave model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDelete2($id)
    {
        $request = Yii::$app->request;
        $employee_id = $request->get('employee_id');
        $leave_request_id = $request->get('leave_request_id');
        $leave_type_id = $request->get('leave_type_id');
        $this->findModel($id)->delete();
        
        /*$modelLeave = Leave::findAll([
            'leave_request_id'=>$_REQUEST['leave_request_id'],
            'leave_type_id'=>$_REQUEST['leave_type_id'],
            'employee_id'=>$_REQUEST['employee_id'],
        ]);*/
        

        return $this->redirect([
            'create2', 
            //'model'=>new Leave(),
            'employee_id'=>$employee_id, 
            'leave_request_id'=>$leave_request_id,
            'leave_type_id'=>$leave_type_id,
        ]);
    }

    /**
     * Finds the Leave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
