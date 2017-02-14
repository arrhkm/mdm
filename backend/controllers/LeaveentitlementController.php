<?php

namespace backend\controllers;

use Yii;
use app\models\LeaveEntitlement;
use app\models\LeaveEntitlementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Employee;
use app\models\LeaveType;
//use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\PeriodYear;
use yii\filters\AccessControl;
use app\models\User;

use app\models\CobaForm;//Buta model test CobaForm 

/**
 * LeaveentitlementController implements the CRUD actions for LeaveEntitlement model.
 */
class LeaveentitlementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout', 
                            
                            'index', 
                            'create',
                            'view',
                            'update',
                            'createh1',
                            'delete',
                            'coba',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LeaveEntitlement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeaveEntitlementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LeaveEntitlement model.
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
     * Creates a new LeaveEntitlement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LeaveEntitlement(['scenario'=>LeaveEntitlement::SCENARIO_1]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('create', [
                'model' => $model,               
                'employee'=>$employee,
                'dtLeaveType'=>$dtLeaveType,
                'periodYear'=>$periodYear, 
            ]);
        }
    }

    public function actionCreateh1()
    {
        $model = new LeaveEntitlement(['scenario'=>LeaveEntitlement::SCENARIO_INSERT]);
        $employee2 = Employee::find()->from('employee a')                
                ->innerJoin('user b', 'a.id = b.employee_id')
                ->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $period = split('to', $model->period_year); 
            $user = $this->userEmployeeFind($model->employee_id);
            
            $model->user_id = $user->id;
            
            /*
            // Jika tidak ditemukan data yang redundance pada periode, employee_id dan leave_type_id nya maka
            if (!($this->isRedundanceEntitlement($period[0], $period[1], $model->employee_id, $model->leave_type_id)))
            {
                $model->from_date = $period[0];
                $model->to_date = $period[1];
                $model->createed_by_name = Yii::$app->user->identity->username;
                if ($model->save())
                {
                    return $this->redirect(['view', 'id' => $model->id]);   
                }
            }
            // jika ditemukan maka cetak session ini di layar tampilan
            yii::$app->session->setFlash('error', 'Leave Entitlement for this user already input');
            */
            if ($model->multiple_insert ==true){
                yii::$app->session->setFlash('sucess', 'multiple insert ada');
                $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
                $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
                //$query= Yii::$app->db->createCommand()
                //foreach($employee as $data_emp){
                    
                //}
                $sql= "INSERT INTO leave_entaitlement employee_id, "
                        . "no_of_days, "
                        . "leave_type_id, "
                        . "user_id, "
                        . "from_date, "
                        . "to_date,"
                        . "created_by_name"
                        . "values $employee_id, "
                        . "$model->no_of_days, "
                        . "$model->leave_type_id,"
                        . "$model->user_id, "
                        . "'$period[0]', '$period[1]', "
                        . "'Yii::$app->user->identity->username'";
                
                return $this->render('createh1', [
                    'model' => $model,               
                    'employee'=> $this->listEmployee(),//$employee,
                    'dtLeaveType'=>$dtLeaveType,
                    'periodYear'=>$periodYear,
                    'employee2'=>$employee2,
                ]);
            }
            yii::$app->session->setFlash('error', 'multiple insert tdk terdeteksi');
        }
        
        
        $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
        $periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
        return $this->render('createh1', [
            'model' => $model,               
            'employee'=> $this->listEmployee(),//$employee,
            'dtLeaveType'=>$dtLeaveType,
            'periodYear'=>$periodYear,
            'employee2'=>$employee2,
        ]);
        
    }

    /**
     * Updates an existing LeaveEntitlement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->createed_by_name = Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $employee = arrayHelper::map(Employee::find()->all(), 'id', 'first_name');
            $dtLeaveType = arrayHelper::map(LeaveType::find()->all(), 'id', 'name_type');
            //$periodYear = arrayHelper::map(PeriodYear::find()->all(), 'name_period', 'name_period');
            return $this->render('update', [
                'model' => $model,
                'employee'=>$employee,
                'dtLeaveType'=>$dtLeaveType,

            ]);
        }
    }

    /**
     * Deletes an existing LeaveEntitlement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionCoba()
    {
        $model = new CobaForm();
        /*if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            
            $this->render('coba', [
                'model'=> $model,
            ]);
        
        }*/
       //$username = Yii::$app->request->post(['username']);
       //$password = Yii::$app->request->post('password');
       //$cb = Yii::$app->request->post('cb');
       $model->load(Yii::$app->request->post());
        return $this->render('coba', [
                'model'=> $model,
                //'username'=>$username,
                //'password'=>$password,
                //'cb'=>$cb,
                
            ]);
    }

    /**
     * Finds the LeaveEntitlement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeaveEntitlement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LeaveEntitlement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function userEmployeeFind($employee_id){
        if (($user = User::find()->where(['employee_id'=>$employee_id])->one()) !== null){
            return $user;
        } else {
            throw new NotFoundHttpException('User canot be found is does not exist.');
        }
    }
    
    protected function listEmployee(){
        return $list_emp = arrayHelper::map(Employee::find()
                ->from('employee a')                
                ->innerJoin('user b', 'a.id = b.employee_id')
                ->all(), 'id', 'first_name');
        
    }
    
    protected function isRedundanceEntitlement($start_date, $end_date, $employee_id, $leave_type_id){
        if (($redudanceEntitlement = LeaveEntitlement::find()               
                ->where(['employee_id' => $employee_id, 'from_date' => $start_date, 'to_date' => $end_date, 'leave_type_id' => $leave_type_id])
                ->count()) >= 1) {
            return true;
        } else {
            return false;
        }
    }
}
